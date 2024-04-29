<?php



namespace App\Http\Middleware;



use Cookie;

use Closure;

use Carbon\Carbon;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\Session;

use App\Providers\InstallerServiceProvider;



class LocaleSetter

{

    /**

     * Handle an incoming request.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \Closure  $next

     * @return mixed

     */

    public function handle($request, Closure $next)

    {

        // If user doesn't have a locale, default to settings one, or config one

        

        if (! Session::has('locale')) {

            if (InstallerServiceProvider::checkIfInstalled()) {

                Session::put('locale', getSetting('site.default_site_language'));

            } else {

                Session::put('locale', Config::get('app.locale'));

            }

        }



        // If user has locale setting, use that one

        if (isset(Auth::user()->settings['locale'])) {

            App::setLocale(Auth::user()->settings['locale']);

        } else {

            // If cookie locale is present, use it

            if(Cookie::get('app_locale')){

                App::setLocale(Cookie::get('app_locale'));

            }

            else{

                $preferredLang = explode('-', $request->server('HTTP_ACCEPT_LANGUAGE'))[0] ?? null;

                if($preferredLang){

                    App::setLocale($preferredLang); // If user has missing locale setting - default on site setting

                }

                else{

                    App::setLocale(getSetting('site.default_site_language')); // If user has missing locale setting - default on site setting

                }

            }

        }



//        Custom Carbon language overrides sample

//        $carbonTranslations = Carbon::getTranslator();

//        $carbonTranslations->addResource('array', require base_path('resources/lang/ro/carbon.php'), 'ru');

//        $carbonTranslations->setLocale('ro');



        // Prepping the translation files for frontend usage

        if( Session::has('locale')){

            App::setLocale(Session::get('locale'));

        }

        $appLocal = App::getLocale();

        if(Route::is("register") && $request->ref){

            $appLocal = "en";

            App::setLocale($appLocal);

        }

        $langPath = resource_path('lang/'.$appLocal);

       

        if(!file_exists($langPath.'.json')){

            $langPath = resource_path('lang/en');

        }

        Session::put('translations', file_get_contents($langPath.'.json'));
        return $next($request);

    }

}

