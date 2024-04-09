
@if($notLockedPost)
    <a  href="{{asset('/img/no-post.png')}}" data-pswp-width="2000" data-pswp-height="1666" target="_blank">
        <img src="{{asset('/img/no-post.png')}}"  class="image-item"  alt="image" />
        <div class="top-left " style="color: #1a1919b8;;font-size:12px">
            @if ($attachment_type =="image")
                Image
            @endif
            @if ($attachment_type =="video")
                Video duration : {{$attachment->videoDuration}} 
            @endif
        </div>
        <div class="centered-text">
            <button  class="btn btn-sm btn-primary"  
                @if(Auth::check())
                    @if(!GenericHelper::creatorCanEarnMoney($post->user))  data-placement='top' title='{{__("This creator cannot earn money yet")}}' @endif
                    data-toggle='modal'
                    data-target='#login-dialog'
                @endif 
            >
            {{config('app.site.currency_symbol') ?? config('app.site.currency_symbol')}}{{$post->price}}{{config('app.site.currency_symbol') ? '' : '' .config('app.site.currency_code')}}
            </button>
        </div>
    </a>
@else
    @if ($attachment_type =="image")
        <a  href="{{ $attachment->path }}" data-pswp-width="2500" data-pswp-height="1666"  target="_blank">
            <img src="{{ $attachment->path }}"  class="image-item"  alt="image" />
        </a>
     @endif
     @if ($attachment_type =="video")
      <a href="#" 
            data-pswp-video-src="{{ $attachment->path }}"
            data-pswp-width="900"
            data-pswp-height="600"
            data-pswp-type="video">
            <video width="960" class="pswp__video image-item" src="{{ $attachment->path }}" controls></video>
        </a>
     @endif
     {{-- @if($attachment_type == 'audio')
        <a  href="{{ $attachment->path }}" data-pswp-width="2500" data-pswp-height="1666"  target="_blank">
            <div class="video-wrapper h-100 w-100 d-flex justify-content-center align-items-center">
                <audio class="video-preview w-75" src="{{$attachment->path}}" controls controlsList="nodownload"></audio>
            </div>
        </a>
    @endif --}}
@endif

 