<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Moderation;

class Post extends Model
{


    const PENDING_STATUS = 0;
    const APPROVED_STATUS = 1;
    const DISAPPROVED_STATUS = 2;

    const MAX_NB_PUBLIC_POST = 10;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'text',
        'price',
        'is_public',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /*
     * Relationships
     */

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Model\PostComment');
    }

    public function reactions()
    {
        return $this->hasMany('App\Model\Reaction');
    }

    public function bookmarks()
    {
        return $this->hasMany('App\Model\UserBookmark');
    }

    public function attachments()
    {
        return $this->hasMany('App\Model\Attachment');
    }

    public function transactions()
    {
        return $this->hasMany('App\Model\Transaction');
    }

    public function postPurchases()
    {
        return $this->hasMany('App\Model\Transaction', 'post_id', 'id')->where('status', 'approved')->where('type', 'post-unlock');
    }

    public function tips()
    {
        return $this->hasMany('App\Model\Transaction')->where('type', 'tip')->where('status', 'approved');
    }

    public static function getStatusName($status){
        switch ($status){
            case self::PENDING_STATUS:
                return __("pending");
                break;
            case self::APPROVED_STATUS:
                return __("approved");
                break;
            case self::DISAPPROVED_STATUS:
                return __("disapproved");
                break;
        }
    }
    
    /** This scope return  query post  where all attachements is apporved */
    public function scopeWhereAllAttachementsApproved($query)
    {
        return $query->whereDoesntHave("attachments" , function($attchmntQuery){
            $attchmntQuery->whereIn('moderation_status',[Moderation::STATUS_DECLINED , Moderation::STATUS_PENDING]);
        });
    }
    public  function getModerationStatus(){
        if (!isset($this->moderationStatus)) {
            $this->setModerationStatus();
        }
        return $this->moderationStatus;
    }
    public  function setModerationStatus(){
        if (!$this->attachments) {
            $this->load(["attachments"]);
        }
        $countAttchmt = $this->attachments->count();
        if (!$countAttchmt) {
            $this->setAttribute('moderationStatus',  Moderation::STATUS_APPROVED);
            return;
        }
        $has_disapproved = $this->attachments->firstWhere("moderation_status" ,Moderation::STATUS_DECLINED);
        if ($has_disapproved) {
            $this->setAttribute('moderationStatus',  Moderation::STATUS_DECLINED);
            return;
        }
        $count_pending = $this->attachments->where("moderation_status" ,Moderation::STATUS_PENDING)->count(); 
        if ($count_pending ==  $countAttchmt) {
            $this->setAttribute('moderationStatus',  Moderation::STATUS_PENDING);
            return;
        }
        $this->setAttribute('moderationStatus',  Moderation::STATUS_APPROVED);
    }

  
}
