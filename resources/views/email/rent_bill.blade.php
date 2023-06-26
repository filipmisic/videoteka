Naslov Filma:{{ $movie->title }} <br>

@if ($user->premium)
Cijena: {{ $days_rented * 1 }} <br>

@else
Cijena: {{ $days_rented * 2 }} <br>
@endif


Iznajmjeno na {{ $days_rented }} dana
