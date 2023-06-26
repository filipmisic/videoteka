@extends('layouts.main.main')
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">

@section('pageTitle')
   Online videoteka 
@endsection

@section('content')

<form action="/" method="get">
   {{csrf_field()}}

<label for="title"> Naslov: </label>
<input type="text" id="title" name="serchTitle"  value="{{($search->serchTitle) ? $search->serchTitle :''}}" > 
<input type="submit" value="Pretrazi">
</form>

<table>
   <thead>
   <tr>
      <th> Naslov </th>
      <th> Godina </th>
      <th> Redatelj </th>
      <th> Zanr </th>

      
      </thead>
      <tbody>
    @foreach ($movies as $movie) 
    <tr>
    <td><a href="movie/{{ $movie->id }}">{{$movie->title }} </a></td>
    <td>{{ $movie->year }}</td> 
    <td>{{ $movie->director }} </td>
    <td>
    @foreach ( $movie->genres as $genre)
    {{$genre->genre." "}}
    @endforeach
    </td>                                    

    </tr> 
    @endforeach
   </tbody>
 </table>
</div>   
 {{ $movies->appends(['serchTitle' => $search->serchTitle])->links() }}
 @endsection
