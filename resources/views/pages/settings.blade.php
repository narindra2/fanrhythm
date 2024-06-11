@extends('layouts.user-no-nav')

@section('page_title',  __(ucfirst($activeSettingsTab)))

@section('scripts')
    {!!
        Minify::javascript(
            array_merge($additionalAssets['js'],[
                '/js/pages/settings/settings.js',
                '/js/suggestions.js',
                '/js/pages/card-box.js',
                '/js/pages/settings/chart.js',
         ])
        )->withFullUrl()
    !!}
    @if(getSetting('profiles.allow_profile_bio_markdown'))
        <script src="{{asset('/libs/simplemde/dist/simplemde.min.js')}}"></script>
    @endif
    {{-- Select2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/i18n/{{ App::getLocale() ?? "en" }}.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@stop

@section('styles')
    {!!
        Minify::stylesheet(
            array_merge($additionalAssets['css'],[
                '/css/pages/settings.css',
                ])
         )->withFullUrl()
    !!}
    <style>
        .selectize-control.multi .selectize-input>div.active {
            background:#{{getSetting('colors.theme_color_code')}};
        }
    </style>
    @if(getSetting('profiles.allow_profile_bio_markdown'))
        <link href="{{asset('/libs/simplemde/dist/simplemde.min.css')}}" rel="stylesheet">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@stop

@section('content')

<div id="aff_content">
    <div class="aff_gauche">

    @if(request()->path() == 'my/settings')
        <p class="aff_title_feed">
        {{__('Paramètres')}}
        </p>
        @include('elements.settings.settings-menu',['availableSettings' => $availableSettings])
    @endif


     @if(request()->path() != 'my/settings')
       

            <p class="aff_title_feed">
            <a href="{{route('my.settings')}}">
                    <svg width="7px" height="12px" viewBox="0 0 7 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                            <g id="Reglages---profil" transform="translate(-541.000000, -54.000000)" stroke="#000000" stroke-width="2">
                                <polyline id="Path" transform="translate(544.500000, 60.000000) scale(-1, 1) translate(-544.500000, -60.000000) " points="542 65 547 60 542 55"></polyline>
                            </g>
                        </g>
                    </svg>
                    {{__($currentSettingTab['heading'])}}
            </a>
            </p>

       
                <div>
                    @include('elements.settings.settings-'.$activeSettingsTab)
                </div>

     @endif


    </div>
</div>


@stop
