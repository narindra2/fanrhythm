
@php
    $total = 0;
@endphp
<table class="table text-white">
  <tbody>
    @foreach ( $datasets as $type )
    @php
        $sum = collect($type['data'] ?? 0 )->sum();
        $total =  $total + $sum;
    @endphp
        <tr>
          <th  class="color-box" style="text-align: center;width: 32%;"> <span  style="background-color: {{ $type['borderColor'] }}"></span></th>
          <td>{{ $type['label'] ?? 'Non define' }}</td>
          <td>{{ $sum   }} {{$currency_code}}</td>
          {{-- <td>Detail</td> --}}
        </tr>
    @endforeach
    <tr>
      <th  style="text-align: center;">Total</th>
      <td></td>
      <td> <span class="text-primary ">{{  $total }} </span><span>{{$currency_code}}</span></td>
      <td></td>
    </tr>
  </tbody>
  
</table>
<style>
  .color-box span {
    padding: 0px;
    padding-left: 25px;
    margin: 0px;
    margin-right: 7px;
    border-radius: 2px;
}
.color-box {
  border: 1px #aaa solid;
  padding: 6px;
  padding-right: 100px;
  border-radius: 3px;
  -moz-box-shadow: inset 0 0 2px 0 #888;
  -webkit-box-shadow: inset 0 0 2px 0 #888;
  box-shadow: inset 0 0 1px 0 #888;
}
.table tbody td, .table tbody th {
    padding: 4px 7px;
    border: none;
    font-size: 14px;
}
.table tbody td, .table tbody th {
    padding: 2px 1px;
    border: none;
    font-size: 14px;
}
 /* Dark Mode Styles for Date Range Picker */
       .dark_theme .daterangepicker {
            background-color: #242526;
            color: #fff;
        }
      .dark_theme  .daterangepicker .calendar-table {
            background-color: #242526;
        }
      .dark_theme  .daterangepicker td, .daterangepicker th {
            color: #fff;
        }
      .dark_theme  .daterangepicker .ranges, .daterangepicker .drp-buttons {
            background-color: #242526;
        }
      .dark_theme  .daterangepicker .range_inputs input {
            background-color: #242526;
            color: #fff;
        }
      .dark_theme  .daterangepicker .applyBtn, .daterangepicker .cancelBtn {
            background-color: #242526;
            color: #fff;
        }
      .dark_theme  .daterangepicker .applyBtn:hover, .daterangepicker .cancelBtn:hover {
            background-color: #242526;
        }
        
      .dark_theme .daterangepicker td.in-range{
        background-color:cornflowerblue;
        border-color: transparent;
        border-radius: 0;
    }
    .dark_theme   .daterangepicker td.off, .daterangepicker td.off.in-range, .daterangepicker td.off.start-date, .daterangepicker td.off.end-date {
          background-color:#242526;
          border-color: transparent;
          color: #999;
      }
</style>