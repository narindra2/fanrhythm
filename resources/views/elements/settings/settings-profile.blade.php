@if(!Auth::user()->email_verified_at) @include('elements.resend-verification-email-box') @endif

@if(getSetting('ai.open_ai_enabled'))
@include('elements.suggest-description')
@endif

<div class="aff_edit_info_form">

<form method="POST" action="{{route('my.settings.profile.save',['type'=>'profile'])}}">
    @csrf
    @include('elements.dropzone-dummy-element')
    <div class="mb-2">
        <div class="card profile-cover-bg aff_cover_uploader">
            <img class="card-img-top centered-and-cropped" src="{{Auth::user()->cover}}">
            <span class="upload-button" data-toggle="tooltip" data-placement="top" title="{{__('Upload cover image')}}">
                {{__('Télécharger une photo')}}
            </span>

        </div>
        <div class="avatar-holder aff_avatar_uploader">
            <img src="{{Auth::user()->avatar}}" class="user-avatar">
            <span class="upload-button" data-toggle="tooltip" data-placement="top" title="{{__('Upload avatar')}}">

                <svg width="20px" height="20px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round"
                        stroke-linejoin="round">
                        <g id="Reglages---profil" transform="translate(-605.000000, -243.000000)" stroke="#FFFFFF"
                            stroke-width="2">
                            <g id="upload" transform="translate(606.000000, 244.000000)">
                                <path
                                    d="M18,12 L18,16 C18,17.1045695 17.1045695,18 16,18 L2,18 C0.8954305,18 0,17.1045695 0,16 L0,12"
                                    id="Path"></path>
                                <polyline id="Path" points="14 5 9 0 4 5"></polyline>
                                <line x1="9" y1="0" x2="9" y2="12" id="Path"></line>
                            </g>
                        </g>
                    </g>
                </svg>
            </span>
        </div>
        <span  class="text-danger d-none" style="font-size: 14px; margin-left: 12px;" id ="attachementBreackModerationRulesMessage">*{{ __("Le fichier que vous avez sélectionné ne respecte pas nos normes de modération et ne peut pas être téléchargé") }}</span>
    </div>
    
    <div class="aff_edit_user">
        <div class="row">
            <div class="col-md-6">
                <div>
                    <label for="username">{{__('Nom d’utilisateur')}}</label>
                    <input class="{{ $errors->has('username') ? 'is-invalid' : '' }}" id="username" name="username"
                        aria-describedby="emailHelp" value="{{Auth::user()->username}}">
                    @if($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$errors->first('username')}}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <label for="name">{{__('Nom et prénom')}}</label>
                    <input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name"
                        aria-describedby="emailHelp" value="{{Auth::user()->name}}">
                    @if($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$errors->first('name')}}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-12">
                <div>
                    <div>
                        <label for="bio">
                            {{__('Biographie')}}
                        </label>
                        <div>
                            @if(getSetting('ai.open_ai_enabled'))
                            <a href="javascript:void(0)" onclick="{{"AiSuggestions.suggestDescriptionDialog();"}}"
                                data-toggle="tooltip" data-placement="left"
                                title="{{__('Use AI to generate your description.')}}">{{__('Suggestion')}}</a>
                            @endif
                        </div>
                    </div>
                    <textarea class="{{ $errors->has('bio') ? 'is-invalid' : '' }}" id="bio" name="bio" rows="3"
                        spellcheck="false">{{Auth::user()->bio}}</textarea>
                    @if($errors->has('bio'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$errors->first('bio')}}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div>
                    <label for="birthdate">{{__('Date de naissance')}}</label>
                    <input type="date" class="{{ $errors->has('location') ? 'is-invalid' : '' }}" id="birthdate"
                        name="birthdate" aria-describedby="emailHelp" value="{{Auth::user()->birthdate}}"
                        max="{{$minBirthDate}}">
                    @if($errors->has('birthdate'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$errors->first('birthdate')}}</strong>
                    </span>
                    @endif
                </div>
            </div>


            <div class="col-md-6">
                <div>
                    <div class="{{getSetting('profiles.allow_gender_pronouns') ? 'w-100' : 'w-100'}}">
                        <div class="">
                            <label for="gender">{{__('Genre')}}</label>
                            <select  id="gender" name="gender">
                                <option value=""></option>
                                @foreach($genders as $gender)
                                <option value="{{$gender->id}}"
                                    {{Auth::user()->gender_id == $gender->id ? 'selected' : ''}}>
                                    {{__($gender->gender_name)}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('gender'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first('gender')}}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            <!-- <div class="col-md-6">
                <div>
                    @if(getSetting('profiles.allow_gender_pronouns'))

                    <label for="pronoun">{{__('Titre')}}</label>
                    <input class="{{ $errors->has('location') ? 'is-invalid' : '' }}" id="pronoun" name="pronoun"
                        aria-describedby="emailHelp" value="{{Auth::user()->gender_pronoun}}">
                    @if($errors->has('pronoun'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$errors->first('pronoun')}}</strong>
                    </span>
                    @endif
                    @endif
                </div>
            </div> -->

            <div class="col-md-12">
                <div>
                    <label for="location">{{__('Adresse (Ville et pays)')}}</label>
                    <input class="{{ $errors->has('location') ? 'is-invalid' : '' }}" id="location" name="location"
                        aria-describedby="emailHelp" value="{{Auth::user()->location}}">
                    @if($errors->has('location'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$errors->first('location')}}</strong>
                    </span>
                    @endif
                </div>
            </div>
           
            <div class="col-md-12">
                <div>
                    <label for="website" value="{{Auth::user()->website}}">{{__('Lien externe')}}</label>
                    <input type="url" class="{{ $errors->has('website') ? 'is-invalid' : '' }}" id="website" name="website"
                        aria-describedby="emailHelp" value="{{Auth::user()->website}}">
                    @if($errors->has('website'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$errors->first('website')}}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-12">
                <button type="submit">

                    <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round"
                            stroke-linejoin="round">
                            <g id="Reglages---profil" transform="translate(-580.000000, -843.000000)" stroke="#FFFFFF">
                                <g id="input" transform="translate(557.000000, 827.000000)">
                                    <g id="save" transform="translate(24.000000, 17.000000)">
                                        <path
                                            d="M12.4444444,14 L1.55555556,14 C0.696445945,14 0,13.3035541 0,12.4444444 L0,1.55555556 C0,0.696445945 0.696445945,0 1.55555556,0 L10.1111111,0 L14,3.88888889 L14,12.4444444 C14,13.3035541 13.3035541,14 12.4444444,14 Z"
                                            id="Path"></path>
                                        <polyline id="Path"
                                            points="10.8888889 14 10.8888889 7.77777778 3.11111111 7.77777778 3.11111111 14">
                                        </polyline>
                                        <polyline id="Path"
                                            points="3.11111111 0 3.11111111 3.88888889 9.33333333 3.88888889"></polyline>
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

</form>

</div>