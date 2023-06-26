@extends('layouts.admin.main') 


@section('pageTitle')
   Kreiranje filma
@endsection
@section('content')
                    
    <form action="insert" method="post" enctype="multipart/form-data">
        {{csrf_field()}}

        @if (isset($errors))
        @foreach ($errors->all() as $error)
            {{ $error }} <br>
        @endforeach
        @endif



        <label for="title">Naslov:</label>
        <input id="title" type="text" name="title" value="{{old('title')}}"><br><br>
        <label for="year">Godina</label>
        <input type="number" name="year" value="{{ old('year') }}"><br><br>
        <label for="director">Redatelj</label>
        <input type="text" name="director" value="{{ old('director') }}"><br>

        <label for="Fantastika">Fantastika</label>
        <input type="checkbox" id="Fantastika" name="genre[]" value="Fantastika">
        <label for="SF">SF</label>
        <input type="checkbox" id="SF" name="genre[]" value="SF">
        <label for="Akcija">Akcija</label>
        <input type="checkbox" id="Akcija" name="genre[]" value="Akcija">
        <label for="Komedija">Komedija</label>
        <input type="checkbox" id="Komedija" name="genre[]" value="Komedija">
        <label for="Drama">Drama</label>
        <input type="checkbox" id="Drama" name="genre[]" value="Drama">
        <label for="Romantika">Romantika</label>
        <input type="checkbox" id="Romantika" name="genre[]" value="Romantika"> <br>

        <label for="movie">Upload:</label>
        <input name="movie" type="file" id="movie" accept="video/*"><br><br>

        <label for="barcode">Barkod:</label>
        <input id="barcode" type="number" name="barcode" value="{{old('barcode')}}"><br><br>

        <input type="submit">

    </form>
@endsection
