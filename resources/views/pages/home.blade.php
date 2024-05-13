@extends('layouts.generic')

@section('page_description', getSetting('site.slogan'))
@section('share_url', route('home'))
@section('share_title', getSetting('site.name') . ' - ' . getSetting('site.slogan'))
@section('share_description', getSetting('site.description'))
@section('share_type', 'article')
@section('share_img', GenericHelper::getOGMetaImage())

@section('scripts')
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "{{getSetting('site.name')}}",
        "url": "{{getSetting('site.app_url')}}",
        "address": ""
    }

</script>
@stop

@section('styles')
    {!! Minify::stylesheet(['/css/pages/home.css', '/css/pages/search.css'])->withFullUrl() !!}
@stop

@section('content')

    <div id="home_1">
        <style>
            #home_1 {
                
            background-size: contain,
            50%;
            background-repeat: repeat,
            no-repeat;
            background-position: center
            }

            @media screen and (min-width: 1440px) {
                #home_1 {
                    
            background-size: contain,
            40%;
            background-repeat: repeat,
            no-repeat;
            background-position: center
            }
            }
        </style>
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6 col-md-7">
                    <h1 class="mb-4">

                        <span class="text-primary">
                            {{ __("Réseau Social Exclusif") }}
                            <br>
                        </span>
                    </h1>
                    <p     style="font-size: 28px;line-height: 42px; letter-spacing: normal;">
                        {{ __('Nous connectons les créateurs de contenus du monde et les fans') }}.
                    </p>
                    <p class="mb-4" style="margin-top: 10px">
                        {{ __('Inscris-toi avant la fin du mois et obtiens 85% des gains le premier mois') }}.
                    </p>

                    <ul class="list-inline mb-2">
                        <li class="list-inline-item">
                            <a class="afri_btn btn-primary" href="{{ route('register') }}">
                                {{ __('Créer un compte') }}

                                <svg width="6px" height="10px" viewBox="0 0 6 10" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Homepage" transform="translate(-394.000000, -621.000000)" stroke="#FFFFFF"
                                            stroke-width="2">
                                            <g id="input" transform="translate(221.000000, 602.000000)">
                                                <g id="chevron-right-(1)" transform="translate(174.000000, 20.000000)">
                                                    <polyline id="Path" points="0 8 4 4 0 0"></polyline>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="afri_btn btn-outline" href="{{ route('login') }}">
                                {{ __('Se connecter') }}
                            </a>
                        </li>
                            <style>
                                .communities-imgs{
                                    object-fit: fill;
                                    width: 50px;
                                    height: 30px !important;
                                    margin: 8px 3px 1px 3px;
                                }
                                .communities{
                                    margin-top:35px ;
                                    font-size: 14px;
                                    width: max-content;
                                    display: flex;
                                }
                                @media (max-width: 768px) {
                                    .communities{
                                        margin-top: 8px;
                                        font-size: 14px;
                                        display: block;
                                    }
                                    .communities-imgs {
                                        object-fit: fill;
                                        width: 84px;
                                        height: 45px !important;
                                        margin: 0px 3px 1px 3px;
                                    }
                                }
                            </style>
                            <div class="mb-4 communities" >
                                <p>{{ __('Our platform is open to all communities like LGBT, models, AI models, etc...') }}.</p>
                                <div style="display: flex; ">
                                    <img src="{{ asset('/img/fanrhythm/lgbt.jpg') }}" class="communities-imgs"/>
                                    <img src="{{ asset('/img/fanrhythm/ai.jpg') }}" class="communities-imgs" />
                                    <img src="{{ asset('/img/fanrhythm/bitcoin.png') }}" class="communities-imgs" />
                                    <img src="{{ asset('/img/fanrhythm/gaming.png') }}" class="communities-imgs" />
                                </div>
                            </div>
                    </ul>
                </div>
                
                <div class="col-md-5">
                    <img src="{{ asset('/img/fanrhythm/home_1.webp') }}" class="img-fluid" width="120%;"/>
                </div>
            </div>
        </div>
    </div>


    <div id="home_4">
        <div class="container">
            <div class="row justify-content-around align-items-center">
                <div class="col-lg-4 col-md-6">
                    <div class="home_info_content active">
                        @if((Auth::check() && Auth::user()->settings['locale'] === 'en') || request()->cookie('app_locale') === 'en')
                            <img src="{{ asset('/img/tab_1_anglais.png') }}" class="img-fluid" />
                        @else
                            <img src="{{ asset('/img/tab_1.webp') }}" class="img-fluid" />
                        @endif
                    </div>
                    <div class="home_info_content">
                        @if((Auth::check() && Auth::user()->settings['locale'] === 'en') || request()->cookie('app_locale') === 'en')
                            <img src="{{ asset('/img/tab_2_anglais.png') }}" class="img-fluid" />
                        @else
                            <img src="{{ asset('/img/tab_2.webp') }}" class="img-fluid" />
                        @endif
                    </div>
                    <div class="home_info_content">
                        @if((Auth::check() && Auth::user()->settings['locale'] === 'en') || request()->cookie('app_locale') === 'en')
                            <img src="{{ asset('/img/tab_3_anglais.png') }}" class="img-fluid" />
                        @else
                            <img src="{{ asset('/img/tab_3.webp') }}" class="img-fluid" />
                        @endif
                    </div>
                    <div class="home_info_content">
                        @if((Auth::check() && Auth::user()->settings['locale'] === 'en') || request()->cookie('app_locale') === 'en')
                            <img src="{{ asset('/img/tab_4_anglais.png') }}" class="img-fluid" />
                        @else
                            <img src="{{ asset('/img/tab_4.webp') }}" class="img-fluid" />
                        @endif
                    </div>
                    <div class="home_info_content">
                        @if((Auth::check() && Auth::user()->settings['locale'] === 'en') || request()->cookie('app_locale') === 'en')
                            <img src="{{ asset('/img/tab_5_anglais.png') }}" class="img-fluid" />
                        @else
                            <img src="{{ asset('/img/tab_5.webp') }}" class="img-fluid" />
                        @endif
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <h2 style="font-size: 40px;">
                        {{ __('C’est quoi ') }}<span class="text-primary">{{ __('Fanrhythm ?') }}
                        </span>
                    </h2>

                    <ul id="home_tab">
                        <li>
                            <a href="#" class="active">
                                {{ __('Souscription') }}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                {{ __('Messages privés') }}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                {{ __('Demande de contenus privés') }}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                {{ __('Pourboires') }}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                {{ __('Contenu éphémère') }}
                            </a>
                        </li>
                        <!--li>
                            <a href="#">
                                {{ __('Live_home') }}
                                <span>
                                    {{ __('en cours de création') }}
                                </span>
                            </a>
                        </li-->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="home_3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="text-center mb-4">
                        <p class="mb-4">
                            <img src="{{ asset('/img/logo.webp') }}" style="width: 25%" class="img-fluid" />
                        </p>
                        <h2>
                            {{ __('Calculateur') }}
                            <span class="text-primary">
                                {{ __('des gains') }}
                            </span>
                            {{ __('des créateurs de contenu') }}
                        </h2>
                        <p class="mb-5">
                            {{ __('Estimez vos revenus pour optimiser votre stratégie de monétisation') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-8">
                    <div id="home_simulateur">
                        <div class="d-flex justify-content-between align-items-center w">
                            <div class="simul_text">
                                {{ __('Nombre d’abonnés sur ') }}

                                <img src="{{ asset('/img/home_social.svg') }}" alt="" class="ml-4">
                            </div>
                            <div class="simul_number">
                                <span id="numberFollowers">
                                    1000
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="home_range">
                        <input type="range" alue="0" min="1000" max="1000000" id="rangeNumberFollowers"
                            oninput="$('#numberFollowers').html($(this).val())">
                    </div>
                </div>
                <div class="col-1 d-none d-lg-flex">

                </div>
                <div class="col-lg-4 col-md-8">
                    <div id="home_simulateur">
                        <div class="d-flex justify-content-between align-items-center w">
                            <div class="simul_text">
                                {{ __('Prix des souscriptions') }}
                            </div>
                            <div class="simul_number">
                                <span id="monthlySubscription">
                                    10
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="home_range">
                        <input type="range" value="10" oninput="$('#monthlySubscription').html($(this).val())"
                            min="5" max="500" id="rangeMonthlySubscription">
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8" id="result_home">
                    <div>
                        {{ __('Wow, vous pourriez gagner jusqua') }} <span id="estimatedEarn">160</span>
                        {{ __('des souscriptions') }}
                    </div>
                    <p>
                        {{ __('Félicitations, voici un estimatif des gains basé') }} <br>
                        {{ __('incluant les 20% de frais de fonctionnement Fanrhythm') }}
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div id="home_2">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-auto col-sm-12">
                    <img src="{{ asset('/img/fanrhythm/home_4.webp') }}" />
                    {{-- <img src="{{ asset('/img/home_10.png') }}" id="mobile_showcase" /> --}}
                    <img src="{{ asset('/img/fanrhythm/home_4.webp') }}" id="mobile_showcase" />

                </div>
                <div class="col-md col-sm-12">
                    <div class="text-center p-lg-5 p-0">
                        <h2 class="mb-4 text-center">
                            {{ __('Inscris-toi ') }}
                            <span class="text-primary">
                                {{ __('maintenant') }}
                            </span>
                            {{ __('et gagne 85% des gains') }}
                        </h2>
                        <p class="mb-4">
                            {{ __('Rejoins comme beaucoup de créateurs de contenus sur notre plateforme, partage ta passion auprès de ta communauté et sois rémunéré pour ton travail') }}
                        </p>

                        <p>
                            <a class="afri_btn btn-primary d-inline-flex" href="{{ route('register') }}">
                                {{ __('Inscris toi pour 85% maintenant') }}
                                <svg width="6px" height="10px" viewBox="0 0 6 10" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Homepage" transform="translate(-394.000000, -621.000000)"
                                            stroke="#FFFFFF" stroke-width="2">
                                            <g id="input" transform="translate(221.000000, 602.000000)">
                                                <g id="chevron-right-(1)" transform="translate(174.000000, 20.000000)">
                                                    <polyline id="Path" points="0 8 4 4 0 0"></polyline>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-md-auto col-sm-12">
                    <img src="{{ asset('/img/fanrhythm/home_3.webp') }}" />
                </div>
            </div>
        </div>
    </div>






    <div id="home_5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center">
                        {{ __('Comment') }}
                        <span class="text-primary">
                            {{ __('ça marche ?') }}
                        </span>
                    </h2>
                </div>
            </div>
            <div class="row" id="home_faq_col">
                <div class="col-lg-4 col-md-12">
                    <div id="hom_faq">
                        
                        @if((Auth::check() && Auth::user()->settings['locale'] === 'en') || request()->cookie('app_locale') === 'en')
                            <img src="{{ asset('/img/faq_1_english.webp') }}" class="img-fluid" />
                        @else
                            <img src="{{ asset('/img/fanrhythm/faq_1.webp') }}" />
                        @endif

                        <div>
                            <span>
                                {{ __('Etape 1') }}
                            </span>
                            <h3>
                                {{ __('Créez votre compte créateur') }}
                            </h3>
                            <p>
                                {{ __('Devenez un compte certifié et commencez à partager du contenu en quelques minutes.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div id="hom_faq">
                        <img src="{{ asset('/img/fanrhythm/faq_2.webp') }}" />
                        <div>

                            <span>
                                {{ __('Etape 2') }}
                            </span>
                            <h3>
                                {{ __('Connectez-vous avec vos fans') }}
                            </h3>
                            <p>
                                {{ __('Partagez votre compte auprès de votre communauté de fans sur vos réseaux sociaux.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div id="hom_faq">
                        
                        
                        @if((Auth::check() && Auth::user()->settings['locale'] === 'en') || request()->cookie('app_locale') === 'en')
                            <img src="{{ asset('/img/faq_3_english.webp') }}" class="img-fluid" />
                        @else
                            <img src="{{ asset('/img/fanrhythm/faq_3.webp') }}" />
                        @endif

                        <div>
                            <span>
                                {{ __('Etape 3') }}
                            </span>
                            <h3>
                                {{ __('Gagnez votre revenu') }}
                            </h3>
                            <p>
                                {{ __('Recevez 85% des gains pendant le premier mois. Retirez vos gains sur votre compte.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="home_6">
        <div class="container">
            <div class="row align-items-center justify-content-around">
                <div class="col-lg-5 col-md-8">
                    <img src="{{ asset('/img/fanrhythm/home_6.webp') }}" class="img-fluid" />
                </div>
                <div class="col-lg-6 col-md-10">
                    <p>
                        {{ __('Ne manquez pas cette opportunité') }}
                    </p>
                    <h2>
                        {{ __('Sans tarder crées ton compte créateur sur fanrhythm.com') }}
                    </h2>
                    <p>
                        <a href="#" class="afri_btn btn-primary d-inline-flex">
                            {{ __('Créer un compte') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

@stop
