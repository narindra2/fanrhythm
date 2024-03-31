<!doctype html>
<html class="h-100" dir="{{GenericHelper::getSiteDirection()}}" lang="{{session('locale')}}">
<head>
    @include('template.google-tag-js')
    @include('template.head')
   
</head>
<body class="{{request()->cookie('app_theme') ==='light' ? 'light_theme' : 'dark_theme'}}">
<div class="w-100">
    @yield('content')
</div>
@if(getSetting('compliance.enable_age_verification_dialog'))
    @include('elements.site-entry-approval-box')
@endif
@include('template.jsVars')
@include('template.jsAssets')
@include('template.cdn2-adtng')
</body>
</html>
