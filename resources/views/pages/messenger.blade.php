@extends('layouts.user-no-nav')

@section('page_title', __('Messenger'))

@section('styles')
{!!
Minify::stylesheet([
'/libs/@selectize/selectize/dist/css/selectize.css',
'/libs/@selectize/selectize/dist/css/selectize.bootstrap4.css',
'/libs/dropzone/dist/dropzone.css',
'/libs/photoswipe/dist/photoswipe.css',
'/libs/photoswipe/dist/default-skin/default-skin.css',
'/css/pages/messenger.css',
'/css/pages/checkout.css'
])->withFullUrl()
!!}
@stop

@section('scripts')
{!!
Minify::javascript([
'/js/pages/messenger.js',
'/libs/@selectize/selectize/dist/js/standalone/selectize.min.js',
'/libs/dropzone/dist/dropzone.js',
'/js/FileUpload.js',
'/js/plugins/media/photoswipe.js',
'/libs/photoswipe/dist/photoswipe-ui-default.min.js',
'/js/plugins/media/mediaswipe.js',
'/js/plugins/media/mediaswipe-loader.js',
'/libs/@joeattardi/emoji-button/dist/index.js',
'/js/pages/lists.js',
'/js/pages/checkout.js',
'/libs/pusher-js-auth/lib/pusher-auth.js'
])->withFullUrl()
!!}
@stop

@section('content')
@include('elements.uploaded-file-preview-template')
@include('elements.photoswipe-container')
@include('elements.report-user-or-post',['reportStatuses' => ListsHelper::getReportTypes()])
@include('elements.feed.post-delete-dialog')
@include('elements.feed.post-list-management')
@include('elements.messenger.message-price-dialog')
@include('elements.checkout.checkout-box')
@include('elements.attachments-uploading-dialog')
@include('elements.messenger.locked-message-no-attachments-dialog')

<div id="aff_content" class="aff_content_block">
    <div class="aff_message">
        <p class="aff_title_feed aff_title_message">
            Messages
        </p>
        <style>
            body {
                overflow: hidden;
            }

            @media screen and (max-width: 1150px){
                #aff_main {
                    width: 100%;
                    padding-left: 0px;
                    max-width: 100%;
                    margin: auto;
                }
            }

            @media screen and (max-width: 768px){
                #aff_main {
                    padding-left: 0px;
                    padding-right: 0px;
                    max-width: 100%;
                }

                div#aff_mobile_nav {
                    display: none;
                }


                #aff_message_box {
                    height: calc(100vh - 140px);
                }
                .conversation-writeup.aff_write_message {
                    position: fixed;
                    left: 0;
                    bottom: 30px;
                }

                #aff_message_box>div:nth-child(1)>span{
                    bottom: auto;
                    top: -1px;
                }

                #aff_message_box>div:nth-child(1) {
                    padding-top: 80px;
                }

                body{
                    overflow: scroll;
                }

                .aff_write_message>div>img{
                    display: none!important;
                }

                .text_foc .input-group-append.z-index-3.d-flex.align-items-center.justify-content-center,
                .text_foc  button.messenger-button.mx-2.to-tooltip,
                .text_foc  button.messenger-button.attach-file.file-upload-button.to-tooltip.dz-clickable  {
                    display: none!important;
                }

                textarea.messageBoxInput.dropzone{
                    /* height: 50px!important; */

                    line-height: 1.5;
                    overflow:scroll;
                }

             

                textarea.messageBoxInput.dropzone {
                    line-height: 2;
                    padding-right: 31px!important;
                    margin-top: 6px;
                     margin-bottom: 6px;
                }

                .text_foc textarea.messageBoxInput.dropzone{
                    padding-right: 0px!important;
                    line-height: 1.5;
                    margin-top: 10px;
                    margin-bottom: 0px;
                }

                .aff_write_message>div,
                .aff_write_message{
                    height: auto;
                }

                .dropzone-previews.dropzone.dz-started {
                    position: fixed!important;
                    left: 0!important;
                    margin-left: 0px!important;
                    bottom: 6px;
                    border-top: 0px solid #eee !important;
                }

              
            }
        </style>

        <div id="aff_message_box">
            <div>
                <div class="aff_message_search">
                    <svg width="17px" height="17px" viewBox="0 0 17 17" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Message---Boite-de-reception" transform="translate(-571.000000, -148.000000)"
                                stroke="#8E8E8E" stroke-width="2">
                                <g id="input" transform="translate(551.000000, 134.000000)">
                                    <g id="search" transform="translate(21.000000, 15.000000)">
                                        <circle id="Oval" cx="6.5" cy="6.5" r="6.5"></circle>
                                        <line x1="15" y1="15" x2="11" y2="11" id="Path"></line>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <input type="text" placeholder="{{__('Recherche ...')}}">
                </div>
                <style>
                    ::-webkit-scrollbar {
                    display: none;
                }
                .scrollable-list{
                    margin-bottom: 55px;
                    overflow: scroll;
                    height: -webkit-fill-available;
                    -ms-overflow-style: none;  /* Internet Explorer 10+ */
                    scrollbar-width: none;  /* Firefox */
                }
                </style>
                <div class="conversations-list scrollable-list">
                    @if($lastContactID == false)
                    
                    @else
                    @include('elements.preloading.messenger-contact-box', ['limit'=>3])
                    @endif
                </div>

                <span data-toggle="tooltip" title="" class="pointer-cursor "
                    data-original-title="{{trans_choice('Send a new message',['user' => 0])}}">
                    <a data-toggle="modal" data-target="#messageModal" title="" class="pointer-cursor"
                        data-original-title="{{trans_choice('Send a new message',['user' => 0])}}">

                        <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                stroke-linecap="round" stroke-linejoin="round">
                                <g id="Message---Boite-de-reception" transform="translate(-672.000000, -830.000000)"
                                    stroke="#9C9C9C">
                                    <g id="Group-5" transform="translate(533.750000, 802.250000)">
                                        <g id="plus-circle" transform="translate(139.250000, 28.750000)">
                                            <circle id="Oval" cx="7" cy="7" r="7"></circle>
                                            <line x1="7" y1="4.2" x2="7" y2="9.8" id="Path"></line>
                                            <line x1="4.2" y1="7" x2="9.8" y2="7" id="Path"></line>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </a>
                </span>
            </div>
            <div>
                @include('elements.message-alert')
                @include('elements.messenger.messenger-conversation-header')
                @include('elements.preloading.messenger-conversation-header-box')
                @include('elements.preloading.messenger-conversation-box')
                <div class="conversation-content">
                    @if(isset($lastContactID) && $lastContactID == false)
                    <div class="d-flex h-100 align-items-center justify-content-center w-100">

                        <div id="aff_empty_message">
                            <img src="{{asset('/img/empty_message.svg')}}" />
                            <div>
                                {{__('Votre messagerie est vide')}}
                            </div>
                            <div>
                                {{__('Découvrez les créateurs et commencez à leur envoyer des messages !')}}
                            </div>

                            <a href="{{url('/verified_user')}}">
                                {{__('Découvrir les créateurs')}}
                            </a>
                        </div>
                        <style>
                            .aff_content_block .conversation-content {
                                height: 100%;
                            }

                        </style>
                    </div>
                    @endif
                </div>
                <div class="dropzone-previews dropzone"></div>
                <div class="conversation-writeup aff_write_message {{!$lastContactID ? 'hidden' : ''}}">
                    <div>
                        <div id="errorModerationMessage" style="font-size: 12px;
                        color: red;
                        display: table;
                        position: absolute;
                        z-index: 14;
                        margin-left: -12px;
                        margin-top: -11%;
                        margin-bottom: 10px;
                        display: flex;
                        width: 100%;"></div>

                        <img src="{{Auth::user()->avatar}}" alt="">
                        {{-- {!! Auth::user()->getUserStatusHtml() !!} --}}
                        <form class="message-form w-100">
                            <div class="input-group messageBoxInput-wrapper">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="receiverID" id="receiverID" value="">
                                <textarea name="message" class="messageBoxInput dropzone"
                                    placeholder="{{__('Saisissez votre message … ')}}"
                                    onkeyup="messenger.textAreaAdjust(this)"></textarea>
                            </div>
                        </form>

                        <span class=" trigger" data-toggle="tooltip" data-placement="top" title="Like">

                                        <svg width="17px" height="17px" viewBox="0 0 17 17" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
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
                        <div
                            class="messenger-buttons-wrapper d-flex {{!GenericHelper::creatorCanEarnMoney(Auth::user()) ? 'pl-2' : ''}}">
                            @if(GenericHelper::creatorCanEarnMoney(Auth::user()))
                            <button class=" messenger-button mx-2 to-tooltip" data-placement="top"
                                title="{{__('Message price')}}" onClick="messenger.showSetPriceDialog()">
                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="message-price-lock">

                                        <svg width="15px" height="16px" viewBox="0 0 15 16" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                                <g id="Message---Discussion"
                                                    transform="translate(-1468.000000, -812.000000)" stroke="#000000">
                                                    <g id="Group-3" transform="translate(851.000000, 741.000000)">
                                                        <g id="unlock-(2)" transform="translate(618.000000, 72.000000)">
                                                            <rect id="Rectangle" x="0" y="6.30204416" width="12.596655"
                                                                height="7.69795584" rx="2"></rect>
                                                            <path
                                                                d="M2.79925487,6.30204416 L2.79925487,3.50278749 C2.79745002,1.70512899 4.15811545,0.198577666 5.94667365,0.0179152218 C7.73523185,-0.162747222 9.36969169,1.04126619 9.72741693,2.80297332"
                                                                id="Path"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="message-price-close d-none">


                                        <svg width="15px" height="16px" viewBox="0 0 15 16" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                                <g id="Message---Discussion"
                                                    transform="translate(-1370.000000, -822.000000)" stroke="#000000">
                                                    <g id="Group-3" transform="translate(851.000000, 741.000000)">
                                                        <g id="lock" transform="translate(520.000000, 82.000000)">
                                                            <rect id="Rectangle" x="0" y="6.3" width="12.6" height="7.7"
                                                                rx="2"></rect>
                                                            <path
                                                                d="M2.8,6.3 L2.8,3.5 C2.8,1.56700338 4.36700338,6.21724894e-16 6.3,6.21724894e-16 C8.23299662,6.21724894e-16 9.8,1.56700338 9.8,3.5 L9.8,6.3"
                                                                id="Path"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </button>
                            @endif
                        </div>

                        <div class="messenger-buttons-wrapper d-flex">
                            <button class="messenger-button attach-file  file-upload-button to-tooltip"
                                data-placement="top" title="{{__('Attach file')}}">
                                <div class="d-flex justify-content-center align-items-center">

                                    <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <g id="Message---Discussion"
                                                transform="translate(-1506.000000, -813.000000)" stroke="#000000">
                                                <g id="Group-3" transform="translate(851.000000, 741.000000)">
                                                    <g id="image-(1)" transform="translate(656.000000, 73.000000)">
                                                        <rect id="Rectangle" x="0" y="0" width="14" height="14" rx="2">
                                                        </rect>
                                                        <circle id="Oval" cx="4.27777778" cy="4.27777778"
                                                            r="1.16666667"></circle>
                                                        <polyline id="Path"
                                                            points="14 9.33333333 10.1111111 5.44444444 1.55555556 14">
                                                        </polyline>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </button>
                            <button class="messenger-button send-message  to-tooltip" onClick="messenger.sendMessage()"
                                data-placement="top" title="{{__('Send message')}}">
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
            </div>
        </div>

    </div>
</div>


@include('elements.messenger.send-user-message')
@include('elements.standard-dialog',[
'dialogName' => 'message-delete-dialog',
'title' => __('Delete message'),
'content' => __('Are you sure you want to delete this message?'),
'actionLabel' => __('Delete'),
'actionFunction' => 'messenger.deleteMessage();',
])
@stop
