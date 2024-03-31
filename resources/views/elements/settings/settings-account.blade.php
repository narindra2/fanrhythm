@if(!Auth::user()->email_verified_at) @include('elements.resend-verification-email-box') @endif
<div class="aff_edit_info_form">
    <div class="aff_edit_user_padding_top">
        <p>
        {{__('Protect your account by choosing a secure password of at least 12 characters, with a combination of letters, numbers, and special characters. Change your password regularly to enhance the security of your account.')}}
        </p>

        <form method="POST" action="{{route('my.settings.account.save')}}">
            @csrf
            <!-- @if(session('success'))
        <div class="alert alert-success text-white font-weight-bold mt-2" role="alert">
            {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="{{__('Close')}}">
                
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
    @endif -->
            <div class="aff_edit_user">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <label for="username">{{__('Mot de passe')}}</label>
                            <input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" id="username"
                                name="password" type="password">
                            @if($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first('password')}}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <div>
                            <label for="username">{{__('New password')}}</label>
                            <input class="{{ $errors->has('new_password') ? 'is-invalid' : '' }}" id="username"
                                name="new_password" type="password">
                            @if($errors->has('new_password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first('new_password')}}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-12">
                        <div>
                            <label for="username">{{__('Confirm password')}}</label>
                            <input class="{{ $errors->has('confirm_password') ? 'is-invalid' : '' }}" id="username"
                                name="confirm_password" type="password">
                            @if($errors->has('confirm_password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first('confirm_password')}}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit">

                            <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <g id="Reglages---profil" transform="translate(-580.000000, -843.000000)"
                                        stroke="#FFFFFF">
                                        <g id="input" transform="translate(557.000000, 827.000000)">
                                            <g id="save" transform="translate(24.000000, 17.000000)">
                                                <path
                                                    d="M12.4444444,14 L1.55555556,14 C0.696445945,14 0,13.3035541 0,12.4444444 L0,1.55555556 C0,0.696445945 0.696445945,0 1.55555556,0 L10.1111111,0 L14,3.88888889 L14,12.4444444 C14,13.3035541 13.3035541,14 12.4444444,14 Z"
                                                    id="Path"></path>
                                                <polyline id="Path"
                                                    points="10.8888889 14 10.8888889 7.77777778 3.11111111 7.77777778 3.11111111 14">
                                                </polyline>
                                                <polyline id="Path"
                                                    points="3.11111111 0 3.11111111 3.88888889 9.33333333 3.88888889">
                                                </polyline>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            {{__('Enregistrer les modifications')}}
                        </button>
                    </div>

                </div>
            </div>

    </div>


    </form>
</div>
