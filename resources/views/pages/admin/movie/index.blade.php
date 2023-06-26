@extends('layouts.admin.main') 
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">

@section('pageTitle')
   Filmovi 
@endsection

@section('content')
<div class="button-68">
<a href="/admin/movie/create" >Kreiraj novi film</a>
</div> 
<br>
<br>
<table>
   <thead>
   <tr>
      <th> Naslov </th>
      <th> Godina </th>
      <th> Redatelj </th>
      <th> Zanr </th>
      <th> barkod </th>
      <th> Akcije </th>   
      
      </thead>
      <tbody>
    @foreach ($movies as $movie) 
    <tr>
    <td><a href="/admin/movie/inventory/{{ $movie->id }}">{{ $movie->title }}</a> </td>
    <td>{{ $movie->year }}</td> 
    <td>{{ $movie->director }} </td>
    <td>
    @foreach ( $movie->genres as $genre)
    {{$genre->genre." "}}
    @endforeach
    </td>
    <td>{{ $movie->barcode }}</td>         
    <td>
      <a href="/admin/movie/edit/{{ $movie->id }}" class="text-hover-green">Uredi</a>
      <a href="/admin/movie/delete/{{ $movie->id }}" class="text-hover-red">Obrisi</a>
    </td>
    </tr> 
    @endforeach
   </tbody>
 </table>
</div>   
 {{ $movies->links() }}
 @endsection
               