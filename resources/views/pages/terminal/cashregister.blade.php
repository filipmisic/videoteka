@extends('layouts.terminal.sub') 
<link rel="stylesheet" href="{{ asset('/css/cashreg.css') }}">
<link rel="stylesheet" href="{{ asset('/css/popup.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@section('pageTitle')
Blagajna
@endsection
@section('content')

<div class="popup" style="display:none" id="popup">
    <div class="popup-content">
        <button class="close" id="togle" onclick="togle()">&times;</button>
        <table id="example">
            <thead>
                <tr>
                    <th>Korisnik</th>
                    <th>OIB</th>
                    <th>Status</th>                   
                    <th>Akcija</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $users as $user )              
                 <tr>
                    <td> {{ $user->name }}</td>
                    <td> {{ $user->oib }} </td>
                    @if ($user->blocked)
                        <td>Blokiran</td>
                    @else
                        <td>Aktivan</td>
                    @endif
                    <td> <button id="korisnik" onclick="fillform({{ json_encode($user) }})">odaberi</button></td>
                 </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> 
<div class="cashreg">

    <div class="user">
        <button  id="togle" class="adduser" onclick="togle()">korisnik</button>
    </div>
    <form id="cashregister"  action="/terminal/dashboard/cashregister/create" method="POST">
        {{csrf_field()}}

        @if (isset($errors))
        @foreach ($errors->all() as $error)
            {{ $error }} <br>
        @endforeach
        @endif
        <div id="newinput"></div>
        
    <div class="display">

        <div id="movieinput" class="movieinput"></div>
        
    </div>
    </form>
    <div class="input">
            <input type="number" id="moviebarcode" class="barcode" >
            <input type="checkbox" id="return"> Povrat
            <button class="movieadd" onclick="fillmovie()"> Add </button>
            <input type="number" disabled class="sum" id="sum" value="0"> 
            <input type="submit" class="reciept" onclick="send()" value="Racun">
    </div>
</div>

@endsection

@section('JS')

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js" type="text/javascript"></script>
<script type="text/javascript">

  $(document).ready(function () {
    $('#example').DataTable({
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
function fillform(user)
{
    filmovi=[];
    $("#movieinput").empty();
    $("#row").remove();
    newRowAdd =
             
            '<div id="row" class="userrow"> ' +
            '<input id="user_id" type="hidden" name="user_id" value="'+user.id+'"> '+
            '<input id="premium" type="hidden"  value="'+user.premium+'"> '+
            '<label for="name">Ime: </label>'+
            '<input id="name" type="text" value="'+user.name+'" disabled>  '+
            '<label for="email">Email: </label>'+
            '<input id="email" type="email" value="'+user.email+'" disabled>  '+
            '<label for="oib">Oib: </label>'+
            '<input id="oib" type="text" value="'+user.oib+'" disabled> </div> ';
    $('#newinput').append(newRowAdd);
    togle();
}
function fillmovie()
{
        axios.get('/terminal/dashboard/cashregister/getrent/'+document.getElementById("moviebarcode").value+'/'+document.getElementById("user_id").value+'/'+$("#return").prop('checked'))
            .then(response => {
                filmovi.forEach(film => {
                    if(film.returnal === $("#return").prop('checked') && film.barcode === response.data.barcode)
                    {
                        throw new Error("Jedan film po racunu");
                    }
                });
                filmovi.push({
                    ...response.data,
                    returnal: $("#return").prop('checked'),
                    user_id: document.getElementById("user_id").value,
                });
                console.log(filmovi)
                reciept()
            }).catch(err =>{
                console.log(err.response.data.message); 
            });
}
function reciept()
{
    let sum=0;
    let i=0;
    $("#movieinput").empty();
    filmovi.forEach(film => {
       sum+=film.price;
       newRowAdd =            
                '<div id="moviesrow" class="moviesrow"> ' +
                '<input id="movie_id" type="hidden" name="movie_id[]" value="'+film.id+'"> '+
                '<input type="text" value="'+film.title+'" disabled> '+
                '<input type="number" name="amount[]" value="1" disabled >  '+
                '<button id="DeleteRow" type="button" onclick="deletemovie('+i+')"> Delete </button> </div>' ;
                $('#movieinput').append(newRowAdd);
                i++;
    });
    if(document.getElementById("premium").value == 1)
    {
        document.getElementById("sum").value=sum/2
    }
    else
    {
        document.getElementById("sum").value=sum
    }  

}

function deletemovie(j)
{
    filmovi.splice(j,1);
    reciept();
}

function send()
{
    axios.post('/terminal/dashboard/cashregister/create',{movies:filmovi})
    .then(response => {
        window.location.reload()
    })
    .catch(function (error) {
    console.log(error);
    });
}

</script>

@endsection
