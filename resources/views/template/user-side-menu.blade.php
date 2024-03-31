<nav class="sidebar aff_main_sidebar">

    @if (Auth::check())
        <a id="aff_user" href="{{ route('profile', ['username' => Auth::user()->username]) }}">
            @if (Auth::check())
                <img src="{{ Auth::user()->avatar }}" class="rounded-circle user-avatar">
            @else
                @include('elements.icon', ['icon' => 'person-circle', 'variant' => 'xlarge text-muted'])
            @endif
            @if (Auth::check())
                <div>
                    <div>
                        {{ Auth::user()->name }}
                    </div>
                    <div>
                        {{ __('@') }}{{ Auth::user()->username }}
                    </div>
                </div>
            @endif
        </a>

    @endif
    <ul>
        @if (GenericHelper::isEmailEnforcedAndValidated())
            <li
                class="{{ Route::currentRouteName() == 'profile' && request()->route('username') == Auth::user()->username ? 'active' : '' }}">
                <a href="{{ route('profile', ['username' => Auth::user()->username]) }}">
                    <svg width="20px" height="22px" viewBox="0 0 20 22" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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
                    {{ __('Mon profil') }}
                </a>
            </li>

            @if (Auth::check())
                @if (Auth::user()->verification && Auth::user()->verification->status == 'verified')
                    @if (getSetting('streams.allow_streams'))
                        <li
                            class="{{ in_array(Route::currentRouteName(), ['my.streams.get', 'public.stream.get', 'public.vod.get']) ? 'active' : '' }}">
                            <a href="{{ route('my.streams.get') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-video">
                                    <polygon points="23 7 16 12 23 17 23 7"></polygon>
                                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2">
                                    </rect>
                                </svg>
                                {{ __('Video en direct') }}

                            </a>
                        </li>
                    @endif
                    
                @endif
                <li
                    class="{{ url()->current() == url('my/settings/wallet')  ? 'active' : '' }}">
                    <a href="{{route('my.settings',['type'=> "wallet"])}}">
                        <span id="reglage-setting-wallet" class="aff_reglage_icons"></span>
                        {{ __('Wallet et paiement') }}

                    </a>
                </li>
            @endif


            <li class="{{ Route::currentRouteName() == 'my.settings.verify' ? 'active' : '' }}">
                <a href="{{ route('my.settings') }}/verify">

                    <svg width="16px" height="26px" viewBox="0 0 16 26" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="menu" transform="translate(-87.000000, -567.000000)" stroke="#000000"
                                stroke-width="2.5">
                                <g id="dollar-sign-(3)" transform="translate(89.000000, 569.000000)">
                                    <line x1="6" y1="0" x2="6" y2="22" id="Path">
                                    </line>
                                    <path
                                        d="M11,4 L3.5,4 C1.56700338,4 -8.8817842e-16,5.56700338 -8.8817842e-16,7.5 C-8.8817842e-16,9.43299662 1.56700338,11 3.5,11 L8.5,11 C10.4329966,11 12,12.5670034 12,14.5 C12,16.4329966 10.4329966,18 8.5,18 L-8.8817842e-16,18"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>

                    {{ __('Devenir créateur') }}</a>
            </li>




            <li class="{{ (Route::currentRouteName() == 'my.settings' && url()->current() != url('my/settings/wallet')) ? 'active' : '' }}">
                <a href="{{ route('my.settings') }}">
                    <svg width="26px" height="26px" viewBox="0 0 26 26" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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

                    {{ __('Paramètres') }}</a>
            </li>

        @endif
        <li>
            <a href="https://web.fanrhythm.com/contact">

                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                        stroke-linecap="round" stroke-linejoin="round">
                        <g id="menu" transform="translate(-58.000000, -594.000000)" stroke="#000000"
                            stroke-width="2.5">
                            <g id="alert-circle" transform="translate(60.000000, 596.000000)">
                                <circle id="Oval" cx="10" cy="10" r="10"></circle>
                                <line x1="10" y1="6" x2="10" y2="10" id="Path">
                                </line>
                                <line x1="10" y1="14" x2="10.01" y2="14" id="Path">
                                </line>
                            </g>
                        </g>
                    </g>
                </svg>

                {{ __('Aide et support') }}</a>
        </li>

        <li>
            <div class="d-flex align-items-center">
                <button id="change-theme" class="theme-btn" aria-label="Change Theme" title="Change Theme"
                    data-theme-btn="">
                    <span class="icon"></span>
                </button>
                <label id="label-theme-active" for="change-theme" class="link_register mb-0"
                    style="cursor: pointer;font-size: 14px; color: var(--base-color)">Mode dark</label>
            </div>
        </li>
       

        @if (getSetting('site.allow_language_switch'))
            <li>
                <a href="#otherSections" class="d-flex align-items-center" data-toggle="collapse"
                    aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="otherSections">
                    @include('elements.icon', [
                        'icon' => 'language',
                        'variant' => 'medium',
                        'centered' => false,
                        'classes' => 'mr-2',
                    ])
                    {{ __('Language') }}
                </a>
                <ul class="list-unstyled collapse" id="otherSections" style="">

                    <li>
                        <a class="scroll-link d-flex align-items-center"
                            href="{{ url("/language/en") }}">English</a>
                    </li>
                    <li>
                        <a class="scroll-link d-flex align-items-center"
                            href="{{ url("/language/fr") }}">Français</a>
                    </li>

                </ul>

            </li>
        @endif


        <li>
            @if (Auth::check())
                <a class=" pointer-cursor"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <svg width="22px" height="24px" viewBox="0 0 22 24" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="menu" transform="translate(-87.000000, -627.000000)" stroke="#000000"
                                stroke-width="2.5">
                                <g id="power-(1)" transform="translate(89.000000, 629.000000)">
                                    <path
                                        d="M15.365,4.64 C18.8788743,8.15502187 18.878254,13.8529724 15.3636147,17.3672293 C11.8489753,20.8814861 6.15102471,20.8814861 2.63638533,17.3672293 C-0.878254046,13.8529724 -0.878874255,8.15502187 2.635,4.64"
                                        id="Path"></path>
                                    <line x1="9.005" y1="0" x2="9.005" y2="10"
                                        id="Path"></line>
                                </g>
                            </g>
                        </g>
                    </svg>

                    {{ __('Se déconnecter') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}">

                    <svg width="22px" height="22px" viewBox="0 0 22 22" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="menu" transform="translate(-22.000000, -565.000000)" stroke="#000000"
                                stroke-width="2.5">
                                <g id="log-in" transform="translate(24.000000, 567.000000)">
                                    <path
                                        d="M12,0 L16,0 C17.1045695,0 18,0.8954305 18,2 L18,16 C18,17.1045695 17.1045695,18 16,18 L12,18"
                                        id="Path"></path>
                                    <polyline id="Path" points="7 14 12 9 7 4"></polyline>
                                    <line x1="12" y1="9" x2="0" y2="9"
                                        id="Path"></line>
                                </g>
                            </g>
                        </g>
                    </svg>
                    {{ __('Se connecter') }}</a>
            @endif
        </li>
    </ul>
</nav>

<!-- Dark overlay -->
<div class="overlay"></div>
