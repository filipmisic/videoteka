@extends('layouts.admin.main') 
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">

@section('pageTitle')
Uredi trgovinu
@endsection

@section('content')

<form action="/admin/store/update" method="post">
    {{csrf_field()}}

    @if (isset($errors))
    @foreach ($errors->all() as $error)
        {{ $error }} <br>
    @endforeach
    @endif



    <label for="name">Ime trgovine: </label>
    <input id="name" type="text" name="name" value="{{old('name') ? old('name') : $store->name}}"><br><br>
    <label for="city">Grad: </label>
    <input id="city" type="text" name="city" value="{{old('city') ? old('city') : $store->city}}"><br><br>
    <label for="director">Adresa: </label>
    <input id="adress" type="text" name="adress" value="{{old('adress') ? old('adress') : $store->adress}}"><br>

    <input type="hidden" name="storeId" value="{{$store->id}}">

    <input type="submit">

</form>

@endsection