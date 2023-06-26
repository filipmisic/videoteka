@extends('layouts.main.main')
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">

@section('content')

<div>
    {{ $movie->title }} ({{ $movie->year }}) <br>
    {{ $movie->director }} <br><br>
</div>

<div>
    Posudi od datuma: {{date('Y-m-d')}} <br>
    @if (Auth::user()->premium)
    <s>Cijena : 2kn </s>
    Cijena : 1kn 
    @else
    Cijena : 2kn 
    @endif
</div> <br>
<form action="/movie/rent/payment" method="get">


    
    <label for="days">Dana za posudit:</label>
    <input id="days" type="number" name="days_rented" value="{{old('title')}}" min='1'><br><br>

    <input type="hidden" name="movie_id" value="{{ $movie->id }}">

    <input type="submit">
</form>

@endsection