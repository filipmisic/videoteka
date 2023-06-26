<?php

namespace App\Http\Controllers\Rent;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOnlineRent;
use App\Mail\RentBill;
use App\Models\Movie;
use App\Models\OnlineRent;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Nullable;
use Str;

class OnlineRentController extends Controller
{
    public $movie,$rent;
    public function __construct()
    {
        $this->movie=new Movie();
        $this->rent=new OnlineRent();
    }

    
    public function insert(CreateOnlineRent $request)
    {
        $getRent=$this->rent->where('user_id',Auth::user()->id)->where('movie_id',$request->movie_id)->first();
        if($getRent)
        {
            $getDate=$getRent->created_at->addDays($getRent->days_rented);
            if(strtotime($getDate) > time())
            {
                return redirect('user');
            }
        }
            $this->sendBill($request);
            $this->rent->create(array_merge($request->validated(),[
                "user_id" => Auth::user()->id,
                "movie_link" => Str::random(15)
                ]));
            $this->movie->where('id',$request->movie_id)->increment('popularity',1);
            

            return redirect('user');
    }
    public function sendBill($request)

    {
        $daysRented=$request->days_rented;
        $movie=$this->movie->where('id',$request->movie_id)->first();
        Mail::to(Auth::user()->email)->queue(new RentBill(Auth::user(),$daysRented,$movie));
    }


}
