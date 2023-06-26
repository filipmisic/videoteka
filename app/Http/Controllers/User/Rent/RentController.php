<?php

namespace App\Http\Controllers\User\Rent;

use App\Http\Controllers\Controller;
use App\Mail\RentBill;
use App\Models\Movie;
use App\Models\OnlineRent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Iman\Streamer\VideoStreamer;

class RentController extends Controller
{
    public $movie,$rent;
    public function __construct()
    {
        $this->movie=new Movie();
        $this->rent=new OnlineRent();
    }

    public function index()
    {
        $getRent=$this->rent->where('user_id',Auth::user()->id)->with('movies')->paginate(10);
        return view('pages.user.index',['rents'=> $getRent],);
    }

    public function ViewMovie($movieLink)
    {
        $getRent=$this->rent->where('movie_link',$movieLink)->with('movies')->first();

        if($getRent)
        {
            $getDate=$getRent->created_at->addDays($getRent->days_rented);
            if(strtotime($getDate) > time())
            {
                $path = public_path($getRent->movies->path);  
                VideoStreamer::streamFile($path);
            }
            return redirect('user'); 
        }
        return redirect('user');    
    }

}
