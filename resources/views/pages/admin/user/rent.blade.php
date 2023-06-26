@extends('layouts.admin.main') 
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">

@section('pageTitle')
   Korisnici 
@endsection

@section('content')

<table>
    <thead>
    <tr>
       <th> Naslov </th>
       <th> Rentan </th>
       <th> Trgovina </th>
       
       </thead>
       <tbody>
     @foreach ($rents as $rent) 
     <tr>
     <td>{{ $rent->movies->title }}</td> 
     <td>{{ $rent->created_at }}</td>
     <td>{{ $rent->stores->name }}</td>
     </tr>
     @endforeach
    </tbody>
  </table>
 </div>   
  {{ $rents->links() }}
@endsection