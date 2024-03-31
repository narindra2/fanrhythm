@extends('voyager::master')

@section('page_title', 'Moderations')

@section('css')

<link href="{{ asset('css/admin-settings.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/libs/@simonwep/pickr/dist/themes/nano.min.css') }}">
@stop

@section('page_header')
<div class="aff_paddin_dash">
    <h1 class="page-title">
        {{ __('Moderations') }}
    </h1>
</div>

@stop

@section('content')

<div class="page-content browse aff_paddin_dash">
    <div class="alerts">
</div>
    <div>
        <div>
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <form method="get" class="form-search">
                        <div id="search-input">
                            <div>
                                <div style="display: flex;">
                                    <select  name="status" id="status"  class="filters"  style="width: 50%; ">
                                        <option  value="" @if ( !Request::get('status')) selected @endif  >Toutes  </option>
                                        <option value="pending" @if (Request::get('status') =="pending") selected @endif >Pending</option>
                                        <option value="approved" @if (Request::get('status') =="approved") selected @endif >Approved</option>
                                        <option value="declined" @if (Request::get('status') =="declined") selected @endif>Declined</option>
                                </select>
                                    {{-- <select  name="momth"  class="filters"  style="width: 50%"> 
                                        <option value="1" >Jan</option>
                                        <option value="2" >Fev</option>
                                        <option value="3" >Mars</option>
                                        <option value="4" >Avrl</option>
                                        <option value="5" >Mai</option>
                                        <option value="6" >Juin</option>
                                        <option value="7" >Jull</option>
                                        <option value="8" >Aout</option>
                                        <option value="9" >Sep</option>
                                        <option value="10" >Oct</option>
                                        <option value="11" >Nov</option>
                                        <option value="12" >Dec</option>
                                    </select> --}}
                                    <input type="text" name="interval" id="interval" autocomplete="off" placeholder="Date entre ..."   style="font-weight: bold;color: black;" />
                                   
                                </div>
                                <div>
                             
                                </div>
                            </div>

                            <div>
                            <button type="submit">

                                    <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                    <g id="input" transform="translate(-17.000000, -10.000000)" stroke="#8E8E8E" stroke-width="2">
                                        <g id="search" transform="translate(18.136364, 11.954545)">
                                            <circle id="Oval" cx="5.61363636" cy="5.61363636" r="5.61363636"></circle>
                                            <line x1="12.9545455" y1="12.9545455" x2="9.5" y2="9.5" id="Path"></line>
                                        </g>
                                    </g>
                                    </g>
                                    </svg>
                                    </button>

                             <input type="text" placeholder="Search" name="search"  value="{{ Request::get('search')?? "" }}">

                            </div>

                        </div>
                                                    </form>
                    <div>
                        <table id="dataTable" class="table itove">
                            <thead>
                                <tr>
                                    <th class="dt-not-orderable">
                                        <input type="checkbox" class="select_all">
                                    </th>
                                    <th class="th-0">
                                    </th>
                                    <th class="th-0">
                                        Username
                                    </th>
                                    <th class="th-1">
                                        Statut
                                    </th>
                                    <th class="th-1">
                                        Score
                                    </th>
                                    <th class="th-1">
                                        Statut de la verification 
                                    </th>
                                    <th class="th-2">
                                        Motif du rejet
                                    </th>
                                    <th class="th-4">
                                        Date d'ajout
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attachments as $attachment)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="row_id" id="checkbox_79" value="79">
                                        </td>
                                        <td class="td-0" >
                                            @if ($attachment->attachmentType == "video")
                                                <video controls class="d-block w-100 mb-2 " style="width: 146px; object-fit: cover;" >
                                                    <source src="{{ $attachment->path  }}"
                                                        type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video> <br>
                                                <a href="{{ $attachment->path }}" target="_blank" >
                                                    Lire la video
                                                </a>
                                            @endif
                                            @if ($attachment->attachmentType == "image")
                                                <a href="{{ $attachment->path }}" target="_blank" >
                                                    <img class="img-row" src="{{  $attachment->path }}" alt="image">
                                                </a>
                                            @endif
                                            
                                        </td>
                                        <td class="td-0">
                                            {{ $attachment->user->username }}
                                        </td>
                                        <td class="td-1">
                                            @php
                                                $class = "App\Model\Moderation";
                                            @endphp
                                            <div class="afrifan_find_badge_value-2155">
                                                @if ($attachment->moderation_status == \App\Model\Moderation::STATUS_APPROVED )
                                                    <span style="color: #2ecf25e3; ">   {{  $attachment->moderation_status }} </span>
                                                
                                                @elseif ($attachment->moderation_status == \App\Model\Moderation::STATUS_DECLINED)
                                                    <span style="color: #d11c1c; ">   {{  $attachment->moderation_status }} </span>
                                                @else
                                                    <span style="color: #e9b60d; ">   {{  $attachment->moderation_status }} </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="td-2">
                                            <div class="afrifan_find_badge_value-test account"><span></span>
                                                @if ($attachment->moderationResult)
                                                    @foreach ($attachment->moderationResult->score as $cat => $score)
                                                    {{"- " . ucfirst($cat) ." : "  .  $score ."%"}}<br>
                                                    @endforeach
                                                    @endif
                                            </div>
                                        </td>
                                        <td class="td-3">
                                            @if ($attachment->moderationResult)
                                                @if ($attachment->moderationResult->is_actived_verification_moderation == "1")
                                                 <span style="color: #2ecf25e3; "> Oui  </span>
                                                @else
                                                <span style="color: #d11c1c; ">  Non  </span>
                                                @endif
                                            @endif
                                               
                                        </td>
                                        <td class="td-3">
                                            @if ($attachment->moderationResult)
                                                @php
                                                    $reasons = $attachment->moderationResult->reasonOfDeclined($attachment->moderation_status);
                                                @endphp
                                                @if ($attachment->moderationResult)
                                                    @foreach ($reasons as $reason )
                                                    {{ ucfirst($reason)  }} <br>
                                                    @endforeach
                                                @endif
                                            @endif
                                                
                                        </td>
                                       
                                        <td class="td-4">
                                            {{ $attachment->created_at }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                      @if (!$attachments->count())
                      <div class="d-flex justify-content-center mt-2 mb-2 font-weight-bold">There are no results.(use the filter to select)</div>
                      @endif
                    <div class="afrifan_table_pagination_edit">
                        <div>
                            <div role="status" class="show-res" aria-live="polite">{{ trans_choice(
                                'voyager::generic.showing_entries', $attachments->total(), [
                                    'from' => $attachments->firstItem(),
                                    'to' => $attachments->lastItem(),
                                    'all' => $attachments->total()
                                ]) }}</div>
                        </div>
                        <div>
                            {{ $attachments->links() }}
                        </div>
                    </div>
                    
                </div>      
            </div>
        </div>
    </div>
</div>
@stop
@php
    // $start = '01/' . now()->format('m/Y');
    // $end =  now()->format('d/m/Y');
  
    $interval = Request::get('interval');
    if ($interval) {
        $interval = explode("-",str_replace(" ","",$interval));
        $start = $interval[0];
        $end =  $interval[1];
    }
@endphp
@section('javascript')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
     $(document).ready(function () {
            $('.filters').select2({
                minimumResultsForSearch: Infinity
            });
            $('#interval').daterangepicker({
                "opens": 'right',
                "autoApply": false,
                "locale": {
                    "format": 'DD/MM/YYYY',
                    "cancelLabel": 'Clear'
                }
                @if( $interval)
                ,
                    "startDate": "{{  $start }}",
                    "endDate": "{{  $end   }}"
                @endif
            })
            .on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            })
            @if( !$interval)
                $('#interval').val("")
            @endif
        });
</script>
@stop
<style>
    .img-row {
    border-radius: 4px;
    padding: 5px;
    width: 150px;
    height: 150px;
    object-fit: cover;
    }
    td ,th {
        text-align: center !important;
    }
</style>