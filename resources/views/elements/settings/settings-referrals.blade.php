<div class="aff_edit_info_form">

    <div class="aff_refferal_info" style="padding: 27px 27px 11px 27px;">
        <div>
            {{__('Lien de parrainage créateur de contenus')}} 
        </div>
        <div>
        {{__("Partagez votre lien de parrainage et invitez d'autres personnes à rejoindre notre plateforme. Grâce à notre programme de parrainage, vous bénéficierez d'une commission sur leurs gains. C'est une excellente occasion de gagner tout en aidant notre communauté à grandir !")}}
        </div>
    </div>
    <div class="aff_ref_notif_title">
        {{__('Refer a content creator')}} :   <span class="text-primary">{{ __("Obtenez 35 % des gains de Fanrhythm") }}</span>
    </div>
    <div class="aff_ref_link">
        <div>
            <input type="text" @switch(getSetting('referrals.referrals_default_link_page')) @case('profile')
                value="{{route('profile',['ref'=>\Illuminate\Support\Facades\Auth::user()->referral_code, 'username'=>\Illuminate\Support\Facades\Auth::user()->username])}}"
                @break @case('home')
                value="{{route('home',['ref'=>\Illuminate\Support\Facades\Auth::user()->referral_code])}}" @break
                @case('register')
                value="{{route('register',['ref'=>\Illuminate\Support\Facades\Auth::user()->referral_code])}}" @break
                @endswitch
                placeholder="{{route('profile',['ref'=>\Illuminate\Support\Facades\Auth::user()->referral_code, 'username'=>\Illuminate\Support\Facades\Auth::user()->username])}}"
                id="copy-input">
            <span class="input-group-btn">
                <button type="button" id="copy-button" data-toggle="tooltip" data-placement="bottom"
                    title={{__('Copy to Clipboard')}}>
                    {{__('Copier')}}
                </button>
            </span>
        </div>
    </div>
    {{-- <div class="aff_refferal_info" style="padding: 3px  27px 11px 27px;">
        <div>
            {{__('Lien de parrainage user')}} 
        </div>
    </div> --}}
    <div class="aff_ref_notif_title">
        {{__('Refer a user')}} :     <span class="text-primary">{{ __("Obtenez 15 % des gains de Fanrhythm") }}</span>
    </div>
    <div class="aff_ref_link">
        <div>
            <input type="text" @switch(getSetting('referrals.referrals_default_link_page')) @case('profile')
                value="{{route('profile',['ref_user'=>\Illuminate\Support\Facades\Auth::user()->referral_code_type_user, 'username'=>\Illuminate\Support\Facades\Auth::user()->username])}}"
                @break @case('home')
                value="{{route('home',['ref_user'=>\Illuminate\Support\Facades\Auth::user()->referral_code_type_user])}}" @break
                @case('register')
                value="{{route('register',['ref_user'=>\Illuminate\Support\Facades\Auth::user()->referral_code_type_user])}}" @break
                @endswitch
                placeholder="{{route('profile',['ref_user'=>\Illuminate\Support\Facades\Auth::user()->referral_code_type_user, 'username'=>\Illuminate\Support\Facades\Auth::user()->username])}}"
                id="copy-input-referral-user">
            <span class="input-group-btn">
                <button type="button" id="copy-button-referral-user" data-toggle="tooltip" data-placement="bottom"
                    title={{__('Copy to Clipboard')}}>
                    {{__('Copier')}}
                </button>
            </span>
        </div>
    </div>

    <div class="aff_ref_notif_title">
        {{__('Votre liste de parrainages')}}
    </div>


    @if(count($referrals))
        @foreach($referrals as $referral)
        <div class="col d-flex align-items-center py-3 border-bottom">
            <div class="pl-2">
                @if($referral->usedBy)
                <a href="{{route('profile',['username'=>$referral->usedBy->username])}}">
                    <img class="rounded-circle avatar" src="{{$referral->usedBy->avatar}}"
                        alt="{{$referral->usedBy->username}}">
                </a>
                @else
                <a href="{{route('profile',['username'=>$referral->usedBy->username])}}">
                    <img class="rounded-circle avatar"
                        src="{{\App\Providers\GenericHelperServiceProvider::getStorageAvatarPath(null)}}" alt="Avatar">
                </a>
                @endif
            </div>
            <div class="col-lg-3 text-truncate">
                <a href="{{route('profile',['username'=>$referral->usedBy->username])}}" >
                    <b>{{$referral->usedBy->name}}</b>
                </a>
            </div>
            <div class="col-lg-3  d-md-block">
                @if ($referral->referral_code_type == App\User::REFERRAL_CODE_TYPE_USER )
                    Referral user
                @elseif ($referral->referral_code_type ==  App\User::REFERRAL_CODE_TYPE_MODEL )
                    Referral model
                @endif
            </div>
            <div class="col-lg-3 d-none d-md-block">
                {{__('Since')}}: {{ \Carbon\Carbon::parse($referral->created_at)->format('Y-m-d') }}
            </div>
            <div class="col-lg-3 text-truncate">
                {{__('Earned')}}:<b>{{config('app.site.currency_symbol')}}{{\App\Providers\UsersServiceProvider::getTotalAmountEarnedFromRewardsByUsers(\Illuminate\Support\Facades\Auth::user()->id, $referral->used_by)}}</b>
            </div>
        </div>
        @endforeach
        <div class="d-flex flex-row-reverse mt-3 mr-4">
            {{ $referrals->onEachSide(1)->links() }}
        </div>
        @else
        <div class="aff_ref_notif_nul">
           {{__('Il n\'y a actuellement aucun abonnement actif ou annulé.')}}
        </div>
    @endif



</div>
