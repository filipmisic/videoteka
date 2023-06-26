@extends('layouts.admin.main') 
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">

@section('pageTitle')
Inventar
@endsection
@section('content')
<div>
<table>
    <thead>
        <th>Naslov</th>
        <th>Barkod</th>
        <th>Ukupna kolicina</th>
        <th>Rentano</th>
        <th>Dostupno</th>
    </thead>
    <tbody>
     @foreach ($inventories as $inventory )
     <tr>
         <td>{{ $inventory->movies->title }}</td>
         <td>{{ $inventory->movies->barcode }}</td>
         <td>{{ $inventory->amount }}</td>
         <td>{{ $inventory->rented }}</td>
         <td>{{ $inventory->amount - $inventory->rented }}</td>
      </tr>
     @endforeach
   </tbody>
  </table> 
  <br>
<div class="paginate">
{{ $inventories->links() }}
</div> 
  <br><br>
</div>
<div>
<table>
    <thead>
        <tr>
            <th>Film</th>
            <th>Korisnik</th>
            <th>Akcija</th>
            <th>Datum</th>
        </tr>
    </thead>
    <tbody>
  @foreach ($rentlogs as $rentlog )
  <tr>
      <td>{{ $rentlog->movies->title }}</td>
      <td>{{ $rentlog->users->name }}</td>
      <td>{{ $rentlog->action }}</td>
      <td>{{ $rentlog->created_at }}</td>
   </tr>
  @endforeach
</tbody>
</table>
</div>
<br>
<div class="paginate">
{{ $rentlogs->links() }}
</div>
@endsection