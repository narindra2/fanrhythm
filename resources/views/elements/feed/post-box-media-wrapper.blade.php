@php
    $attachment_type = AttachmentHelper::getAttachmentType($attachment->type);
@endphp
@if( !(!$isGallery && $attachment_type == 'video'))
    <a href="{{$attachment->path}}" rel="mswp" title="">
@endif

    @if($isGallery)
            @if($attachment_type == 'image')
                <div class="post-media-image" style="background-image: url('{{$attachment->path}}');">
               
                </div>
            @elseif($attachment_type == 'video')
            <span style="margin-left: 2%;font-size: 13px;"> Video duration : {{$attachment->videoDuration}} </span>
                <div class="video-wrapper h-100 w-100 d-flex justify-content-center align-items-center">
                    <video class="video-preview w-100" src="{{$attachment->path}}" controls controlsList="nodownload"></video>
                </div>
            @elseif($attachment_type == 'audio')
                <div class="video-wrapper h-100 w-100 d-flex justify-content-center align-items-center">
                    <audio class="video-preview w-75" src="{{$attachment->path}}" controls controlsList="nodownload"></audio>
                </div>
            @endif
        @else
            @if($attachment_type == 'image')
                <img src="{{$attachment->path}}" draggable="false" alt="" class="img-fluid rounded-0 w-100">
            @elseif($attachment_type == 'video')
                <span style="margin-left: 2%;font-size: 13px;"> Video duration : {{$attachment->videoDuration}} </span>
                <div class="video-wrapper h-100 w-100 d-flex justify-content-center align-items-center">
                    <video class="video-preview w-100" src="{{$attachment->path}}" controls controlsList="nodownload"></video>
                </div>
            @elseif($attachment_type == 'audio')
               
                <div class="video-wrapper h-100 w-100 d-flex justify-content-center align-items-center">
                    <audio class="video-preview w-75" src="{{$attachment->path}}" controls controlsList="nodownload"></audio>
                </div>
            @endif
        @endif

@if( !(!$isGallery && $attachment_type == 'video'))
    </a>
@endif
