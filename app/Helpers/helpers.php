<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Providers\InstallerServiceProvider;
use App\Providers\GenericHelperServiceProvider;

if (! function_exists('getSetting')) {
    function getSetting($key, $default = null)
    {
        try {
            $dbSetting = TCG\Voyager\Facades\Voyager::setting($key, $default);
        }
        catch (Exception $exception){
            $dbSetting = null;
        }

        $configSetting = config('app.'.$key);
        if ($dbSetting) {
            // If voyager setting is file type, extract the value only
            if (is_string($dbSetting) && strpos($dbSetting, 'download_link')) {
                $file = json_decode($dbSetting);
                if ($file) {
                    $file = Storage::disk(config('filesystems.defaultFilesystemDriver'))->url(str_replace('\\','/',$file[0]->download_link));
                }
                return $file;
            }

            return $dbSetting;
        }
        if ($configSetting) {
            return $configSetting;
        }

        return $default;
    }
}

function getLockCode(){
    if(session()->get(InstallerServiceProvider::$lockCode) == env('APP_KEY')){
        return true;
    }
    else{
        return false;
    }
}

function setLockCode($code){
    $sessData = [];
    $sessData[$code] = env('APP_KEY');
    session($sessData);
    return true;
}

function getUserAvatarAttribute($a){
    return GenericHelperServiceProvider::getStorageAvatarPath($a);
}

function getLicenseType(){
    $licenseType = 'Unlicensed';
    if(file_exists(storage_path('app/installed'))){
        $licenseV = json_decode(file_get_contents(storage_path('app/installed')));
        if(isset($licenseV->data) && isset($licenseV->data->license)){
            $licenseType = $licenseV->data->license;
        }
    }
    return $licenseType;
}

function handledExec($command, $throw_exception = true) {
    $result = exec('('.$command.')', $output, $return_code);
    if ($throw_exception) {
        if (($result === false) || ($return_code !== 0)) {
            throw new Exception('Error processing command: ' . $command . "\n\n" . implode("\n", $output) . "\n\n");
        }
    }
    return implode("\n", $output);
}

if (!function_exists('convert_to_real_time_humains')) {
    function convert_to_real_time_humains($dateTime = "", $format = "d-m-Y", $with_time = true)
    {

        if (!$dateTime) {
            return null;
        }
        $humains_date = null;
        $date = Carbon::make($dateTime);
        if ($date->isToday()) {
            return $date->diffForHumans();
        } elseif ($date->isYesterday()) {
            $humains_date = __("Hier") . ($with_time ? __("à") : "");
        } elseif ($date->format($format) ==  Carbon::tomorrow()->format($format)) {
            $humains_date = __("Démain")  . ($with_time ? " à partir"  : "");;
        } else {
            return " ". $date->format($format . ($with_time ? " H:i" : ""));
        }
        return  $humains_date . " " . ($with_time  ? $date->format("H:i") : "");
    }
}
if (!function_exists('getUserStatusHelper')) {
    function getUserStatusHelper($user_id = 0)
    {
        if (!Auth::check() || !$user_id) {
            return "unknow"; 
        }
        if (Cache::get("user-is-online-$user_id")) {
            return "online";
        }else if(Cache::get("user-is-offline-$user_id")){
            return "offline";
        }else if(Cache::get("user-is-online-but-not-actif-$user_id")){
            return "not-actif";
        }else {
            return "offline";
        }
       
    }
}
if (!function_exists('getUserStatusHtmlHelper')) {
    function getUserStatusHtmlHelper($more_margin_left = "" , $more_margin_top ='' , $user_id = 0)
    {
        $status = getUserStatusHelper($user_id);
        if ($status == "unknow") {
            return "";
        }
        $style_custom = "";
        if ($more_margin_left) {
            $more_margin_left = "margin-left: $more_margin_left !important; ";
        }
        if ($more_margin_top ) {
            $more_margin_top = "margin-top: $more_margin_top !important;";
        }
        if ($more_margin_left ||  $more_margin_top ) {
            $style_custom = "style=' $more_margin_left   $more_margin_top'";
        }
        if ( $status == "online") {
           return  "<span  $style_custom  class='user-status-circle-online'></span>";
        }else if( $status == "offline"){
            return  "<span $style_custom  class='user-status-circle-offline'></span>";

        }else if( $status == "not-actif"){
            return  "<span  $style_custom  class='user-status-circle-not-actif'></span>";
        }else{
            return  "<span  $style_custom  class='user-status-circle-offline'></span>";
        }
    }
}
if (!function_exists('getSpokenlanguage')) {
    function getSpokenlanguage()
    {
        return [
            "English",
            "French",
            "Spanish",
            "Arabic",
            "Chinese",
            "Japanese",
            "Hindi",
            "Russian",
            "German",
            "Bengali",
            "Portuguese",
            "Javanese",
            "Italian",
            "Telugu",
            "Marathi",
            "Urdu",
            "Tamil",
            "Vietnamese",
            "Korean",
            "Hausa",
            "Gujarati",
            "Malay",
            "Pashto",
            "Tagalog",
            "Oriya",
            "Malayalam",
        ];
        // return [
        //     "Afar",
        //     "Abkhaze",
        //     "Avestique",
        //     "Afrikaans",
        //     "Akan",
        //     "Amharique",
        //     "Aragonais",
        //     "Arabe",
        //     "Assamais",
        //     "Avar",
        //     "Aymara",
        //     "Azéri",
        //     "Bachkir",
        //     "Biélorusse",
        //     "Bulgare",
        //     "Bihari",
        //     "Bichelamar",
        //     "Bambara",
        //     "Bengali",
        //     "Tibétain",
        //     "Tibétain",
        //     "Bosnien",
        //     "Catalan",
        //     "Tchétchène",
        //     "Chamorro",
        //     "Corse",
        //     "Cri",
        //     "Tchèque",
        //     "Vieux-slave",
        //     "Tchouvache",
        //     "Gallois",
        //     "Danois",
        //     "Allemand",
        //     "Maldivien",
        //     "Dzongkha",
        //     "Ewe",
        //     "Grec moderne",
        //     "Anglais",
        //     "Espéranto",
        //     "Espagnol",
        //     "Basque",
        //     "Persan",
        //     "Peul",
        //     "Finnois",
        //     "Fidjien",
        //     "Féroïen",
        //     "Français",
        //     "Frison occidental",
        //     "Irlandais",
        //     "Écossais",
        //     "Galicien",
        //     "Guarani",
        //     "Gujarati",
        //     "Mannois",
        //     "Haoussa",
        //     "Hébreu",
        //     "Hindi",
        //     "Hiri motu",
        //     "Croate",
        //     "Créole haïtien",
        //     "Hongrois",
        //     "Arménien",
        //     "Héréro",
        //     "Interlingua",
        //     "Indonésien",
        //     "Igbo",
        //     "Yi",
        //     "Inupiak",
        //     "Ido",
        //     "Islandais",
        //     "Italien",
        //     "Inuktitut",
        //     "Javanais",
        //     "Géorgien",
        //     "Kikongo",
        //     "Kikuyu",
        //     "Kuanyama",
        //     "Kazakh",
        //     "Groenlandais",
        //     "Khmer",
        //     "Coréen",
        //     "Kanouri",
        //     "Cachemiri",
        //     "Kurde",
        //     "Komi",
        //     "Cornique",
        //     "Kirghiz",
        //     "Latin",
        //     "Luxembourgeois",
        //     "Ganda",
        //     "Limbourgeois",
        //     "Lingala",
        //     "Lao",
        //     "Lituanien",
        //     "Luba-katanga",
        //     "Letton",
        //     "Marshallais",
        //     "Maori de Nouvelle-Zélande",
        //     "Macédonien",
        //     "Malayalam",
        //     "Mongol",
        //     "Moldave",
        //     "Marathi",
        //     "Malais",
        //     "Maltais",
        //     "Birman",
        //     "Nauruan",
        //     "Norvégien Bokmål",
        //     "Sindebele",
        //     "Népalais",
        //     "Ndonga",
        //     "Néerlandais",
        //     "Norvégien Nynorsk",
        //     "Norvégien",
        //     "Nrebele",
        //     "Navajo",
        //     "Chichewa",
        //     "Occitan",
        //     "Ojibwé",
        //     "Ojibwé",
        //     "Ojibwé",
        //     "Ossète",
        //     "Pendjabi",
        //     "Pali",
        //     "Polonais",
        //     "Pachto",
        //     "Portugais",
        //     "Quechua",
        //     "Créole Réunionnais",
        //     "Romanche",
        //     "Kirundi",
        //     "Roumain",
        //     "Russe",
        //     "Kinyarwanda",
        //     "Sanskrit",
        //     "Sarde",
        //     "Sindhi",
        //     "Same du Nord",
        //     "Serbo-croate",
        //     "Cingalais",
        //     "Slovaque",
        //     "Slovène",
        //     "Samoan",
        //     "Shona",
        //     "Somali",
        //     "Albanais",
        //     "Serbe",
        //     "Swati",
        //     "Sotho du Sud",
        //     "Soundanais",
        //     "Soundanais",
        //     "Swahili",
        //     "Tamoul",
        //     "Télougou",
        //     "Tadjik",
        //     "Thaï",
        //     "Tigrigna",
        //     "Turkmène",
        //     "Tagalog",
        //     "Tswana",
        //     "Tongien",
        //     "Turc",
        //     "Tsonga",
        //     "Tatar",
        //     "Twi",
        //     "Tahitien",
        //     "Ouïghour",
        //     "Tongien",
        //     "ToUkrainienngien",
        //     "Ourdou",
        //     "Ouzbek",
        //     "Tongien",
        //     "Venda",
        //     "Vietnamien",
        //     "Volapük",
        //     "Wallon",
        //     "Wolof",
        //     "Xhosa",
        //     "Yiddish",
        //     "Yoruba",
        //     "Zhuang",
        //     "Chinois",
        //     "Zoulou",
        // ];
    }
}
