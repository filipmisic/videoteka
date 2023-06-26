@extends('layouts.main.main')
<link rel="stylesheet" href="{{ asset('/css/general.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section('content')

<div>
{{ $movie->title }} ({{ $movie->year }}) <br>
{{ $movie->director }} <br>

<span class="fa fa-star {{($average >= 1) ? 'checked' :""}} "></span>
<span class="fa fa-star {{($average >= 1.5) ? 'checked' :""}} "></span>
<span class="fa fa-star {{($average >= 2.5) ? 'checked' :""}} "></span>
<span class="fa fa-star {{($average >= 3.5) ? 'checked' :""}} "></span>
<span class="fa fa-star {{($average >= 4.5) ? 'checked' :""}} "></span> 
{{ $average }}<br><br>

</div>

<div class="button-68">
<a href="rent/getmovie/{{ $movie->id }}"> Rentmovie </a>
</div> <br><br>

<div>
    @foreach ($reviews as $review)

    Korisnik : {{ $review->users->name }} <br>

    <span class="fa fa-star {{($review->score >= 1) ? 'checked' :""}} "></span>
    <span class="fa fa-star {{($review->score >= 2) ? 'checked' :""}} "></span>
    <span class="fa fa-star {{($review->score >= 3) ? 'checked' :""}} "></span>
    <span class="fa fa-star {{($review->score >= 4) ? 'checked' :""}} "></span>
    <span class="fa fa-star {{($review->score >= 5) ? 'checked' :""}} "></span> <br>

    {{ $review->title }} <br>
    {{ $review->body}} <br> <br>
        
    @endforeach
    {{ $reviews->links() }}
</div>
@endsection