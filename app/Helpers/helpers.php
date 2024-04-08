<?php

use Carbon\Carbon;
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
