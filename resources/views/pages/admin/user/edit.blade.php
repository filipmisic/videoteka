@extends('layouts.admin.main') 
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">

@section('pageTitle')
   Uredi Korisnika 
@endsection

@section('content')

<div>
    Korisnicko ime: {{$user->name}} <br>
    Email: {{$user->email}}
</div>

<form action="/admin/user/update" method="post">
    {{csrf_field()}}

    @if (isset($errors))
    @foreach ($errors->all() as $error)
        {{ $error }} <br>
    @endforeach
    @endif

<label for="oib">Oib</label>
<input type="number" name="oib" id="oib" value="{{old('oib') ? old('oib') : $user->oib}}"> <br>

<label for="korisnik">Korisnik</label>
<input type="radio" id="korisnik" name="admin" value="0" {{ ($user->admin) ?"":"checked" }}> <br>

<label for="administrator">Administrator</label>
<input type="radio" id="administrator" name="admin" value="1" {{ ($user->admin) ?"checked":"" }}> <br>

<label for="osnovno">Osnovno</label>
<input type="radio" id="osnovno" name="premium" value="0" {{ ($user->premium) ?"":"checked" }}>

<label for="prime">Premium</label>
<input type="radio" id="prime" name="premium" value="1" {{ ($user->premium) ?"checked":"" }}> <br>
 
<label for="aktivan">Aktivan</label>
<input type="radio" id="aktivan" name="blocked" value="0" {{ ($user->blocked) ?"":"checked" }}>

<label for="blokiran">Blokiran</label>
<input type="radio" id="blokiran" name="blocked" value="1" {{ ($user->blocked) ?"checked":""}} {{ ($user->admin)?"disabled":"" }}> <br><br>

<input type="hidden" name="userId" value="{{$user->id}}">
<input type="submit">

</form>

@endsection