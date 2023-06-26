@extends('layouts.user.main')
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">


@section('content')
<table>
   <thead>
   <tr>
      <th> Naslov </th>
      <th> Godina </th>
      <th> Redatelj </th>
      <th> Datum isteka </th>
      <th> Link </th>
      <th> Akcija </th>
      </thead>
      <tbody>
        @foreach ($rents as $rent)
        @if (strtotime($rent->created_at->addDays($rent->days_rented)) > time())
        <tr>
        <td>{{ $rent->movies->title }}</td>
        <td>{{ $rent->movies->year }}</td>
        <td>{{ $rent->movies->director }}</td>
        <td>{{ $rent->created_at->adddays($rent->days_rented) }}<br></td>
        <td><a href="user/view/{{ $rent->movie_link }}">{{ $rent->movie_link }}</a></td>
        <td class="text-hover-green"><a href="user/review/movie/{{ $rent->movie_id }}"> Osvrt </a></td>
        </tr> 
        @endif
        @endforeach

   </tbody>
 </table>          
@endsection

