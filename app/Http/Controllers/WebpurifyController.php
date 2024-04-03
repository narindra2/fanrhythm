<?php

namespace App\Http\Controllers;

use App\Model\Attachment;
use App\Model\Moderation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebpurifyController extends Controller
{ 
    /** 
     * This method capture the return from  webpurify api for the resukt of analyse of the media
    * Doc is here : https://www.webpurify.com/image-moderation/documentation/results/#callback
    */
   public function callbackReturnCapture(Request $request) {
    $id = DB::table("attachments_moderation_callback")->insertGetId(["data" => serialize($request->all())]);
    if ($id) {
        $this->callbackReturnHandle($request->all(), $id);
    }
   }
   public function callbackReturnHandle($resp = [] , $id = 0)   {
    try {
        if (isset($resp["rsp"]["customvidid"]) && isset($resp["rsp"]["frames"]["frames"]) ) {
            $custom_id = $resp["rsp"]["customvidid"];
            $frames = $resp["rsp"]["frames"]["frames"];
            $status = Moderation::STATUS_APPROVED;
            $rules = Moderation::getDegreeOfCats("post");
            $settig_moderation_status = getSetting("moderations.moderation_status");
            if (!Moderation::isVideoRespectTheModeration($frames , $rules) && $settig_moderation_status == "1" ) {
                $status = Moderation::STATUS_DECLINED;
            }
            Attachment::where("id" ,$custom_id)->update(["moderation_status" =>$status]);
            DB::table("attachments_moderation_callback")->where("id",$id)->update(["status" => "done" , "attachment_id" =>   $custom_id  , "rules" => serialize($rules),"is_actived_verification_moderation" => $settig_moderation_status]);
        }
    } catch (\Throwable $th) {
        if (isset($resp["rsp"]["customvidid"])) {
            $this->retryVericationModeration(isset($resp["rsp"]["customvidid"]));
            DB::table("attachments_moderation_callback")->where("id",$id )->delete();
        }
    }
   }
   public function retryVericationModeration($custom_id = 0) {
        $attachement = Attachment::find($custom_id);
        if ($attachement) {
           Moderation::launchVerificationVideo($attachement->path, $custom_id);
        }
    }
}