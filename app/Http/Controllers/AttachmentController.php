<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Model\Attachment;
use App\Model\Moderation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Providers\AttachmentServiceProvider;
use App\Http\Requests\UploadAttachamentRequest;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;

class AttachmentController extends Controller
{

    /**
     * Process the attachment and upload it to the selected storage driver.
     *
     * @param UploadAttachamentRequest $request
     * @param bool $type Dummy param to follow route parameters
     * @param bool $chunkedFile If using chunk uploads, this final chunked file is sent over this request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(UploadAttachamentRequest $request, $type = false, $chunkedFile = false)
    {
        ini_set("upload_max_filesize", "2048M");
        ini_set("post_max_size", "2048M");
        if ($chunkedFile) {
            $file = $chunkedFile;
        } else {
            $file = $request->file('file');
        }
        $type = $request->route('type');

        $fileMimeType = $file->getMimeType();
        try {
            switch ($fileMimeType) {
                case 'video/mp4':
                case 'video/avi':
                case 'video/quicktime':
                case 'video/x-m4v':
                case 'video/mpeg':
                case 'video/wmw':
                case 'video/x-matroska':
                case 'video/x-ms-asf':
                case 'video/x-ms-wmv':
                case 'video/x-ms-wmx':
                case 'video/x-ms-wvx':
                    $directory = 'videos';
                    break;
                case 'audio/mpeg':
                case 'audio/ogg':
                case 'audio/wav':
                    $directory = 'audio';
                    break;
                case 'application/vnd.ms-excel':
                case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                case 'application/pdf':
                    $directory = 'documents';
                    break;
                default:
                    $directory = 'images';
                    break;
            }
            $generateThumbnail = false;
            $settingsCatsModerationOn = null;
            if ($type == 'post') {
                $directory = 'posts/' . $directory;
                $settingsCatsModerationOn = $type;
                $generateThumbnail = true;
            } elseif ($type == 'message') {
                $directory = 'messenger/' . $directory;
                $generateThumbnail = true;
                $settingsCatsModerationOn = $type;
            } elseif ($type == 'payment-request') {
                $directory = 'payment-request/' . $directory;
            }

            $attachment = AttachmentServiceProvider::createAttachment($file, $directory, $generateThumbnail);

            if ($chunkedFile) {
                unlink($file->getPathname());
            }

            $isInModeration = true;
            $path = $attachment->path;
            $type =  AttachmentServiceProvider::getAttachmentType($attachment->type);
            $attachment->moderation_status = Moderation::STATUS_APPROVED;
            $moderation_status_setting= getSetting("moderations.moderation_status") ;
            // $path = "https://web.fanrhythm.com/storage/users/cover/a69b06b137774f4dbbc6e6c0e7ae1911.jpg"; //This a exemaple a image content porn 90.99 of degree
            if ($type  == "image" ) {
                $settingsRules = Moderation::getDegreeOfCats($settingsCatsModerationOn); // this will return ex:  ["porn" => 98 , "nudity" => 90]
                $result = Moderation::verifieModerationInImage($path, $settingsRules, $attachment);
                if (!Moderation::isRespectTheModeration($result) && $moderation_status_setting == "1") {
                    $attachment->moderation_status = Moderation::STATUS_DECLINED;
                    $isInModeration = false;
                } 
            }
            if ($type == "video") {
                dispatch(function () use ($path, $attachment, $settingsCatsModerationOn) {
                    Moderation::launchVerificationVideo($path, $attachment->id, $settingsCatsModerationOn);
                })->afterResponse();
                if ($moderation_status_setting == "1") {
                    $attachment->moderation_status = Moderation::STATUS_PENDING;
                }
            }
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'errors' => [$exception->getMessage()]], 500);
        }
        dispatch(function () use ( $attachment) {
            $attachment->save();
        })->afterResponse();
        $attachment->save();
        $attachmentID =  $attachment->id;
        $thumbnail =  AttachmentServiceProvider::getThumbnailPathForAttachmentByResolution($attachment, 150, 150);
        return response()->json([
            'success' => true,
            'attachmentID' => $attachmentID,
            'path' => Storage::url($attachment->filename),
            'type' =>  $type,
            'isInModeration' => $isInModeration,
            'thumbnail' => $thumbnail,
        ]);
    }

    /**
     * Chunk uploadining method
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws UploadMissingFileException
     * @throws \Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException
     */
    public function uploadChunk(Request $request, $type = false)
    {
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }
        $save = $receiver->receive();
        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            $saveRequest = new UploadAttachamentRequest(['file' => $save->getFile()]);
            $saveRequest->validate($saveRequest->rules());
            return $this->upload($saveRequest, $type, $save->getFile());
        }
        // we are in chunk mode, lets send the current progress
        $handler = $save->handler();
        return response()->json(['success' => true, 'data' => ['percentage' => $handler->getPercentageDone()]]);
    }

    /**
     * Removes attachment out of db & out of the storage driver.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeAttachment(Request $request)
    {
        try {
            $attachment = Attachment::where('id', $request->get('attachmentId'))->first();
            if ($attachment != null) {
                AttachmentServiceProvider::removeAttachment($attachment);
                $attachment->delete();
            }
            return response()->json(['success' => true, 'data' => [__('Attachments removed successfully')]]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'errors' => [$exception->getMessage()]]);
        }
    }
    public function upload2(Request $request)
    {
        $file = $request->file("file");
        $extension = $file->getClientOriginalExtension();

        $size = $file->getSize(); // kB;
        $file_info = [];
        if (!$file) {
            return $file_info;
        }
        $real_storage = storage_path("app/public/test-upload" );

        $name = Str::uuid() . '.' . $extension;

        ini_set("upload_max_filesize", "2048M");
        ini_set("post_max_size", "2048M");
        $file->move($real_storage, $name);
        if ($name) {
            $file_info["name"] = $name;
            $file_info["size"] = $size;
            $file_info["extension"] = $extension;
            $file_info["originale_name"] = $file->getClientOriginalName();
            if (Auth::check()) {
                $file_info["created_by"] = Auth::id();
            }
            return $file_info;
        }
    }
    public function moderationResult(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return abort(404);
        }
        $query = Attachment::select("id", "moderation_status", "user_id", "created_at", "filename", "type");
        if ($request->status) {
            $query->where("moderation_status", $request->status);
        }
        // $start = '01/' . now()->format('m/Y');
        // $end =  now()->format('d/m/Y');
        if ($request->interval) {
            $interval = explode("-", str_replace(" ", "", $request->interval));
            $start =  Carbon::make(str_replace("/", "-", $interval[0]))->format("Y-m-d");
            $end =   Carbon::make(str_replace("/", "-", $interval[1]))->format("Y-m-d");
            $query->whereBetween("created_at", [$start, $end]);
        }
        if ($request->search) {
            $query->whereHas('user', function ($query) use ($request) {
                $query->Where('username', 'like', '%' . $request->search . '%');
            });
        }
        $attachments = $query->with(["user:id,username", "moderationResult"])->latest()->paginate(6);
        return view('vendor.voyager.attachment-moderation.index', ["attachments" => $attachments]);
    }
}
