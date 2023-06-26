@extends('layouts.admin.main') 
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">

@section('pageTitle')
Trgovine
@endsection

@section('content')

<div class="button-68">
  <a href="/admin/store/create" >Kreiraj trgovinu</a> 
</div> <br><br>

<table>
  <thead>
  <tr>
     <th> Ime trgovine </th>
     <th> Grad </th>
     <th> Adresa </th>  
     <th>Akcije</th>
     
     
     </thead>
     <tbody>
   @foreach ($stores as $store) 
   <tr>
   <td><a href="/admin/store/inventory/{{ $store->id }}">{{ $store->name }}</a> </td>
   <td>{{ $store->city }}</td> 
   <td>{{ $store->adress }}</td> 
  <td>
      <a href="/admin/store/edit/{{ $store->id }}" class="text-hover-green">Uredi</a>
      <a href="/admin/store/delete/{{ $store->id }}" class="text-hover-red">Obrisi</a>
  </td>
  </tr>
   @endforeach
  </tbody>
</table>
</div>   
{{ $stores->links() }}
@endsection