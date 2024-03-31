<div class="col-md-4 col-12">
    <div class="live_thumb position-relative">
        <div class="play_thumb">

            <div class="relative_play">
                @if($isLive)
                <span class=" rounded mr-2 show-stream-details-label"
                    onclick="Streams.showStreamDetailsDialog({{$stream->id}},'{{$stream->rtmp_server}}','{{$stream->rtmp_key}}')">
                    @include('elements.icon',['icon'=>'server-outline'])
                </span>
                @endif

                @if($isLive)
                <span class=" rounded mr-2"
                    onclick="Streams.showStreamEditDialog('edit',{{$stream->id}})">
                    @include('elements.icon',['icon'=>'create-outline'])
                </span>
                @endif

                @if($isLive)
                <a class=" rounded mr-2"
                    href="{{route('public.stream.get',['streamID'=>$stream->id,'slug'=>$stream->slug])}}">
                    @include('elements.icon',['icon'=>'eye-outline'])
                </a>
                @else
                @if(($stream->status == 'ended' && $stream->settings['dvr'] && $stream->vod_link))
                <a class=" rounded mr-2"
                    href="{{route('public.vod.get',['streamID'=>$stream->id,'slug'=>$stream->slug])}}">
                    @include('elements.icon',['icon'=>'eye-outline'])
                </a>
                @else
                <span class=" rounded mr-2" data-toggle="tooltip" data-placement="top"
                    title="{{__('Stream VOD unavailable')}}">
                    @include('elements.icon',['icon'=>'eye-off-outline'])
                </span>
                @endif
                @endif

                @if($isLive)
                <span class=" rounded" onclick="Streams.showStreamStopDialog({{$stream->id}})">
                    @include('elements.icon',['icon'=>'stop-circle-outline'])
                </span>
                @else
                <span class=" rounded" onclick="Streams.showStreamDeleteDialog({{$stream->id}})">
                    @include('elements.icon',['icon'=>'close-outline'])
                </span>
                @endif
            </div>


            <img src="{{$stream->poster}}"
                class="rounded img_stream_post_cover {{$isLive ? 'active-stream-poster' : ''}}" />
        </div>

        <div class="{{$isLive ? 'active-stream-name' : ''}} text-live_h">
            <div class="text_live">
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
            </div>
            <div class="text_live_info">
                {{__("Created at")}}: {{$stream->created_at_short}} @if(!$isLive)•
                {{__('Length')}}: {{$stream->duration}}
                {{trans_choice('minute',$stream->duration)}}.@endif
            </div>


        </div>
    </div>
</div>
