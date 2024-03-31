@extends('layouts.stream')
@section('page_title', $stream->name)


@section('styles')
<link rel="stylesheet" href="{{asset('/libs/video.js/dist/video-js.min.css')}}">
<link rel="stylesheet" href="{{asset('/css/player-theme.css')}}">
{!!
Minify::stylesheet([
'/libs/dropzone/dist/dropzone.css',
'/css/pages/checkout.css',
'/css/pages/stream.css',
])->withFullUrl()
!!}
@stop

@section('scripts')
<script type="text/javascript" src="{{asset('/libs/video.js/dist/video.min.js')}}"></script>
<script type="text/javascript"
    src="{{asset('/libs/videojs-contrib-quality-levels/dist/videojs-contrib-quality-levels.min.js')}}"></script>
<script type="text/javascript"
    src="{{asset('/libs/videojs-http-source-selector/dist/videojs-http-source-selector.min.js')}}"></script>
{!!
Minify::javascript([
'/libs/dropzone/dist/dropzone.js',
'/js/FileUpload.js',
'/js/pages/stream.js',
'/libs/videojs-contrib-quality-levels/dist/videojs-contrib-quality-levels.min.js',
'/libs/videojs-http-source-selector/dist/videojs-http-source-selector.min.js',
'/libs/pusher-js-auth/lib/pusher-auth.js',
'/js/pages/checkout.js',
'/libs/@joeattardi/emoji-button/dist/index.js',
])->withFullUrl()
!!}

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.querySelector('#emoji-button');
        const picker = new EmojiButton();
        const messageBox = document.querySelector('.messageBoxInput');

        picker.on('emoji', emoji => {
            messageBox.value += emoji; // Insérer l'emoji dans le textarea
        });

        button.addEventListener('click', () => picker.togglePicker(button));
    });

    document.getElementById('refreshPage').addEventListener('click', function (event) {
        event.preventDefault();
        window.location.reload();
    });

</script>

@stop


@section('content')

<div class="vids_nav">
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center">
                <a href="{{ route('home') }}">
                    <img src="{{asset('img/logo.webp')}}" alt="">
                </a>
                <div
                    class="{{(Cookie::get('app_theme') == null ? (getSetting('site.default_user_theme') == 'dark' ? '' : 'text-dark-r') : (Cookie::get('app_theme') == 'dark' ? '' : 'text-dark-r'))}}">
                    <span>
                        Streaming
                    </span>

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>

                    {{$stream->name}}</div>
            </div>
        </div>
        <div class="col-auto">
            <a id="aff_user" href="{{route('profile',['username'=>Auth::user()->username])}}">
                @if(Auth::check())
                <img src="{{Auth::user()->avatar}}" class="rounded-circle user-avatar">
                @else
                @include('elements.icon',['icon'=>'person-circle','variant'=>'xlarge text-muted'])
                @endif
                @if(Auth::check())
                <div>
                    <div>
                        {{Auth::user()->name}}
                    </div>
                    <div>
                        {{ __('@') }}{{Auth::user()->username}}
                    </div>
                </div>
                @endif
            </a>

        </div>
    </div>
</div>
<div class="vids">
    <div class="vids_infos">
        <div class="vids_top_view">
            <div class="d-flex align-items-center">
                <div class="live_box">
                    <span></span>
                    Live
                </div>

                <div>
                    @if(!isset($streamEnded))
                    <span><span class="live-stream-users-count">0</span>
                        {{__("Watching")}} • {{__("Started streaming")}}
                        {{$stream->created_at->diffForHumans(null,false,true)}}.</span>
                    @else
                    {{__('Stream ended :time time ago',['time'=>$stream->ended_at->diffForHumans(null,false,true)])}}
                    @endif
                </div>
            </div>
        </div>
        <div class="vids_middle_view">
            <div class="stream-wrapper">
                <div class="stream-video ">
                    @if($stream->canWatchStream)
                    <video id="my_video_1" class="video-js vjs-fluid vjs-theme-forest" controls preload="auto" autoplay
                        muted>
                        <source src="{{isset($streamEnded) ? 'https://'.$stream->vod_link : $stream->hls_link}}"
                            type="application/x-mpegURL">
                    </video>
                    @else
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-12">
                            <div class="card p-5">
                                <div class="p-4 p-md-5">
                                    <img src="{{asset('/img/live-stream-locked.svg')}}" class="lock_icon_stream">
                                </div>
                                <div class="d-flex align-items-center justify-content-center" style="">
                                    <span>🔒 {{__("Live stream requires a")}} @if(isset($subLocked)) {{__("valid")}}
                                        <a href="javascript:void(0);" class="stream-subscribe-label to-tooltip"
                                            @if(!GenericHelper::creatorCanEarnMoney($stream->user))
                                            data-placement="top"
                                            title="{{__('This creator cannot earn money yet')}}"
                                            @endif
                                            >{{__("user subscription")}}</a>@endif
                                        @if(isset($priceLocked))
                                        {{__("and an")}} <a href="javascript:void(0);"
                                            class="stream-unlock-label to-tooltip"
                                            @if(!GenericHelper::creatorCanEarnMoney($stream->user))
                                            data-placement="top"
                                            title="{{__('This creator cannot earn money yet')}}"
                                            @endif
                                            >{{__("one time fee")}}</a>
                                        @endif.
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="vids_bottom_view">
            <div class="d-flex align-items avatarize">
                <img src="{{$stream->user->avatar}}" alt="{{$stream->user->username}}">
                <div>
                    {!! __(":user", ['user' => "<a href=\"".route('profile', ['username'=>
                        $stream->user->username])."\" class=\"text-".(Cookie::get('app_theme') == null ?
                        (getSetting('site.default_user_theme') == 'dark' ? 'white' : 'dark') :
                        (Cookie::get('app_theme') == 'dark' ? 'white' :
                        'dark'))."\"><span>".$stream->user->name."</span>
                        <span>@".$stream->user->username."</span></a>"]) !!}

                </div>
            </div>
        </div>

        <div class="vids_call_to_action d-flex align-items-center justify-content-between">
            <div class="d-flex">




                @if(!isset($streamEnded))
                <div class="d-flex align-items-center">
                    @if(isset($subLocked) && $stream->user->id !== Auth::user()->id)
                    <div class="d-sm-block">
                        <a href="#" class="btn btn-primary stream-subscribe-button"
                            @if(!\App\Providers\GenericHelperServiceProvider::creatorCanEarnMoney($stream->user))
                            data-placement="top"
                            title="{{__('This creator cannot earn money yet')}}"
                            @else
                            data-toggle="modal"
                            data-target="#checkout-center"
                            data-type="one-month-subscription"
                            data-recipient-id="{{$stream->user->id}}"
                            data-amount="{{$stream->user->profile_access_price}}"
                            data-first-name="{{Auth::user()->first_name}}"
                            data-last-name="{{Auth::user()->last_name}}"
                            data-billing-address="{{Auth::user()->billing_address}}"
                            data-country="{{Auth::user()->country}}"
                            data-city="{{Auth::user()->city}}"
                            data-state="{{Auth::user()->state}}"
                            data-postcode="{{Auth::user()->postcode}}"
                            data-available-credit="{{Auth::user()->wallet->total}}"
                            data-username="{{$stream->user->username}}"
                            data-name="{{$stream->user->name}}"
                            data-avatar="{{$stream->user->avatar}}"
                            data-stream-id="{{$stream->id}}"
                            @endif
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-credit-card">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                <line x1="1" y1="10" x2="23" y2="10"></line>
                            </svg>
                            {{__('Subscribe now')}}
                        </a>
                    </div>
                    @endif

                    @if(isset($priceLocked) && $stream->user->id !== Auth::user()->id)
                    <div class="d-sm-block">
                        <a href="#" class="btn btn-outline-primary pointer-cursor to-tooltip stream-unlock-button"
                            @if(!GenericHelper::creatorCanEarnMoney($stream->user))
                            data-placement="top"
                            title="{{__('This creator cannot earn money yet')}}"
                            @else
                            data-toggle="modal"
                            data-target="#checkout-center"
                            data-type="stream-access"
                            data-recipient-id="{{$stream->user->id ? $stream->user->id : ''}}"
                            data-amount="{{$stream->price}}"
                            data-first-name="{{Auth::user()->first_name}}"
                            data-last-name="{{Auth::user()->last_name}}"
                            data-billing-address="{{Auth::user()->billing_address}}"
                            data-country="{{Auth::user()->country}}"
                            data-city="{{Auth::user()->city}}"
                            data-state="{{Auth::user()->state}}"
                            data-postcode="{{Auth::user()->postcode}}"
                            data-available-credit="{{Auth::user()->wallet->total}}"
                            data-username="{{$stream->user->username}}"
                            data-name="{{$stream->user->name}}"
                            data-avatar="{{$stream->user->avatar}}"
                            data-stream-id="{{$stream->id}}"
                            @endif
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-lock">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            {{__('Unlock')}}
                        </a>
                    </div>
                    @endif

                    @if($stream->canWatchStream && $stream->user->id !== Auth::user()->id)
                    <div class="">
                        <a href="#" class="btn btn-primary btn_aff pointer-cursor to-tooltip"
                            @if(!GenericHelper::creatorCanEarnMoney($stream->user))
                            data-placement="top"
                            title="{{__('This creator cannot earn money yet')}}"
                            @else
                            data-placement="top"
                            title="{{__('Send a tip')}}"
                            data-toggle="modal"
                            data-target="#checkout-center"
                            data-type="tip"
                            data-first-name="{{Auth::user()->first_name}}"
                            data-last-name="{{Auth::user()->last_name}}"
                            data-billing-address="{{Auth::user()->billing_address}}"
                            data-country="{{Auth::user()->country}}"
                            data-city="{{Auth::user()->city}}"
                            data-state="{{Auth::user()->state}}"
                            data-postcode="{{Auth::user()->postcode}}"
                            data-available-credit="{{Auth::user()->wallet->total}}"
                            data-username="{{$stream->user->username}}"
                            data-name="{{$stream->user->name}}"
                            data-avatar="{{$stream->user->avatar}}"
                            data-recipient-id="{{$stream->user->id}}"
                            data-stream-id="{{$stream->id}}"
                            @endif
                            >
                            <svg width="18px" height="18px" viewBox="0 0 18 18" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <g id="Group" transform="translate(-18.000000, -784.000000)" stroke="#fff"
                                        stroke-width="2">
                                        <g id="gift" transform="translate(19.000000, 785.000000)">
                                            <polyline id="Path"
                                                points="13.815 7.675 13.815 15.35 1.535 15.35 1.535 7.675">
                                            </polyline>
                                            <rect id="Rectangle" x="0" y="3.8375" width="15.35" height="3.8375"></rect>
                                            <line x1="7.675" y1="15.35" x2="7.675" y2="3.8375" id="Path"></line>
                                            <path
                                                d="M7.675,3.8375 L4.22125,3.8375 C3.16155364,3.8375 2.3025,2.97844636 2.3025,1.91875 C2.3025,0.859053636 3.16155364,0 4.22125,0 C6.9075,0 7.675,3.8375 7.675,3.8375 Z"
                                                id="Path"></path>
                                            <path
                                                d="M7.675,3.8375 L11.12875,3.8375 C12.1884464,3.8375 13.0475,2.97844636 13.0475,1.91875 C13.0475,0.859053636 12.1884464,0 11.12875,0 C8.4425,0 7.675,3.8375 7.675,3.8375 Z"
                                                id="Path"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>

                            {{__('Send a tip')}}
                        </a>
                    </div>
                    @endif

                    @if($stream->user->id === Auth::user()->id)
                    <div class="d-sm-block">
                        <a class="btn btn-outline-primary pointer-cursor to-tooltip"
                            href="{{route('my.streams.get')}}?action=details">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-info">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            </svg>
                            {{__('Live infos')}}
                        </a>
                    </div>
                    <div class="d-sm-block">
                        <a class="btn btn-outline-primary pointer-cursor to-tooltip"
                            href="{{route('my.streams.get')}}?action=edit">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-edit">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            {{__('Edit')}}
                        </a>
                    </div>
                    @endif

                </div>
                @endif

                <a href="#share_url_modal" class="btn btn-outline-primary" data-toggle="modal"
                    data-target="#share_url_modal">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-share-2">
                        <circle cx="18" cy="5" r="3"></circle>
                        <circle cx="6" cy="12" r="3"></circle>
                        <circle cx="18" cy="19" r="3"></circle>
                        <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                        <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                    </svg>
                    {{__('Get Live URL')}}
                </a>

            </div>

            <a href="#" class="btn button-primary" id="refreshPage">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-refresh-ccw">
                    <polyline points="1 4 1 10 7 10"></polyline>
                    <polyline points="23 20 23 14 17 14"></polyline>
                    <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
                </svg>
                {{__('Refresh page')}}
            </a>


        </div>



    </div>





    <div class="vids_chat">
        <div class="stream-chat{{$stream->canWatchStream ? '' : 'mt-3'}}">
            @include('elements.message-alert',['classes'=>'py-3'])
            <div class="card border-0">
                @if($stream->canWatchStream)
                <div class="message_chat_live_content chat-content conversations-wrapper overflow-hidden p-0 flex-fill">
                    <div class="conversation-content flex-fill">
                        @if($stream->messages->count())
                        @foreach($stream->messages as $message)
                        @include('elements.streams.stream-chat-message',['message'=>$message, 'streamOwnerId' =>
                        $stream->user_id])


                        @endforeach
                        @endif

                        <div
                            class="d-{{$stream->messages->count() ? 'none' : 'flex'}} h-100 align-items-center justify-content-center no-chat-comments-label">
                            @if($stream->status == 'in-progress')
                            <div class="d-flex"><span>👋 {{__('There are no messages yet.')}} </span>
                      
                            </div>
                            @else
                            <div class="d-flex"><span>⏲ {{__("Stream ended, can't add comments.")}} </span></div>
                            @endif

                        </div>
                        <div class="mobile_space_cc">

                        </div>
                    </div>
                </div>

                @if(!isset($streamEnded))
                <div class="message_chat_form_live conversation-writeup d-flex align-items-center">
                    <div class="message_chat_find_ui">
                        <div>
                            @if(Auth::check())
                            <img src="{{Auth::user()->avatar}}" class="rounded-circle user-avatar">
                            @endif
                        </div>
                        <form class="message-form w-100">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="receiverID" id="receiverID" value="">
                            <textarea name="message" class="form-control messageBoxInput"
                                placeholder="{{__('Write a message..')}}" onkeyup="textAreaAdjust(this)"></textarea>
                        </form>
                        <div class="messenger-buttons-wrapper d-flex">
                            <div class="input-group-append z-index-3 d-flex align-items-center justify-content-center">
                                <span class=" trigger" data-toggle="tooltip" data-placement="top" title="Emoji"
                                    id="emoji-button">

                                    <svg width="17px" height="17px" viewBox="0 0 17 17" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <g id="Message---Discussion"
                                                transform="translate(-1316.000000, -822.000000)" stroke="#000000">
                                                <g id="Group-3" transform="translate(851.000000, 741.000000)">
                                                    <g id="smile" transform="translate(466.000000, 82.000000)">
                                                        <circle id="Oval" cx="7.5" cy="7.5" r="7.5"></circle>
                                                        <path
                                                            d="M4.5,9 C4.5,9 5.625,10.5 7.5,10.5 C9.375,10.5 10.5,9 10.5,9"
                                                            id="Path"></path>
                                                        <line x1="5.25" y1="5.25" x2="5.2575" y2="5.25" id="Path">
                                                        </line>
                                                        <line x1="9.75" y1="5.25" x2="9.7575" y2="5.25" id="Path">
                                                        </line>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                            </div>

                            <button class="btn btn-outline-primary btn-rounded-icon messenger-button send-message"
                                onClick="Stream.sendMessage({{$stream->id}})">
                                <div class="d-flex justify-content-center align-items-center">
                                    <svg width="15px" height="15px" viewBox="0 0 15 15" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <g id="Message---Discussion"
                                                transform="translate(-1397.000000, -823.000000)" stroke="#000000">
                                                <g id="Group-3" transform="translate(851.000000, 741.000000)">
                                                    <g id="send-(1)" transform="translate(547.000000, 83.000000)">
                                                        <line x1="13" y1="0" x2="5.85" y2="7.15" id="Path"></line>
                                                        <polygon id="Path" points="13 0 8.45 13 5.85 7.15 0 4.55">
                                                        </polygon>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </button>
                        </div>

                    </div>

                </div>
                @endif

                @else
                <div class="d-flex align-items-center justify-content-center mt-4 stream-chat-no-message"><span>🔒
                        {{__("Chat locked. Unlock the stream to see the messages.")}}</span></div>
                @endif
            </div>
        </div>


    </div>

</div>



<!-- Modal -->
<div class="modal fade" id="share_url_modal" tabindex="-1" role="dialog" aria-labelledby="share_url_modal_Title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> {{__('Get Live URL')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
                    $currentUrl = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                ?>

                <input type="text" value="<?php echo htmlspecialchars($currentUrl); ?>" class="input_form_share">

                
            </div>
        </div>
    </div>
</div>


<style>
        .input_form_share {
            width: 100%;
            border: 1px solid #111;
            padding: 10px;
            margin-bottom: 30px;
            border-radius: 5px;
            font-size: 14px;
        }

    .message_avatar_ui img {
        width: 1.5vw;
        margin-bottom: 0.5vw;
        margin-right: 0.5vw;
    }

    span.text-dak.chat-message-user,
    span.text-dak.chat-message-user:hover,
    span.text-dak.chat-message-user:focus {
        font-size: .6vw;
        display: block;
        margin-bottom: 0.2vw;
        font-weight: normal !important;
    }

    .chat-message-user a:hover {
        font-weight: normal !important;
    }

    span.text-dak.chat-message-user:hover,
    span.text-dak.chat-message-user:focus {
        text-decoration: underline;
    }

    .emoji-picker.light {
        z-index: 100;
        position: relative;
        margin-top: -8.5vw;
    }

    .chat_is_owner .chat-message-content,
    .chat_is_not_owner .chat-message-content {
        text-align: left;
        border-radius: 1vw;
        border-top-left-radius: 0px;
        padding: 0.5vw 0.7vw;
        font-size: .8vw;
        letter-spacing: -0.32px;
        display: inline-block;
        margin-bottom: 0.5vw;
    }


    .chat_is_not_owner .chat-message-action {
        order: 2;
    }


    .chat_is_not_owner>div:nth-child(2) {
        order: 1;
    }

    .chat_is_owner .h-pill-accent_del {
        color: #ef3232;
        background: #ef323233;
        margin-right: 0.5vw;
    }

    .chat_is_not_owner .h-pill-accent_del {
        color: #ef3232;
        background: #ef323233;
        margin-left: 0.5vw;
    }

    .chat_is_owner .h-pill-accent_del,
    .chat_is_not_owner .h-pill-accent_del {
        opacity: 0;
        transition: .4s;
        margin-bottom: .1vw;
    }

    .chat_is_owner:hover .h-pill-accent_del,
    .chat_is_not_owner:hover .h-pill-accent_del {
        opacity: 1;
        transition: .4s;
        background: #ef3232;
        color: #fff;
    }

    .chat_is_owner .chat-message-content {
        background: #28A0F0;
        background-image: none !important;
        border: 0px !important;
        border-top-left-radius: 1vw;
        border-bottom-right-radius: 0px;
        color: #fff;
    }


    .chat_is_not_owner .chat-message-content {
        background-color: #f6f7f8 !important;
    }

    .message_chat_find_ui {
        display: flex;
        align-items: center;
    }

    .message_chat_find_ui>div>img {
        width: 2.4vw;
        height: 2.4vw;
        margin-right: 0.5vw;
        border: 1px solid #ddd;
        transform: scale(.8);
    }

    .message_chat_form_live {
        position: fixed;
        width: 31vw;
        bottom: 0;
        background: transparent;
        border-top: 1px solid #ddd;
        padding: 1vw;
        z-index: 20;
    }

    .message_chat_form_live textarea {
        font-size: .8vw;
        color: #0b0b0b;
        letter-spacing: 0;
        outline: none;
        border: 0px !important;
        background: transparent !important;
        max-width: 100%;
        width: 100%;
        padding-right: 0px !important;
        padding-left: 0;
        box-shadow: none !important;
        border-radius: 0;
        height: auto;
    }

    .messenger-buttons-wrapper.d-flex svg {
        width: 1vw;
        height: auto;
    }

    .message_chat_live_content .conversation-content {
        height: 83vh;
        overflow-x: hidden;
        padding: 1vw 1vw 1vw 1vw;
    }

    .message_chat_live_content .conversation-content::-webkit-scrollbar-track {
        -webkit-box-shadow: transparent;
        background-color: transparent;
        width: 0px;
        height: 0;
    }

    .message_chat_live_content.conversation-content::-webkit-scrollbar {
        width: 0px;
        background-color: transparent;
        height: 0;
    }

    .message_chat_live_content .conversation-content::-webkit-scrollbar-thumb {
        background-color: transparent;
        width: 0px;
        height: 0;
    }

    .vids_chat,
    .stream-chat .card.border-0 {
        position: relative;
    }

    .message_chat_find_ui {
        width: 100%;
        background: #F5F5F5;
        padding: 0.1vw 0.5vw;
        border-radius: .5vw;
    }

    .layout {
        position: absolute;
        width: 100%;
        left: 0;
        top: 0;
        height: auto;
        z-index: -10;
        display: none;
    }


    .vids_chat {
        position: relative;
    }


    body>div.w-100>div.vids>div.vids_infos>div.vids_middle_view>div {
        background: ;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        position: relative;
    }

    .vjs-error .vjs-error-display .vjs-modal-dialog-content {
        font-size: 0 !important;
    }

    .vjs-error .vjs-error-display:before {
        content: '';
    }

    .avatarize img {
        width: 2.4vw;
        height: 2.4vw;
        margin-right: 0.5vw;
        border-radius: 100%;
        object-fit: cover;
    }

    .avatarize>div>a {
        display: block;
    }

    .avatarize>div>a>span:nth-child(1) {
        font-weight: 600;
        font-size: .8vw;
        color: #fff;

        display: block;
    }

    .avatarize>div>a>span:nth-child(2) {
        font-size: .75vw;
        color: #9E9E9E;
        letter-spacing: -0.28px;
        display: block;
    }

    div.vids_nav>div>div.col>div>a>img {
        height: 2.5vw;
        margin-right: 2vw;
    }

    .vids_nav {
        border-bottom: 1px solid #ddd;
        padding: 1vw 1.35vw;
        height: 4.5vw;
    }


    .vids_nav #aff_user {
        display: flex;
        margin-bottom: 0px;
    }

    .vids_nav #aff_user>img {
        width: 2.4vw;
        height: 2.4vw;
        margin-right: 0.5vw;
    }

    .vids_nav #aff_user>div>div:nth-child(1) {
        font-size: .8vw;
    }


    div.vids_nav>div>div.col>div>div {
        font-weight: 600;
        font-size: .8vw;
        color: #242529;
    }

    #aff_user>div>div:nth-child(2) {
        font-size: .75vw;
    }


    div.vids_nav>div>div.col>div>div svg {
        height: 1vw;
    }

    .vids {
        height: calc(100vh - 4.5vw);
        display: flex;
    }

    body {
        margin-bottom: 0 !important;
    }

    .vids_infos {
        padding: 1.5vw;
    }

    .vids_infos {
        width: 76vw;
    }

    .vids_chat {
        width: 34vw;
        border-left: 1px solid #ddd;
    }

    .vids_top_view,
    .vids_bottom_view {
        background: #000;
        display: flex;
        align-items: center;
        padding: 0.9vw 1vw;
    }

    .live_box {
        background: #E90517;
        font-weight: 600;
        font-size: .7vw;
        color: #FFFFFF;
        text-transform: uppercase;
        height: 1.8vw;
        width: 3.4vw;
        border-radius: 0.5vw;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1vw;
    }

    @keyframes blink {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }
    }

    .live_box span {
        display: block;
        width: 0.5vw;
        height: 0.5vw;
        background: white;
        border-radius: 100%;
        margin-right: 0.5vw;
        animation: blink 1s infinite;
        /* Applique l'animation avec une durée de 1 seconde et de façon infinie */
    }

    div.vids_top_view>div>div:nth-child(2) {
        font-weight: 600;
        font-size: .8vw;
        color: #fff;
    }

    .vids_call_to_action {
        padding-top: 1vw;
    }

    .vids_call_to_action .btn {
        font-weight: 600;
        font-size: .78vw;
        color: #FFFFFF;
        letter-spacing: 0;
        text-align: center;
        background-image: linear-gradient(93deg, #59B8F7 39%, #28A0F0 79%);
        border-radius: 3vw;
        text-transform: none;
        justify-content: center;
        margin-right: 0.5vw;
        margin-bottom: 0;
        outline: none !important;
        box-shadow: none !important;
    }

    .vids_call_to_action .btn svg {
        margin-right: 0.5vw;
        width: 0.8vw;
        height: auto;
    }

    .vids_call_to_action a.btn.btn-outline-primary {
        background-image: none;
        color: #59b8f7;
    }

    @media screen and (max-width: 1150px) and (min-width: 992px) {
        body {
            padding-bottom: 0px;
            padding-top: 0;
        }
    }

    @media screen and (min-width: 2400px) {
        .vids_infos {
            width: 63vw;
        }

        .vids_chat {
            width: 37vw;
        }

        .message_chat_form_live {
            width: 37vw;
        }
    }

    .card {
        background: transparent;
    }



    @media screen and (max-width: 992px) {
        .vids_nav {
            background: #fff;
            width: 100%;
            z-index: 1020;
            height: auto;
            padding: 2vw 4vw;
        }

        div.vids_nav>div>div.col>div>a>img {
            height: 7vw;
        }

        div.vids_nav #aff_user>div {
            display: none;
        }

        .vids_nav #aff_user>img {
            width: 8vw;
            height: 8vw;
            margin-right: 0;
        }

        .avatarize img {
            width: 8vw;
            height: 8vw;
            margin-right: 2vw;
        }

        .vids_nav .row {
            align-items: center;
        }

        div.vids_nav>div>div.col>div>div {
            display: none;
        }

        .vids {
            height: auto;
            display: flex;
            flex-wrap: wrap;
        }

        .vids_infos,
        .vids_chat {
            width: 100%;
        }

        .vids_infos {
            padding: 0;
        }

        .live_box {
            font-size: 2.5vw;
            color: #FFFFFF;
            height: 6vw;
            width: 15vw;
            border-radius: 1vw;
            margin-right: 3vw;
            width: auto;
            padding: 2vw;
        }

        div.vids_top_view>div>div:nth-child(2) {
            font-weight: 600;
            font-size: 2.4vw;
            color: #fff;
        }

        .live_box span {
            width: 1.5vw;
            height: 1.5vw;
            margin-right: 1vw;
        }

        .vids_top_view {
            padding: 5vw 3vw 3vw 3vw;
        }

        .vids_bottom_view {
            padding: 3vw 3vw 5vw 3vw;
        }

        .d-flex.align-items.avatarize {
            align-items: center;
        }

        .avatarize>div>a>span:nth-child(1) {
            font-size: 2.4vw;
        }

        .avatarize>div>a>span:nth-child(2) {
            font-size: 2vw;
        }

        .vids_call_to_action {
            padding: 3vw 3vw;
            border-bottom: 1px solid #ddd;
        }

        .vids_call_to_action .btn {
            font-size: 0;
        }

        .vids_call_to_action .btn svg {
            margin: 0;
            height: 3vw;
            width: auto;
        }

        .vids_call_to_action .btn {
            font-size: 0;
            padding: 0;
            width: 10vw;
            height: 10vw;
            border-radius: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .vids_call_to_action .btn {
            margin-right: 1.5vw;
        }

        a#refreshPage {
            margin-right: 0;
            margin-left: 0;
        }

        .message_chat_live_content .conversation-content {
            padding: 4vw 4vw 10vw 4vw !important;
            height: 89vw !important;
        }

        .chat_is_owner .chat-message-content,
        .chat_is_not_owner .chat-message-content {
            padding: 2vw;
            font-size: 3vw;
            border-radius: 3vw;
        }

        .chat_is_owner .chat-message-content {
            border-top-left-radius: 3vw;
        }

        .message_avatar_ui img {
            width: 6vw;
            margin-right: 2vw;
        }

        span.text-dak.chat-message-user,
        span.text-dak.chat-message-user:hover,
        span.text-dak.chat-message-user:focus {
            font-size: 2.5vw;
            display: block;
            margin-bottom: 1vw;
            font-weight: normal !important;
        }

        .chat_is_owner,
        .chat_is_not_owner {
            margin-bottom: 2vw;
        }

        .message_chat_live_content .conversation-content {
            padding: 4vw 4vw 4vw 4vw !important;
            height: auto !important;
        }

        .message_chat_form_live {
            padding: 3vw;
            width: 100%;
        }

        .message_chat_find_ui>div>img {
            display: none;
        }

        .message_chat_form_live textarea {
            font-size: 3vw;
        }

        .messenger-buttons-wrapper.d-flex svg {
            width: 4vw;
            height: auto;
        }

        #emoji-button>svg {
            position: relative;
            top: -.4vw
        }

        .message_chat_form_live textarea {
            font-size: 3vw;
            padding-left: 4vw;
        }

        .message_chat_find_ui {
            width: 100%;
            padding: 1vw 0vw 1vw 0vw;
            border-radius: 0.5vw;
        }





    }


    @media screen and (max-width: 992px) {
        body {
            padding-top: 0;
        }
    }


    .message_avatar_ui img {
        border-radius: 100%;
    }

    .lock_icon_stream {
        width: 6vw;
        height: auto;
        margin: 8vw auto;
        display: block;
        transform: scale(1.5);
    }

    .stream-chat-no-message {
        height: calc(100vh - 4vw);
    }


    .alert-box.py-3 {
    padding: 0 1vw;
}


.alert-success .close {
    font-size: 0px;
    margin-right: 0;
}


</style>


@include('elements.checkout.checkout-box')


@stop
