@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing') . ' ' . __('voyager::generic.settings'))

@section('css')
    <link href="{{ asset('css/admin-settings.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/libs/@simonwep/pickr/dist/themes/nano.min.css') }}">
@stop

@section('page_header')
    <div class="aff_paddin_dash">
        <h1 class="page-title">
            {{ __('voyager::generic.settings') }}
        </h1>
    </div>

@stop

@section('content')


    @include('voyager::dashboard.empty')

    <div class="page-content settings aff_paddin_dash">

        @if (isset($storageErrorMessage) && $storageErrorMessage !== false)
            <div class="storage-incorrect-bucket-config tab-additional-info">
                <div class="alert alert-warning alert-dismissible mb-1">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <svg width="14px" height="14px" viewBox="0 0 14 14" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                opacity="0.352515811" stroke-linecap="round" stroke-linejoin="round">
                                <g id="8---Fil-d'actualité---Pourboire" transform="translate(-1101.000000, -248.000000)"
                                    stroke="#000000">
                                    <g id="Group-3" transform="translate(534.000000, 222.000000)">
                                        <g id="x-(4)" transform="translate(568.000000, 27.000000)">
                                            <line x1="12" y1="0" x2="0" y2="12"
                                                id="Path"></line>
                                            <line x1="0" y1="0" x2="12" y2="12"
                                                id="Path"></line>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg></button>
                    <div class="info-label">
                        <div class="icon voyager-info-circled"></div><strong>{{ __('Warning!') }}</strong>
                        {{ __('The last storage settings you provided are invalid. Storage driver will reverted to local storage.') }}
                    </div>
                    <div class="mt-05">{{ __('Last error received:') }}</div>
                    <pre>{{ $storageErrorMessage }}</pre>
                </div>
            </div>
        @endif

        @if (isset($emailsErrorMessage) && $emailsErrorMessage !== false)
            <div class="storage-incorrect-bucket-config tab-additional-info">
                <div class="alert alert-warning alert-dismissible mb-1">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <svg width="14px" height="14px" viewBox="0 0 14 14" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                opacity="0.352515811" stroke-linecap="round" stroke-linejoin="round">
                                <g id="8---Fil-d'actualité---Pourboire" transform="translate(-1101.000000, -248.000000)"
                                    stroke="#000000">
                                    <g id="Group-3" transform="translate(534.000000, 222.000000)">
                                        <g id="x-(4)" transform="translate(568.000000, 27.000000)">
                                            <line x1="12" y1="0" x2="0" y2="12"
                                                id="Path"></line>
                                            <line x1="0" y1="0" x2="12" y2="12"
                                                id="Path"></line>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg></button>
                    <div class="info-label">
                        <div class="icon voyager-info-circled"></div><strong>{{ __('Warning!') }}</strong>
                        {{ __('The email driver settings you provided are invalid. Email driver will reverted to logs.') }}
                    </div>
                    <div class="mt-05">{{ __('Last error received:') }}</div>
                    <pre>{{ $emailsErrorMessage }}</pre>
                </div>
            </div>
        @endif

        <!-- Charger les variables -->




        <?php
        $categoriesOrder = ['Site', 'Profiles', 'Storage', 'Media', 'Feed', 'Payments', 'Websockets', 'Emails', 'Social login', 'Social media', 
        'Custom Code / Ads', 'Admin', 'Streams', 'Compliance', 'Security', 'Referrals', 'AI', 'Colors', 'Moderations',];
        
        $settings = array_intersect_key($settings, array_flip($categoriesOrder));
        
        ?>

        {{-- @foreach ($settings as $group => $setting)
            @if ($group != 'Colors' && $group != 'License')
            @endif
        @endforeach --}}



        <!-- Fin chargement des variables -->
        <form action="{{ route('voyager.settings.update') }}" method="POST" enctype="multipart/form-data"
            class="save-settings-form">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <input type="hidden" name="setting_tab" class="setting_tab" value="{{ $active }}" />
            <div>

                <div class="afrifan_reglages">
                    <div>

                        <ul>

                            <li class="active">
                                <a data-toggle="tab" class="settings-menu-referrals" href="#referrals"
                                    aria-expanded="true">
                                    Affiliations agence
                                    <svg width="6px" height="9px" viewBox="0 0 6 9" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g id="17---Tableau-de-bord---Reglages-Agence"
                                                transform="translate(-557.000000, -218.000000)" stroke="#000000"
                                                stroke-width="2">
                                                <g id="Rectangle" transform="translate(284.000000, 194.000000)">
                                                    <g id="Group" transform="translate(15.656047, 17.000000)">
                                                        <g id="chevron-right" transform="translate(258.343953, 8.000000)">
                                                            <polyline id="Path" points="0 7 3.5 3.5 0 0"></polyline>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>

                            <li class="d-none">
                                <a data-toggle="tab" class="settings-menu-security" href="#security">
                                    Vérification à deux facteurs

                                    <svg width="6px" height="9px" viewBox="0 0 6 9" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g id="17---Tableau-de-bord---Reglages-Agence"
                                                transform="translate(-557.000000, -218.000000)" stroke="#000000"
                                                stroke-width="2">
                                                <g id="Rectangle" transform="translate(284.000000, 194.000000)">
                                                    <g id="Group" transform="translate(15.656047, 17.000000)">
                                                        <g id="chevron-right" transform="translate(258.343953, 8.000000)">
                                                            <polyline id="Path" points="0 7 3.5 3.5 0 0"></polyline>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>

                            <li class="d-none">
                                <a data-toggle="tab" class="settings-menu-compliance" href="#compliance">Gestion des
                                    cookies

                                    <svg width="6px" height="9px" viewBox="0 0 6 9" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g id="17---Tableau-de-bord---Reglages-Agence"
                                                transform="translate(-557.000000, -218.000000)" stroke="#000000"
                                                stroke-width="2">
                                                <g id="Rectangle" transform="translate(284.000000, 194.000000)">
                                                    <g id="Group" transform="translate(15.656047, 17.000000)">
                                                        <g id="chevron-right" transform="translate(258.343953, 8.000000)">
                                                            <polyline id="Path" points="0 7 3.5 3.5 0 0"></polyline>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>

                            <li>
                                <a data-toggle="tab" class="settings-menu-social media" href="#social-media">Réseaux
                                    sociaux

                                    <svg width="6px" height="9px" viewBox="0 0 6 9" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g id="17---Tableau-de-bord---Reglages-Agence"
                                                transform="translate(-557.000000, -218.000000)" stroke="#000000"
                                                stroke-width="2">
                                                <g id="Rectangle" transform="translate(284.000000, 194.000000)">
                                                    <g id="Group" transform="translate(15.656047, 17.000000)">
                                                        <g id="chevron-right" transform="translate(258.343953, 8.000000)">
                                                            <polyline id="Path" points="0 7 3.5 3.5 0 0"></polyline>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>

                            <li>
                                <a data-toggle="tab" class="settings-menu-social login" href="#social-login">API Réseaux
                                    sociaux

                                    <svg width="6px" height="9px" viewBox="0 0 6 9" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g id="17---Tableau-de-bord---Reglages-Agence"
                                                transform="translate(-557.000000, -218.000000)" stroke="#000000"
                                                stroke-width="2">
                                                <g id="Rectangle" transform="translate(284.000000, 194.000000)">
                                                    <g id="Group" transform="translate(15.656047, 17.000000)">
                                                        <g id="chevron-right" transform="translate(258.343953, 8.000000)">
                                                            <polyline id="Path" points="0 7 3.5 3.5 0 0"></polyline>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>

                            <li>
                                <a data-toggle="tab" class="settings-menu-emails" href="#emails">
                                    Configuration e-mails
                                    <svg width="6px" height="9px" viewBox="0 0 6 9" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g id="17---Tableau-de-bord---Reglages-Agence"
                                                transform="translate(-557.000000, -218.000000)" stroke="#000000"
                                                stroke-width="2">
                                                <g id="Rectangle" transform="translate(284.000000, 194.000000)">
                                                    <g id="Group" transform="translate(15.656047, 17.000000)">
                                                        <g id="chevron-right" transform="translate(258.343953, 8.000000)">
                                                            <polyline id="Path" points="0 7 3.5 3.5 0 0"></polyline>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>

                            <li class="d-none">
                                <a data-toggle="tab" class="settings-menu-websockets" href="#websockets"
                                    aria-expanded="false">
                                    Messagerie Pusher

                                    <svg width="6px" height="9px" viewBox="0 0 6 9" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g id="17---Tableau-de-bord---Reglages-Agence"
                                                transform="translate(-557.000000, -218.000000)" stroke="#000000"
                                                stroke-width="2">
                                                <g id="Rectangle" transform="translate(284.000000, 194.000000)">
                                                    <g id="Group" transform="translate(15.656047, 17.000000)">
                                                        <g id="chevron-right" transform="translate(258.343953, 8.000000)">
                                                            <polyline id="Path" points="0 7 3.5 3.5 0 0"></polyline>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>

                            <li class="">
                                <a data-toggle="tab" class="settings-menu-site" href="#site" aria-expanded="false">
                                    Informations
                                    <svg width="6px" height="9px" viewBox="0 0 6 9" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g id="17---Tableau-de-bord---Reglages-Agence"
                                                transform="translate(-557.000000, -218.000000)" stroke="#000000"
                                                stroke-width="2">
                                                <g id="Rectangle" transform="translate(284.000000, 194.000000)">
                                                    <g id="Group" transform="translate(15.656047, 17.000000)">
                                                        <g id="chevron-right" transform="translate(258.343953, 8.000000)">
                                                            <polyline id="Path" points="0 7 3.5 3.5 0 0"></polyline>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" class="security-menu-site" href="#security" aria-expanded="false">
                                    Security
                                    <svg width="6px" height="9px" viewBox="0 0 6 9" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g id="17---Tableau-de-bord---Reglages-Agence"
                                                transform="translate(-557.000000, -218.000000)" stroke="#000000"
                                                stroke-width="2">
                                                <g id="Rectangle" transform="translate(284.000000, 194.000000)">
                                                    <g id="Group" transform="translate(15.656047, 17.000000)">
                                                        <g id="chevron-right" transform="translate(258.343953, 8.000000)">
                                                            <polyline id="Path" points="0 7 3.5 3.5 0 0"></polyline>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" class="settings-menu-feed" href="#feed">
                                    Fil d'actualités

                                    <svg width="6px" height="9px" viewBox="0 0 6 9" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g id="17---Tableau-de-bord---Reglages-Agence"
                                                transform="translate(-557.000000, -218.000000)" stroke="#000000"
                                                stroke-width="2">
                                                <g id="Rectangle" transform="translate(284.000000, 194.000000)">
                                                    <g id="Group" transform="translate(15.656047, 17.000000)">
                                                        <g id="chevron-right" transform="translate(258.343953, 8.000000)">
                                                            <polyline id="Path" points="0 7 3.5 3.5 0 0"></polyline>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" class="settings-menu-moderations" href="#moderations">
                                    Modérations des contenues medias
                                    <svg width="6px" height="9px" viewBox="0 0 6 9" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g id="17---Tableau-de-bord---Reglages-Agence"
                                                transform="translate(-557.000000, -218.000000)" stroke="#000000"
                                                stroke-width="2">
                                                <g id="Rectangle" transform="translate(284.000000, 194.000000)">
                                                    <g id="Group" transform="translate(15.656047, 17.000000)">
                                                        <g id="chevron-right" transform="translate(258.343953, 8.000000)">
                                                            <polyline id="Path" points="0 7 3.5 3.5 0 0"></polyline>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" class="settings-menu-payments" href="#payments">
                                    Paiements & facturations

                                    <svg width="6px" height="9px" viewBox="0 0 6 9" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g id="17---Tableau-de-bord---Reglages-Agence"
                                                transform="translate(-557.000000, -218.000000)" stroke="#000000"
                                                stroke-width="2">
                                                <g id="Rectangle" transform="translate(284.000000, 194.000000)">
                                                    <g id="Group" transform="translate(15.656047, 17.000000)">
                                                        <g id="chevron-right" transform="translate(258.343953, 8.000000)">
                                                            <polyline id="Path" points="0 7 3.5 3.5 0 0"></polyline>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" class="settings-menu-streams" href="#streams">
                                   Pusher Video Live
                                    <svg width="6px" height="9px" viewBox="0 0 6 9" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <g id="17---Tableau-de-bord---Reglages-Agence"
                                                transform="translate(-557.000000, -218.000000)" stroke="#000000"
                                                stroke-width="2">
                                                <g id="Rectangle" transform="translate(284.000000, 194.000000)">
                                                    <g id="Group" transform="translate(15.656047, 17.000000)">
                                                        <g id="chevron-right" transform="translate(258.343953, 8.000000)">
                                                            <polyline id="Path" points="0 7 3.5 3.5 0 0"></polyline>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li> 




                        </ul>




                    </div>

                    <div class="tab-content">



                        @foreach ($settings as $group => $group_settings)
                            <div id="{{ \Illuminate\Support\Str::slug($group) }}"
                                class="tab-pane fade in @if ($group == 'Referrals') active @endif">

                                <div class="afrifan_titre_reglages">{{ $group }}</div>

                                @if ($group == 'Payments')
                                @endif


                                <div>
                                    @php
                                        $i = 0;
                                        $niova = false;
                                    @endphp
                                    @foreach ($group_settings as $setting)
                                        @php
                                            if ($setting->group == 'Moderations') {
                                                if ($i == 0) {
                                                    $niova = true;
                                                    $actus = explode('_', explode('.', $setting->key)[1])[0];
                                                }
                                                $temp = explode('_', explode('.', $setting->key)[1])[0];

                                                if ($temp != $actus) {
                                                    $niova = true;
                                                    $actus = $temp;
                                                } else {
                                                    if ($i > 0) {
                                                        $niova = false;
                                                    }
                                                }
                                            }

                                            $i++;
                                        @endphp

                                        @if ($setting->group == 'Moderations' && $niova)
                                            <div style="width: 100%">
                                                <hr />
                                                <h4 style="padding-left: 22px; text-transform: capitalize;">
                                                    {{ __($actus) }}
                                                </h4>
                                            </div>
                                        @endif
                                        <div class="afrifan_field_{{ $setting->type }}"
                                            id="{{ 'afd_' . str_replace('.', '_', $setting->key) }}">
                                            @if ($setting->group == 'Moderations')
                                                <label for="#" class="afrifan_setting_label">
                                                    {{ $setting->display_name }}
                                                </label>
                                            @else
                                                <label for="#" class="afrifan_setting_label">
                                                    {{ $setting->display_name }}
                                                </label>
                                            @endif
                                            <label for="#" class="afrifan_setting_label">
                                                @if ($setting->type == 'range')
                                                    <span
                                                        style="font-size: 13px;  color: #4f4f4f; font-weight: 700;">(Degré:
                                                        <span
                                                            id="range-{{ $setting->id }}">{{ $setting->value ?? "0.00" }}</span>%)
                                                    </span>
                                                @endif
                                            </label>

                                            <div class="afrifan_form_padding setting-{{ $setting->key }}"
                                                data-settingkey={{ $setting->key }}>
                                                <div class="afrifan_input_type_ui">
                                                    @if ($setting->type == 'text')
                                                        <input type="text" class="form-control"
                                                            name="{{ $setting->key }}" value="{{ $setting->value }}">
                                                    @elseif($setting->type == 'range')
                                                        <input type="range" class="form-range" min="0.00"
                                                            max="100" step="1" name="{{ $setting->key }}"
                                                            value="{{ $setting->value }}"
                                                            onchange="updateTextInput{{ $setting->id }}(this.value);">

                                                        <script>
                                                            function updateTextInput{{ $setting->id }}(val) {
                                                                document.getElementById('range-{{ $setting->id }}').innerText = val;
                                                            }
                                                        </script>
                                                    @elseif($setting->type == 'text_area')
                                                        <textarea class="form-control" name="{{ $setting->key }}">{{ $setting->value ?? '' }}</textarea>
                                                    @elseif($setting->type == 'rich_text_box')
                                                        <textarea class="form-control richTextBox" name="{{ $setting->key }}">{{ $setting->value ?? '' }}</textarea>
                                                    @elseif($setting->type == 'code_editor')
                                                        <?php $options = json_decode($setting->details); ?>
                                                        <div id="{{ $setting->key }}"
                                                            data-theme="{{ @$options->theme }}"
                                                            data-language="{{ @$options->language }}"
                                                            class="ace_editor min_height_400" name="{{ $setting->key }}">
                                                            {{ $setting->value ?? '' }}</div>
                                                        <textarea name="{{ $setting->key }}" id="{{ $setting->key }}_textarea" class="hidden">{{ $setting->value ?? '' }}</textarea>
                                                    @elseif($setting->type == 'image' || $setting->type == 'file')
                                                        @if (isset($setting->value) &&
                                                                !empty($setting->value) &&
                                                                Storage::disk(config('voyager.storage.disk'))->exists($setting->value))
                                                            <div class="img_settings_container">
                                                                <a href="{{ route('voyager.settings.delete_value', $setting->id) }}"
                                                                    class="voyager-x delete_value"></a>
                                                                <img src="{{ Storage::disk(config('voyager.storage.disk'))->url($setting->value) }}"
                                                                    class="setting-value-image">
                                                            </div>

                                                            <div class="clearfix"></div>
                                                        @elseif($setting->type == 'file' && isset($setting->value))
                                                            @if (json_decode($setting->value) !== null)
                                                                @foreach (json_decode($setting->value) as $file)
                                                                    <div class="fileType">
                                                                        <a class="fileType" target="_blank"
                                                                            href="{{ Storage::disk(config('voyager.storage.disk'))->url($file->download_link) }}">
                                                                            {{ $file->original_name }}
                                                                        </a>
                                                                        <a href="{{ route('voyager.settings.delete_value', $setting->id) }}"
                                                                            class="voyager-x delete_value"></a>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        @endif

                                                        <input type="file" name="{{ $setting->key }}">
                                                    @elseif($setting->type == 'select_dropdown')
                                                        <?php $options = json_decode($setting->details); ?>
                                                        <?php $selected_value = isset($setting->value) && !empty($setting->value) ? $setting->value : null; ?>

                                                        <select class="form-control" name="{{ $setting->key }}">
                                                            <?php $default = isset($options->default) ? $options->default : null; ?>
                                                            @if (isset($options->options))
                                                                @foreach ($options->options as $index => $option)
                                                                    <option value="{{ $index }}"
                                                                        @if ($default == $index && $selected_value === null) selected="selected" @endif
                                                                        @if ($selected_value == $index) selected="selected" @endif>
                                                                        {{ $option }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    @elseif($setting->type == 'radio_btn')
                                                        <?php $options = json_decode($setting->details); ?>
                                                        <?php $selected_value = isset($setting->value) && !empty($setting->value) ? $setting->value : null; ?>
                                                        <?php $default = isset($options->default) ? $options->default : null; ?>

                                                        <ul class="radio">
                                                            @if (isset($options->options))
                                                                @foreach ($options->options as $index => $option)
                                                                    <li>
                                                                        <input type="radio"
                                                                            id="option-{{ $index }}"
                                                                            name="{{ $setting->key }}"
                                                                            value="{{ $index }}"
                                                                            @if ($default == $index && $selected_value === null) checked @endif
                                                                            @if ($selected_value == $index) checked @endif>
                                                                        <label
                                                                            for="option-{{ $index }}">{{ $option }}</label>
                                                                        <div class="check"></div>
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    @elseif($setting->type == 'checkbox')
                                                        <?php $options = json_decode($setting->details); ?>
                                                        <?php $checked = isset($setting->value) && $setting->value == 1 ? true : false; ?>
                                                        @if (isset($options->on) && isset($options->off))
                                                            <input type="checkbox" name="{{ $setting->key }}"
                                                                class="toggleswitch"
                                                                @if ($checked) checked @endif
                                                                data-on="{{ $options->on }}"
                                                                data-off="{{ $options->off }}">
                                                        @else
                                                            <input type="checkbox" name="{{ $setting->key }}"
                                                                @if ($checked) checked @endif
                                                                class="toggleswitch">
                                                        @endif
                                                    @endif

                                                </div>
                                                {{-- <div class="d-none abc">
                                                    @if ($setting->group == "Moderations")
                                                        @dd($groups,$setting->key)
                                                    @endif
                                                    <select class="form-control group_select"
                                                    name="{{ $setting->key }}_group">
                                                    @foreach ($groups as $group)
                                                            <option  value="{{ $group }}" {!! $setting->group == $group ? 'selected' : '' !!}>
                                                                {{ $group }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                                <div class="d-none abc">
                                                    <input type="hidden" value="{{ $setting->group }}" name="{{ $setting->key }}_group">
                                                </div>

                                            </div>
                                        </div>


                                        <?php
                                        $settingDetails = json_decode($setting->details);
                                        $hasDescription = false;
                                        if (isset($settingDetails->description)) {
                                            $hasDescription = true;
                                        }
                                        ?>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <button type="submit" class="btn-primary afri_btn_2">{{ __('voyager::settings.save') }}</button>
        </form>

        <div class="clearfix"></div>


    </div>



@stop

@section('javascript')
    <script type="text/javascript" src="{{ asset('/libs/@simonwep/pickr/dist/pickr.es5.min.js') }}"></script>
    <script>
        $('document').ready(function() {
            $('#toggle_options').on('click', function() {
                $('.new-settings-options').toggle();
                if ($('#toggle_options .voyager-double-down').length) {
                    $('#toggle_options .voyager-double-down').removeClass('voyager-double-down').addClass(
                        'voyager-double-up');
                } else {
                    $('#toggle_options .voyager-double-up').removeClass('voyager-double-up').addClass(
                        'voyager-double-down');
                }
            });

            $('.toggleswitch').bootstrapToggle();

            $('[data-toggle="tab"]').on('click', function() {
                $(".setting_tab").val($(this).html());
            });

            $('.delete_value').on('click', function(e) {
                e.preventDefault();
                $(this).closest('form').attr('action', $(this).attr('href'));
                $(this).closest('form').submit();
            });

            // Initiliaze rich text editor
            tinymce.init(window.voyagerTinyMCE.getConfig());
        });
    </script>
    <script type="text/javascript">
        $(".group_select").not('.group_select_new').select2({
            tags: true,
            width: 'resolve'
        });
        $(".group_select_new").select2({
            tags: true,
            width: 'resolve',
            placeholder: '{{ __('voyager::generic.select_group') }}'
        });
        $(".group_select_new").val('').trigger('change');
    </script>
    <iframe id="form_target" name="form_target" class="d-none"></iframe>
    <form class="settings-upload" id="my_form" action="{{ route('voyager.upload') }}" target="form_target"
        method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
        <input type="hidden" name="type_slug" id="type_slug" value="settings">
    </form>

    <script>
        try {
            var options_editor = ace.edit('options_editor');
            options_editor.getSession().setMode("ace/mode/json");

            var options_textarea = document.getElementById('options_textarea');
            options_editor.getSession().on('change', function() {
                console.log(options_editor.getValue());
                options_textarea.value = options_editor.getValue();
            });
        } catch (e) {
            // eslint-disable-next-line no-console
            console.warn(e);
        }

        var site_settings = {
            'emails.driver': "{{ getSetting('emails.driver') }}",
            'storage.driver': "{{ getSetting('storage.driver') }}",
            'websockets.driver': "{{ getSetting('websockets.driver') }}",
            'colors.theme_color_code': "{{ getSetting('colors.theme_color_code') }}",
            'colors.theme_gradient_from': "{{ getSetting('colors.theme_gradient_from') }}",
            'colors.theme_gradient_to': "{{ getSetting('colors.theme_gradient_to') }}",
            'license.product_license_key': "{{ getSetting('license.product_license_key') }}",
        }
    </script>
@stop
