
@if($notLockedPost)
@php
    $attchmt_type_info = "";
    if ($attachment_type =="image") {
        $attchmt_type_info = "Image";
    }
    if($attachment_type =="video"){
        $attchmt_type_info = " Video duration : " .  $attachment->videoDuration;
    }
@endphp

    <a  href="{{asset('/img/no-post.png')}}" data-pswp-width="2000" data-pswp-height="1666" target="_blank">
        <img src="{{asset('/img/no-post.png')}}"  class="image-item"  alt="{{$attchmt_type_info}} " />
        <div class="top-left" style="color: #1a1919b8;;font-size:12px">
            {{$attchmt_type_info}} 
        </div>
        @if ($post->price > 0)
            <div class="centered-text">
                <button  class="btn btn-sm btn-primary"  
                    @if(Auth::check())
                        @if(!GenericHelper::creatorCanEarnMoney($post->user))  data-placement='top' title='{{__("This creator cannot earn money yet")}}' @endif
                    @else
                        data-toggle='modal'
                        data-target='#login-dialog'
                    @endif 
                >
                {{config('app.site.currency_symbol') ?? config('app.site.currency_symbol')}}{{$post->price}}{{config('app.site.currency_symbol') ? '' : '' .config('app.site.currency_code')}}
                </button>
            </div>
        @endif
        
    </a>
@else
    @if ($attachment_type =="image")
        <a  href="{{ $attachment->path }}" data-pswp-width="2500" data-pswp-height="1666"  target="_blank">
            <img src="{{ $attachment->path }}"  class="image-item"  alt="" />
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
    @if(Auth::check() && $post->user->id == Auth::id() && $post->price >0 )
        <span   class="btn btn-sm btn-block  btn-primary">
        {{config('app.site.currency_symbol') ?? config('app.site.currency_symbol')}}{{$post->price}}{{config('app.site.currency_symbol') ? '' : '' .config('app.site.currency_code')}}
        </span>
    @endif 
@endif

 