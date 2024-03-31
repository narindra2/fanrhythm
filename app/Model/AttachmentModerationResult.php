<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentModerationResult extends Model
{
    use HasFactory;
    public $table = "attachments_moderation_callback";

    protected $appends = ["type", 'resultScan', "rulesSetting", "score", "reasonOfDeclined","is_actived_verification_moderation"];

    public function getResultScanAttribute()
    {
        if ($this->data) {
            $scan = unserialize($this->data);
            if (isset($scan["rsp"])) {
                return $scan["rsp"];
            }
            return  $scan;
        }
    }
    public function getRulesSettingAttribute()
    {
        if ($this->rules) {
            // dd($this->rules);
            return unserialize($this->rules);
        }
    }
    public function getTypeAttribute()
    {
        if (isset($this->resultScan["frames"])) {
            return "video";
        }
        return "image";
    }
    public function getScoreAttribute()
    {
        // if (condition) {
        //     # code...
        // }
        if ($this->type == "image") {
            /** Images scan result */
            return collect($this->resultScan)->only(array_keys(Moderation::availableCats))->toArray();
        } else {
            /** Videos scan result */
            $scores = [];
            $cats = array_keys(Moderation::availableCats);
            foreach ($cats as $cat_name) {
                $max = collect( $this->resultScan["frames"]["frames"])->max($cat_name);
                if ($max !=null) {
                    $scores[$cat_name] = $max ;
                }
            }
            return $scores;
        }
    }
    public function reasonOfDeclined($status = "")
    {
        /** All accepted or if the verifcation of moderation was disabled  are no reason to Declined */
        if ($status != Moderation::STATUS_DECLINED || $this->is_actived_verification_moderation != "1" ) {
            return [];
        }
        $rules = $this->rulesSetting;
        $scan_result = $this->score;
        $reasons =  [];
        /** * $normal_degree is value in setting  and $result_degree is value from scan  Api  */
        foreach ($rules  as $cat_name => $normal_degree) {
            if (array_key_exists($cat_name, $scan_result)) {
                $result_degree =  $scan_result[$cat_name];
                if ((float) $normal_degree < (float) $result_degree) {
                    $reasons[] =  "$cat_name : $result_degree%";
                }
            }
        }
        return $reasons;
    }
}
