<?php

namespace App;

use App\Model\Post;
use App\Model\Subscription;
use App\Model\UserList;
use App\Providers\GenericHelperServiceProvider;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class User extends \TCG\Voyager\Models\User implements MustVerifyEmail
{
    use Notifiable;

    const REFERRAL_CODE_TYPE_MODEL = "referral_model";
    const REFERRAL_CODE_TYPE_USER = "referral_user";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'role_id', 'password', 'username', 'bio', 'birthdate', 'location', 'website', 'avatar', 'cover', 'postcode','phone','settings',
        'billing_address', 'first_name', 'last_name', 'profile_access_price',
        'gender_id', 'gender_pronoun',
        'profile_access_price_6_months',
        'profile_access_price_12_months',
        'profile_access_price_3_months',
        "automatic_message_for_new_subscriber",
        'public_profile', 'city', 'country', 'state', 'email_verified_at', 'paid_profile',
        'auth_provider','auth_provider_id', 'enable_2fa', 'enable_geoblocking', 'open_profile', 'referral_code',"referral_code_type_user"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'public_profile' => 'boolean',
        'settings' => 'array',
    ];

    /*
     * Virtual attributes
     */
    public function getAvatarAttribute($value)
    {
        if (env("APP_DEV_LOCAL")) {
            return "https://preview.keenthemes.com/metronic8/demo1/assets/media/svg/illustrations/easy/1.svg" ;
        }
        return GenericHelperServiceProvider::getStorageAvatarPath($value);
    }
    public function getAvatarOriginalAttribute($value)
    {
        $orginal = str_replace("users/avatar/","users/avatar/original-",$this->avatar);
        if ( @getimagesize($orginal) ) {
            return $orginal ;
        } else {
            return $this->avatar;
        }
    }

    public function getCoverAttribute($value)
    {
        if (env("APP_DEV_LOCAL")) {
            return "https://preview.keenthemes.com/metronic8/demo1/assets/media/svg/illustrations/easy/1.svg" ;
        }
        return GenericHelperServiceProvider::getStorageCoverPath($value);
    }


    /**
     * Gets current count of active subscribers
     * @return int
     * @throws \Exception
     */
    public function getFansCountAttribute(){
        $activeSubscriptionsCount = Subscription::query()
            ->where('recipient_user_id', Auth::user()->id)
            ->whereDate('expires_at', '>=', new \DateTime('now', new \DateTimeZone('UTC')))
            ->count('id');

        return $activeSubscriptionsCount;
    }

    /**
     * Gets the count of followers
     * @return int|mixed
     */
    public function getFollowingCountAttribute(){
        $userId = Auth::user()->id;
        $userFollowingMembers = UserList::query()
            ->where(['user_id' => $userId, 'type' => 'followers'])
            ->withCount('members')->first();

        return $userFollowingMembers != null && $userFollowingMembers->members_count > 0 ? $userFollowingMembers->members_count : 0;
    }


    public function getIsActiveCreatorAttribute($value)
    {
        if(getSetting('compliance.monthly_posts_before_inactive')){
            $check = Post::where('user_id', $this->id)->where('created_at','>=',Carbon::now()->subdays(30))->count();
            $hasPassedPreApprovedLimit = true;
            if(getSetting('compliance.admin_approved_posts_limit')){
                $hasPassedPreApprovedLimit = Post::where('user_id', $this->id)->where('status', Post::APPROVED_STATUS)->count();
                $hasPassedPreApprovedLimit = $hasPassedPreApprovedLimit >= (int)getSetting('compliance.admin_approved_posts_limit');
            }
            return ($hasPassedPreApprovedLimit && $check >= (int)getSetting('compliance.monthly_posts_before_inactive'));
        }
        return true;
    }
    public function isAverifiedUser()
    {
        if ($this->isAdmin()) {
            return true;
        }
        if (isset($this->verification)) {
            return  $this->email_verified_at && ($this->verification && $this->verification->status == 'verified');
        }else{
            return $this->email_verified_at && ($this->verification()->where("status", "=" , 'verified')->first());
        }
    }
    public function isAdmin()
    {
        return $this->role_id === 1;
    }
    /** Real status user */
    public function getUserStatus()
    {
        return getUserStatusHelper($this->id);
    }
      /**  Status user info bull  */
    public function getUserStatusHtml($more_margin_left ='' , $more_margin_top ='')
    {
        return getUserStatusHtmlHelper($more_margin_left  , $more_margin_top, $this->id);
    }

    /*
     * Relationships
     */
    public function posts()
    {
        if(getSetting('compliance.admin_approved_posts_limit') > 0) {
            return $this->hasMany('App\Model\Post')->where('status', Post::APPROVED_STATUS);
        } else {
            return $this->hasMany('App\Model\Post');
        }
    }

    public function postComments()
    {
        return $this->hasMany('App\Model\PostComment');
    }

    public function reactions()
    {
        return $this->hasMany('App\Model\Reaction');
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Model\Subscription');
    }

    public function activeSubscriptions()
    {
        return $this->hasMany('App\Model\Subscription', 'sender_user_id')->where('status', 'completed');
    }

    public function activeCanceledSubscriptions()
    {
        return $this->hasMany('App\Model\Subscription', 'sender_user_id')->where('status', 'canceled')->where('expire_at', '<', Carbon::now());
    }

    public function subscribers()
    {
        return $this->hasMany('App\Model\Subscription', 'recipient_user_id');
    }

    public function transactions()
    {
        return $this->hasMany('App\Model\Transaction');
    }

    public function withdrawals()
    {
        return $this->hasMany('App\Model\Withdrawal');
    }

    public function attachments()
    {
        return $this->hasMany('App\Model\Attachment');
    }

    public function lists()
    {
        return $this->hasMany('App\Model\UserList');
    }

    public function bookmarks()
    {
        return $this->hasMany('App\Model\UserBookmark');
    }

    public function wallet()
    {
        return $this->hasOne('App\Model\Wallet');
    }

    public function verification()
    {
        return $this->hasOne('App\Model\UserVerify');
    }

    public function offer()
    {
        return $this->hasOne('App\Model\CreatorOffer');
    }
    public function userKnow()
    {
        return $this->hasOne('App\Model\Userknow');
    }

    public function demoposts()
    {
        return $this->hasMany('App\Model\Demopost');
    }
    public function billingsCard()
    {
        return $this->hasMany('App\Model\UserBillignCard')->orderBy('status', 'desc')->latest();
    }
    public function billingsCardActive()
    {
        return $this->hasOne('App\Model\UserBillignCard')->where('status', 1);
    }

}
