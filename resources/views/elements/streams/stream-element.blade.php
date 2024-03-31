<div class="top_post_main">

    @if($isLive)
    <a href="{{route('public.stream.get',['streamID'=>$stream->id,'slug'=>$stream->slug])}}">
        <img src="{{$stream->poster}}" class="rounded mb-4 {{$isLive ? 'active-stream-poster' : ''}}" />
        <div class="top_post_main_play">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-fill"
                viewBox="0 0 16 16">
                <path
                    d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393" />
            </svg>
        </div>
    </a>
    @else
    @if(($stream->status == 'ended' && $stream->settings['dvr'] && $stream->vod_link))
    <a href="{{route('public.vod.get',['streamID'=>$stream->id,'slug'=>$stream->slug])}}">
        <img src="{{$stream->poster}}" class="rounded mb-4 {{$isLive ? 'active-stream-poster' : ''}}" />
        <div class="top_post_main_play">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-fill"
                viewBox="0 0 16 16">
                <path
                    d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393" />
            </svg>
        </div>
    </a>
    @else
    <span data-toggle="tooltip" data-placement="top" title="{{__('Stream VOD unavailable')}}">
        <img src="{{$stream->poster}}" class="rounded mb-4 {{$isLive ? 'active-stream-poster' : ''}}" />
        <div class="top_post_main_play">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-fill"
                viewBox="0 0 16 16">
                <path
                    d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393" />
            </svg>
        </div>
    </span>
    @endif
    @endif
</div>

<div class="top_post_main_play_title_post  {{$isLive ? 'active-stream-name' : ''}} text-truncate">
    <span class="text-truncate">
        @if($isLive)
        <a href="{{route('public.stream.get',['streamID'=>$stream->id,'slug'=>$stream->slug])}}"
            class="text-{{(Cookie::get('app_theme') == null ? (getSetting('site.default_user_theme') == 'dark' ? 'white' : 'dark') : (Cookie::get('app_theme') == 'dark' ? 'white' : 'dark'))}}">{{$stream->name}}</a>
        @else
        @if($stream->settings['dvr'] && $stream->vod_link)
        <a href="{{route('public.vod.get',['streamID'=>$stream->id,'slug'=>$stream->slug])}}"
            class="text-{{(Cookie::get('app_theme') == null ? (getSetting('site.default_user_theme') == 'dark' ? 'white' : 'dark') : (Cookie::get('app_theme') == 'dark' ? 'white' : 'dark'))}}">{{$stream->name}}</a>
        @else
        {{$stream->name}}
        @endif
        @endif
    </span>
</div>
<div class="text-muted">{{__("Created at")}}: {{$stream->created_at_short}} @if(!$isLive)•
    {{__('Length')}}: {{$stream->duration}}
    {{trans_choice('minute',$stream->duration)}}.@endif</div>


<div class="d-flex live_button_ui_list">

    @if($isLive)
    <span class="show-stream-details-label"
        onclick="Streams.showStreamDetailsDialog({{$stream->id}},'{{$stream->rtmp_server}}','{{$stream->rtmp_key}}')">

        {{__('Details')}}
    </span>
    @endif

    @if($isLive)
    <span onclick="Streams.showStreamEditDialog('edit',{{$stream->id}})">
        {{__('Edit Live infos')}}
    </span>
    @endif

    @if($isLive)
    <a class="" href="{{route('public.stream.get',['streamID'=>$stream->id,'slug'=>$stream->slug])}}">
        {{__('View')}}
    </a>
    @else
    @if(($stream->status == 'ended' && $stream->settings['dvr'] && $stream->vod_link))
    <a href="{{route('public.vod.get',['streamID'=>$stream->id,'slug'=>$stream->slug])}}">
        {{__('View')}}
    </a>
    @else
    <span data-toggle="tooltip" data-placement="top" title="{{__('Stream VOD unavailable')}}">
        {{__('VOD')}}
    </span>
    @endif
    @endif

    @if($isLive)
    <span class="close_or_stop" onclick="Streams.showStreamStopDialog({{$stream->id}})">
        {{__('Stop')}}
    </span>
    @else
    <span class="close_or_stop" onclick="Streams.showStreamDeleteDialog({{$stream->id}})">
        {{__('Close')}}
    </span>
    @endif

</div>
