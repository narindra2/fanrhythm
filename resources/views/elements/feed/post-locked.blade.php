<div class="aff_empty_post_wrap">
    @php
        $count = count($post->attachments);
        foreach ($post->attachments as $attachment) {
            $videoCount = $imageCount = $audioCount = $files = 0; $info = [];
            $video = null;
            $attachment_type = AttachmentHelper::getAttachmentType($attachment->type);
            if ($attachment_type == "video") {
                $videoCount++;
                $video = $attachment;
            }elseif($attachment_type == "image"){
                $imageCount++;
            }elseif($attachment_type == "audio"){
                $audioCount++;
            }else {
                $files++;
            }
        }
    @endphp
    @if ($imageCount)
        <span style="margin-left: 2%;font-size: 13px;margin-top: 6%; position: absolute;">
           x{{ $imageCount  }} {{ __("image(s)") }} ... 
        </span> 
        <br>
    @endif
    @if ($videoCount)
        @if ($videoCount == 1)
            <span style="margin-left: 2%;font-size: 13px;margin-top: 10%; position: absolute;">01 Video duration : {!! $video->videoDuration !!} </span> <br>
        @else 
            <span style="margin-left: 2%;font-size: 13px;margin-top: 6%; position: absolute;">
                x{{ $videoCount }} {{ __("vidéo(s)") }} ... 
            </span> 
        @endif
    <br>
    @endif
    @if ($audioCount)
        <span style="margin-left: 2%;font-size: 13px;margin-top: 6%; position: absolute;">
            x{{ $audioCount  }} {{ __("audio(s)") }} ... 
        </span> 
     <br>
    @endif
    @if ($files)
        <span style="margin-left: 2%;font-size: 13px;margin-top: 6%; position: absolute;">
            x{{ $files }} {{ __("autre(s) fichier(s)") }} ... 
        </span> 
     <br>
    @endif
<img src="{{asset('/img/no-post.png')}}" class="img-fluid">
    @if($type == 'post')
    <button class="btn btn-primary btn-block to-tooltip {{(!GenericHelper::creatorCanEarnMoney($post->user)) ? 'disabled' : ''}}"
                    @if(Auth::check())
                        @if(!GenericHelper::creatorCanEarnMoney($post->user))
                            data-placement="top"
                            title="{{__('This creator cannot earn money yet')}}"
                        @else
                            data-toggle="modal"
                            data-target="#checkout-center"
                            data-type="post-unlock"
                            data-recipient-id="{{$post->user->id}}"
                            data-amount="{{$post->price}}"
                            data-first-name="{{Auth::user()->first_name}}"
                            data-last-name="{{Auth::user()->last_name}}"
                            data-billing-address="{{Auth::user()->billing_address}}"
                            data-country="{{Auth::user()->country}}"
                            data-city="{{Auth::user()->city}}"
                            data-state="{{Auth::user()->state}}"
                            data-postcode="{{Auth::user()->postcode}}"
                            data-available-credit="{{Auth::user()->wallet->total}}"
                            data-username="{{$post->user->username}}"
                            data-name="{{$post->user->name}}"
                            data-avatar="{{$post->user->avatar}}"
                            data-post-id="{{$post->id}}"
                        @endif
                    @else
                    data-toggle="modal"
                    data-target="#login-dialog"
                    @endif
            >{{__('Dévérouiller ce contenu pour')}} {{config('app.site.currency_symbol') ?? config('app.site.currency_symbol')}}{{$post->price}}{{config('app.site.currency_symbol') ? '' : ' ' .config('app.site.currency_code')}}</button>
    @endif
    
</div>
