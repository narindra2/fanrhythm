<div class="modal fade" tabindex="-1" role="dialog" id="stream-details-dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title">{{__('Download streaming app to start your live')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{__('Close')}}">

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
            <div class="modal-body body_app_start">
                <div class="mt-3 inline-border-tabs">
                    <nav class="nav nav-pills nav-justified" role="tablist">
                        <a class="nav-link active" data-toggle="tab" data-target="#nav-desktop" type="button" role="tab"
                            aria-controls="nav-desktop" aria-selected="true">
                            <div class="d-flex align-items-center justify-content-center">
                                @include('elements.icon',['icon'=>'laptop-outline','variant'=>'small','classes'=>'mr-2'])
                                {{__("Desktop")}}
                            </div>
                        </a>
                        <a class="nav-link" data-toggle="tab" data-target="#nav-mobile" type="button" role="tab"
                            aria-controls="nav-mobile" aria-selected="true">
                            <div class="d-flex align-items-center justify-content-center">
                                @include('elements.icon',['icon'=>'phone-portrait-outline','variant'=>'small','classes'=>'mr-2'])
                                {{__("Mobile")}}
                            </div>
                        </a>
                    </nav>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-desktop" role="tabpanel">
                        <div class="mt-2">
                            <ol>
                                <li class="mb-1">{{__('Download')}} <a href="https://obsproject.com/download"
                                        target="_blank">OBS</a> {{__('for desktop or mobile alternatives.')}}</li>
                                <li class="mb-1">{{__('Go to')}} <code>{{__("Settings > Stream")}}</code>. {{__('For')}}
                                    <code>{{__("Service")}}</code>, {{__('select')}} <code>{{__("Custom")}}</code>.</li>
                                <li class="mb-1">{{ucfirst(__('for the'))}} <code>{{__("Server & Stream key")}}</code>,
                                    {{__('use the values below.')}}</li>
                            </ol>
                            <div class="form-group row ">
                                <div class="col-sm-12">
                                    <label for="colFormLabelSm">{{__('Stream url')}}</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="stream-url"
                                        placeholder="{{__('Stream url')}}">
                                </div>
                                <div class="col-sm-4">
                                    <span class="h-pill-accent_btn rounded" onclick="Streams.copyStreamData('url')">
                                        {{__("Copy to clipboard")}}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="colFormLabelSm">{{__('Stream key')}}</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="stream-key"
                                        placeholder="{{__('Stream key')}}">
                                </div>
                                <div class="col-sm-4">
                                    <span class="h-pill-accent_btn rounded" onClick="Streams.copyStreamData('key');">
                                        {{__("Copy to clipboard")}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-mobile" role="tabpanel">
                        <div class="mt-2">
                            <ol>
                                <li class="mb-1">{{__('Download')}} {{__("Larix for")}} <a
                                        href="https://apps.apple.com/us/app/larix-broadcaster/id1042474385"
                                        target="_blank">iOS</a> {{__("or")}} <a
                                        href="https://play.google.com/store/apps/details?id=com.wmspanel.larix_broadcaster&hl=en&gl=US"
                                        target="_blank">Android</a>.</li>
                                <li class="mb-1">{{__('Go to')}}
                                    <code>{{__("Settings > Connection > New connection")}}</code>.</li>
                                <li class="mb-1">{{ucfirst(__('for the'))}} <code>URL</code>,
                                    {{__("use the following value")}}.</li>
                            </ol>
                            <div class="form-group row ">
                                <div class="col-sm-12">
                                    <label for="colFormLabelSm">{{__('Stream url')}}</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-md" id="stream-url-larix"
                                        placeholder="{{__('Stream url')}}">
                                </div>
                                <div class="col-sm-4 d-flex align-items-center justify-content-center">
                                    <span class="h-pill-accent_btn rounded mr-2"
                                        onclick="Streams.copyStreamData('mobile-url')">
                                        {{__("Copy to clipboard")}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">{{__('Continue now')}}</button>
            </div>
        </div>
    </div>
</div>

