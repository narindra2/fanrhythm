@extends('layouts.no-nav')
@section('page_title', __('Login'))

@section('content')

<!--style="background: url({{asset('/img/home_2.webp')}});    background-size: 40%;-->
<!--    background-repeat: repeat;"-->

<div id="afri_login">
    <div>
        <p class="text-center"> 
             <a href="{{action('HomeController@index')}}">
             <img src="{{asset('img/logo.webp')}}" alt="" style="width:auto;height: 80px">
                </a>
        </p>
        @include('auth.social-login-box')
        <!-- <p class="ou">
        {{__("Login_ou")}}
        </p> -->

        @include('auth.login-form')
        
    </div>
</div>


@endsection
