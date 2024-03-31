<div class="modal fade" tabindex="-1" role="dialog" id="stream-update-dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="create-label d-none">{{__('Démarrer un nouveau live')}}</span> <span
                        class="edit-label d-none">{{__('Edit stream details')}}</span></h5>
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
            <div class="modal-body">
                    <div  class=" show active aff_show_form_ui">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div>
                                    <label for="stream-name">
                                        {{__('Titre du live et durée du live')}}
                                    </label>
                                    <input type="text" name="card_name" id="stream-name" value="{{$activeStream ? $activeStream->name : ''}}" class=" uifield required ">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('name')}}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div>
                                    <label for="stream-name">
                                        {{__('Définir le prix')}}
                                    </label>
                                    <input type="number" name="access_price" id="stream-access_price" value="{{$activeStream ? $activeStream->name : ''}}" class=" uifield required ">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('access_price')}}</strong>
                                    </span>
                                </div>
                            </div>
                           
                        </div>
                    </div>
            </div>
            <div class="modal-body">
                <div class="form_ui_as_same_post">
                    <label for="username">{{__('Photo de couverture')}} {{  getSetting('payments.currency_symbol') }}</label>
                    <div class="card profile-cover-bg"
                        style="background-image: url('{{$activeStream && $activeStream->poster ? $activeStream->poster : asset('/img/live-stream-cover.png')}}');">
                        <div class="card-img-overlay d-flex justify-content-center align-items-center">
                            <div class="actions-holder d-none">
                                <div class="d-flex">
                                    <span class="h-pill h-pill-accent pointer-cursor mr-1 upload-button"
                                        data-toggle="tooltip" data-placement="top"
                                        title="{{__('Upload stream poster')}}">
                                        @include('elements.icon',['icon'=>'image','variant'=>'medium'])
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom-control custom-switch label_custom_switch">
                    <input type="checkbox" class="custom-control-input" id="requires_subscription"
                        name="requires_subscription"
                        {{$activeStream && $activeStream->requires_subscription ? 'checked' : ''}}>
                    <label class="custom-control-label"
                        for="requires_subscription">
                        <span>
                        {{__("Requires a subscription")}}
                        </span>
                    </label>
                </div>

                <div class="custom-control custom-switch mt-1 label_custom_switch">
                    <input type="checkbox" class="custom-control-input" id="is_public" name="is_public"
                        {{$activeStream ? ( $activeStream->is_public ? 'checked' : '') : 'checked'}}>
                    <label class="custom-control-label" for="is_public">
                        <span>
                        {{__("Public stream")}}
                        </span>
                    </label>
                </div>

            </div>
            <div class="modal-footer pt-4">
                <button type="button" class="btn btn-primary stream-save-btn"
                    onclick="Streams.updateStream();">{{__('Continue')}}</button>
            </div>
        </div>
    </div>
</div>
