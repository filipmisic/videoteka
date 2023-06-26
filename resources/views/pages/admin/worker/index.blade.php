@extends('layouts.admin.main') 
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">

@section('pageTitle')
Trgovine
@endsection

@section('content')

<div class="button-68">
  <a href="/admin/worker/create" >Kreiraj radnika</a> 
</div> <br><br>

<table>
  <thead>
  <tr>
    <th>Sifra trgovca </th>  
    <th> Ime  </th>
    <th> Prezime </th>
    <th> Status </th>  
    <th>Akcije</th>
     
     </thead>
     <tbody>
    @foreach ($workers as $worker) 
    <tr>
    <td>{{ $worker->number }} </td>
    <td>{{ $worker->name }} </td>
    <td>{{ $worker->surname }}</td> 
    <td>{{ ($worker->status)?"Aktivan":"Neaktivan" }} </td>
    <td>
    <a href="/admin/worker/edit/{{ $worker->id }}" class="text-hover-green">Uredi</a>
    <a href="/admin/worker/delete/{{ $worker->id }}" class="text-hover-red">Obrisi</a>
    </td>
    @endforeach
  </tbody>
</table>
</div>   

@endsection