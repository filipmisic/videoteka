@extends('layouts.terminal.main') 
<link rel="stylesheet" href="{{ asset('/css/terminal.css') }}">
@section('pageTitle')
Izbornik
@endsection

@section('content')
<div class="grid">
    <div class="item">
        <div class="bg cash-register"></div>
        <a class="link" href="/terminal/dashboard/cashregister"></a>
    </div>
    <div class="item">
        <div class="bg truck"></div>
        <a class="link" href="/terminal/dashboard/delivery"></a>
    </div>
    <div class="item">
        <div class="bg loyalty"></div>
        <a class="link" href="/terminal/dashboard/loyalty"></a>
    </div>
    <div class="item">
        <div class="bg shelf"></div>
        <a class="link" href="/terminal/dashboard/inventory"></a>
    </div>
</div>
@endsection




