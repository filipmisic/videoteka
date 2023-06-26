@extends('layouts.admin.main') 
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">

@section('pageTitle')
   Korisnici 
@endsection

@section('content')

<table>
    <thead>
    <tr>
       <th> Korisnicko ime </th>
       <th> Email </th>
       <th> Oib </th>
       <th> Clanstvo </th>
       <th> Status </th>
       <th> Admin </th>   
       <th>Akcije</th>
       
       </thead>
       <tbody>
     @foreach ($users as $user) 
     <tr>
     <td><a href="/admin/user/rent/{{ $user->id }}">{{ $user->name }}</a> </td>
     <td>{{ $user->email }}</td> 
     <td>{{ $user->oib }}</td>
     <td>{{ ($user->premium)?"Premium":"Osnovno" }} </td>
     <td>{{ ($user->blocked)?"Blokiran":"Aktivan" }} </td>
     <td>{{ ($user->admin)?"Admin":"Korisnik" }} </td>
    <td>
        <a href="/admin/user/edit/{{ $user->id }}" class="text-hover-green">Uredi</a>
    </td>
     @endforeach
    </tbody>
  </table>
 </div>   
  {{ $users->links() }}
@endsection

