<?php

namespace App\Http\Controllers;

use App\User;
use JavaScript;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Model\Country;
use App\Model\Userknow;
use Carbon\CarbonPeriod;
use App\Model\Attachment;
use App\Model\Moderation;
use App\Model\UserDevice;
use App\Model\UserGender;
use App\Model\UserVerify;
use App\Model\Transaction;
use App\Model\CreatorOffer;
use App\Model\Subscription;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Model\UserBillignCard;
use App\Model\ReferralCodeUsage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use App\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Storage;
use App\Providers\EmailsServiceProvider;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUploadRequest;
use App\Providers\AttachmentServiceProvider;
use App\Providers\GenericHelperServiceProvider;
use App\Http\Requests\UpdateUserSettingsRequest;
use App\Http\Requests\AddUserBillingsCardRequest;
use App\Http\Requests\VerifyProfileAssetsRequest;
use App\Http\Requests\UpdateUserFlagSettingsRequest;
use App\Http\Requests\UpdateUserRatesSettingsRequest;
use App\Http\Requests\UpdateUserProfileSettingsRequest;

class SettingsController extends Controller
{
    /**
     * Available settings types.
     * Note*: The values are translated over on view side
     * @var array
     */
    public $availableSettings = [
        'profile' => ['heading' => 'Modifier mon profil', 'icon' => 'person'],
        'account' => ['heading' => 'Informations', 'icon' => 'settings'],
        'wallet' => ['heading' => 'Paiements', 'icon' => 'wallet'],
        'payments' => ['heading' => 'Historique des transactions', 'icon' => 'card'],
        'rates' => ['heading' => 'Gestions des abonnements', 'icon' => 'layers'],
        'subscriptions' => ['heading' => 'Gerer les abonnements', 'icon' => 'people'],
        'referrals' => ['heading' => 'Affiliations', 'icon' => 'person-add'],
        'notifications' => ['heading' => 'Paramètres de notification', 'icon' => 'notifications'],
        'privacy' => ['heading' => 'Paramètres de confidentialité', 'icon' => 'shield'],
        'verify' => ['heading' => 'Vérification de votre compte', 'icon' => 'checkmark'],
        'dashboard' => ['heading' => 'Tableau de bord', 'icon' => 'checkmark'],
    ];

    public function __construct()
    {
        if (getSetting('site.hide_identity_checks')) {
            unset($this->availableSettings['verify']);
        }

        if (!getSetting('referrals.enabled')) {
            unset($this->availableSettings['referrals']);
        }
    }

    /**
     * Check if active route is a valid one, based on setting types.
     *
     * @param $route
     * @return bool
     */
    public function checkIfValidRoute($route)
    {
        if ($route) {
            if (!isset($this->availableSettings[$route])) {
                abort(404);
            }
        }

        return true;
    }

    /**
     * Renders the main settings page.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->checkIfValidRoute($request->route('type'));
        $user = Auth::user();
        $userID = $user->id;
        $data = [];
        switch ($request->route('type')) {
            case 'wallet':
                JavaScript::put([
                    'stripeConfig' => [
                        'stripePublicID' => getSetting('payments.stripe_public_key'),
                        'langConfig' => App::getLocale(),
                    ],
                ]);
                $activeWalletTab = $request->get('active');
                $data['activeTab'] = $activeWalletTab != null ? $activeWalletTab : 'deposit';
                Auth::user()->load(["billingsCard"]);
                // dd(Auth::user()->billingsCard[0]->cardStripe);
                $data['billingsCard'] = Auth::user()->billingsCard;
                break;
            case 'subscriptions':

                // Default tab - active subs
                $activeSubsTab = 'subscriptions';
                if ($request->get('active')) {
                    $activeSubsTab = $request->get('active');
                }

                // Get either active (own) subs or subs paid for
                if ($activeSubsTab == 'subscriptions') {
                    $subscriptions = Subscription::with(['creator'])->where('sender_user_id', $userID)->orderBy('id', 'desc')->paginate(6);
                } else {
                    $subscriptions = Subscription::with(['creator'])->where('recipient_user_id', $userID)->orderBy('id', 'desc')->paginate(6);
                }
                $subscribersCount = Subscription::with(['creator'])->where('recipient_user_id', $userID)->orderBy('id', 'desc')->count();

                $data['subscriptions'] = $subscriptions;
                $data['subscribersCount'] = $subscribersCount;
                $data['activeSubsTab'] = $activeSubsTab;

                break;
            case 'subscribers':
                $subscribers = Subscription::with(['creator'])->where('recipient_user_id', $userID)->orderBy('id', 'desc')->paginate(2);
                $data['subscribers'] = $subscribers;
                break;
            case 'dashboard':
               
                break;
            case 'privacy':
                $devices = UserDevice::where('user_id', $userID)->orderBy('created_at', 'DESC')->get()->map(function ($item) {
                    $agent = new Agent();
                    $agent->setUserAgent($item->agent);
                    $deviceType = 'Desktop';
                    if ($agent->isPhone()) {
                        $deviceType = 'Mobile';
                    }
                    if ($agent->isTablet()) {
                        $deviceType = 'Tablet';
                    }
                    $item->setAttribute('device_type', $deviceType);
                    $item->setAttribute('browser', $agent->browser());
                    $item->setAttribute('device', $agent->device());
                    $item->setAttribute('platform', $agent->platform());
                    return $item;
                });
                $data['devices'] = $devices;
                $data['verifiedDevicesCount'] = UserDevice::where('user_id', $userID)->where('verified_at', '<>', NULL)->count();
                $data['unverifiedDevicesCount'] = UserDevice::where('user_id', $userID)->where('verified_at', NULL)->count();
                $data['countries'] = Country::all();
                JavaScript::put([
                    'userGeoBlocking' => [
                        'countries' => isset(Auth::user()->settings['geoblocked_countries']) ? json_decode(Auth::user()->settings['geoblocked_countries']) : [],
                        'enabled' => getSetting('security.allow_geo_blocking'),
                    ],
                ]);
                break;
            case 'payments':
                $payments = Transaction::with(['receiver', 'sender'])->where('sender_user_id', $userID)->orWhere('recipient_user_id', $userID)->orderBy('id', 'desc')->paginate(6);
                $data['payments'] = $payments;
                break;
            case null:
            case 'profile':
                JavaScript::put([
                    "maxNbSpokenLanguage" => Userknow::MAX_NB_LANGUAGE,
                    'langConfig' => App::getLocale(),
                    'bioConfig' => [
                        'allow_profile_bio_markdown' => getSetting('profiles.allow_profile_bio_markdown'),
                        'allow_profile_bio_markdown_links' => getSetting('profiles.allow_profile_bio_markdown_links'),
                    ],
                ]);
                $data['genders'] = UserGender::all();
                $data['minBirthDate'] = Carbon::now()->subYears(18)->format('Y-m-d');
                $data['spokenlanguage'] = collect(getSpokenlanguage())->sortBy("");
                $data['categories'] = [__("Model"), __("Influenceur(se)"), __("Artiste"),
                __("Photographe") ,__("Coach") ,__("Coach de vie") , __("Coach en nutrition") ,
                __("Coach en séduction") , __("Gamer(se)"),__("Cuisinier") ,__("Lifestyle"),__("Musicien") ,__("Danseur(se)"),
                __("Designeur"),__("Entrepreneur"),__("Figure publique") ,__("Parieur") , __("Journaliste"),__("Chanteur(se)"),
                __("Astrologie & voyance") ,__("Sportif") ,__("Formateur professionel") , __("Professeur"),__("Vidéastre")
                ];
                break;
            case 'referrals':
                if (getSetting('referrals.enabled')) {
                    $data['referrals'] = ReferralCodeUsage::with(['usedBy'])->where(
                        function($q) use ($user) {
                            $q->where('referral_code', $user->referral_code);
                            $q->OrWhere('referral_code', $user->referral_code_type_user);
                        }
                    )->orderBy('id', 'desc')->paginate(6);
                }
                break;
        }

        return $this->renderSettingView($request->route('type'), $data);
    }
    public function getChartDataUser(Request $request) {
       
        $start   = $request->startDate  ? Carbon::make($request->startDate )->format('Y-m-d') : now()->subDays(7)->format('Y-m-d');
        // $start  = '2024-06-06';
        $end =  now()->format('Y-m-d');
        // dd( $start);
        $interval = CarbonPeriod::create($start, $end);
        $datasets = [] ;
        $types =[
            Transaction::TIP_TYPE,
            Transaction::DEPOSIT_TYPE,
            Transaction::CHAT_TIP_TYPE,
            Transaction::POST_UNLOCK,
            Transaction::MESSAGE_UNLOCK,
            Transaction::ONE_MONTH_SUBSCRIPTION,
            Transaction::THREE_MONTHS_SUBSCRIPTION,
            Transaction::SIX_MONTHS_SUBSCRIPTION,
            Transaction::YEARLY_SUBSCRIPTION,
            Transaction::SUBSCRIPTION_RENEWAL,
            // Transaction::STREAM_ACCESS,
        ];
        $trasanctions =Transaction::select(['id','status','recipient_user_id','amount' , 'created_at','type'])
                        ->where('recipient_user_id',Auth::id())
                        ->whereIn('type',$types)
                        ->where('status',Transaction::APPROVED_STATUS)
                        ->whereBetween('created_at', [$start ." 00:00:00",  $end ." 23:59:59"])
                        ->get();
        foreach ($types as $type ) {
            $dataValue = [];
            foreach ($interval as $date) {
                $dataValue[] = $trasanctions->where('type',$type)->filter(function ($transaction) use ( $date) {
                    return $transaction->created_at->format('Y-m-d') == $date->format('Y-m-d') ;
                })->sum('amount');
                
            }
            $datasets[] = ['label' => $type , 'data' => $dataValue ,'fill' => false];
        }
        foreach ($interval as $date ) {
            $labels[] = $date->translatedFormat('d-M');
        }
        $data['labels'] = $labels;
        $data['datasets'] = $datasets;
        $data['currency_code'] = getSetting('payments.currency_code');
    
        return ['success' => true,'chartData'=> $data ,'table'=> view('elements.settings.settings-chart-table' ,$data)->render()];
    }
    /**
     * Renders the selected setting type page.
     *
     * @param $route
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function renderSettingView($route, $data = [])
    {
        /**  Rates setting is only for user verified */
        if (!Auth::user()->isAverifiedUser()) {
            unset($this->availableSettings["rates"]);
        }
        $currentTab = $route ? $route : 'profile';
        $currentSettingTab = $this->availableSettings[$currentTab];
        Javascript::put(
            [
                'mediaSettings' => [
                    'allowed_file_extensions' => '.' . str_replace(',', ',.', AttachmentServiceProvider::filterExtensions('imagesOnly')),
                    'max_file_upload_size' => (int) getSetting('media.max_file_upload_size'),
                    'manual_payments_file_extensions' => '.' . str_replace(',', ',.', AttachmentServiceProvider::filterExtensions('manualPayments')),
                    'manual_payments_excel_icon' => asset('/img/excel-preview.svg'),
                    'manual_payments_pdf_icon' => asset('/img/pdf-preview.svg'),
                ],
            ]
        );

        return view('pages.settings', array_merge(
            $data,
            [
                'availableSettings' => $this->availableSettings,
                'currentSettingTab' => $currentSettingTab,
                'activeSettingsTab' => $currentTab,
                'additionalAssets'   => $this->getAdditionalRouteAssets($route),
            ]
        ));
    }

    /**
     * Custom method for saving profile settings.
     *
     * @param UpdateUserProfileSettingsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveProfile(UpdateUserProfileSettingsRequest $request)
    {
        $validator = $this->validateUsername($request->get('username'));
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $AI_genders = [3];
        if(in_array($request->get('gender'),$AI_genders)){
            $name = "AI_".$request->get('name');
            $username = "AI_". $request->get('username');
        }else{
            $name = str_replace("AI_" , "" ,$request->get('name'));
            $username =str_replace("AI_" , "" ,$request->get('username')); 
        }
        $user = Auth::user();
        $user->update([
            'name' =>  $name,
            'username' =>  $username,
            'bio' => $request->get('bio'),
            'location' => $request->get('location'),
            'website' => $request->get('website'),
            'birthdate' => $request->get('birthdate'),
            'gender_id' => $request->get('gender'),
            'gender_pronoun' => $request->get('pronoun'),
        ]);
        Userknow::updateOrCreate(['user_id'   => $user->id],
            [
                "categories" => collect($request->categories)->take(Userknow::MAX_NB_LANGUAGE)->implode(","),
                "spoken_languages" => collect($request->spoken_languages)->take(Userknow::MAX_NB_LANGUAGE)->implode(",")
            ]
        );
        // return back()->with('success', __('Settings saved.'));
        return Redirect::route('profile',["username" => $user->username])->with('success', __('Settings saved.'));
    }

    private function validateUsername($username)
    {
        $routes = [];

        // You need to iterate over the RouteCollection you receive here
        // to be able to get the paths and add them to the routes list
        foreach (Route::getRoutes() as $route) {
            $routes[] = $route->uri;
        }

        $validator = \Illuminate\Support\Facades\Validator::make(
            ['username' => $username],
            ['username' => 'not_in:' . implode(',', $routes)],
            ['username.*' => __('The selected username is invalid.')]
        );

        return $validator;
    }

    /**
     * Custom method for saving user rates.
     *
     * @param UpdateUserRatesSettingsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveRates(Request $request)
    {
        $user = Auth::user();
        if ($request->get('is_offer')) {
            $offerExpireDate = $request->get('profile_access_offer_date');
            $currentOffer = CreatorOffer::where('user_id', Auth::user()->id)->first();
            $data = [
                'expires_at' => $offerExpireDate,
                'old_profile_access_price' => $user->profile_access_price,
                'old_profile_access_price_6_months' => $user->profile_access_price_6_months,
                'old_profile_access_price_12_months' => $user->profile_access_price_12_months,
                'old_profile_access_price_3_months' => $user->profile_access_price_3_months,
            ];

            if ($currentOffer) {
                $currentOffer->update($data);
            } else {
                $data['user_id'] = $user->id;
                CreatorOffer::create($data);
            }
        } else {
            $currentOffer = CreatorOffer::where('user_id', Auth::user()->id)->first();
            if ($currentOffer) {
                $currentOffer->delete();
            }
        }

        $rules = UpdateUserRatesSettingsRequest::getRules();
        $trimmedRules = [];
        foreach ($rules as $key => $rule) {
            if (($request->get($key) != null) || $key == 'profile_access_price') {
                $trimmedRules[$key] = $rule;
            }
        }
        $request->validate($trimmedRules);
        $user->update([
            "automatic_message_for_new_subscriber" => $request->get('automatic_message_for_new_subscriber'),
            'profile_access_price' => $request->get('profile_access_price'),
            'profile_access_price_6_months' => $request->get('profile_access_price_6_months'),
            'profile_access_price_12_months' => $request->get('profile_access_price_12_months'),
            'profile_access_price_3_months' => $request->get('profile_access_price_3_months'),
        ]);
        return back()->with('success', __('Settings saved.'));
    }

    /**
     * Saves one user flag at the time
     * Used for on the fly custom BS switches used on privacy & notifications settings
     * !Must whitelist all allowed keys to be updated!
     *
     * @param UpdateUserFlagSettingsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateFlagSettings(UpdateUserFlagSettingsRequest $request)
    {
        $user = Auth::user();
        $key = $request->get('key');
        $value = filter_var($request->get('value'), FILTER_VALIDATE_BOOLEAN);
        if (!in_array($key, ['public_profile', 'paid-profile', 'enable_2fa', 'enable_geoblocking', 'open_profile'])) {
            return response()->json(['success' => false, 'message' => __('Settings not saved')]);
        }
        if ($key === 'paid-profile') {
            $key = 'paid_profile';
        }

        if ($key == 'enable_2fa') {
            if ($value) {
                $userDevices = UserDevice::where('user_id', $user->id)->get();
                if (count($userDevices) == 0) {
                    AuthServiceProvider::addNewUserDevice($user->id, true);
                }
            }
        }

        $user->update([
            $key => $value,
        ]);

        return response()->json(['success' => true, 'message' => __('Settings saved')]);
    }

    /**
     * Custom method for saving account (password) settings.
     *
     * @param UpdateUserSettingsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveAccount(UpdateUserSettingsRequest $request)
    {
        Auth::user()->update(['password' => Hash::make($request->input('confirm_password'))]);

        return back()->with('success', __('Settings saved.'));
    }

    /**
     * Method used for injecting additional assets into any desired setting type page.
     *
     * @param $settingRoute
     * @return array
     */
    public function getAdditionalRouteAssets($settingRoute)
    {
        $additionalAssets = ['js' => [], 'css' => []];
        switch ($settingRoute) {
            case 'account':
                $additionalAssets['js'][] = '/js/pages/settings/account.js';
                break;
            case 'wallet':
                $additionalAssets['js'][] = '/js/pages/settings/deposit.js';
                $additionalAssets['js'][] = '/js/pages/settings/withdrawal.js';
                $additionalAssets['css'][] = '/libs/dropzone/dist/dropzone.css';
                $additionalAssets['js'][] = '/libs/dropzone/dist/dropzone.js';
                $additionalAssets['js'][] = '/js/FileUpload.js';
                break;
            case 'profile':
            case null:
                $additionalAssets['css'][] = '/libs/dropzone/dist/dropzone.css';
                $additionalAssets['js'][] = '/libs/dropzone/dist/dropzone.js';
                $additionalAssets['js'][] = '/js/pages/settings/profile.js';
                break;
            case 'privacy':
                $additionalAssets['js'][] = '/js/pages/settings/privacy.js';
                $additionalAssets['js'][] = '/js/pages/settings/notifications.js';
                $additionalAssets['js'][] = '/libs/@selectize/selectize/dist/js/standalone/selectize.min.js';
                $additionalAssets['css'][] = '/libs/@selectize/selectize/dist/css/selectize.css';
                $additionalAssets['css'][] = '/libs/@selectize/selectize/dist/css/selectize.bootstrap4.css';
                break;
            case 'notifications':
                $additionalAssets['js'][] = '/js/pages/settings/notifications.js';
                break;
            case 'subscriptions':
                $additionalAssets['js'][] = '/js/pages/settings/subscriptions.js';
                break;
            case 'verify':
                $additionalAssets['css'][] = '/libs/dropzone/dist/dropzone.css';
                $additionalAssets['js'][] = '/libs/dropzone/dist/dropzone.js';
                $additionalAssets['js'][] = '/js/pages/settings/verify.js';
                $additionalAssets['js'][] = '/js/FileUpload.js';
                break;
            case 'rates':
                $additionalAssets['js'][] = '/js/pages/settings/rates.js';
                break;
            case 'referrals':
                $additionalAssets['js'][] = '/js/pages/settings/referrals.js';
                $additionalAssets['css'][] = '/css/pages/referrals.css';
                break;
        }

        return $additionalAssets;
    }

    /**
     * Method used for uploading and saving the profile assets ( avatar & cover ).
     *
     * @param ProfileUploadRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadProfileAsset(ProfileUploadRequest $request)
    {
        $file = $request->file('file');
        $type = $request->route('uploadType');

        try {
            $directory = 'users/' . $type;
            $s3 = Storage::disk(config('filesystems.defaultFilesystemDriver'));
            $fileId = Uuid::uuid4()->getHex();
            $filePath = $directory . '/' . $fileId . '.' . $file->guessClientExtension();
            $img = Image::make($file);
            if ($type == 'cover') {
                $coverWidth = 599;
                $coverHeight = 180;
                if (getSetting('media.users_covers_size')) {
                    $coverSizes = explode('x', getSetting('media.users_covers_size'));
                    if (isset($coverSizes[0])) {
                        $coverWidth = (int)$coverSizes[0];
                    }
                    if (isset($coverSizes[1])) {
                        $coverHeight = (int)$coverSizes[1];
                    }
                }
                $img->fit($coverWidth, $coverHeight)->orientate();
                $data = ['cover' => $filePath];
            } else {
                $avatarWidth = 96;
                $avatarHeight = 96;
                if (getSetting('media.users_avatars_size')) {
                    $sizes = explode('x', getSetting('media.users_avatars_size'));
                    if (isset($sizes[0])) {
                        $avatarWidth = (int)$sizes[0];
                    }
                    if (isset($sizes[1])) {
                        $avatarHeight = (int)$sizes[1];
                    }
                }
                $img->fit($avatarWidth, $avatarHeight)->orientate();
                $file->storeAs($directory,"original-".$fileId . '.' . $file->guessClientExtension(), 'public');
                $data = ['avatar' => $filePath];
            }
            // Resizing the asset
            $img->encode('jpg', 100);
            // Saving to disk
            $s3->put($filePath, $img, 'public');
           /** Moderation  */
            do {
                $fileId = Uuid::uuid4()->getHex();
            } while (Attachment::query()->where('id', $fileId)->first() != null);
            $attchment =  Attachment::create([
                "id" => Uuid::uuid4()->getHex(),
                "filename" =>  $filePath,
                "moderation_status" => Moderation::STATUS_APPROVED,
                "driver" => 0,
                "type" => "jpg",
                "user_id" => Auth::id(),
            ]);
            $path =  GenericHelperServiceProvider::getStorageAvatarPath($filePath);
            $settingsRules = Moderation::getDegreeOfCats("profile"); // this will return ex:  ["porn" => 98 , "nudity" => 90]
            $result = Moderation::verifieModerationInImage($path, $settingsRules, $attchment);
            if (!Moderation::isRespectTheModeration($result) && getSetting("moderations.moderation_status") == "1") {
                $attchment->update(["moderation_status" => Moderation::STATUS_DECLINED]);
                return response()->json(['success' => false, "isInModeration" => false]);
            }
             /** End moderation  */
             // Saving to user db
            Auth()->user()->update($data);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'errors' => ['file' => $exception->getMessage()]]);
        }
        $assetPath = GenericHelperServiceProvider::getStorageAvatarPath($filePath);
        if ($type == 'cover') {
            $assetPath = GenericHelperServiceProvider::getStorageCoverPath($filePath);
        }
        return response()->json(['success' => true, 'assetSrc' => $assetPath]);
    }

    /**
     * Method used for deleting profile asset from db & storage disk.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeProfileAsset(Request $request)
    {
        $type = $request->route('assetType');
        $data = ['avatar' => ''];
        if ($type == 'cover') {
            $data = ['cover' => ''];
        }
        Auth::user()->update($data);

        return response()->json(['success' => true, 'message' => ucfirst($type) . ' ' . __("removed successfully") . '.', 'data' => [
            'avatar' => Auth::user()->avatar,
            'cover' => Auth::user()->cover,
        ]]);
    }

    /**
     * General method for saving user fields, they must be valid and fillable fields.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUserSettings(Request $request)
    {
        try {
            if (!in_array($request->key, [
                'notification_email_new_post_created',
                'notification_email_new_sub',
                'notification_email_new_message',
                'notification_email_expiring_subs',
                'notification_email_renewals',
                'notification_email_new_tip',
                'notification_email_new_comment',
                'geoblocked_countries'
            ])) {
                return response()->json(['success' => false, 'message' => __('Invalid setting key')]);
            }

            User::where('id', Auth::user()->id)->update([
                'settings' => array_merge(
                    Auth::user()->settings->toArray(),
                    [$request->get('key') => $request->get('value')]
                ),
            ]);

            return response()->json(['success' => true, 'message' => __('Settings saved')]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => __('Settings not saved'), 'error' => $exception->getMessage()]);
        }
    }

    /**
     * Method used for uploading ID check files.
     *
     * @param VerifyProfileAssetsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyUpload(VerifyProfileAssetsRequest $request)
    {
        $file = $request->file('file');
        try {
            $directory = 'users/verifications';
            $s3 = Storage::disk(config('filesystems.defaultFilesystemDriver'));
            $fileId = Uuid::uuid4()->getHex();
            $filePath = $directory . '/' . $fileId . '.' . $file->guessClientExtension();

            $img = Image::make($file);

            // Resizing the asset
            $img->encode('jpg', 100);
            // Saving to disk
            $s3->put($filePath, $img, 'public');

            if ($request->session()->get('verifyAssets')) {
                $data = json_decode($request->session()->get('verifyAssets'));
                $data[] = $filePath;
                session(['verifyAssets' => json_encode($data)]);
            } else {
                $data = [$filePath];
                session(['verifyAssets' => json_encode($data)]);
            }
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'errors' => ['file' => $exception->getMessage()]], 500);
        }

        return response()->json(['success' => true, 'assetSrc' => $filePath]);
    }
    /**
     * Delete ID checks assets.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteVerifyAsset(Request $request)
    {
        try {
            $filePath = $request->get('assetSrc');
            $data = json_decode($request->session()->get('verifyAssets'));
            $newData = array_diff($data, [$filePath]);
            session(['verifyAssets' => json_encode($newData)]);
            $storage = Storage::disk(config('filesystems.defaultFilesystemDriver'));
            $storage->delete($filePath);

            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'errors' => ['file' => $exception->getMessage()]]);
        }
    }

    /**
     * Send ID check to admin for approval.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveVerifyRequest(Request $request)
    {
        // 
        if ($request->session()->get('verifyAssets')) {
            Auth::user()->load("verification");
            if (!Auth::user()->verification) {
                UserVerify::create([
                    'user_id' => Auth::user()->id,
                    'files' => $request->session()->get('verifyAssets'),
                ]);
            } else {
                Auth::user()->verification->update(
                    [
                        'user_id' => Auth::user()->id,
                        'files' => $request->session()->get('verifyAssets'),
                        'status' => 'pending',
                    ]
                );
            }

            // Sending out admin email
            $adminEmails = User::where('role_id', 1)->select(['email', 'name'])->get();
            foreach ($adminEmails as $user) {
                try {
                    EmailsServiceProvider::sendGenericEmail(
                        [
                            'email' => $user->email,
                            'subject' => __('Action required | New identity check'),
                            'title' => __('Hello, :name,', ['name' => $user->name]),
                            'content' => __('There is a new identity check on :siteName that requires your attention.', ['siteName' => getSetting('site.name')]),
                            'button' => [
                                'text' => __('Go to admin'),
                                'url' => route('voyager.dashboard'),
                            ],
                        ]
                    );
                } catch (\Throwable $th) {
                   continue;
                }
            }

            $request->session()->forget('verifyAssets');

            return back()->with('success', __('Request sent. You will be notified once your verification is processed.'));
        } else {
            return back()->with('error', __('Please attach photos with the front and back sides of your ID.'));
        }
    }

    public static function getCountries()
    {
        try {
            $countries = Country::all();
            return response()->json(['success' => true, 'data' => $countries]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => __('Could not fetch countries list.'), 'error' => $exception->getMessage()]);
        }
    }
    // public  function saveCardBillingUser(AddUserBillingsCardRequest $request)
    public  function saveCardBillingUser(Request $request)
    {
        try {
            $auth = Auth::user();
            $auth->load(["billingsCard"]);
            $stripeTokenCard = $request->stripeToken;
            \Stripe\Stripe::setApiKey(getSetting('payments.stripe_secret_key'));
            $customer = \Stripe\Customer::create([
                'email' => $auth->email,
                'source' => $stripeTokenCard["id"],
            ]);
            $data = [
                "name_card" => $request->name_card,
                "user_id" => $auth->id ,
                "customer_info" => json_encode($customer),
                "card_info" => json_encode($stripeTokenCard["card"] ), // save card info 
            ];
            if ($request->active_card == "active" || !$auth->billingsCard) {
                $data["status"] =  1;
                /** Make other card not active*/
                UserBillignCard::where("user_id", $auth->id )->update(["status" => 0]);
            }
            UserBillignCard::create($data);
            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false,  'message' => $exception->getMessage()]);
        }
    }
    public  function activeCardBillingUser(Request $request)
    {
        $card = UserBillignCard::find($request->card_id);
        if ($card &&   Auth::id()  == $card->user_id) {
            UserBillignCard::where("user_id", Auth::id())->update(["status" => 0]);
            $card->update(["status" => 1]);
            $mess = ($card->name_card ?? $card->card_number) . " " .  __('carte est activée');
            back()->with('success', $mess);
            return response()->json(['success' => true]);
        }
        back()->with('success', __('Vous ne pouvez pas faire ça.'));
        return response()->json(['success' => false,  'message' => __('Vous ne pouvez pas faire ça.')]);
    }
    public  function dashboardUser(Request $request)
    {
        dd(true);
    }
}
