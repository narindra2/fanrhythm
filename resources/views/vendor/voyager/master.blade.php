<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ __('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr' }}">
<head>
    @hasSection('page_title')
        <title>@yield('page_title') | {{setting('admin.title')}} </title>
    @else
        <title>{{setting('admin.title') . " - " . setting('admin.description') }}</title>
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="assets-path" content="{{ route('voyager.voyager_assets') }}"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/libs/@simonwep/pickr/dist/themes/nano.min.css')}}">

    <!-- Favicon -->
    <?php $admin_favicon = Voyager::setting('admin.icon_image', ''); ?>
    @if($admin_favicon == '')
        <link rel="shortcut icon" href="{{  getSetting('admin.icon_image') }}" type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ Voyager::image($admin_favicon) }}" type="image/png">
    @endif

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">

    <!-- Few Dynamic Styles -->
    <style type="text/css">
        .voyager .side-menu .navbar-header {
            background:{{ config('voyager.primary_color','#22A7F0') }};
            border-color:{{ config('voyager.primary_color','#22A7F0') }};
        }
        .widget .btn-primary{
            border-color:{{ config('voyager.primary_color','#22A7F0') }};
        }
        .widget .btn-primary:focus, .widget .btn-primary:hover, .widget .btn-primary:active, .widget .btn-primary.active, .widget .btn-primary:active:focus{
            background:{{ config('voyager.primary_color','#22A7F0') }};
        }
        .voyager .breadcrumb a{
            color:{{ config('voyager.primary_color','#22A7F0') }};
        }
    </style>

    @if(!empty(config('voyager.additional_css')))<!-- Additional CSS -->
        @foreach(config('voyager.additional_css') as $css)<link rel="stylesheet" type="text/css" href="{{ asset($css) }}">@endforeach
    @endif

    @yield('head')


    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


@include('voyager::dashboard.style')

</head>

<body class="voyager @if(isset($dataType) && isset($dataType->slug)){{ $dataType->slug }}@endif">



<?php
if (\Illuminate\Support\Str::startsWith(Auth::user()->avatar, 'http://') || \Illuminate\Support\Str::startsWith(Auth::user()->avatar, 'https://')) {
    $user_avatar = Auth::user()->avatar;
} else {
    $user_avatar = Voyager::image(Auth::user()->avatar);
}
?>

<div class="app-container">
    <div class="fadetoblack visible-xs"></div>
    <div class="row content-container">
        @include('voyager::dashboard.navbar')
        @include('voyager::dashboard.sidebar')
        <!-- Main Content -->
        <div>
            <div class="side-body padding-top">
                @yield('page_header')
                <div id="voyager-notifications"></div>
                @yield('content')
            </div>
        </div>
    </div>
</div>
@include('voyager::partials.app-footer')

<!-- Javascript Libs -->


<script type="text/javascript" src="{{ voyager_asset('js/app.js') }}"></script>

<script>
    @if(Session::has('alerts'))
        let alerts = {!! json_encode(Session::get('alerts')) !!};
        helpers.displayAlerts(alerts, toastr);
    @endif

    @if(Session::has('message'))

    var alertType = {!! json_encode(Session::get('alert-type', 'info')) !!};
    var alertMessage = {!! json_encode(Session::get('message')) !!};
    var alerter = toastr[alertType];


    if (alerter) {
        alerter(alertMessage);
    } else {
        toastr.error("toastr alert-type " + alertType + " is unknown");
    }
    @endif
    var appUrl = "{{url('')}}";

</script>
@include('voyager::media.manager')
@yield('javascript')
@stack('javascript')
@if(!empty(config('voyager.additional_js')))<!-- Additional Javascript -->
    @foreach(config('voyager.additional_js') as $js)<script type="text/javascript" src="{{ asset($js) }}"></script>@endforeach
@endif

@if(request()->is('admin/transactions'))

<script>
// Sélectionnez tous les éléments <td> avec la classe 'td-6'.
const tdElements = document.querySelectorAll('td.td-6');

// Parcourez chaque élément <td>.
tdElements.forEach((td) => {
  // Obtenez la valeur en recherchant la classe 'afrifan_find_badge_value-XXX'.
  const divElement = td.querySelector('div');
  const value = divElement.textContent;

  // Créez un nouvel élément <a> avec l'URL et la valeur correctes.
  const newAnchor = document.createElement('a');
  newAnchor.href = `https://web.fanrhythm.com/admin/subscriptions/${value}/edit`;
  newAnchor.className = `afrifan_find_badge_value-${value}`;
  newAnchor.innerHTML = `Confirmer <span></span>${value} `;
  newAnchor.target = '_blank'; // Cela garantit que le lien s'ouvre dans un nouvel onglet.

  // Remplacez le contenu actuel de <td> par le nouvel élément <a>.
  td.innerHTML = '';
  td.appendChild(newAnchor);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Sélectionnez tous les éléments <td> avec la classe 'td-2'.
  const statusCells = document.querySelectorAll('td.td-2');

  // Parcourez chaque élément <td>.
  statusCells.forEach(function(cell) {
    // Vérifiez si le contenu texte de la cellule est 'Approved'.
    if (cell.textContent.trim() === 'Approved') {
      // Si oui, ajoutez la classe 'tr_approved' au parent <tr> de cette cellule.
      cell.parentElement.classList.add('tr_approved');
    }
  });
});
</script>

<style>
  tr.tr_approved { background: rgba(40, 160, 240, 0.12); border-bottom: 1px solid #fff; } tr.tr_approved td div, tr.tr_approved td, tr.tr_approved td a { color: #28A0F0!important; font-weight: 600!important; } .th-7, .th-8, .th-9, .th-7, .th-8, .th-9, .th-10, .td-7, .td-8, .td-9, .td-7, .td-8, .td-9, .td-10{ display: none; }

  .td-6 a {
    color: #9e9e9e!important;
    background: #F5F5F5!important;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 12px;
  }

    .tr_approved .td-6 a {
        color: #fff!important;
        background: #28A0F0!important;
    }

    .tr_approved .td-6 a:hover,
    .td-6 a:hover{
        color: #fff!important;
        background: #0172bd!important;
    }
</style>
@endif


@if(request()->is('admin/subscriptions'))
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Sélectionnez tous les éléments <td> avec la classe 'td-2'.
  const statusCells = document.querySelectorAll('td.td-4');

  // Parcourez chaque élément <td>.
  statusCells.forEach(function(cell) {
    // Vérifiez si le contenu texte de la cellule est 'Approved'.
    if (cell.textContent.trim() === 'Completed') {
      // Si oui, ajoutez la classe 'tr_approved' au parent <tr> de cette cellule.
      cell.parentElement.classList.add('tr_approved');
    }
  });
});
</script>

<style>
  tr.tr_approved { 
    background: rgba(40, 160, 240, 0.12); border-bottom: 1px solid #fff; 

} 

tr.tr_approved td div, tr.tr_approved td, tr.tr_approved td a { color: #28A0F0!important; font-weight: 600!important; } 

</style>
@endif


</body>
</html>
