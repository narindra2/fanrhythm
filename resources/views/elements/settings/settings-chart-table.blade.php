
<table class="table table-sm text-white">
  <tbody>
    @foreach ( $datasets as $type )
        <tr>
        <th scope="row">Color</th>
        <td>{{ $type['label'] }}</td>
        <td>{{   collect($type['data'] )->sum() }} {{$currency_code}}</td>
        <td>Detail</td>
        </tr>
    @endforeach
  </tbody>
</table>