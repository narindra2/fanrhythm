<?php



namespace App\Model;



use Illuminate\Support\Facades\Cache;

use Illuminate\Database\Eloquent\Model;

use App\Providers\AttachmentServiceProvider;

use App\Providers\GenericHelperServiceProvider;



class Attachment extends Model

{

  

    const PUBLIC_DRIVER = 0;

    const S3_DRIVER = 1;

    const WAS_DRIVER = 2;

    const DO_DRIVER = 3;

    const MINIO_DRIVER = 4;



    // Disable auto incrementing as we set the id manually (uuid)

    public $incrementing = false;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'user_id', 'post_id', 'filename', 'type', 'id', 'driver', 'payment_request_id',"moderation_status"

    ];



    protected $appends = ['attachmentType', 'path', 'thumbnail',"videoDuration"];



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

        'id' => 'string',

    ];



    /*

     * Virtual attributes

     */



    public function getAttachmentTypeAttribute()

    {

        return AttachmentServiceProvider::getAttachmentType($this->type);

    }

    public function getVideoDurationAttribute()

    {

        if($this->attachmentType == "video" ){

                 try {

                    $SongPath = storage_path("app/public/$this->filename");

                    $getID3 = new \getID3;

                    $ThisFileInfo = $getID3->analyze($SongPath);

                    $string = explode(":",$ThisFileInfo["playtime_string"]);

                    $count  = count($string);

                    try {

                        if ($count == 2) {

                            return "$string[0]min$string[1]s";

                        }elseif($count == 3){

                            return "$string[0]h$string[1]min$string[2]s";

                        }else{

                            return$ThisFileInfo["playtime_string"];

                        }

                    } catch (\Throwable $th) {

                        return$ThisFileInfo["playtime_string"];

                    }

                    

                } catch (\Throwable $th) {

                    return "Unread";

                }

        }

        

    }



    public function getPathAttribute()

    {   

        if ( !$this->post_id &&  !$this->message_id && !$this->payment_request_id ) {

            /** attachmt avatr */

            // return GenericHelperServiceProvider::getStorageAvatarPath($this->filename);

            return url("storage/$this->filename");

            return GenericHelperServiceProvider::getStorageAvatarPath($this->filename);

        }
        return str_replace('/public',""  ,AttachmentServiceProvider::getFilePathByAttachment($this)) ;
        return AttachmentServiceProvider::getFilePathByAttachment($this);

    }



    public function getThumbnailAttribute()

    {

        if ($this->message_id) {

            $path = '/messenger/images/';

        } else {

            $path = '/posts/images/';

        }



        return AttachmentServiceProvider::getThumbnailPathForAttachmentByResolution($this, 150, 150, $path);

    }



    /*

     * Relationships

     */



    public function user()

    {

        return $this->belongsTo('App\User', 'user_id');

    }



    public function post()

    {

        return $this->belongsTo('App\Model\Post', 'post_id');

    }



    public function paymentRequest()

    {

        return $this->belongsTo('App\Model\PaymentRequest', 'payment_request_id');

    }

    public function moderationResult()

    {

        return $this->hasOne('App\Model\AttachmentModerationResult', 'attachment_id');

    }

}

