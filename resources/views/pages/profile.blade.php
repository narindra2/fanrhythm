@extends('layouts.user-no-nav')

@section('page_title', $user->name . '\'s profile')
@section('share_url', route('home'))
@section('share_title', $user->name . '\'s profile' . ' - ' . getSetting('site.name'))
@section('share_description', $seo_description ?? getSetting('site.description'))
@section('share_type', 'article')
@section('share_img', $user->cover)

@section('scripts')
    {!! Minify::javascript(
        array_merge(
            [
                '/js/PostsPaginator.js',
                '/js/CommentsPaginator.js',
                '/js/StreamsPaginator.js',
                '/js/Post.js',
                '/js/pages/profile.js',
                '/js/pages/lists.js',
                '/js/pages/checkout.js',
                '/libs/swiper/swiper-bundle.min.js',
                '/js/plugins/media/photoswipe.js',
                '/libs/photoswipe/dist/photoswipe-ui-default.min.js',
                '/libs/@joeattardi/emoji-button/dist/index.js',
                '/js/plugins/media/mediaswipe.js',
                '/js/plugins/media/mediaswipe-loader.js',
                '/js/LoginModal.js',
                '/js/pages/messenger.js',
                '/js/pages/card-box.js',
            ],
            $additionalAssets,
        ),
    )->withFullUrl() !!}

    <script>
        // aff_top_profile
        var myID = $("#fixed-subscr-profile");
        var myScrollFunc = function() {
            var y = window.scrollY;
            if (y >= 120) {
                myID.addClass("show-nav-subsc").removeClass("hide-nav-subsc")
            } else {
                myID.addClass("hide-nav-subsc").removeClass("show-nav-subsc")
            }
        };
        window.addEventListener("scroll", myScrollFunc);
    </script>
@stop

@section('styles')
    {!! Minify::stylesheet([
        '/css/pages/profile.css',
        '/css/pages/checkout.css',
        '/css/pages/lists.css',
        '/libs/swiper/swiper-bundle.min.css',
        '/libs/photoswipe/dist/photoswipe.css',
        '/libs/photoswipe/dist/default-skin/default-skin.css',
        '/css/pages/profile.css',
        '/css/pages/lists.css',
        '/css/posts/post.css',
    ])->withFullUrl() !!}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photoswipe@5.3.0/dist/photoswipe.css">
@stop

@section('meta')
    @if (getSetting('security.recaptcha_enabled') && !Auth::check())
        {!! NoCaptcha::renderJs() !!}
    @endif
    @if ($activeFilter)
        <link rel="canonical" href="{{ route('profile', ['username' => $user->username]) }}" />
    @endif
@stop

@section('content')


    <div id="aff_content">
        <div class="aff_gauche">
            <p class="aff_title_feed">
                {{ __('Profil de') }} {{ $user->name }}
            </p>

            <style>
                .responsive-add-video {
                    display: none;
                }

                @media screen and (max-width: 769px) {
                    .responsive-add-video {
                        display: block;
                        margin-top: 15px;
                    }
                }
            </style>

            <div class="aff_top_profile">
                <div class="aff_cover">
                    <img src="{{ $user->cover }}">
                </div>
                {!! $user->getUserStatusHtml("120px","33px") !!}
                <div class="aff_avatar">
                    <div>
                        <img src="{{ $user->avatar }}" class="rounded-circle">
                       
                        <div class="aff_info_name">

                            <div class="d-flex">
                                <span>
                                    {{ $user->name }}
                                    @if ($user->email_verified_at && ($user->verification && $user->verification->status == 'verified'))
                                        <span data-toggle="tooltip" data-placement="top" title="{{ __('Verified user') }}">
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
                                </span>

                                @if ($hasActiveStream)
                                    <span data-toggle="tooltip" data-placement="right" title="{{ __('Live streaming') }}">
                                        <div class="blob red ml-3"></div>
                                    </span>
                                @endif
                            </div>
                            <div>
                                <span>@</span>{{ $user->username }}
                            </div>
                        </div>
                    </div>
                    <div>
                        @if (!Auth::check() || Auth::user()->id !== $user->id)

                            @if (Auth::check())
                                <span
                                    onclick="copieClipboard('{{ route('profile', ['username' => $user->username]) }}' , '#copyUrlUser')"
                                    id="copyUrlUser" class="pointer-cursor" data-toggle="tooltip" data-placement="top"
                                    title="{{ __('Copier le lien de profil : ') . ' ' . $user->name }} ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                                        <path
                                            d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z" />
                                        <path
                                            d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z" />
                                    </svg>
                                </span>

                                <span class="to-tooltip"
                                    @if (!Auth::user()->email_verified_at && getSetting('site.enforce_email_validation')) data-placement="top"
                        title="{{ __('Please verify your account') }}"
                        @elseif(!\App\Providers\GenericHelperServiceProvider::creatorCanEarnMoney($user))
                        data-placement="top"
                        title="{{ __('This creator cannot earn money yet') }}"
                        @else
                        data-placement="top"
                        title="{{ __('Send a tip') }}"
                        data-toggle="modal"
                        data-target="#checkout-center"
                        data-type="tip"
                        data-first-name="{{ Auth::user()->first_name }}"
                        data-last-name="{{ Auth::user()->last_name }}"
                        data-billing-address="{{ Auth::user()->billing_address }}"
                        data-country="{{ Auth::user()->country }}"
                        data-city="{{ Auth::user()->city }}"
                        data-state="{{ Auth::user()->state }}"
                        data-postcode="{{ Auth::user()->postcode }}"
                        data-available-credit="{{ Auth::user()->wallet->total }}"
                        data-username="{{ $user->username }}"
                        data-name="{{ $user->name }}"
                        data-avatar="{{ $user->avatar }}"
                        data-recipient-id="{{ $user->id }}" @endif>


                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-gift">
                                        <polyline points="20 12 20 22 4 22 4 12"></polyline>
                                        <rect x="2" y="7" width="20" height="5"></rect>
                                        <line x1="12" y1="22" x2="12" y2="7"></line>
                                        <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                                        <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                                    </svg>
                                </span>


                                @if ($hasSub || $viewerHasChatAccess)
                                    <span class="pointer-cursor" data-toggle="tooltip" data-placement="top"
                                        title="{{ __('Send a message') }}" onclick="messenger.showNewMessageDialog()">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-send">
                                            <line x1="22" y1="2" x2="11" y2="13"></line>
                                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                        </svg>
                                    </span>
                                @else
                                @endif
                                <span class="pointer-cursor" data-toggle="tooltip" data-placement="top"
                                    title="{{ __('Add to your lists') }}" onclick="Lists.showListAddModal();">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </span>
                            @endif

                            @if ($user->paid_profile && (!getSetting('profiles.allow_users_enabling_open_profiles') ||(getSetting('profiles.allow_users_enabling_open_profiles') && !$user->open_profile)))
                                @if ((!Auth::check() || Auth::user()->id !== $user->id) && !$hasSub)
                                @endif
                            @elseif(!Auth::check() || (Auth::check() && Auth::user()->id !== $user->id))
                                @if (Auth::check())
                                    <button onclick="Lists.manageFollowsAction('{{ $user->id }}')">
                                        @if ($hasSub || $viewerHasChatAccess)
                                            {{ __('Ne plus suivre') }}
                                        @else
                                            {{ __('Suivre gratuitement') }}
                                        @endif


                                    </button>
                                @else
                                    <button data-toggle="modal" data-target="#login-dialog" data-original-title=""  title="" {{-- onclick="window.location.href='/login'"  --}}>
                                        {{ __('Suivre gratuitement') }}
                                    </button>
                                @endif

                            @endif
                        @else
                            <span
                                onclick="copieClipboard('{{ route('profile', ['username' => Auth::user()->username]) }}' , '#copyUrlProfil')"
                                id="copyUrlProfil" class="pointer-cursor" data-toggle="tooltip" data-placement="top"
                                title="{{ __('Copier le lien de mon profil') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                                    <path
                                        d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z" />
                                    <path
                                        d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z" />
                                </svg>
                            </span>
                            <a href="{{ route('my.settings') }}/profile" class="modifier_profil">
                                {{ __('Modifier') }}
                                <svg width="13px" height="13px" viewBox="0 0 13 13" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Mon-profil" transform="translate(-1099.000000, -344.000000)"
                                            stroke="#28A0F0">
                                            <g id="Group-5" transform="translate(534.000000, 117.000000)">
                                                <g id="input" transform="translate(485.000000, 219.000000)">
                                                    <g id="edit-(1)" transform="translate(81.000000, 8.000000)">
                                                        <path
                                                            d="M5.14285714,1.71428571 L1.14285714,1.71428571 C0.511674572,1.71428571 0,2.22596029 0,2.85714286 L0,10.8571429 C0,11.4883254 0.511674572,12 1.14285714,12 L9.14285714,12 C9.77403971,12 10.2857143,11.4883254 10.2857143,10.8571429 L10.2857143,6.85714286"
                                                            id="Path"></path>
                                                        <path
                                                            d="M9.42857143,0.857142857 C9.90195836,0.383755946 10.6694702,0.383755954 11.1428571,0.857142875 C11.616244,1.3305298 11.6162441,2.09804164 11.1428571,2.57142857 L5.71428571,8 L3.42857143,8.57142857 L4,6.28571429 L9.42857143,0.857142857 Z"
                                                            id="Path"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        @endif

                    </div>
                </div>

                <div class="aff_description">
                    <div
                        class="description-content {{ $user->bio && (strlen(trim(strip_tags(GenericHelper::parseProfileMarkdownBio($user->bio)))) >= 85 || substr_count($user->bio, "\r\n") > 1) && !getSetting('profiles.disable_profile_bio_excerpt') ? '' : '' }}">
                        @if ($user->bio)
                            @if (getSetting('profiles.allow_profile_bio_markdown'))
                                {{ $user->bio }}
                            @else
                                {{ $user->bio }}
                            @endif
                        @else
                        @endif
                    </div>
                    @if ($user->website)
                        <a href="{{ $user->website }}" target="_blank" rel="nofollow" class="text-primary">
                            {{ str_replace(['https://', 'http://', 'www.'], '', $user->website) }}
                        </a>
                    @endif


                </div>
                @if ($user->location)
                    <div class="aff_date">
                        <svg width="12px" height="14px" viewBox="0 0 12 14" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                stroke-linecap="round" stroke-linejoin="round">
                                <g id="Mon-profil" transform="translate(-553.000000, -497.000000)" stroke="#A9A9A9">
                                    <g id="Group-5" transform="translate(534.000000, 117.000000)">
                                        <g id="Group-3" transform="translate(20.000000, 378.000000)">
                                            <g id="map-pin" transform="translate(0.000000, 3.000000)">
                                                <path
                                                    d="M9.81818182,4.90909084 C9.81818182,8.72727265 4.90909091,12 4.90909091,12 C4.90909091,12 -9.91207116e-14,8.72727265 -9.91207116e-14,4.90909084 C-9.91207116e-14,2.19787482 2.19787489,-2.97362135e-13 4.90909091,-2.97362135e-13 C7.62030693,-2.97362135e-13 9.81818182,2.19787482 9.81818182,4.90909084 L9.81818182,4.90909084 Z"
                                                    id="Path"></path>
                                                <circle id="Oval" cx="4.90909091" cy="4.90909084" r="1.63636364">
                                                </circle>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        {{ $user->location }}
                    </div>
                @endif


                @if (!Auth::check() || Auth::user()->id !== $user->id)
                    @if (Auth::check())
                        @if ($hasSub || $viewerHasChatAccess)
                        @endif
                    @endif
                @else
                    @php
                        $symb = getSetting('payments.currency_symbol');
                    @endphp

                    <div class="liste_abonnements">
                        @if (Auth::user()->paid_profile)
                            @if ($user->offer)
                                @php
                                    $expiresAt = $user->offer->expires_at;
                                    $now = \Carbon\Carbon::now();
                                    $daysRemaining = $now->diffInDays($expiresAt);
                                    $hoursRemaining = $now->diffInHours($expiresAt);
                                    $minutesRemaining = $now->diffInMinutes($expiresAt);
                                @endphp
                                @if ($now <= $expiresAt)
                                    <p style="font-size: 12px; color: #59b8f7;">
                                        {{ __('Il reste ') }}
                                        {{ $daysRemaining > 0 ? $daysRemaining . __(' jour(s)') : ($hoursRemaining > 0 ? $hoursRemaining . __(' heure(s)') : $minutesRemaining . __(' minute(s)')) }}
                                        {{ __("pour cette promotion de prix d'abonement") }}
                                    </p>
                                @endif
                            @endif
                            <button class="btn btn-primary"
                                onclick="window.location.href='https://web.fanrhythm.com/my/settings/rates'">
                                <span>{{ __('Subscribe') }} {{ __('for') }}
                                    {{ trans_choice('days', 30, ['number' => 30]) }}</span>
                                <span class="d-sm-block">
                                    {{ Auth::user()->profile_access_price }}
                                    {{ $symb }}
                                </span>
                            </button>

                            <button class=" btn btn-outline-primary"
                                onclick="window.location.href='https://web.fanrhythm.com/my/settings/rates'">
                                <span>{{ __('Subscribe') }} {{ __('for') }}
                                    {{ trans_choice('months', 3, ['number' => 3]) }} </span>
                                <span class="d-sm-block">
                                    {{ Auth::user()->profile_access_price_3_months * 3 }}
                                    {{ $symb }}
                                </span>
                            </button>

                            <button class=" btn btn-outline-primary"
                                onclick="window.location.href='https://web.fanrhythm.com/my/settings/rates'">
                                <span>{{ __('Subscribe') }} {{ __('for') }}
                                    {{ trans_choice('months', 6, ['number' => 6]) }}</span>
                                <span class="d-sm-block">
                                    {{ Auth::user()->profile_access_price_6_months * 6 }}
                                    {{ $symb }}
                                </span>
                            </button>

                            <button class=" btn btn-outline-primary"
                                onclick="window.location.href='https://web.fanrhythm.com/my/settings/rates'">
                                <span>{{ __('Subscribe') }} {{ __('for') }}
                                    {{ trans_choice('months', 12, ['number' => 12]) }}</span>
                                <span class="d-sm-block">
                                    {{ Auth::user()->profile_access_price_12_months * 12 }}
                                    {{ $symb }}
                                </span>
                            </button>
                        @endif
                    </div>

                @endif


                {{-- Message alert --}}

                @include('elements.message-alert', ['classes' => ''])
                @if ($user->paid_profile && (!getSetting('profiles.allow_users_enabling_open_profiles') || (getSetting('profiles.allow_users_enabling_open_profiles') && !$user->open_profile)))
                    @if (0)

                    @else
                        <div class="liste_abonnements">
                            @if ($user->paid_profile)
                                @if ($user->offer && $user->id !== (Auth::check() ? Auth::id() : 0))
                                    @php
                                        $expiresAt = $user->offer->expires_at;
                                        $now = \Carbon\Carbon::now();
                                        $daysRemaining = $now->diffInDays($expiresAt);
                                        $hoursRemaining = $now->diffInHours($expiresAt);
                                        $minutesRemaining = $now->diffInMinutes($expiresAt);
                                    @endphp
                                    @if ($now <= $expiresAt)
                                        <p style="font-size: 12px; color: #59b8f7;">
                                            {{ __('Il reste ') }}
                                            {{ $daysRemaining > 0 ? $daysRemaining . __(' jour(s)') : ($hoursRemaining > 0 ? $hoursRemaining . __(' heure(s)') : $minutesRemaining . __(' minute(s)')) }}
                                            {{ __("pour cette promotion de prix d'abonement") }}
                                        </p>
                                    @endif
                                @endif
                                @if (count($offer))

                                    <div class="profil_message_info">
                                        {{ __('Limited offer main label', ['discount' => round($offer['discountAmount']), 'days_remaining' => $offer['daysRemaining']]) }}
                                        <br>
                                        {{ __('Offer ends label', ['date' => $offer['expiresAt']->format('d M')]) }}
                                        <br>
                                        @if ($user->profile_access_price_6_months || $user->profile_access_price_12_months)
                                        @endif
                                        @if (count($offer))
                                            {{ __('Regular price label', ['currency' => getSetting('payments.currency_code') ?? 'USD', 'amount' => $user->offer->old_profile_access_price]) }}
                                        @endif
                                    </div>

                                @endif
                            @endif
                            @if ($hasSub)
                                <button class="btn btn-round btn-lg btn-primary btn-block text-center d-none">
                                    <span>{{ __('Subscribed') }}</span>
                                </button>
                            @else
                                @if (Auth::check())
                                    @if (!GenericHelper::isEmailEnforcedAndValidated())
                                        <i>{{ __('Your email address is not verified.') }} <a
                                                href="{{ route('verification.notice') }}">{{ __('Click here') }}</a>
                                            {{ __('to re-send the confirmation email.') }}</i>
                                    @endif
                                @endif

                                @if ($user->paid_profile)
                                    @include('elements.checkout.subscribe-button-30')
                                    @if (
                                        $user->profile_access_price_6_months ||
                                            $user->profile_access_price_12_months ||
                                            $user->profile_access_price_3_months)
                                        <div class="makewhite">
                                            @if ($user->profile_access_price_3_months)
                                                @include('elements.checkout.subscribe-button-90')
                                            @endif

                                            @if ($user->profile_access_price_6_months)
                                                @include('elements.checkout.subscribe-button-182')
                                            @endif

                                            @if ($user->profile_access_price_12_months)
                                                @include('elements.checkout.subscribe-button-365')
                                            @endif

                                        </div>
                                    @endif
                                @endif
                            @endif
                        </div>

                    @endif

                   
                @elseif(!Auth::check() || (Auth::check() && Auth::user()->id !== $user->id))
                
                @endif
            </div>


            <div class="responsive-add-video">
                @if (!Auth::check() || Auth::user()->id !== $user->id)
                    
                @else
                    @if (  $user->email_verified_at &&($user->verification && $user->verification->status == 'verified') &&  count($demoposts) <= 2)
                        <div class="post_video_form">
                            <form action="{{ route('demoposts.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <p>
                                    <img src="{{ asset('/img/cc.svg') }}" />
                                </p>
                                <h2>{{ __('Téléchargez votre vidéo de présentation') }}</h2>
                                <p>{{ __('Celle-ci sera visible publiquement sur votre profil et sur le flux de la plateforme, donnant à chacun un aperçu unique de votre personnalité et de vos passions.') }}
                                </p>

                                <div id="fake_place_holder_mobile"
                                    onclick="document.getElementById('file_input_mobile').click();">
                                    {{ __('Choisir un fichier') }}
                                </div>
                                <input id="file_input_mobile" type="file" name="images[]" multiple
                                    style="display: none;" accept="video/*">
                                <input name="text" type="hidden" value="video">
                                <button type="submit">{{ __('Publier ') }}</button>
                            </form>
                            <script>
                                document.getElementById('file_input_mobile').onchange = function() {
                                    document.getElementById('fake_place_holder_mobile').textContent = this.files[0].name;
                                };
                            </script>
                        </div>
                    @endif

                @endif
            </div>

            @foreach ($demoposts as $demopost)
                <div class="mobile_vids">
                    @php
                        $images = json_decode($demopost->images, true);
                    @endphp

                    @if (is_array($images))
                        @foreach ($images as $image)
                            <video controls class="d-block w-100 mb-2 videocontrol">
                                <source src="https://web.fanrhythm.com/storage/public/images/{{ $image }}"
                                    type="video/mp4">
                                Your browser does not support the video tag.
                            </video>

                            @if (Auth::check() && Auth::user()->id == $demopost->user_id)
                                <form action="{{ route('demoposts.destroy', $demopost->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn  btn-danger d-block w-100">
                                        {{ __('Supprimer ma video') }}</button>
                                </form>
                            @endif
                        @endforeach
                    @endif
                </div>
            @endforeach
            @php
                // dd( $posts->total() );
            @endphp
            <div class="aff_profil_tab">
                <div>
                    <a class=" {{ $activeFilter == false ? 'active' : '' }}"
                        href="{{ route('profile', ['username' => $user->username]) }}">
                        {{-- {{ __('Toutes') }} --}}
                        {{ __('Posts') }}
                        {{-- <span>
                            {{ $posts->total() }}
                        </span> --}}
                        <span>
                            {{ $filterTypeCounts['all'] }}
                        </span>
                    </a>
                </div>

                {{-- @if ($filterTypeCounts['image'] > 0)
                    <div>
                        <a class=" {{ $activeFilter == 'image' ? 'active' : '' }}"
                            href="{{ route('profile', ['username' => $user->username]) . '?filter=library' }}">
                            {{ __('Photos') }}
                            
                            <span>
                                {{ $filterTypeCounts['image'] }}  
                            </span>
                        </a>
                    </div>
                @endif --}}
                @if ($filterTypeCounts['library'])
                    <div>
                        <a class=" {{ $activeFilter == 'library' ? 'active' : '' }}"
                            href="{{ route('profile', ['username' => $user->username]) . '?filter=library' }}">
                            {{-- {{ __('Photos') }} --}}
                            {{ __('Library') }}
                            <span>
                                {{ $filterTypeCounts['library'] }}
                            </span>
                        </a>
                    </div>
                @endif

                {{-- @if ($filterTypeCounts['video'] > 0)
                    <div>
                        <a class=" {{ $activeFilter == 'video' ? 'active' : '' }}"
                            href="{{ route('profile', ['username' => $user->username]) . '?filter=video' }}">
                            {{ __('Vidéos') }}
                            <span>
                                {{ $filterTypeCounts['video'] }}
                            </span>
                        </a>
                    </div>
                @endif --}}

                @if ($filterTypeCounts['mediaOnDemand'])
                    <div>
                        <a class=" {{ $activeFilter == 'mediaOnDemand' ? 'active' : '' }}"
                            href="{{ route('profile', ['username' => $user->username]) . '?filter=mediaOnDemand' }}">
                            {{ __('Media on demand') }}
                            <span>
                                {{ $filterTypeCounts['mediaOnDemand'] }}
                            </span>
                        </a>
                    </div>
                @endif

                @if ($filterTypeCounts['audio'] > 0)
                    <div>
                        <a class="{{ $activeFilter == 'audio' ? 'active' : '' }}"
                            href="{{ route('profile', ['username' => $user->username]) . '?filter=audio' }}">
                            {{ __('Audio') }}
                            {{ $filterTypeCounts['audio'] }}
                        </a>
                    </div>
                @endif



                {{-- @if (getSetting('streams.allow_streams'))
            @if (isset($filterTypeCounts['streams']) && $filterTypeCounts['streams'] > 0)
            <div>
                <a class=" {{$activeFilter == 'streams' ? 'active' : ''}}"
                    href="{{route('profile',['username'=> $user->username]) . '?filter=streams'}}">
                    {{__('En direct')}}
                    {{ $filterTypeCounts['streams'] }}
                </a>
            </div>
            @endif
            @endif --}}
            </div>







            <div class="justify-content-center align-items-center {{ Cookie::get('app_feed_prev_page') && PostsHelper::isComingFromPostPage(request()->session()->get('_previous')) ? 'mt-0' : 'mt-0' }}">
                @if ($activeFilter !== 'streams')
                    @if (in_array($activeFilter, ['library', 'mediaOnDemand']))
                        <div class="feed-box mt-0  ">
                            @include('elements.feed.post-librairy', ['posts' => $posts])
                        </div>
                    @else
                        @include('elements.feed.posts-load-more', ['classes' => 'mb-2'])
                        <div class="feed-box mt-0 posts-wrapper">
                            @include('elements.feed.posts-wrapper', ['posts' => $posts])
                        </div>
                    @endif
                @else
                    <div class="streams-box mt-4 streams-wrapper mb-4">
                        @include('elements.search.streams-wrapper', [
                            'streams' => $streams,
                            'showLiveIndicators' => true,
                            'showUsername' => false,
                        ])
                    </div>
                @endif
                @include('elements.feed.posts-loading-spinner')
            </div>
            @if (Auth::check() && Auth::id() != $user->id && !$hasSub)

                <nav id="fixed-subscr-profile"
                    class=" transition-scroll hide-nav-subsc  nav-subsc justify-content-center fixed-subscr-profile">
                    <div class="d-flex w-100">
                        @if ($user->paid_profile &&  (!getSetting('profiles.allow_users_enabling_open_profiles') || (getSetting('profiles.allow_users_enabling_open_profiles') && !$user->open_profile)))
                            <div class="liste_abonnements_one_bth  w-100" style="padding: 0;">
                                @include('elements.checkout.subscribe-button-30')
                            </div>
                        @else
                            <button class="btn btn-primary btn-block"
                                onclick="Lists.manageFollowsAction('{{ $user->id }}')">
                                {{ __('Suivre gratuitement') }}
                            </button>
                        @endif
                        &nbsp;
                        <div class=" dropup">
                            <button type="button" class="btn btn-primary to-tooltip " style="border-radius: 9px;"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg width="5px" height="18px" viewBox="0 0 5 18" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Symbols" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="post" transform="translate(-584.000000, -24.000000)" fill="#9E9E9E"
                                            stroke="#9E9E9E" stroke-width="2.5">
                                            <g id="date" transform="translate(443.000000, 24.000000)">
                                                <g id="more-horizontal"
                                                    transform="translate(143.000000, 9.000000) rotate(90.000000) translate(-143.000000, -9.000000) translate(136.000000, 8.000000)">
                                                    <circle id="Oval" cx="7" cy="0.875" r="1"></circle>
                                                    <circle id="Oval" cx="13.125" cy="0.875" r="1"></circle>
                                                    <circle id="Oval" cx="0.875" cy="0.875" r="1"></circle>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </button>
                            <div class="dropdown-menu" style="margin-left: -108px !important;margin-bottom: 5px;">
                                <a class="dropdown-item"
                                    href="javascript:void(0);"onclick="Lists.showReportBox({{ $user->id }},0);">
                                    {{ __('Signaler') }}
                                </a>
                                <a class="dropdown-item" href="javascript:void(0);"
                                    onclick="copieClipboard('{{ route('profile', ['username' => $user->username]) }}' , '#copyUrlUser2')"
                                    id="copyUrlUser2">
                                    {{ __('Copier le lien de profil') }}
                                </a>
                            </div>
                        </div>
                    </div>

                </nav>
            @endif
        </div>

        <style>
            .liste_abonnements_one_bth button {
                width: 100%;
                margin-bottom: 10px;
                display: flex;
                justify-content: space-between;
                font-weight: 600;
                font-size: 12px;
                letter-spacing: -0.28px;
                text-transform: none;
                box-shadow: none !important;
                border-radius: .5rem !important;
                padding: .75rem 1.5rem !important;
            }
        </style>
        <div class="aff_droite">
            <p class="aff_title_feed">
                &nbsp;
            </p>

            @foreach ($demoposts as $demopost)
                <div>
                    <style>
                        .videocontrol {
                            border-radius: 10px;
                            box-shadow: 1px 1px 9px rgb(0 0 0 / 8%);
                            border-radius: 15px 15px 15px 15px;
                            border: 1px solid #eee;
                        }

                        /*.post_video_form{*/
                        /*    display: none;*/
                        /*}*/

                        .mobile_vids {
                            display: none;
                        }

                        .mobile_vids {
                            margin-top: 30px;
                        }

                        @media screen and (max-width: 769px) {
                            .mobile_vids {
                                display: block;
                            }
                        }
                    </style>
                    @php
                        $images = json_decode($demopost->images, true);
                    @endphp

                    @if (is_array($images))
                        @foreach ($images as $image)
                            <video controls class="d-block w-100 mb-2 videocontrol">
                                <source src="https://web.fanrhythm.com/storage/public/images/{{ $image }}"
                                    type="video/mp4">
                                Your browser does not support the video tag.
                            </video>

                            @if (Auth::check() && Auth::user()->id == $demopost->user_id)
                                <form action="{{ route('demoposts.destroy', $demopost->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger d-block w-100">{{ __('Supprimer ma video') }}</button>
                                </form>
                            @endif
                        @endforeach
                    @endif
                </div>
            @endforeach


            @if (!Auth::check() || Auth::user()->id !== $user->id)

                @if (Auth::check())
                    @if ($hasSub || $viewerHasChatAccess)
                    @else
                    @endif
                @endif

                @if (
                    $user->paid_profile &&
                        (!getSetting('profiles.allow_users_enabling_open_profiles') ||
                            (getSetting('profiles.allow_users_enabling_open_profiles') && !$user->open_profile)))
                    @if ((!Auth::check() || Auth::user()->id !== $user->id) && !$hasSub)
                    @endif
                @elseif(!Auth::check() || (Auth::check() && Auth::user()->id !== $user->id))
                    @if (Auth::check())
                        @if ($hasSub || $viewerHasChatAccess)
                        @else
                        @endif
                    @else
                    @endif

                @endif
            @else
                @if (
                    $user->email_verified_at &&
                        ($user->verification && $user->verification->status == 'verified') &&
                        count($demoposts) <= 2)
                    <div class="post_video_form">
                        <form action="{{ route('demoposts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <p>
                                <img src="{{ asset('/img/cc.svg') }}" />
                            </p>
                            <h2>{{ __('Téléchargez votre vidéo de présentation') }}</h2>
                            <p>{{ __('Celle-ci sera visible publiquement sur votre profil et sur le flux de la plateforme, donnant à chacun un aperçu unique de votre personnalité et de vos passions.') }}
                            </p>

                            <div id="fake_place_holder" onclick="document.getElementById('file_input').click();">
                                {{ __('Choisir un fichier') }}
                            </div>
                            <input id="file_input" type="file" name="images[]" multiple style="display: none;"
                                accept="video/*">
                            <input name="text" type="hidden" value="videos">
                            <button type="submit">{{ __('Publier ') }}</button>
                        </form>

                        <script>
                            document.getElementById('file_input').onchange = function() {
                                document.getElementById('fake_place_holder').textContent = this.files[0].name;
                            };
                        </script>
                    </div>
                @endif

            @endif
            @include('elements.profile.widgets')
        </div>

    </div>

    @if (Auth::check())
        @include('elements.lists.list-add-user-dialog', [
            'user_id' => $user->id,
            'lists' => ListsHelper::getUserLists(),
        ])
        @include('elements.checkout.checkout-box')
        @include('elements.messenger.send-user-message', ['receiver' => $user])
        @include('elements.horizontal-member-card', ['user' => $user])
    @else
        @include('elements.modal-login')
    @endif

    @include('elements.profile.qr-code-dialog')

@stop
