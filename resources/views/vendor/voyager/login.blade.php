@extends('voyager::auth.master')

@section('content')
    <div class="afrifan_login_admin">

       
       <div>
        <form action="{{ route('voyager.login') }}" method="POST">
                {{ csrf_field() }}

                <p>
                <a href="/">
                    <img src="{{asset('img/logo.webp')}}" alt="" style="width:auto;height: 53px;filter: brightness(5.5);">
                </a>
                </p>
                <input autocomplete="{{ uniqid() }}" type="text" name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('voyager::generic.email') }}"  required>

                <input autocomplete="{{ uniqid() }}" type="password" name="password" placeholder="{{ __('voyager::generic.password') }}" required>

                <button type="submit">
                    <span class="signingin hidden"><span class="voyager-refresh"></span> {{ __('voyager::login.loggingin') }}...</span>
                    <span class="signin">{{ __('voyager::generic.login') }}</span>
                </button>

            </form>

            @if(!$errors->isEmpty())
                <div class="alert alert-red">
                    <ul class="list-unstyled">
                        @foreach($errors->all() as $err)
                            <li>Identifiants incorrects. Veuillez vérifier votre adresse e-mail et votre mot de passe.</li>
                        @endforeach
                    </ul>
                </div>
            @endif
       </div>

    </div> <!-- .login-container -->
@endsection