@extends('layouts.no-nav')
@section('content')

 <!--style="background: url({{asset('/img/home_2.webp')}});    background-size: 40%;-->
 <!--   background-repeat: repeat;"-->
<div id="afri_login">
    <div>
        <p class="text-center">
            <a href="{{action('HomeController@index')}}">
            <img src="{{asset('img/logo.webp')}}" alt="" style="width:auto;height: 80px">
            </a>
        </p>


        <p class="creer_compte">
            {{__("Définir un nouveau mot de passe")}}
        </p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">

                <div class="">
                    <input placeholder="{{__("E-mail")}}" id="email" type="email"
                        class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">

                <div class="">
                    <input placeholder="{{__("Mot de passe")}}" id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">

                <div class="">
                    <input placeholder="{{__("Confirmer votre mot de passe")}}" id="password-confirm" type="password"
                        class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <button type="submit" class="btn btn-primary afri_btn w-100">
                {{ __('Réinitialisation') }}
            </button>

        </form>

    </div>
</div>

@endsection
