<div class="aff_edit_info_form aff_privacy">
<p>
    {{__('Afrifan vous permet de contrôler la visibilité de votre profil et offre des options de sécurité supplémentaires, comme l\'authentification à deux facteurs par e-mail.')}}
</p>

<div class="aff_privacy_checkbox">
    <div>
        {{__('Compte public')}}
    </div>

    <div class="custom-control custom-switch custom-switch">
        <input type="checkbox" class="custom-control-input" id="public_profile" {{Auth::user()->public_profile ? 'checked' : ''}}>
        <label class="custom-control-label" for="public_profile"></label>
    </div>
</div>

<div class="aff_privacy_info">
    <div>
        {{__('Si votre profil est configuré en mode privé :')}}
    </div>
    <ul>
        <li>
            {{__('Il sera entièrement invisible pour les moteurs de recherche et les utilisateurs non inscrits.')}}
        </li>
        <li>
            {{__('Il sera généralement absent des suggestions et des recherches d\'utilisateurs sur notre plateforme.')}}
        </li>
    </ul>
</div>




    @if(getSetting('profiles.allow_users_enabling_open_profiles'))

    <div class="aff_privacy_checkbox">
        <div>
            {{__('Profil ouvert')}}
        </div>
        <div class="custom-control custom-switch custom-switch">
            <input type="checkbox" class="custom-control-input" id="open_profile" {{Auth::user()->open_profile ? 'checked' : ''}}>
            <label class="custom-control-label" for="open_profile"></label>
        </div>
    </div>

    <div class="aff_privacy_info">
        <div>
            {{__('Si votre profil est configuré en mode ouvert :')}}
        </div>
        <ul>
            <li>
                {{__('Tous les utilisateurs, inscrits ou non, pourront consulter vos publications.')}}
            </li>
            <li>
                {{__('Si le compte est privé, seuls les utilisateurs inscrits pourront accéder au contenu.')}}
            </li>
            <li>
                {{__('Les publications payantes demeureront verrouillées même pour les profils ouverts.')}}
            </li>
        </ul>
    </div>


    @endif




    @if(getSetting('security.allow_geo_blocking'))

    <div class="aff_privacy_checkbox ">
        <div>
            Activez le blocage géographique
        </div>

        <div class="">
            <div class="custom-control custom-switch custom-switch">
                <input type="checkbox" class="custom-control-input" id="enable_geoblocking"
                    {{Auth::user()->enable_geoblocking ? 'checked' : ''}}>
                <label class="custom-control-label" for="enable_geoblocking"></label>
            </div>
        </div>
    </div>

    <div class="aff_privacy_blocage_titre ">
        Si cette fonctionnalité est activée, l'accès sera limité pour les visiteurs de certains pays.
    </div>
    <div class="aff_privacy_blocage_pays "> 
        <div>
            <label for="countrySelect">
            {{__('Country')}}
            </label>
            <select class="country-select input-sm uifield-country" id="countrySelect" required multiple="multiple">
                @foreach($countries as $country)
                @if($country->name !== 'All')
                    <option>{{$country->name}}</option>
                @endif
                @endforeach
            </select>
        </div>
    </div>
    @endif

    @if(getSetting('security.allow_users_2fa_switch'))

    <div class="aff_privacy_checkbox">
        <div>
            Activez l'authentification à deux facteurs par email
        </div>

        <div class="custom-control custom-switch custom-switch">
            <input type="checkbox" class="custom-control-input" id="enable_2fa"
                {{Auth::user()->enable_2fa ? 'checked' : ''}}>
            <label class="custom-control-label" for="enable_2fa"></label>
        </div>
    </div>



    <div class="aff_privacy_devices">
        @if($verifiedDevicesCount)
        <div class="aff_privacy_devices_ok">
        Appareils autorisés
        </div>

        @include('elements.settings.user-devices-list', ['type' => 'verified'])
        @endif
        @if($unverifiedDevicesCount)
        <div class="aff_privacy_devices_not_ok">
        Appareils non vérifiés.
        </div>
        @include('elements.settings.user-devices-list', ['type' => 'unverified'])
        @endif
    </div>

    @endif


</div>
@include('elements.settings.device-delete-dialog')
