@extends('layouts.main.main')
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">
@section('pageTitle')
Payment
@endsection

@section('content')

<div>  
    @if (Auth::user()->premium)
    <s>Cijena : {{ 2* $data->days_rented}} kn </s>
    Cijena : {{ 1* $data->days_rented}} kn
    @else
    Cijena : {{ 2* $data->days_rented}} kn
    @endif
</div>
<form action="/movie/rent/insert" method="post">

    {{csrf_field()}}

    @if (isset($errors))
    @foreach ($errors->all() as $error)
        {{ $error }} <br>
    @endforeach
    @endif

    <label for="korisnik">Visa</label>
    <input type="radio" id="visa" name="karica" >

    <label for="mastercard">Mastrecard</label>
    <input type="radio" id="mastercard" name="karica" > <br><br>

    <label for="card_number">Broj kartice:</label>
    <input type="number" id="card_number" name="card_number"> <br><br>

    <label for="expiration_year">Godina isteka kartice:</label>
    <input type="number" id="expiration_year" name="expiration_year"> <br><br>

    <label for="expiration_month">Mjesec isteka kartice:</label>
    <input type="number" id="expiration_month" name="expiration_month"> <br><br>

    <label for="cvc">CVC:</label>
    <input type="number" id="cvc" name="cvc"> <br><br>

    <input type="hidden" name="days_rented" value={{ $data->days_rented }}>

    <input type="hidden" name="movie_id" value="{{ $data->movie_id }}">

    <input type="submit">
    
</form>
@endsection