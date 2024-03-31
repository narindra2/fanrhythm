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
            {{__("Réinitialisation du mot de passe")}}
        </p>

        @if (session('status'))
                            <div class="alert alert-success text-white" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            @include('auth.passwords.email-form')

    </div>
</div>


@endsection
