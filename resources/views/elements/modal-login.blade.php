<div class="modal fade " tabindex="-1" role="dialog" id="login-dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content p-2">
            <div class="modal-header">
                <h5 class="modal-title">
                    <span class="block-user-label">{{__('Login to subscribe')}}</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    
<svg width="14px" height="14px" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" opacity="0.352515811" stroke-linecap="round" stroke-linejoin="round">
        <g id="8---Fil-d'actualité---Pourboire" transform="translate(-1101.000000, -248.000000)" stroke="#000000">
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
                <div class="row">
                    <div class="col-6 d-none d-md-block">
                        <div class="d-flex align-items-center justify-content-center card-wrapper">
                            @include('elements.vertical-member-card',['profile' => $user])
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 d-flex align-items-center pl-0">
                        @include('auth.modal-forms')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
