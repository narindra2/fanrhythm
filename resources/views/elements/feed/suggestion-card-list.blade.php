<div data-memberuserid="{{$profile->id}}" class="aff_suggest_thumbs">
    <div class="aff_search_user_list">
        <a href="{{route('profile',['username'=>$profile->username])}}">

            <img src="{{$profile->avatar}}" />
            {!! $profile->getUserStatusHtml() !!}
            <div class="aff_info_name">
                <div>
                    <span>
                        {{$profile->name}}

                        @if($profile->email_verified_at && $profile->birthdate && ($profile->verification &&
                        $profile->verification->status == 'verified'))

                        @endif

                    </span>
                </div>
                <div>
                    <span>
                        <span>@</span>{{$profile->username}}
                    </span>
                </div>
            </div>
        </a>

        <a href="{{route('profile',['username'=>$profile->username])}}">
            {{__("Voir le profil")}}
        </a>
    </div>
</div>
