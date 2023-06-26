@extends('layouts.user.main')
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">

@section('pageTitle')
Osvrt na film {{ $movie->movies->title }}
@endsection

@section('content')
<form action="/user/review/insert" method="post">
    {{csrf_field()}}

    @if (isset($errors))
    @foreach ($errors->all() as $error)
        {{ $error }} <br>
    @endforeach
    @endif
<label for="title">Naslov:</label>
<input id="title" type="text" name="title" value="{{old('title')}}"><br><br>
<label for="body">Osvrt:</label>
<textarea name="body" id="body" cols="30" rows="5">{{old('body')}}</textarea><br>

<div class="stars">
    <input id="star-5" type="radio" value=5 name="score"/>
    <label for="star-5"></label>
    <input id="star-4" type="radio" value=4 name="score"/>
    <label for="star-4"></label>
    <input id="star-3" type="radio" value=3 name="score"/>
    <label for="star-3"></label>
    <input id="star-2" type="radio" value=2 name="score"/>
    <label for="star-2"></label>
    <input id="star-1" type="radio" value=1 name="score"/>
    <label for="star-1"></label>
</div><br>

<input type="hidden" name="movie_id" value="{{ $movie->movie_id }}">
<input type="submit">


</form>


@endsection