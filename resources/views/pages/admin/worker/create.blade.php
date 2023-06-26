@extends('layouts.admin.main') 
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">

@section('pageTitle')
Kreiraj radnika
@endsection

@section('content')

<form action="/admin/worker/insert" method="post">
    {{csrf_field()}}

    @if (isset($errors))
    @foreach ($errors->all() as $error)
        {{ $error }} <br>
    @endforeach
    @endif

    <label for="number">Sifra radnika </label>
    <input id="number" type="number" name="number" value="{{old('number')}} "><br><br>
    <label for="password">Lozinka: </label>
    <input id="password" type="password" name="password" ><br><br>
    <label for="name">Ime : </label>
    <input id="name" type="text" name="name" value="{{old('name')}}"><br><br>
    <label for="surname">Prezime : </label>
    <input id="surname" type="text" name="surname" value="{{old('surname')}}"><br><br>
    <label for="store">Trgovina:</label>
    <select id="store" name="store_id">
    @foreach ($stores as $store )
     <option value="{{ $store->id }}">{{ $store->name }}</option>
    @endforeach
    </select> <br>

    <input type="submit">

</form>

@endsection