@extends('layouts.admin.main') 
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">

@section('pageTitle')
Uredi radnika
@endsection

@section('content')

<form action="/admin/worker/update" method="post">
    {{csrf_field()}}

    @if (isset($errors))
    @foreach ($errors->all() as $error)
        {{ $error }} <br>
    @endforeach
    @endif

    <label for="number">Sifra radnika: </label>
    <input id="number" type="number" name="number" value="{{ $worker->number }}" disabled ><br><br>
    <label for="password">Lozinka: </label>
    <input id="password" type="password" name="password"><br><br>
    <label for="name">Ime : </label>
    <input id="name" type="text" name="name"  value="{{old('name') ? old('name') : $worker->name}}"><br><br>
    <label for="surname">Prezime : </label>
    <input id="surname" type="text" name="surname"  value="{{old('surname') ? old('surname') : $worker->surname}}"><br><br>
    <label for="aktivan">Aktivan</label>
    <input type="radio" id="aktivan" name="status" value="1" {{ ($worker->status) ?"checked":"" }}>
    <label for="Neaktivan">Neaktivan</label>
    <input type="radio" id="Neaktivan" name="status" value="0" {{ ($worker->status) ?"":"checked"}}> <br><br>

    <label for="store">Trgovina:</label>
    <select id="store" name="store_id">
    @foreach ($stores as $store )
     <option value="{{ $store->id }}">{{ $store->name }}</option>
    @endforeach
    </select> <br>
    <input type="hidden" name="workerId" value="{{ $worker->id }}">
    <input type="submit">

</form>

@endsection