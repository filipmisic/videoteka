@extends('layouts.terminal.sub') 
<link rel="stylesheet" href="{{ asset('/css/popup.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


@section('pageTitle')
Dostupnost
@endsection

@section('content')

<div class="logs-table">
    <table id="inventory" class="logs">
       <thead>
           <th>Naslov</th>
           <th>Dostupno</th>
           <th>Trgovina</th>
           <th>Adresa</th>
           <th>Grad</th>
       </thead>
       <tbody>
        @foreach ($inventories as $inventory )
        <tr>
            <td>{{ $inventory->movies->title }}</td>
            <td>{{ $inventory->amount - $inventory->rented }}</td>
            <td>{{ $inventory->stores->name }}</td>
            <td>{{ $inventory->stores->adress }}</td>
            <td>{{ $inventory->stores->city }}</td>
         </tr>
        @endforeach
      </tbody>
    </table>
</div>

@endsection

@section('JS')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script type="text/javascript">

  $(document).ready(function () {
    $('#inventory').DataTable({
        lengthMenu: [
            [5, 10, 15],
            [5, 10, 15],
        ],
    });
});
</script>
@endsection