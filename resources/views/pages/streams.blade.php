@extends('layouts.user-no-nav')
@section('page_title', __('Your live streams'))

@section('styles')
{!!
Minify::stylesheet([
'/libs/dropzone/dist/dropzone.css',
'/css/pages/stream.css',
])->withFullUrl()
!!}
@stop

@section('scripts')
{!!
Minify::javascript([
'/libs/dropzone/dist/dropzone.js',
'/js/FileUpload.js',
'/js/pages/streams.js',
])->withFullUrl()
!!}
@stop

@section('content')

<div id="aff_content">
    <div class="aff_gauche">

        <p class="aff_title_feed">
            <a href="/my/settings">
                <svg width="7px" height="12px" viewBox="0 0 7 12" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round"
                        stroke-linejoin="round">
                        <g id="Reglages---profil" transform="translate(-541.000000, -54.000000)" stroke="#000000"
                            stroke-width="2">
                            <polyline id="Path"
                                transform="translate(544.500000, 60.000000) scale(-1, 1) translate(-544.500000, -60.000000) "
                                points="542 65 547 60 542 55"></polyline>
                        </g>
                    </g>
                </svg>
                {{__('Streams')}}
            </a>

            <button
                class="{{!GenericHelper::isUserVerified() && getSetting('site.enforce_user_identity_checks') ? 'disabled' : '' }}"
                onclick="{{!GenericHelper::isUserVerified() && getSetting('site.enforce_user_identity_checks') ? '' : "Streams.showStreamEditDialog('create')" }}"
                data-toggle="{{!GenericHelper::isUserVerified() && getSetting('site.enforce_user_identity_checks') ? 'none' : 'tooltip' }}"
                data-placement="top" title="{{__('Go live')}}">
                {{__("Create live video")}}
            </button>
        </p>


        <div>
            @if(!GenericHelper::isUserVerified() && getSetting('site.enforce_user_identity_checks'))
            <div class="alert alert-warning text-white font-weight-bold mt-2 mb-4" role="alert">
                {{__("Before being able to start a new stream, you need to complete your")}} <a class="text-white"
                    href="{{route('my.settings',['type'=>'verify'])}}">{{__("profile verification")}}</a>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <svg width="14px" height="14px" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            opacity="0.352515811" stroke-linecap="round" stroke-linejoin="round">
                            <g id="8---Fil-d'actualité---Pourboire" transform="translate(-1101.000000, -248.000000)"
                                stroke="#000000">
                                <g id="Group-3" transform="translate(534.000000, 222.000000)">
                                    <g id="x-(4)" transform="translate(568.000000, 27.000000)">
                                        <line x1="12" y1="0" x2="0" y2="12" id="Path"></line>
                                        <line x1="0" y1="0" x2="12" y2="12" id="Path"></line>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
            @endif 

            <div class="aff_edit_info_form">


                <div class="aff_refferal_info">
                    <div>
                        {{__("Active streams")}}
                    </div>
                    <div>
                        <div
                            class=" pgx-{{StreamsHelper::getUserInProgressStream() ? '2' : '0'}} active-stream-container">
                            @if(StreamsHelper::getUserInProgressStream())
                            @include('elements.streams.stream-element',['stream'=>$activeStream, 'isLive' => true])
                            @else
                            <span>{{__("There are no active streams. Click the button above to start a new one.")}}</span>
                            @endif
                        </div>
                    </div>
                </div>


            </div>

            <br>
            <div class="aff_edit_info_form">
                <div class="aff_refferal_info">
                    <div>
                        {{__("Previous streams")}}
                    </div>

                    @if($previousStreams->count())

                    <div class="row">
                        @foreach($previousStreams as $stream)
                        @include('elements.streams.stream-element-loop',['stream'=>$stream, 'isLive' => false])
                        @endforeach

                        @if($previousStreams->total() > 6)
                        <div class="d-block">
                            <div class="d-flex flex-row-reverse mt-3 mr-4">
                                {{ $previousStreams->onEachSide(1)->links() }}
                            </div>
                        </div>
                        @endif


                    </div>

                    @else
                    <div>
                        {{__("No previous streams available")}}
                    </div>

                    @endif


                </div>
            </div>







        </div>




    </div>
</div>


@include('elements.streams.stream-create-update-dialog')
@include('elements.streams.stream-stop-dialog')
@include('elements.streams.stream-delete-dialog')
@include('elements.streams.stream-details-dialog')
@include('elements.dropzone-dummy-element')
@stop
