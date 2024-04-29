<?php



namespace App\Http\Controllers;



use Cookie;

use App\User;

use App\Model\Tax;

use ZanySoft\Zip\Zip;

use App\Model\Country;

use Illuminate\Http\Request;

use App\Model\ContactMessage;

use TCG\Voyager\Models\Setting;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Storage;

use App\Providers\EmailsServiceProvider;

use Illuminate\Support\Facades\Redirect;

use App\Providers\InstallerServiceProvider;

use App\Http\Requests\SaveNewContactMessageRequest;



class GenericController extends Controller

{

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function countries()

    {

        // find taxes for all countries

        $allCountriesAppliedTaxes = Tax::query()

            ->select('taxes.*')

            ->join('country_taxes', 'taxes.id', '=', 'country_taxes.tax_id')

            ->join('countries', 'country_taxes.country_id', '=', 'countries.id')

            ->where('countries.name', '=', 'All')->get();



        $countries = Country::query()->where('name', '!=', 'All')->with(['taxes'])->get();

        if(count($allCountriesAppliedTaxes)){

            foreach ($countries as $country){

                foreach ($allCountriesAppliedTaxes as $appliedTax){

                    $country->taxes->add($appliedTax);

                }

            }

        }

        return response()->json([

            'countries'=> $countries,

        ]);

    }



    /**

     * Sets user locale.

     *

     * @param Request $request

     * @return \Illuminate\Http\RedirectResponse

     */

    public function setLanguage(Request $request)

    {

        

        $locale = getSetting('site.default_site_language');

        if(Auth::check()){

            $user = Auth::user();

            $user->settings = collect(array_merge($user->settings->toArray(), ['locale'=> $request->route('locale')]));

            $user->save();

            $locale = $user->settings['locale'];

        }

        else{

            $locale = $request->route('locale');

            Cookie::queue('app_locale', $locale, 356, null, null, null, false, false, null);

        }

        // Resetting cached translation files ( for frontend )

        App::setLocale($locale);

        $langPath = resource_path('lang/'.$locale);

        Session::put('locale', $request->route('locale'));

        if (env('APP_ENV') == 'production') {

            Cache::forget('translations');

            Cache::rememberForever('translations', function () use ($langPath) {

                return file_get_contents($langPath.'.json');

            });

        } else {

            Cache::forget('translations');

            Cache::remember('translations', 5, function () use ($langPath) {

                return file_get_contents($langPath.'.json');

            });

        }

        return redirect()->back();

    }



    /**

     * Contact page main page

     *

     * @param Request $request

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function contact(Request $request){

        return view('pages.contact', []);

    }



    /**

     * Sends contact message

     * @param SaveNewContactMessageRequest $request

     * @return \Illuminate\Http\RedirectResponse

     */

    public function sendContactMessage(SaveNewContactMessageRequest $request){

        ContactMessage::create([

            'email' => $request->get('email'),

            'subject' => $request->get('subject'),

            'message' => $request->get('message'),

        ]);

        if(getSetting('admin.send_notifications_on_contact')){

            // Send admin notifications

            $adminEmails = User::where('role_id', 1)->select(['email', 'name'])->get();

            foreach ($adminEmails as $user) {

                EmailsServiceProvider::sendGenericEmail(

                    [

                        'email' => $user->email,

                        'subject' => __('Action required | New contact message received'),

                        'title' => __('Hello, :name,', ['name' => $user->name]),

                        'content' => __('There is a new contact message on :siteName that requires your attention.', ['siteName' => getSetting('site.name')]),

                        'quote' => $request->get('message'),

                        'replyTo' => $request->get('email'),

                        'button' => [

                            'text' => __('Go to admin'),

                            'url' => route('voyager.dashboard').'/contact-messages',

                        ],

                    ]

                );

            }

        }

        return back()->with('success', __('Message sent.'));

    }

    

        

    /**

     * agreement page main page

     *

     * @param Request $request

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function agreement(){

        return view('pages.agreement');

    }

    public function guidelines(){

        return view('pages.guidelines');

    }

    public function privacy(){

        return view('pages.privacy');

    }

    public function dmca(){

        return view('pages.dmca');

    }

    public function discosureStatement(){

        return view('pages.discosureStatement');

    }





    /**

     * Manually resending verification emails method

     * @return \Illuminate\Http\JsonResponse

     */

    public function resendConfirmationEmail(){

        $user = Auth::user();

        $user->sendEmailVerificationNotification();

        return response()->json(['success' => true, 'message' => __('Verification email sent successfully.')]);

    }



    /**

     * Display the user verify page

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function userVerifyEmail(){

        // dd(Auth::check(),Auth::user()->hasVerifiedEmail());

        if(!Auth::check() || (Auth::check() && Auth::user()->hasVerifiedEmail())){

            return redirect(route('home'));

        }

        return view('vendor.auth.verify', []);

    }



    /**

     * Generates custom theme and saves the new colors to settings table

     * @param Request $request

     * @return \Illuminate\Http\JsonResponse|object

     */

    public function generateCustomTheme(Request $request){

        $themingServer = '/';

        try{

            $response = InstallerServiceProvider::curlGetContent($themingServer.'?'.http_build_query($request->all()));

            $response = json_decode($response);

            if($response->success){

                Setting::where('key','colors.theme_color_code')->update(['value'=>$request->get('color_code')]);

                Setting::where('key','colors.theme_gradient_from')->update(['value'=>$request->get('gradient_from')]);

                Setting::where('key','colors.theme_gradient_to')->update(['value'=>$request->get('gradient_to')]);

                if (extension_loaded('zip')){

                    $contents = InstallerServiceProvider::curlGetContent($themingServer.'/'.$response->path);

                    Storage::disk('tmp')->put('theme.zip', $contents);

                    $zip = Zip::open(storage_path('app/tmp/theme.zip'));

                    $zip->extract(public_path('css/theme/'));

                    Storage::disk('tmp')->delete('theme.zip');

                    return response()->json(['success' => true, 'data'=>['path'=>$response->path, 'doBrowserRedirect' => false], 'message' => __("Theme generated & updated the frontend.")], 200);

                }

                return response()->json(['success' => true, 'data'=>['path'=>$response->path, 'doBrowserRedirect' => true], 'message' => $response->message], 200);

            }

            else{

                return response()->json(['success' => false, 'error'=>$response->error], 500);

            }

        } catch (\Exception $exception) {

            return (object)['success' => false, 'error' => 'Error: "'.$exception->getMessage().'"'];

        }



    }



    /**

     */

    /**

     * Saves license

     * @param Request $request

     * @return \Illuminate\Http\JsonResponse

     */

    public function saveLicense(Request $request){

        try{

            $licenseCode = $request->get('product_license_key');

            $license = InstallerServiceProvider::gld($licenseCode);



            if (isset($license->error)) {

                return response()->json(['success' => false, 'error' => $license->error],500);

            }

            Storage::disk('local')->put('installed', json_encode(array_merge((array)$license,['code'=>$licenseCode])));

            Setting::where('key','license.product_license_key')->update(['value'=>$licenseCode]);

            return response()->json(['success' => true, 'message' => __("License key updated")], 200);

        } catch (\Exception $exception) {

            return response()->json(['success' => false, 'error' => 'Error: "'.$exception->getMessage().'"'],500);

        }

    }

    public function setUserNotActifButOnline(Request $request){
        try {
            $user_id = $request->user_id;
            Cache::forget('user-is-online-' .  $user_id);
            Cache::forget('user-is-offline-' .  $user_id);
            Cache::forget('user-is-offline-at-' .  $user_id);
            Cache::put('user-is-online-but-not-actif-' . $user_id, now()->addMinutes(2));
            return ["success" => true ];
        } catch (\Throwable $th) {
            return ["success" => true ];
        }
    }

}

