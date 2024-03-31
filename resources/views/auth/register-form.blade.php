<form method="POST" action="{{ route('register') }}" id="register-form">
    @csrf



    <div class="form-group ">

        <div class="">
            <input placeholder="{{ __('Nom') }}" id="name" type="text"
                class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                autocomplete="name" autofocus>
            {{-- @error('name')
            <span class="invalid-feedback" role="alert">
            {{ $message }}
            </span>
            @enderror --}}
        </div>
    </div>

    <div class="form-group ">

        <div class="">
            <input placeholder="{{ __('E-mail') }}" id="email" type="email"
                class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                required autocomplete="email">
            {{-- @error('email')
            <span class="invalid-feedback" role="alert">
            {{ $message }}
            </span>
            @enderror --}}
        </div>
    </div>

    <div class="form-group ">

        <div class="">
            <input placeholder="{{ __('Mot de passe') }}" id="password" type="password"
                class="form-control @error('password') is-invalid @enderror" required name="password"
                autocomplete="new-password">

            {{-- @error('password')
            <span class="invalid-feedback" role="alert">
            {{ $message }}
            </span>
            @enderror --}}
        </div>
    </div>

    <div class="form-group ">


        <div class="">
            <input placeholder="{{ __('Confirmer votre mot de passe') }}" id="password-confirm" type="password"
                class="form-control @error('password_confirmation') is-invalid @enderror" required
                name="password_confirmation" autocomplete="new-password">
            {{-- @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
            {{ $message }}
            </span>
            @enderror --}}
        </div>
    </div>
    <style>
        .error-register{
            font-size: 12px; 
            color: #f33535;
        }
    </style>
    @error('name')
    <span class="error-register" role="alert">
        {{ $message }}
    </span> <br>
    @enderror
    @error('email')
        <span class="error-register" role="alert">
            {{ $message }}
        </span><br>
    @enderror
    @error('password')
        <span class="error-register" role="alert">
            {{ $message }}
        </span><br>
    @enderror
    @error('password_confirmation')
        <span class="error-register" role="alert">
            {{ $message }}
        </span><br>
    @enderror
    @error('terms')
        <span class="error-register" role="alert">
            {{ $message }}
        </span><br>
    @enderror

    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <div class="">
                <input class="custom-control-input @error('terms') is-invalid @enderror" id="tosAgree" type="checkbox"
                    name="terms" value="1" placeholder="{{ __('Terms and Conditions') }}">
                <label class="custom-control-label" for="tosAgree">
                    <span>{{ __('Jaccepte') }}
                        <a
                            href="{{ url('/agreement') }}">{{ __("les conditions d'utilisation") }}</a>
                       , <a
                        <a
                            href="{{ url('/agreement#community-guidelines') }}">{{ __("community guidelines") }}</a>
                        {{ __('et') }} <a
                            href="/privacy/">{{ __('la politique de confidentialité.') }}</a></span>
                </label>
            </div>
        </div>
    </div>

    @if(getSetting('security.recaptcha_enabled') && !Auth::check())
    <div class="form-group row d-flex justify-content-center captcha-field">
        {!! NoCaptcha::display(['data-theme' => (Cookie::get('app_theme') == null ?
        (getSetting('site.default_user_theme')) : Cookie::get('app_theme') )]) !!}
        {{--        {!! NoCaptcha::displaySubmit('register-form', 'submit now!', ['data-theme' => (Cookie::get('app_theme') == null ? (getSetting('site.default_user_theme')) : Cookie::get('app_theme') )]) !!}--}}
        @error('g-recaptcha-response')
        <span class="text-danger" role="alert">
            <strong>{{__("Vérifier le captcha")}}</strong>
        </span>
        @enderror
    </div>
    @endif

    <button type="submit" class="btn btn-primary afri_btn w-100">
        {{ __('Créer un compte') }}
    </button>

</form>

<p class="avez_vous avez_vous_2">
    {{__('Vous avez déjà un compte ?')}}
    @if(isset($mode) && $mode == 'ajax')
    <a href="javascript:void(0);" onclick="LoginModal.changeActiveTab('login')"
        class="text-primary text-gradient font-weight-bold">{{__('Sign in')}}</a>
    @else
    <a href="{{route('login')}}" class="text-primary">{{__('Se connecter')}}</a>
    @endif
</p>


<ul>
    <!--<li>-->
    <!--    <a href="https://blog.afrifan.com/">-->
    <!--        {{__('Blog')}}-->
    <!--    </a>-->
    <!--</li>-->
    <!--<li>-->
    <!--    <a href="https://blog.afrifan.com/category/faq/">-->
    <!--        {{__('FAQ')}}-->
    <!--    </a>-->
    <!--</li>-->
    <li>
        <a href="/agreement/">
            {{__('Termes and conditions')}}
        </a>
    </li>
    <li>
        <a href="{{ url('/agreement#community-guidelines') }}">
            {{__('Guidelines')}}
        </a>
    </li>
</ul>

<p class="login_copyright">
© {{date('Y')}} Fanrhythm 
</p>

