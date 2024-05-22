<div id="nav_home" class="w-100 position-absolute top-0">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-auto pl-0">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{asset('img/logo.webp')}}" alt="">
                </a>
            </div>
            <div class="col-auto">
                <a href="#" id="open_menu_home">
                    <div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </a>


                @if(Auth::check())

                @endif
                @guest


                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        @include('elements.changeTheme.button')
                    </li>
                    @if(getSetting('site.allow_language_switch'))
                    <li class="list-inline-item">
                        <a href="#otherSections" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                            role="button" aria-controls="otherSections">
                            {{__('Language')}}
                        </a>
                        <ul class="list-unstyled collapse" id="otherSections" style="">

                            <li>
                                <a class="scroll-link d-flex align-items-center" href="{{ url("/language/en") }}">{{
                                    __("Anglais")}}</a>
                            </li>
                            <li>
                                <a class="scroll-link d-flex align-items-center" href="{{ url("/language/fr") }}">{{
                                    __("Français")}}</a>
                            </li>
                            <li>
                                <a class="scroll-link d-flex align-items-center" href="{{ url("/language/es")
                                    }}">Español</a>
                            </li>

                        </ul>

                    </li>
                    @endif

                    <li class="list-inline-item">
                        <a class="link_register" href="{{ route('login') }}">
                            {{ __('Se connecter') }}
                        </a>
                    </li>

                    @if (Route::has('register'))
                    <li class="list-inline-item">
                        <a class="link_login" href="{{ route('register') }}">
                            {{ __('Créer un compte') }}
                        </a>
                    </li>
                </ul>
                @endif
                @else

                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        @include('elements.changeTheme.button')
                    </li>
                    @if(getSetting('site.allow_language_switch'))
                    <li class="list-inline-item">
                        <a href="#otherSections" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                            role="button" aria-controls="otherSections">
                            {{__('Language')}}
                        </a>
                        <ul class="list-unstyled collapse" id="otherSections" style="">

                            <li>
                                <a class="scroll-link d-flex align-items-center" href="{{ url("/language/en") }}">{{
                                    __("Anglais")}}</a>
                            </li>
                            <li>
                                <a class="scroll-link d-flex align-items-center" href="{{ url("/language/fr") }}">{{
                                    __("Français")}}</a>
                            </li>
                            <li>
                                <a class="scroll-link d-flex align-items-center" href="{{ url("/language/es")
                                    }}">Español</a>
                            </li>
                        </ul>

                    </li>
                    @endif

                    <li class="list-inline-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-right" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <img src="{{Auth::user()->avatar}}"
                                class="rounded-circle home-user-avatar">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('feed')}}">
                                {{__("Fil d'actualité")}}
                            </a>
                            <a class="dropdown-item" href="{{route('my.settings')}}">
                                {{__("Reglages")}}
                            </a>
                            <a class="dropdown-item" href="{{route('profile',['username'=>Auth::user()->username])}}">
                                {{__("Mon profil")}}
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{__("Se déconnecter")}}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
                @endguest

            </div>
        </div>
    </div>
</div>

<div class="is_mobile_menu">
    <ul>

        <li>
            <a href="#otherSections" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle right"
                role="button" aria-controls="otherSections">
                {{__('Language')}}
            </a>
            <ul class="list-unstyled collapse" id="otherSections" style="">

                <li>
                    <a class="scroll-link d-flex align-items-center" href="{{ url("/language/en") }}">{{
                        __("Anglais")}}</a>
                </li>
                <li>
                    <a class="scroll-link d-flex align-items-center" href="{{ url("/language/fr") }}">{{
                        __("Français")}}</a>
                </li>
                <li>
                    <a class="scroll-link d-flex align-items-center" href="{{ url("/language/es") }}">Español</a>
                </li>

            </ul>

        </li>



        @guest
        <li>
            <a href="{{ route('login') }}">
                {{ __('Se connecter') }}
            </a>
        </li>
        @if (Route::has('register'))
        <li>
            <a href="{{ route('register') }}">
                {{ __('Créer un compte') }}
            </a>
        </li>
    </ul>
    @endif
    @else

    <ul>

        <li>
            <a href="{{route('feed')}}">
                {{__("Fil d'actualité")}}
            </a>
        </li>
        <li>
            <a href="{{route('profile',['username'=>Auth::user()->username])}}">
                {{__("Mon profil")}}
            </a>
        </li>

        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                {{__("Se déconnecter")}}
            </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </ul>
    @endguest
</div>