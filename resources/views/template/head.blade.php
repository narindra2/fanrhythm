<meta name="google-site-verification" content="3JxUdNxykh3B9e9k9HkN82DwTnVXeJdVjcnoGUc_Vlw" />
<meta charset="utf-8">
{{-- Page title --}}
@hasSection('page_title')
<title>@yield('page_title') - {{getSetting('site.name')}} </title>
@else
<title>{{getSetting('site.name')}} - {{getSetting('site.slogan')}}</title>
@endif

{{-- Generic Meta tags --}}
@hasSection('page_description')
<meta name="description" content="@yield('page_description')">
@endif

{{-- Mobile tab color --}}
<meta name="theme-color" content="#505050">
<meta name="color-scheme" content="dark light">

{{-- Facebook share section --}}
<meta property="og:url" content="@yield('share_url')" />
<meta property="og:type" content="@yield('share_type')" />
<meta property="og:title" content="@yield('share_title')" />
<meta property="og:description" content="@yield('share_description')" />

{{-- Twitter share section --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@yield('share_url')">
<meta name="twitter:creator" content="@yield('author')">
<meta name="twitter:title" content="@yield('share_title')">
<meta name="twitter:description" content="@yield('share_description')">

{{-- CSRF Baby --}}
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">


@yield('meta')

@if(getSetting('site.allow_pwa_installs'))
@laravelPWA
<script type="text/javascript">
    (function () {
        // Initialize the service worker
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/serviceworker.js', {
                scope: '.'
            }).then(function (registration) {
                // Registration was successful
                // eslint-disable-next-line no-console
                console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration
                    .scope);
            }, function (err) {
                // registration failed :(
                // eslint-disable-next-line no-console
                console.log('Laravel PWA: ServiceWorker registration failed: ', err);
            });
        }
    })();

</script>
@endif
<script src="{{asset('libs/pusher-js/dist/web/pusher.min.js')}}"></script>

{{-- Favicon --}}
<link rel="shortcut icon" href="{{ getSetting('site.favicon') }}" type="image/x-icon">

{{-- (Preloading) Fonts --}}
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300" rel="preload" as="style">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,500,600,700"
    rel="preload" as="style">
{{-- Global CSS Assets --}}
{!!
Minify::stylesheet(
array_merge([
'/libs/cookieconsent/build/cookieconsent.min.css',
'/css/theme/bootstrap'.
(Cookie::get('app_rtl') == null ? (getSetting('site.default_site_direction') == 'rtl' ? '.rtl' : '') :
(Cookie::get('app_rtl') == 'rtl' ? '.rtl' : '')).
(Cookie::get('app_theme') == null ? (getSetting('site.default_user_theme') == 'dark' ? '.dark' : '') :
(Cookie::get('app_theme') == 'dark' ? '.dark' : '')).
'.css',
'/css/app.css',
'/fonts/stylesheet.css',
],
(isset($additionalCss) ? $additionalCss : [])
))->withFullUrl()
!!}

{{-- Page specific CSS --}}
@yield('styles')

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-BNRK08HNGB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-BNRK08HNGB');
</script>


<link rel="stylesheet" href="/css/site.css">
<style>
    form#userMessageForm .selectize-input {
        background: var(--bg-card)!important;
    }
    .video-preview-item.shadow,
   .aff_create_post div.dz-progress div {
    display: block!important;
}

.aff_create_post .dz-upload{
    height: 20px;
    background: #39acf3!important;
}

.video-preview-item .video-preview,
.aff_create_post .dropzone .dz-preview .dz-image img {
    width: 106px;
    height: 106px;
    object-fit: cover;
    background: var(--border-default);
}

.aff_create_post .dropzone .dz-preview {
    margin-right: 10px!important;
}


.aff_create_post .dropzone .dz-preview img {
    border: 1px solid var(--border-default);
    border-radius: 14px;
}

.aff_create_post .dropzone-previews>div>div {
    border-radius: 20px;
}

.description-content {
    font-size: 12px;
}

.post-media-image {
    border-top: 1px solid var(--border-default);
    border-bottom: 1px solid var(--border-default);
    box-shadow: 1px 1px 9px rgb(0 0 0 / 8%);
}

.aff_create_post .aff_create_post .dz-progress {
    z-index: 222;
    display: block!important;
    height: 8px!important;
}

.aff_create_post .dz-progress{
    height: 8px!important;
}

.aff_liste_module{
    width: 33%;
}

@media screen and (max-width: 769px){
    .aff_liste_module{
    width: 100%;
    margin-bottom: 0px;
}

div > .aff_liste_module:last-child{
    width: 100%;
    margin-bottom: 20px;
}

#paiement_virgo > div:nth-child(2),
.autres_pay  {
    justify-content: center;
}
}
.aff_liste_module img {
    width: 72px;
    height: auto;
}

.find_check {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

div.find_check > div:nth-child(2) > div > div > div,
div.find_check > div:nth-child(1) > div > div > div {
    font-size: 8px;
    display: flex;
    align-items:center;
    justify-content: center;
    margin-top: 3px;
}

div.find_check > div:nth-child(1) > div > div > img{
    height: 15px;
    width: auto!important;
}
div.find_check > div:nth-child(2) > div > div > div img{
    width: auto!important;
    height: 10px;
    margin-left: 3px;
}

div.find_check > div:nth-child(1) > div > div > div img{
    height: 5px;
    width: auto!important;
    margin-left: 3px;
}

#paiement_virgo > div:nth-child(2){
    display: flex;
    align-items:center;
    margin-top: 6px;
}

#paiement_virgo > div:nth-child(2) > img:nth-child(1){
    height: 10px;
}

#paiement_virgo > div:nth-child(2) > img:nth-child(2){
    height: 20px;
}

.autres_pay {
    display: flex;
}

.autres_pay > img {
    height: 15px;
    margin-bottom: 30px;
}

.description-content {
    margin-bottom: 20px;
}


    .g-recaptcha {
    border: 0!important;
    padding: 0px!important;
}

.profil_message_info {
    font-size: 12px;
    margin-bottom: 20px;
}

.sidebar ul ul a{
    background: transparent!important;
    padding-left : 40px;
}

#nav_home #otherSections{
    position: absolute;
    background: var(--bg-card);
    border: 1px solid var(--border-default);
    padding: 12px;
    width: 150px;
    top: 50px;
    z-index: 10;
    font-size: 15px;
    border-radius: 6px;
    box-shadow: 1px 1px 2px 2px #0000000
}

#nav_home #otherSections  a{
    font-weight: 600;
    font-size: 14px;
    color: var(--base-color);
    letter-spacing: -0.37px;
    padding: 4px;
}

#nav_home #otherSections a:hover{
    color: #2e8dcd;
}

.important_text {
    color: #f65252;
    background: #f652522b;
    font-size: 11px;
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.aff_post_comment_form button:hover,
.aff_post_comment_form button:focus{
    opacity: .4;
    display: block;
}
</style>

<style>
                    .revin-gadra {
                        position: fixed;
                        width: 100%;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        top: 0;
                    }

                    .revin-gadra>div {
                        max-width: 350px;
                        padding: 30px 20px;
                        box-shadow: 1px 1px 20px #0000002e;
                        border-radius: 10px;
                        background: var(--base-color);
                        text-align: center;
                    }

                    .revin-gadra h4 {
                        font-size: 14px;
                        font-weight: 600;
                        letter-spacing: 0;
                    }

                    .revin-gadra p {
                        font-size: 10px;
                    }

                    .revin-gadra a,
                    .revin-gadra button {
                        border: 0;
                        border-radius: 10px;
                        padding: 6px 20px;
                    }

                    .revin-gadra a {
                        font-size: 12px;
                        font-weight: 500;
                        margin-right: 0px;
                        color: inherit;
                        background: #e84730;
                        color: var(--base-color);
                        transition: .4s;
                    }

                    .revin-gadra a:hover {
                        background: #ff2000;
                        transition: .4s;
                    }

                    .revin-gadra button {
                        font-size: 12px;
                        font-weight: 500;
                        margin-right: 0px;
                        background: #309be7;
                        color: var(--base-color);
                        transition: .4s;
                    }


                    .revin-gadra button:hover {
                        background: #105c92;
                        transition: .4s;
                    }
                    .post_video_form {
                            text-align:center;
                        }
                    .post_video_form img{
                        width: 100px;
                    }
                    .post_video_form{
                        background: var(--bg-card);
                        box-shadow: 1px 1px 9px rgb(0 0 0 / 8%);
                        border-radius: 15px 15px 15px 15px;
                        border: 1px solid var(--border-default);
                        padding: 25px;
                    }
                    
                    .post_video_form p, 
                    .post_video_form h2, 
                    .post_video_form div {
                        color: var(--base-color);
                    }

                    .post_video_form h2 {
                        font-weight: 600;
                        font-size: 16px;
                        letter-spacing: -0.37px;
                    }

                    .post_video_form p{ 
                        font-size: 12px;
                        margin-bottom: 20px;
                    }

                    #fake_place_holder {
                        font-size: 12px;
                        border: dotted #ddd;
                        padding: 15px;
                        text-align: center;
                        margin-bottom: 10px;
                        border-radius: 15px 15px 15px 15px;
                        cursor: pointer;
                    }

                    .post_video_form button{
                        font-weight: 600;
                        font-size: 14px;
                        color: var(--base-color);
                        letter-spacing: -0.32px;
                        text-align: center;
                        background-image: linear-gradient(93deg, #59B8F7 39%, #28A0F0 79%);
                        border-radius: 24px;
                        text-transform: none;
                        justify-content: center;
                        border: 0;
                        padding: 10px;
                        width: 100%;
                    }

                    .post_video_form button:hover{
                        opacity: .8;
                    }
                </style>
                
                <link rel="stylesheet" href="/css/site_live.css">
                <style>
                    .user-search-box-item_change_color *{
                        color: #fff;
                    }
                
                    .user-search-box-item_change_color{
                        padding: 40px 14px 14px 14px;
                        position: relative;
                        align-items: end;
                    }
                
                    .user-search-box-item_change_color:before {
                        content: '';
                        opacity: .5;
                        background-image: radial-gradient(circle at 50% -33%, rgb(38 11 11 / 84%) 0%, rgba(0, 0, 0, 0.14) 162%);
                        border-radius: 0 0 10px 10px;
                        position: absolute;
                        width: 100%;
                        height: 100%;
                        top: 0px;
                        left: 0px;
                        z-index: 1;
                        border-radius: 10px;
                    }
                
                    .user-search-box-item_change_color>a:nth-child(1) {
                        position: relative;
                        z-index: 10;
                        display: flex;
                        align-items: end;
                    }
                
                    .user-search-box-item_change_color>a:nth-child(2) {
                    position: relative;
                    z-index: 10;
                }
                
                .user-search-box-item_change_color>a:nth-child(2):hover {
                    background: #fff!important;
                    color: #32a0f0!important;
                }
                
                .user-search-box-item_change_color a img{
                    height: 80px!important;
                    width: 80px!important;
                    border: 2px solid #FFFFFF;
                }
                
                .phpdebugbar {
                    display: none!important;
                }
                
                </style>
<meta name="google-site-verification" content="3JxUdNxykh3B9e9k9HkN82DwTnVXeJdVjcnoGUc_Vlw" />              