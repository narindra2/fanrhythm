<div>
    @if(Auth::check())
    <a id="aff_user" href="{{route('profile',['username'=>Auth::user()->username])}}">
        @if(Auth::check())
        <img src="{{Auth::user()->avatar}}" class="rounded-circle user-avatar">
        @else
        @include('elements.icon',['icon'=>'person-circle','variant'=>'xlarge text-muted'])
        @endif
        @if(Auth::check())
        <div>
            <div>
                {{Auth::user()->name }}
                
                @if(Auth::check())
                @if(Auth::user()->verification && Auth::user()->verification->status == 'verified')

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
                                
                @endif
                @endif
            </div>
            <div>
                {{ __('@') }}{{Auth::user()->username}}
            </div>
        </div>
        @endif
    </a>

    @endif

    @if(!Auth::check())
    <a href="/" class="non_connecte">
        <img src="/img/logo.webp" class="mail-logo" width="77">
    </a>
    @endif




    <ul>
        <li>
            <a href="{{Auth::check() ? route('feed') : route('home')}}"
                class="{{Route::currentRouteName() == 'feed' ? 'active' : ''}}">


                <div>
                    <svg width="24px" height="26px" viewBox="0 0 24 26" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="menu" transform="translate(1.000000, 2.000000)" stroke="#000000" stroke-width="2.5">
                                <g id="home-(1)" transform="translate(1.000000, 0.000000)">
                                    <path
                                        d="M0,7.7 L9.9,0 L19.8,7.7 L19.8,19.8 C19.8,21.0150264 18.8150264,22 17.6,22 L2.2,22 C0.98497355,22 0,21.0150264 0,19.8 L0,7.7 Z"
                                        id="Path"></path>
                                    <polyline id="Path" points="6.6 22 6.6 11 13.2 11 13.2 22"></polyline>
                                </g>
                            </g>
                        </g>
                    </svg>

                    {{__('Accueil')}}
                </div>
            </a>
        </li>

        <li>
            <a href="{{url('/search?filter=public')}}"
                class="{{url()->full() == url('/search?filter=public') ? 'active' : ''}}">
                <div>
                    <svg width="26px" height="26px" viewBox="0 0 26 26" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="menu" transform="translate(1.000000, -61.000000)" stroke="#000000"
                                stroke-width="2.5">
                                <g id="search" transform="translate(1.000000, 63.000000)">
                                    <circle id="Oval" cx="9.77777778" cy="9.77777778" r="9.77777778"></circle>
                                    <line x1="22" y1="22" x2="16.6833333" y2="16.6833333" id="Path"></line>
                                </g>
                            </g>
                        </g>
                    </svg>
                    {{__('Explorer')}}
                </div>
            </a>
        </li>


        @if(Auth::check())
         @if(Auth::user()->verification && Auth::user()->verification->status == 'verified')



        @if(getSetting('streams.allow_streams'))
        <li class="d-none">
            <a href="{{route('search.get')}}?filter=live"
                class="{{Route::currentRouteName() == 'search.get' && request()->get('filter') == 'live' ? '' : ''}}">


                <div>
                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="10---Recherche---Rechercher-une-personne"
                                transform="translate(-274.000000, -404.000000)" fill="#000000" fill-rule="nonzero">
                                <g id="play-circle-fill" transform="translate(274.000000, 404.000000)">
                                    <path
                                        d="M24,12 C24,18.627417 18.627417,24 12,24 C5.372583,24 0,18.627417 0,12 C0,5.372583 5.372583,0 12,0 C18.627417,0 24,5.372583 24,12 M10.185,7.6395 C9.95637593,7.47672153 9.65600119,7.45520755 9.4065122,7.58374175 C9.15702322,7.71227595 9.00017298,7.96934761 9,8.25 L9,15.75 C9.00017298,16.0306524 9.15702322,16.2877241 9.4065122,16.4162583 C9.65600119,16.5447925 9.95637593,16.5232785 10.185,16.3605 L15.435,12.6105 C15.6322605,12.4697363 15.7493513,12.2423347 15.7493513,12 C15.7493513,11.7576653 15.6322605,11.5302637 15.435,11.3895 L10.185,7.6395 Z"
                                        id="Shape"></path>
                                </g>
                            </g>
                        </g>
                    </svg>

                    {{__('Explore live')}}
                </div>

            </a>
        </li>
        @endif

        @endif
        @endif





        @if(GenericHelper::isEmailEnforcedAndValidated())
        <li>
            <a href="{{route('my.notifications')}}"
                class="{{Route::currentRouteName() == 'my.notifications' ? 'active' : ''}}">
                <div>

                    <svg width="24px" height="26px" viewBox="0 0 24 26" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="menu" transform="translate(1.000000, -124.000000)" stroke="#000000"
                                stroke-width="2.5">
                                <g id="bell" transform="translate(1.000000, 126.000000)">
                                    <path
                                        d="M16.5,6.6 C16.5,2.95492065 13.5450793,0 9.9,0 C6.25492065,0 3.3,2.95492065 3.3,6.6 C3.3,14.3 0,16.5 0,16.5 L19.8,16.5 C19.8,16.5 16.5,14.3 16.5,6.6"
                                        id="Path"></path>
                                    <path
                                        d="M11.803,20.9 C11.4094225,21.5784848 10.6843755,21.9961019 9.9,21.9961019 C9.11562453,21.9961019 8.39057754,21.5784848 7.997,20.9"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    {{__('Notifications')}}
                </div>
                <div
                    class="{{(isset($notificationsCountOverride) && $notificationsCountOverride->total > 0 ) || (NotificationsHelper::getUnreadNotifications()->total > 0) ? '' : 'd-none'}}">
                    {{!isset($notificationsCountOverride) ? NotificationsHelper::getUnreadNotifications()->total : $notificationsCountOverride->total}}
                </div>
            </a>
        </li>
        <li>
            <a href="{{route('my.messenger.get')}}"
                class="{{Route::currentRouteName() == 'my.messenger.get' ? 'active' : ''}}">

                <div>

                    <svg width="26px" height="26px" viewBox="0 0 26 26" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="menu" transform="translate(1.000000, -187.000000)" stroke="#000000"
                                stroke-width="2.5">
                                <g id="message-square" transform="translate(1.000000, 189.000000)">
                                    <path
                                        d="M22,14.6666667 C22,16.0166961 20.9055849,17.1111111 19.5555556,17.1111111 L4.88888889,17.1111111 L0,22 L0,2.44444444 C0,1.09441506 1.09441506,0 2.44444444,0 L19.5555556,0 C20.9055849,0 22,1.09441506 22,2.44444444 L22,14.6666667 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    {{__('Messages')}}
                </div>

                <div class="{{(NotificationsHelper::getUnreadMessages() > 0) ? '' : 'd-none'}}">
                    {{NotificationsHelper::getUnreadMessages()}}
                </div>
            </a>
        </li>




        <li>
            <a href="{{route('my.lists.all')}}" class="{{Route::currentRouteName() == 'my.lists.all' ? 'active' : ''}}">
                <div>

                    <svg width="24px" height="18px" viewBox="0 0 24 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="menu" transform="translate(0.000000, -257.000000)" stroke="#000000"
                                stroke-width="2.5">
                                <g id="list" transform="translate(1.000000, 258.000000)">
                                    <line x1="6.85714286" y1="1.14285714" x2="21.7142857" y2="1.14285714" id="Path">
                                    </line>
                                    <line x1="6.85714286" y1="8" x2="21.7142857" y2="8" id="Path"></line>
                                    <line x1="6.85714286" y1="14.8571429" x2="21.7142857" y2="14.8571429" id="Path">
                                    </line>
                                    <line x1="1.14285714" y1="1.14285714" x2="1.15428571" y2="1.14285714" id="Path">
                                    </line>
                                    <line x1="1.14285714" y1="8" x2="1.15428571" y2="8" id="Path"></line>
                                    <line x1="1.14285714" y1="14.8571429" x2="1.15428571" y2="14.8571429" id="Path">
                                    </line>
                                </g>
                            </g>
                        </g>
                    </svg>
                    {{__('Listes')}}
                </div>
            </a>
        </li>
        {{-- <li>
            <a href="{{route('my.settings',['type'=>'subscriptions'])}}"
                class="{{Route::currentRouteName() == 'my.settings' &&  is_int(strpos(Request::path(),'subscriptions')) ? 'active' : ''}}">
                <div>
                    <svg width="31px" height="26px" viewBox="0 0 31 26" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="users-(1)" transform="translate(2.000000, 2.000000)" stroke="#000000"
                                stroke-width="3">
                                <path
                                    d="M19.5555556,22 L19.5555556,19.5555556 C19.5555556,16.8554968 17.3667254,14.6666667 14.6666667,14.6666667 L4.88888889,14.6666667 C2.18883011,14.6666667 0,16.8554968 0,19.5555556 L0,22"
                                    id="Path"></path>
                                <circle id="Oval" cx="9.77777778" cy="4.88888889" r="4.88888889"></circle>
                                <path
                                    d="M26.8888889,22 L26.8888889,19.5555556 C26.887227,17.3275884 25.379443,15.3825469 23.2222222,14.8255556"
                                    id="Path"></path>
                                <path
                                    d="M18.3333333,0.158888889 C20.4965626,0.712763074 22.0095862,2.66198918 22.0095862,4.895 C22.0095862,7.12801082 20.4965626,9.07723693 18.3333333,9.63111111"
                                    id="Path"></path>
                            </g>
                        </g>
                    </svg>
                    {{__('Mes abonnements')}}
                </div>
            </a>
        </li> --}}
        <li>
            <a href="{{ url('/my/bookmarks/list?filter=all')}}"
                class="{{Route::currentRouteName() == 'my.settings' &&  is_int(strpos(Request::path(),'subscriptions')) ? 'active' : ''}}">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
                      </svg>
                    {{__('Mes bookmarks')}}
                </div>
            </a>
        </li>
        <li>
            <a href="{{route('profile',['username'=>Auth::user()->username])}}"
                class="{{Route::currentRouteName() == 'profile' && (request()->route("username") == Auth::user()->username) ? 'active' : ''}}">
                <div>

                    <svg width="20px" height="22px" viewBox="0 0 20 22" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="menu" transform="translate(-2.000000, -315.000000)" stroke="#000000"
                                stroke-width="2.5">
                                <g id="user" transform="translate(4.000000, 317.000000)">
                                    <path
                                        d="M16,18 L16,16 C16,13.790861 14.209139,12 12,12 L4,12 C1.790861,12 0,13.790861 0,16 L0,18"
                                        id="Path"></path>
                                    <circle id="Oval" cx="8" cy="4" r="4"></circle>
                                </g>
                            </g>
                        </g>
                    </svg>
                    {{__('Mon profil')}}
                </div>

            </a>
        </li>
        @endif

        <li>
            <a href="{{route('my.settings')}}" class="{{Route::currentRouteName() == 'my.settings' ? 'active' : ''}}">
                <div>

                    <svg width="26px" height="26px" viewBox="0 0 26 26" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="menu" transform="translate(2.000000, -382.000000)" stroke="#000000"
                                stroke-width="2.5">
                                <g id="settings" transform="translate(0.000000, 384.000000)">
                                    <circle id="Oval" cx="11" cy="11" r="3"></circle>
                                    <path
                                        d="M18.4,14 C18.1276535,14.6170901 18.2583341,15.3378133 18.73,15.82 L18.79,15.88 C19.1655541,16.2551365 19.3765733,16.7641815 19.3765733,17.295 C19.3765733,17.8258185 19.1655541,18.3348635 18.79,18.71 C18.4148635,19.0855541 17.9058185,19.2965733 17.375,19.2965733 C16.8441815,19.2965733 16.3351365,19.0855541 15.96,18.71 L15.9,18.65 C15.4178133,18.1783341 14.6970901,18.0476535 14.08,18.32 C13.4755294,18.5790683 13.0826229,19.1723571 13.08,19.83 L13.08,20 C13.08,21.1045695 12.1845695,22 11.08,22 C9.9754305,22 9.08,21.1045695 9.08,20 L9.08,19.91 C9.0641566,19.2326708 8.63587177,18.6338652 8,18.4 C7.38290993,18.1276535 6.66218673,18.2583341 6.18,18.73 L6.12,18.79 C5.74486349,19.1655541 5.2358185,19.3765733 4.705,19.3765733 C4.1741815,19.3765733 3.66513651,19.1655541 3.29,18.79 C2.91444591,18.4148635 2.70342669,17.9058185 2.70342669,17.375 C2.70342669,16.8441815 2.91444591,16.3351365 3.29,15.96 L3.35,15.9 C3.82166588,15.4178133 3.95234646,14.6970901 3.68,14.08 C3.42093172,13.4755294 2.82764292,13.0826229 2.17,13.08 L2,13.08 C0.8954305,13.08 0,12.1845695 0,11.08 C0,9.9754305 0.8954305,9.08 2,9.08 L2.09,9.08 C2.76732918,9.0641566 3.36613483,8.63587177 3.6,8 C3.87234646,7.38290993 3.74166588,6.66218673 3.27,6.18 L3.21,6.12 C2.83444591,5.74486349 2.62342669,5.2358185 2.62342669,4.705 C2.62342669,4.1741815 2.83444591,3.66513651 3.21,3.29 C3.58513651,2.91444591 4.0941815,2.70342669 4.625,2.70342669 C5.1558185,2.70342669 5.66486349,2.91444591 6.04,3.29 L6.1,3.35 C6.58218673,3.82166588 7.30290993,3.95234646 7.92,3.68 L8,3.68 C8.60447061,3.42093172 8.99737709,2.82764292 9,2.17 L9,2 C9,0.8954305 9.8954305,0 11,0 C12.1045695,0 13,0.8954305 13,2 L13,2.09 C13.0026229,2.74764292 13.3955294,3.34093172 14,3.6 C14.6170901,3.87234646 15.3378133,3.74166588 15.82,3.27 L15.88,3.21 C16.2551365,2.83444591 16.7641815,2.62342669 17.295,2.62342669 C17.8258185,2.62342669 18.3348635,2.83444591 18.71,3.21 C19.0855541,3.58513651 19.2965733,4.0941815 19.2965733,4.625 C19.2965733,5.1558185 19.0855541,5.66486349 18.71,6.04 L18.65,6.1 C18.1783341,6.58218673 18.0476535,7.30290993 18.32,7.92 L18.32,8 C18.5790683,8.60447061 19.1723571,8.99737709 19.83,9 L20,9 C21.1045695,9 22,9.8954305 22,11 C22,12.1045695 21.1045695,13 20,13 L19.91,13 C19.2523571,13.0026229 18.6590683,13.3955294 18.4,14 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    {{__('Paramètres')}}
                </div>
            </a>
        </li>



        @if(Auth::check())
        @if(Auth::user()->verification && Auth::user()->verification->status == 'verified')



        @if(GenericHelper::isEmailEnforcedAndValidated())
        @if(getSetting('streams.allow_streams'))
        <li>
            <a role="button" class=""
                href="{{route('my.streams.get')}}{{StreamsHelper::getUserInProgressStream() ? '' : ( !GenericHelper::isUserVerified() && getSetting('site.enforce_user_identity_checks') ? '' : '?action=create')}}">

                <div>

                    <svg width="30px" height="20px" viewBox="0 0 30 20" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="10---Recherche---Rechercher-une-personne"
                                transform="translate(-222.000000, -528.000000)" stroke="#000000"
                                stroke-width="2.66666667">
                                <g id="video-(1)" transform="translate(224.000000, 530.000000)">
                                    <polygon id="Path"
                                        points="26.1904767 2.38095243 17.8571432 8.3333335 26.1904767 14.2857146">
                                    </polygon>
                                    <rect id="Rectangle" x="0" y="0" width="17.8571432" height="16.666667"
                                        rx="2.66666667"></rect>
                                </g>
                            </g>
                        </g>
                    </svg>

                    {{__('Create live video')}}

                </div>
            </a>
        </li>
        @endif
        @endif

        @endif
        @endif



        <li>
            <a href="#" class="open-menu">
                <div>

                    <svg width="25px" height="6px" viewBox="0 0 25 6" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="menu" transform="translate(-1.000000, -457.000000)" stroke="#000000"
                                stroke-width="2.5">
                                <g id="more-horizontal" transform="translate(3.000000, 459.000000)">
                                    <circle id="Oval" cx="10.5" cy="1.3125" r="1.3125"></circle>
                                    <circle id="Oval" cx="19.6875" cy="1.3125" r="1.3125"></circle>
                                    <circle id="Oval" cx="1.3125" cy="1.3125" r="1.3125"></circle>
                                </g>
                            </g>
                        </g>
                    </svg>
                    {{__('Plus')}}
                </div>

            </a>
        </li>






        @if(Auth::check())
        @if(Auth::user()->email_verified_at)
        @if(Auth::user()->verification && Auth::user()->verification->status == 'verified')
        @if(!getSetting('site.hide_create_post_menu'))
        @if(GenericHelper::isEmailEnforcedAndValidated())
        <li>
            <a class="btn btn-primary btn_aff " href="{{route('posts.create')}}">
                <div>
                    {{__('Publier')}}
                </div>
            </a>
        </li>
        @endif
        @endif
        @endif
        @endif
        @endif

    </ul>


</div>
