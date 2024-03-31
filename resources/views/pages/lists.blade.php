@extends('layouts.user-no-nav')
@section('page_title', __('Your lists'))

@section('styles')
{!!
Minify::stylesheet([
'/css/pages/lists.css'
])->withFullUrl()
!!}
@stop

@section('scripts')
{!!
Minify::javascript([
'/js/pages/lists.js'
])->withFullUrl()
!!}
@stop

@section('content')

<div id="aff_content">
    <div class="aff_gauche">

        <p class="aff_title_feed aff_title_feed_button ">
            {{__('Mes listes')}}

            <button onclick="Lists.showListEditDialog()" data-toggle="tooltip" data-placement="top"
                title="{{__('Add list')}}">

                <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round"
                        stroke-linejoin="round">
                        <g id="Listes" transform="translate(-1109.000000, -53.000000)" stroke="#59B8F7">
                            <g id="plus-circle" transform="translate(1110.000000, 54.000000)">
                                <circle id="Oval" cx="7" cy="7" r="7"></circle>
                                <line x1="7" y1="4.2" x2="7" y2="9.8" id="Path"></line>
                                <line x1="4.2" y1="7" x2="9.8" y2="7" id="Path"></line>
                            </g>
                        </g>
                    </g>
                </svg>
            </button>
        </p>

    
       <div class="aff_list_blade_link">
             @if(count($lists))
                    @foreach($lists as $key => $list)
                    @include('elements.lists.list-box', ['list'=>$list, 'isLastItem' => (count($lists) == $key + 1)])
                    @endforeach
                    @else
                    <p class="ml-4">{{__('No lists available')}}</p>
            @endif
       </div>


    </div>
    <div class="aff_droite">

    </div>
</div>


@include('elements.lists.list-update-dialog',['mode'=>'create'])
@stop
