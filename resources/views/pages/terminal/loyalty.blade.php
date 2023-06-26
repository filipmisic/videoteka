@extends('layouts.terminal.sub') 
@section('pageTitle')
Kreiraj korisnika
@endsection
@section('content')

<div class="forma">

<h3>Kreiraj korisnika</h3>
<form action="/terminal/dashboard/loyalty/create" method="POST">

    {{csrf_field()}}
    
    @if (isset($errors))
    @foreach ($errors->all() as $error)
        {{ $error }} <br>
    @endforeach
    @endif

    <label for="name">Ime : </label>
    <input id="name" type="text" name="name" value="{{old('name')}}"><br><br>
    <label for="oib">Oib : </label>
    <input id="oib" type="text" name="oib" value="{{old('oib')}}"><br><br>

<input class="submit" type="submit">
</form>
</div>

@endsection