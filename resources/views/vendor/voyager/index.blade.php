@extends('voyager::master')

@section('page_header')
<div class="aff_paddin_dash">
<h1 class="page-title">
            Tableau de bord
    </h1>
</div>
 
@stop

@section('content')
    <div class="page-content">
        @include('voyager::alerts')
        @include('voyager::dimmers')
        <div class="analytics-container">
            
            @include('elements.admin.metrics')

        </div>

    </div>
@stop
