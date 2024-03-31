<?php

namespace App\Model;

use App\Model\Attachment;
use Illuminate\Support\Facades\DB;

class Moderation
{
    /** 
     * Cats of dection 
     * doc here https://www.webpurify.com/image-moderation/documentation/methods/aim-imgcheck-2/
     */
    public const  availableCats = [
        "porn" => 90, // Detects images that contain commercial pornography, amateur pornography, sexting selfies, nudity, sex acts, greyscale pornographic images, sexually explicit cartoons and manga.
        "nudity" => 90, // Detects images that contain commercial pornography, amateur pornography, sexting selfies, nudity, sex acts, greyscale pornographic images, sexually explicit cartoons and manga.
        "extremism" => 90, //Detects images containing extremism militants, beheadings, executions, propaganda, acts of extremism, flags and insignia. 
        "csam" => 90,  //Detects Child Sexual Abuse Material
        "weapons" => 90, //Detects images containing handheld weapons such as rifles, machine guns, hand guns, knives, swords, grenade launchers and people holding firearms.
        "gore" => 90, //Detects images containing graphic violence, bloody wounds, accident victims,beatings, mutilation, decapitation and other images that contain blood and guts.
        "drugs" => 90, //Detects images containing illegal drugs, drug use, drug paraphernalia, plants and symbols relating to drugs.
        "gestures" => 25, // Images containing middle finger hand gestures.
        "underwear" => 90, // Detects images containing people wearing swimsuit, bikinis, underwear, bras,panties and lingerie.
        "alcohol" => 90, // Alcoholic brands and beverages, people drinking alcohol, frat parties, keg stands,bars and nightclubs, party aftermaths, shots, beer pong, kegs, and plastic cups  associated with drinking.
        "minor" => 60, // Detects presence probability of a minor
    ];
    public const STATUS_PENDING = "pending";
    public const STATUS_APPROVED = "approved";
    public const STATUS_DECLINED = "declined";

    /**
     * Eject all post not Approved by 
     */
    static function filterPostsOnlyApproved($posts)
    {
        $posts->filter(function ($post, $key) use (&$posts) {
            if ($post->moderationStatus !== Moderation::STATUS_APPROVED) {
                $posts->forget($key);
            }
        });
    }

    /**
     * get Degree Of Cats from settigs 
     */

    static function getDegreeOfCats($type = "")
    {
        $catsDegree = [];
        if (!$type) {
            return $catsDegree;
        }
        $settings = DB::table("settings")->where("group", "=", "Moderations")->where('key', 'like', '%' . $type . '%')->get();
        foreach ($settings as $setting) {
            $category_name = str_replace("moderations." . $type . "_", "", $setting->key);
            if (in_array($category_name, array_keys(self::availableCats))) {
                $catsDegree[$category_name] =  $setting->value;
            }
        }
        return  $catsDegree;
    }
    static function verifieModerationInImage($media_url = "", $rules = [],  $attachment = null)
    {
        $result = [];
        $rules = !count($rules) ? self::availableCats :  $rules;
        $cats = $rules;
        if (key_exists("minor", $cats)) {
            $cats["face-description"] = "0";
            unset($cats["minor"]);
        }
        $cats = implode(",", array_keys($cats));
        try {
            $response = self::launchVerification($media_url, $cats);
        } catch (\Throwable $th) {
            // There are bug errors sometimes we have to do it again
            return  self::retryVerifieModerationInImage($media_url, $rules, $attachment);
        }
        if ($attachment) {
            DB::table("attachments_moderation_callback")->updateOrInsert(["attachment_id" => $attachment->id], ["status" => "done" ,"data" => serialize($response),  "rules" => serialize($rules) ,"is_actived_verification_moderation" => getSetting("moderations.moderation_status")]);
        }
        foreach ($rules  as $cat_name => $normal_degree) {
            if (array_key_exists($cat_name, $response)) {
                $result_degree =  $response[$cat_name];
                if ((float) $normal_degree < (float) $result_degree) {
                    $result[$cat_name] = true;
                } else {
                    $result[$cat_name] = false;
                }
            }
        }
        return $result;
    }

    static function  retryVerifieModerationInImage($media_url = "", $rules = [],  $attachment = null)
    {
        return self::verifieModerationInImage($media_url, $rules, $attachment);
    }
    static function  isRespectTheModeration($result = [])
    {
        foreach ($result as $key => $exceed_rule) {
            // if once in category was broken it breaks the rule and returns false
            if ($exceed_rule == true) {
                return false;
            }
        }
        return true;
    }
    static function isVideoRespectTheModeration($frames_results  = [], $rules = [])
    {
        foreach ($frames_results as $frame) {
            foreach ($frame as $cat_name => $result_degree) {
                if (array_key_exists($cat_name, $rules)) {
                    $normal_degree =  $rules[$cat_name];
                    if ((float) $normal_degree < (float) $result_degree) {
                        return false;
                    }
                }
            }
        }
        return true;
    }
    /**
     * example response 
     * "porn" => "99.89"
     * "extremism" => "0.36"
     * "alcohol" => "0.20"
     * "gambling" => "0.09"
     *  "underwear" => "21.82"
     *  "gore" => "94.74"
     *  "drugs" => "21.00"
     */
    static function  launchVerification($media_url = "", $cats = "")
    {
        $api_key = env("API_KEY_WEBPURIFY");
        $checkurl = "https://im-api1.webpurify.com/v2/services/rest/?method=webpurify.aim.imgcheck&api_key=$api_key&cats=$cats&imgurl=$media_url";
        $checkurl2 = "http://im-api1.webpurify.com/services/rest/?method=webpurify.aim.imgcheck&api_key=$api_key&imgurl=$media_url";

        $response = simplexml_load_file($checkurl, 'SimpleXMLElement', LIBXML_NOCDATA);
        $response2 = simplexml_load_file($checkurl2, 'SimpleXMLElement', LIBXML_NOCDATA);

        $response = json_encode($response);
        $response2 = json_encode($response2);

        $response = json_decode($response, TRUE);
        if (isset($response["face_details"]) &&  isset($response["face_details"]["face_detail"])) {
            $faces = $response["face_details"]["face_detail"];
            if (isset($faces["female"])) {
                $response["female"] = $faces["female"];
            }
            if (isset($faces["male"])) {
                $response["male"] = $faces["male"];
            }
            if (isset($faces["minor"])) {
                $response["minor"] = $faces["minor"];
            }
            unset($response["face_details"]);
        }
        $response2 =  json_decode($response2, TRUE);
        return array_merge($response, $response2);
    }
    static function  launchVerificationVideo($media_url = "",  $custom_id = "", $type = "post")
    {
        $cats = [];
        $settings = DB::table("settings")->where("group", "=", "Moderations")->where('key', 'like', '%' . $type . '%')->get();
        foreach ($settings as $setting) {
            $cat_name = str_replace("moderations." . $type . "_", "", $setting->key);
            if ($cat_name == "minor") {
                $cats[] = "face-description";
            } else {
                $cats[] = $cat_name;
            }
        }
        $cats = implode(",", $cats);
        $method = "webpurify.aim.vidcheck";
        $api_key = env("API_KEY_WEBPURIFY_VIDEO");
        // $callbackUrl ="https://web.fanrhythm.com/api/webpurify";
        $callbackUrl = url("api/webpurify");
        $ch = curl_init();
        // try {
        curl_setopt($ch, CURLOPT_URL, "https://vid-api1.webpurify.com/v2/services/rest/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "cats=$cats&api_key=$api_key&method=$method&vidurl=$media_url&customvidid=$custom_id&callback=$callbackUrl");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        // } catch (\Exception $ex) {

        // }
    }
    static function  launchVerificationText($text = "")
    {
        $api_key = env("API_KEY_WEBPURIFY_TEXT");
        $data = [];
        $checkurl = "http://api1.webpurify.com/services/rest/?method=webpurify.live.return&api_key=$api_key&format=json&text=".urlencode($text);
        $scanResponse = json_decode(file_get_contents($checkurl),true);
        if (isset($scanResponse["rsp"])) {
            if (isset($scanResponse["rsp"]["err"]) ) {
                $data["error"] = $scanResponse["rsp"]["err"]["@attributes"]["code"] . " " . $scanResponse["rsp"]["err"]["@attributes"]["msg"];
            }else{
                $resp = $scanResponse["rsp"];
                if((int) $resp["found"]){
                    $data = ["foundCount" => (int) $resp["found"] , "badText" => $resp["expletive"]];
                }else{
                    $data = ["foundCount" => 0 , "badText" =>  null];
                }
            } 
            return $data;
        }
    }
    
}
