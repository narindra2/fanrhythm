<!doctype html>
<html class="h-100" dir="{{GenericHelper::getSiteDirection()}}" lang="{{session('locale')}}">

<head>
    @include('template.google-tag-js')
    @include('template.head',['additionalCss' => [
    '/libs/animate.css/animate.css',
    '/libs/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css',
    '/css/side-menu.css',
    ]])
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

</head>
<body class="{{request()->cookie('app_theme') ==='light' ? 'light_theme' : 'dark_theme'}}">
    @include('elements.mobile-navbar-top')
    @include('template.user-side-menu')
    <div id="aff_" class="wokc">
        <div id="aff_cont">
            <div id="aff_left">
                @include('template.side-menu')
            </div>
            <div id="aff_main">
                @if (Auth::check())
                    @include('elements.wallet-top')
                @endif
                @yield('content')
            </div>
        </div>
    </div>

    @include('elements.mobile-navbar')

    @if(getSetting('compliance.enable_age_verification_dialog'))
    @include('elements.site-entry-approval-box')
    @endif
    {{-- @include('template.footer-compact',['compact'=>true]) --}}
    @include('template.jsVars')
    @include('template.jsAssets',['additionalJs' => [
    '/libs/jquery-backstretch/jquery.backstretch.min.js',
    '/libs/wow.js/dist/wow.min.js',
    '/libs/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
    '/js/SideMenu.js'
    ]])
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
@include('template.cdn2-adtng')
</body>

</html>
