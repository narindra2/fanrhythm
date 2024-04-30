<div data-memberuserid="{{$profile->id}}" class="aff_suggest_thumbs">

    <a href="{{route('profile',['username'=>$profile->username])}}"
        style="background: url({{$profile->cover}});background-size:cover;background-position:center">
        @if(isset($isListMode))
        <span class="h-pill h-pill-accent rounded mt-1 suggestion-card-btn" data-toggle="tooltip"
            data-placement="bottom" title="" onclick="Lists.showListMemberRemoveModal({{$profile->id}})"
            data-original-title="{{__('Delete')}}">
            @include('elements.icon',['icon'=>'trash-outline','variant'=>'medium'])
        </span>
        @endif

        <div>
            <img src="{{$profile->avatar}}" class="avatar rounded-circle" />
            {!! $profile->getUserStatusHtml("57px") !!}
            <div>
                <div>
                    {{$profile->name}}

                    @if($profile->email_verified_at 
                    // && $profile->birthdate 
                    && ($profile->verification &&
                    $profile->verification->status == 'verified'))
                    <span data-toggle="tooltip" data-placement="top" title="{{__('Verified user')}}">

                        <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="card-user" transform="translate(-218.000000, -79.000000)">
                                    <g id="Group" transform="translate(218.000000, 79.000000)">
                                        <circle id="Oval" fill="#59B8F7" cx="8" cy="8" r="8"></circle>
                                        <g id="check" transform="translate(5.000000, 6.000000)" stroke="#FFFFFF"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <polyline id="Path" points="5.81818182 0 1.81818182 4 0 2.18181818">
                                            </polyline>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </span>

                    @endif

                </div>
                <div>
                    {{__('@')}}{{$profile->username}}
                </div>
            </div>
        </div>
    </a>


</div>

{{-- <style scoped>
    .user-status-circle-online{
    background-color: #18d963 !important ;
    width: 12px !important;
    height: 12px !important;
    border-radius: 50% !important;
    margin-left: 57px  !important;
    margin-top: 25px !important;
    position: absolute !important;
}
.user-status-circle-not-actif{
    background-color:   #18d963 !important;
    width: 12px !important;
    height: 12px !important;
    border-radius: 50% !important;
    border: 3px solid white !important;
    margin-left: 57px  !important;
    margin-top: 25px !important;
    position: absolute !important;
}
.user-status-circle-offline{
    background-color:rgb(255, 186, 0) !important;
    width: 12px !important;
    height: 12px !important;
    border-radius: 50% !important;
    border: 2px solid white !important;
    margin-left:  57px  !important;
    margin-top: 22px !important;
    position: absolute !important;
}
</style> --}}
