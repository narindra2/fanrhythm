<div class="col-md-4 col-12">
    <div class="live_thumb position-relative">
        <div class="play_thumb">
            <div class="relative_infos_streaming">
                <div class="live_now">
                    <span></span>
                    Live
                </div>
            </div>
            <div class="relative_play">
                @if(($stream->status == 'ended' && $stream->settings['dvr'] && $stream->vod_link) || $stream->status ==
                'in-progress')
                <a class="rounded"
                    href="{{$stream->status == 'in-progress' ?  route('public.stream.get',['streamID'=>$stream->id,'slug'=>$stream->slug]) : route('public.vod.get',['streamID'=>$stream->id,'slug'=>$stream->slug])}}">
                    @include('elements.icon',['icon'=>'eye-outline'])
                </a>
                @else
                <span class="rounded" data-toggle="tooltip" data-placement="top"
                    title="{{__('Stream VOD unavailable')}}">
                    @include('elements.icon',['icon'=>'eye-off-outline'])
                </span>
                @endif

            </div>
            <img src="{{$stream->poster}}" class="rounded img_stream_post_cover ">
            <div class="relative_infos_streaming_bottom">
                @if(($stream->status == 'ended' && $stream->settings['dvr'] && $stream->vod_link) || $stream->status ==
                'in-progress')
                @if($stream->price == 0)
                <span class="badge_format">Free</span>
                @else
                <span class="badge_format">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-lock">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg> PPV</span>
                @endif

                @if($stream->requires_subscription)
                <span class="badge_format"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-lock">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg> Sub</span>
                @endif
                @endif
            </div>
        </div>

        <div class="text-live_h d-flex">
            <img src="{{$stream->user->avatar}}" alt="" class="avatar_streamed">
            <div>
                <div class="text_live">
                    @if($showLiveIndicators && $stream->status == 'in-progress')
                    <div>
                        <div class="blob red mr-3"></div>
                    </div>
                    @endif
                    @if($stream->status == 'in-progress')
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
                    {{$stream->created_at->diffForHumans(null,false,true)}} @if($showUsername), by <a class="text-muted"
                        href="{{route('profile',['username'=>$stream->user->username])}}"><span>@</span>{{$stream->user->username}}</a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
