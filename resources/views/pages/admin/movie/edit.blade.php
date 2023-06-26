@extends('layouts.admin.main') 
@section('pageTitle')
   Uredi
@endsection

@section('content') 
<form action="/admin/movie/update" method="post">
    {{csrf_field()}}

    @if (isset($errors))
    @foreach ($errors->all() as $error)
        {{ $error }} <br>
    @endforeach
    @endif

<label for="title">Naslov:</label>
<input id="title" type="text" name="title" value="{{old('title') ? old('title') : $movie->title}}"><br><br>
<label for="year">Godina</label>
<input type="number" name="year" value="{{old('year') ? old('year') : $movie->year}}"><br><br>
<label for="director">Redatelj</label>
<input type="text" name="director" value="{{old('director') ? old('director') : $movie->director}}"><br>

<label for="Fantastika">Fantastika</label>
<input type="checkbox" id="Fantastika" name="genre[]" value="Fantastika" {{in_array('Fantastika', $genres) ? 'checked' :''}}>
<label for="SF">SF</label>
<input type="checkbox" id="SF" name="genre[]" value="SF"{{in_array('SF', $genres) ? 'checked' :''}}>
<label for="Akcija">Akcija</label>
<input type="checkbox" id="Akcija" name="genre[]" value="Akcija" {{in_array('Akcija', $genres) ? 'checked' :''}}>
<label for="Komedija">Komedija</label>
<input type="checkbox" id="Komedija" name="genre[]" value="Komedija" {{in_array('Komedija', $genres) ? 'checked' :''}}>
<label for="Drama">Drama</label>
<input type="checkbox" id="Drama" name="genre[]" value="Drama" {{in_array('Drama', $genres) ? 'checked' :''}}>
<label for="Romantika">Romantika</label>
<input type="checkbox" id="Romantika" name="genre[]" value="Romantika" {{in_array('Romantika', $genres) ? 'checked' :''}}> <br>
<label for="barcode">Barkod:</label>
<input id="barcode" type="number" name="barcode" value="{{old('barcode') ? old('barcode') : $movie->barcode}}"><br><br>

<input type="hidden" name="movieId" value="{{$movie->id}}">

<input type="submit">

</form>

 @endsection