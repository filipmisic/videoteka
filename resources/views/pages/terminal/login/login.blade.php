<html>
    <head> <title>Logiranje Radnika</title></head>
    <body>
        
  <div>
<form action="/terminal/authentification" method="POST">
    {{csrf_field()}}

    @if (isset($errors))
    @foreach ($errors->all() as $error)
        {{ $error }} <br>
    @endforeach
    @endif

    
    <label for="number">Sifra radnika </label>
    <input id="number" type="number" name="number" value="{{old('number')}} "><br><br>
    <label for="password">Lozinka: </label>
    <input id="password" type="password" name="password" ><br><br>

    <input type="submit">

</form>
</div>
</body>
</html>  