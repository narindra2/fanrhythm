@extends('layouts.user-no-nav')

@section('content')
<div id="aff_content">
    <div class="aff_gauche">
        <p class="aff_title_feed">
            {{__('Rechercher')}}
        </p>

        <div id="aff_search">
            <form action="https://web.fanrhythm.com/search" class="search-box-wrapper w-100" method="GET">
                <span onclick="submitSearch();">

                    <svg width="17px" height="17px" viewBox="0 0 17 17" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Page-de-recherche" transform="translate(-554.000000, -133.000000)" stroke="#8E8E8E"
                                stroke-width="2">
                                <g id="input" transform="translate(534.000000, 114.000000)">
                                    <g id="search" transform="translate(21.000000, 20.000000)">
                                        <circle id="Oval" cx="6.5" cy="6.5" r="6.5"></circle>
                                        <line x1="15" y1="15" x2="11" y2="11" id="Path"></line>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>

                <input type="text" aria-label="Text input with dropdown button"
                    placeholder="{{__('Rechercher par pseudo , hashtag ou autres … ')}}" name="query" value="">
                <input type="hidden" name="filter" value="people">
            </form>

            <span class="search-back-button" data-toggle="collapse" href="#colappsableFilters" role="button"
                aria-expanded="false" aria-controls="colappsableFilters">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-sliders">
                    <line x1="4" y1="21" x2="4" y2="14"></line>
                    <line x1="4" y1="10" x2="4" y2="3"></line>
                    <line x1="12" y1="21" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12" y2="3"></line>
                    <line x1="20" y1="21" x2="20" y2="16"></line>
                    <line x1="20" y1="12" x2="20" y2="3"></line>
                    <line x1="1" y1="14" x2="7" y2="14"></line>
                    <line x1="9" y1="8" x2="15" y2="8"></line>
                    <line x1="17" y1="16" x2="23" y2="16"></line>
                </svg>
            </span>
        </div>
                
        <div class="aff_profil_tab">
            <div>
                <a class="" href="/search?query=&amp;filter=live">
                    <div>
                    {{__('Live')}}
                    </div>
                </a>
            </div>

            <div>
                <a class="" href="/search?query=&amp;filter=top">
                    <div>
                    {{__('Top')}}
                    </div>
                </a>
            </div>

            <div>
                <a class="active" href="/verified_user">
                    <div>
                    {{__('People')}}
                    </div>
                </a>
            </div>

            <div style="display: none">
                <a class="" href="/search?query=&amp;filter=photos">
                    <div>
                    {{__('Photos')}}
                    </div>
                </a>
            </div>

            {{-- <div>
                <a class="" href="/search?query=&amp;filter=videos">
                    <div>
                    {{__('Videos')}}
                    </div>
                </a>
            </div> --}}
            <div>
                <a class="" href="/search?query=&amp;filter=videosPres">
                    <div>
                    {{__('Videos')}}
                    </div>
                </a>
            </div>

        </div>

        <div class="row pt-2">
            @foreach ($verifiedUsers as $userVerify)
            @if ($userVerify->status == 'verified' && $userVerify->user)
            <div class="col-sm-12">
                <div class="aff_search_user_list user-search-box-item user-search-box-item_change_color"
                    style="background: url('{{ $userVerify->user->cover ?? 'chemin_par_defaut_pour_cover' }}'); background-size:cover; background-repeat:no-repeat; background-position:center">
                    <a href="/{{ $userVerify->user->username ?? 'Username Non Disponible' }}">

                        <img src="{{ $userVerify->user->avatar ?? 'chemin_par_defaut_pour_avatar' }}" alt="avatar" />
                        <div class="aff_info_name">
                            <div>
                                <span>
                                    {{ $userVerify->user->name ?? 'Nom Non Disponible' }}

                                    <span data-toggle="tooltip" data-placement="top" title="{{__('Verified user')}}">
                                        <svg style="fill: #59b8f7; height: 16px;" viewBox="0 0 22 22"
                                            aria-label="Compte certifié" role="img" data-testid="icon-verified">
                                            <g>
                                                <path
                                                    d="M20.396 11c-.018-.646-.215-1.275-.57-1.816-.354-.54-.852-.972-1.438-1.246.223-.607.27-1.264.14-1.897-.131-.634-.437-1.218-.882-1.687-.47-.445-1.053-.75-1.687-.882-.633-.13-1.29-.083-1.897.14-.273-.587-.704-1.086-1.245-1.44S11.647 1.62 11 1.604c-.646.017-1.273.213-1.813.568s-.969.854-1.24 1.44c-.608-.223-1.267-.272-1.902-.14-.635.13-1.22.436-1.69.882-.445.47-.749 1.055-.878 1.688-.13.633-.08 1.29.144 1.896-.587.274-1.087.705-1.443 1.245-.356.54-.555 1.17-.574 1.817.02.647.218 1.276.574 1.817.356.54.856.972 1.443 1.245-.224.606-.274 1.263-.144 1.896.13.634.433 1.218.877 1.688.47.443 1.054.747 1.687.878.633.132 1.29.084 1.897-.136.274.586.705 1.084 1.246 1.439.54.354 1.17.551 1.816.569.647-.016 1.276-.213 1.817-.567s.972-.854 1.245-1.44c.604.239 1.266.296 1.903.164.636-.132 1.22-.447 1.68-.907.46-.46.776-1.044.908-1.681s.075-1.299-.165-1.903c.586-.274 1.084-.705 1.439-1.246.354-.54.551-1.17.569-1.816zM9.662 14.85l-3.429-3.428 1.293-1.302 2.072 2.072 4.4-4.794 1.347 1.246z">
                                                </path>
                                            </g>
                                        </svg>
                                    </span>

                                </span>
                            </div>
                            <div>
                                <span>
                                    <span>@</span>{{ $userVerify->user->username ?? 'Username Non Disponible' }}
                                </span>
                            </div>
                        </div>
                    </a>

                    <a href="/{{ $userVerify->user->username ?? 'Username Non Disponible' }}">
                        {{ __("Voir le profil") }}
                    </a>
                </div>
            </div>
            @endif
            @endforeach
            
            {{ $verifiedUsers->links() }}
        </div>
    </div>
    <div class="aff_droite">

    </div>

</div>
@include('template.searchmobile')
@stop
