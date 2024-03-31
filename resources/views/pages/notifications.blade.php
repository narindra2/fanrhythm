@extends('layouts.user-no-nav')

@section('page_title', __('Notifications'))

@section('styles')
    {!!
        Minify::stylesheet([
            '/css/pages/notifications.css'
         ])->withFullUrl()
    !!}
@stop

@section('scripts')
    {!!
        Minify::javascript([
            '/js/pages/notifications.js'
         ])->withFullUrl()
    !!}
@stop

@section('content')

<div id="aff_content">
    <div class="aff_gauche">
        <p class="aff_title_feed">
        {{__('Notifications')}}
        </p>

        @include('elements.notifications.notifications-menu', ['variant' => 'desktop'])
        @include('elements.notifications.notifications-wrapper', ['notifications' => $notifications])
    </div>
    <div class="aff_droite">

    </div>
</div>

@stop
