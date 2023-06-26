@extends('layouts.terminal.sub') 
<link rel="stylesheet" href="{{ asset('/css/popup.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


@section('pageTitle')
Inventar
@endsection

@section('content')

<button  id="togle" onclick="togle()">Izlaz</button>

<div class="popup" style="display:none" id="popup">
    <div class="popup-content">
        <button class="close" id="togle" onclick="togle()">&times;</button>
        <table id="example">
            <thead>
                <tr>
                    <th>Naslov</th>
                    <th>Barkod</th>
                    <th>Akcija</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($inventories as $inventory )
            <tr>
                <td>{{ $inventory->movies->title }}</td>
                <td>{{ $inventory->movies->barcode }}</td>
                <td> <button onclick="fillform({{ json_encode($inventory) }})">dodaj</button></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div> 

<div id="form">
    <form action="/terminal/dashboard/inventory/update" method="post">
           {{csrf_field()}}

    @if (isset($errors))
    @foreach ($errors->all() as $error)
        {{ $error }} <br>
    @endforeach
    @endif
        <div id="newinput"></div>
        <input id="submit" type="submit" style="display:none">
    </form>
</div>

<div class="logs-table">
    <table id="inventory" class="logs">
       <thead>
           <th>Naslov</th>
           <th>Barkod</th>
           <th>Ukupna kolicina</th>
           <th>Rentano</th>
           <th>Dostupno</th>
       </thead>
       <tbody>
        @foreach ($inventories as $inventory )
        <tr>
            <td><a class="availability" href="/terminal/dashboard/inventory/availability/{{ $inventory->movie_id }}">{{ $inventory->movies->title }}</a></td>
            <td>{{ $inventory->movies->barcode }}</td>
            <td>{{ $inventory->amount }}</td>
            <td>{{ $inventory->rented }}</td>
            <td>{{ $inventory->amount - $inventory->rented }}</td>
         </tr>
        @endforeach
      </tbody>
    </table>
</div>

@endsection

@section('JS')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script type="text/javascript">

  $(document).ready(function () {
    $('#example').DataTable({
        lengthMenu: [
            [5, 10, 15],
            [5, 10, 15],
        ],
    });
    $('#inventory').DataTable({
        lengthMenu: [
            [5, 10, 15],
            [5, 10, 15],
        ],
    });
});
function togle()
{
    if(document.getElementById("popup").style.display === "none")
    {
        document.getElementById("popup").style.display="flex";
    }
    else
    {
        document.getElementById("popup").style.display="none";
    }
 
}
function fillform(movie)
{ 
    if(document.getElementById("submit").style.display === "none")
    {
        document.getElementById("submit").style.display = ""
    }
    newRowAdd =
             
            '<div id="row"> ' +
            '<input id="movie_id" type="hidden" name=movie_id[] value="'+movie.movies.id+'"> '+
            '<label for="title">Film: </label>'+
            '<input type="text" name="title[]" value="'+movie.movies.title+'" disabled> '+
            '<label for="amount" >Kolicina: </label>'+
            '<input type="number" name="amount[]">  '+
            '<button id="DeleteRow" type="button"> Delete </button> </div>' ;
 
    $('#newinput').append(newRowAdd);
    togle();
}

$("body").on("click", "#DeleteRow", function () {
            $(this).parents("#row").remove();
        })
</script>
@endsection