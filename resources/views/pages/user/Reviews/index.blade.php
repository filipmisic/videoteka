@extends('layouts.user.main')
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@section('pageTitle')
Osvrti
@endsection

@section('content')


@foreach ($reviews as $review )
Naslov: {{ $review->movies->title }} <br>

<span class="fa fa-star {{($review->score >= 1) ? 'checked' :""}} "></span>
<span class="fa fa-star {{($review->score >= 2) ? 'checked' :""}} "></span>
<span class="fa fa-star {{($review->score >= 3) ? 'checked' :""}} "></span>
<span class="fa fa-star {{($review->score >= 4) ? 'checked' :""}} "></span>
<span class="fa fa-star {{($review->score >= 5) ? 'checked' :""}} "></span> <br>

{{ $review->title }}<br>
{{ $review->body }}<br>

<a href="/user/review/edit/{{$review->movie_id}}" class="button-68">Uredi</a> 
<a href="/user/review/delete/{{$review->id}}" class="button-delete">Obrisi</a> <br><br>
@endforeach
{{ $reviews->links() }}
@endsection