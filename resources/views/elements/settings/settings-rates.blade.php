@if(session('success'))
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
@endif

<div class="aff_edit_info_form">
    <form method="POST" action="{{route('my.settings.rates.save')}}">
        @csrf
        <div class="aff_edit_user">
            <div class="aff_first_label">
                <span>
                    <span>
                        {{__('Activer les abonnements')}}
                    </span>
                    <span>
                        {{__('Uniquement pour les comptes validés')}}
                    </span>
                </span>

                <span>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="paid-profile" name="paid-profile"
                            {{isset(Auth::user()->paid_profile) ? (Auth::user()->paid_profile == '1' ? 'checked' : '') : false}}>
                        <label class="custom-control-label" for="paid-profile"></label>
                    </div>
                </span>
            </div>
        </div>

        <div class="aff_edit_user ">
            <div class="row">
                <div class="col-12">
                    <div>
                        <label for="automatic_message_for_new_subscriber">
                            {{__('Message de bienvenue automatique pour tous vos nouveaux abonnés')}}
                        </label>
                        <input class=" {{ $errors->has('automatic_message_for_new_subscriber') ? 'is-invalid' : '' }}"   id="automatic_message_for_new_subscriber" name="automatic_message_for_new_subscriber" aria-describedby="emailHelp" autocomplete="off"  value="{{Auth::user()->automatic_message_for_new_subscriber ?? __(\App\Model\UserMessage::DEFAULT_MESSAGE_FOR_NEW_SUBSCRIBER)}}">
                        @if($errors->has('automatic_message_for_new_subscriber'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{__($errors->first('automatic_message_for_new_subscriber'))}}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="explication_">
            <p>{{__('Paramétrage des Prix des Abonnements par Mois')}}</p>
            <p>
                {{__("Lorsque vous fixez le prix de l'abonnement, veillez à insérer le montant mensuel TVA incluse (19%). La TVA sera déduite de votre portefeuille après le paiement des utilisateurs et des frais de traitement des paiements (7%). Définissez simplement le prix mensuel de chaque tablette. Cela vous aidera à créer des réductions pour les abonnements plus longs :")}}
            </p>
            {{-- <ul>
                <li>{{__('- Pour un abonnement de 1 mois : Insérez 3000 (ceci est le prix pour un mois).')}}</li>
                <li>{{__('- Pour un abonnement de 3 mois : Insérez 2700 (ceci est le prix pour un mois). Ne multipliez pas par 3, le système le fera automatiquement.')}}</li>
                <li>{{__('- Pour un abonnement de 6 mois : Insérez 2500 (ceci est le prix pour un mois). Ne multipliez pas par 6, le système le fera automatiquement.')}}</li>
                <li>{{__('- Pour un abonnement de 12 mois : Insérez 2000 (ceci est le prix pour un mois). Ne multipliez pas par 12, le système le fera automatiquement.')}}</li>
            </ul> --}}
            <p><strong>{{__('Date limite :')}}</strong> {{__('Veuillez faire ces changements avant la date limite pour garantir que vos abonnements sont correctement paramétrés.')}}</p>
        </div>
        

        <div class="aff_edit_user paid-profile-rates {{isset(Auth::user()->paid_profile) ? (Auth::user()->paid_profile == '1' ? '' : 'd-none') : ''}}">
            <div class="row">
                <div class="col-12">
                    <div>
                        <label for="name">{{__('1 mois')}}  ({{ __("prix par mois TVA incluse 19%")}})</label>
                        <input class=" {{ $errors->has('profile_access_price') ? 'is-invalid' : '' }}"
                            id="profile_access_price" name="profile_access_price" aria-describedby="emailHelp"
                            value="{{Auth::user()->profile_access_price}}">
                        @if($errors->has('profile_access_price'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{__($errors->first('profile_access_price'))}}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div>
                        <label for="name">{{__('3 mois')}}  ({{ __("prix par mois TVA incluse 19%")}})</label>
                        <input class=" {{ $errors->has('profile_access_price_3_months') ? 'is-invalid' : '' }}"
                            id="profile_access_price" name="profile_access_price_3_months" aria-describedby="emailHelp"
                            value="{{ Auth::user()->profile_access_price_3_months  }}">
                        @if($errors->has('profile_access_price_3_months'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{__($errors->first('profile_access_price_3_months'))}}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div>
                        <label for="name">{{__('6 mois')}}  ({{ __("prix par mois TVA incluse 19%")}})</label>
                        <input class=" {{ $errors->has('profile_access_price_6_months') ? 'is-invalid' : '' }}"
                            id="profile_access_price" name="profile_access_price_6_months" aria-describedby="emailHelp"
                            value="{{Auth::user()->profile_access_price_6_months}}">
                        @if($errors->has('profile_access_price_6_months'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{__($errors->first('profile_access_price_6_months'))}}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div>
                        <label for="name">{{__('12 mois')}}  ({{ __("prix par mois TVA incluse 19%")}})</label>
                        <input class=" {{ $errors->has('profile_access_price_12_months') ? 'is-invalid' : '' }}"
                            id="profile_access_price_12_months" name="profile_access_price_12_months"
                            aria-describedby="emailHelp" value="{{Auth::user()->profile_access_price_12_months}}">
                        @if($errors->has('profile_access_price_12_months'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{__($errors->first('profile_access_price_12_months'))}}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div>
                        <label for="name">{{__('Date limite')}}</label>
                        <input type="date" class=" {{ $errors->has('profile_access_offer_date') ? 'is-invalid' : '' }}"
                            id="profile_access_offer_date" name="profile_access_offer_date" aria-describedby="emailHelp"
                            value="{{Auth::user()->offer && Auth::user()->offer->expires_at ? Auth::user()->offer->expires_at->format('Y-m-d') : ''}}">
                    </div>
                </div>
                <div class="col-12">
                   
                </div>

                <div class="col-12">
                    <label for="is_offer" id="label_accept_ui">
                        <input type="checkbox" aria-label="Checkbox for following text input" name="is_offer" id="is_offer"
                        {{Auth::user()->offer && Auth::user()->offer->expires_at ? 'checked' : ''}}>

                        <span>
                            {{__("Activer la date de fin. Pour commencer une promotion, réduisez vos tarifs mensuels et sélectionnez une date de fin de promotion future.")}}
                        </span>
                    </label>
                </div>


                <div class="col-12">
                    @if($errors->has('profile_access_offer_date'))
                    <span class="invalid-feedback" role="alert">
                        {{__($errors->first('profile_access_offer_date'))}}
                    </span>
                    @endif
                </div>

            </div>

        </div>

        <div class="aff_edit_user">
            <div class="row">
                <div class="col-12">
                    <button type="submit">
                        <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                stroke-linecap="round" stroke-linejoin="round">
                                <g id="Reglages---Historique-des-transactions"
                                    transform="translate(-578.000000, -595.000000)" stroke="#FFFFFF">
                                    <g id="input" transform="translate(555.000000, 579.000000)">
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
    </form>


</div>
