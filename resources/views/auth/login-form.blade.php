<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group ">
        <div class="">
            <input placeholder="{{__('E-mail')}}" id="email" type="email"
                class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                autocomplete="email" autofocus>
            {{-- @error('email')
            <span class="invalid-feedback" role="alert">
            {{ $message }}
            </span>
            @enderror --}}
        </div>
    </div>

    <div class="form-group">

        <div class="">
            <input placeholder="{{__('Mot de passe')}}" id="password" type="password"
                class="form-control @error('password') is-invalid @enderror" name="password"
                autocomplete="current-password">
            {{-- @error('password')
            <span class="invalid-feedback"  role="alert">
            {{ $message }}
            </span>
            @enderror --}}
        </div>
            @error('email')
            <span style="font-size: 12px; color: #f33535;" role="alert">
                *{{__("Email ou mot de passe est incorrect")}}.
            </span>
            @enderror
            @error('password')
                <span style="font-size: 12px; color: #f33535;" role="alert">
                    *{{__('Email ou mot de passe est incorrect')}}.
                </span>
            @enderror
    </div>
    <p>
        @if (Route::has('password.request'))

        @if(isset($mode) && $mode == 'ajax')
        <a href="javascript:void(0);" onclick="LoginModal.changeActiveTab('forgot')" class=""
            id="forgotPass-label">{{ __('Mot de passe oublié') }}</a>
        @else
        <a href="{{ route('password.request') }}" class="" id="forgotPass-label">{{ __('Mot de passe oublié') }}</a>
        @endif

        @endif
    </p>

    <button type="submit" class="btn btn-primary afri_btn w-100">
        {{__('Se connecter')}}
    </button>

</form>
<br>
<p class="avez_vous">
    {{__("Login Vous n’avez-pas encore un compte")}}
    <a href="{{route('register')}}" class="text-primary">{{__('Login Créer un compte')}}</a>
</p>
<br>

<ul>
    <!--<li>-->
    <!--    <a href="https://blog.fanrhythm.com/">-->
    <!--        {{__('Blog')}}-->
    <!--    </a>-->
    <!--</li>-->
    <!--<li>-->
    <!--    <a href="https://blog.fanrhythm.com/category/faq/">-->
    <!--        {{__('FAQ')}}-->
    <!--    </a>-->
    <!--</li>-->
    <li>
        <a href="{{ url('/agreement') }}">
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
© {{date('Y')}} fanrhythm 
</p>
