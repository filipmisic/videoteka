@extends('layouts.admin.main') 
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">

@section('pageTitle')
Inventar
@endsection
@section('content')
<table>
    <thead>
        <th>Naslov</th>
        <th>Trgovina</th>
        <th>Barkod</th>
        <th>Ukupna kolicina</th>
        <th>Rentano</th>
        <th>Dostupno</th>
    </thead>
    <tbody>
     @foreach ($inventories as $inventory )
     <tr>
         <td>{{ $inventory->movies->title }}</td>
         <td>{{ $inventory->stores->name }}</td>
         <td>{{ $inventory->movies->barcode }}</td>
         <td>{{ $inventory->amount }}</td>
         <td>{{ $inventory->rented }}</td>
         <td>{{ $inventory->amount - $inventory->rented }}</td>
      </tr>
     @endforeach
   </tbody>
  </table>
 </div>   
  {{ $inventories->links() }}
@endsection
               