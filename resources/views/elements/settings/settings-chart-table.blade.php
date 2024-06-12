
<table class="table table-sm text-white">
  <thead>
    <tr>
      <th scope="col">{{  time() }}</th>
      <th scope="col">Type</th>
      <th scope="col">Total</th>
      <th scope="col">detail</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $datasets as $type )
        <tr>
        <th scope="row">Color</th>
        <td>{{ $type['label'] }}</td>
        <td>{{   collect($type['data'] )->sum() }} {{$currency_code}}</td>
        <td>Voir detail</td>
        </tr>
    @endforeach
  </tbody>
</table>