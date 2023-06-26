@extends('layouts.terminal.sub') 
<link rel="stylesheet" href="{{ asset('/css/popup.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


@section('pageTitle')
Dostava
@endsection

@section('content')

<button  id="togle" onclick="togle()">Unos</button>

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
            @foreach ($movies as $movie )
            <tr>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->barcode }}</td>
                <td> <button onclick="fillform({{ json_encode($movie) }})">dodaj</button></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div> 

<div id="form">
    <form action="/terminal/dashboard/delivery/insert" method="post">
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
    <table id="logs" class="logs">
       <thead>
           <th>Naslov</th>
           <th>Barkod</th>
           <th>Kolicina</th>
           <th colspan="2">Ranik</th>
           <th> Akcija </th>
           <th> Datum </th>
       </thead>
       <tbody>
           @foreach ($logs as $log )
           <tr>
               <td>{{ $log->movies->title }}</td>
               <td>{{ $log->movies->barcode }}</td>
               <td>{{ $log->amount }}</td>
               <td>{{ $log->workers->name }}</td>
               <td>{{ $log->workers->surname }}</td>
               <td>{{ $log->action }}</td>
               <td>{{ $log->created_at }}</td>
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
    $('#logs').DataTable({
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
            '<input id="movie_id" type="hidden" name=movie_id[] value="'+movie.id+'"> '+
            '<label for="title">Film: </label>'+
            '<input type="text" name="title[]" value="'+movie.title+'" disabled> '+
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