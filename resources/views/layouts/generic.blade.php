<!doctype html>
<html class="h-100" dir="{{GenericHelper::getSiteDirection()}}" lang="{{session('locale')}}">
<head>
    @include('template.google-tag-js')
    @include('template.head')
</head>

<body class="{{request()->cookie('app_theme') ==='light' ? 'light_theme' : 'dark_theme'}}">  
    <!-- class="d-flex flex-column" -->
@include('template.header')
<div class="flex-fill">
    @yield('content')
</div>
@if(getSetting('compliance.enable_age_verification_dialog'))
    @include('elements.site-entry-approval-box')
@endif
@include('template.footer')
@include('template.jsVars')
@include('template.jsAssets')
@include('template.cdn2-adtng')
</body>
</html>
