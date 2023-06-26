<?php

namespace App\Http\Controllers\termilan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRent;
use App\Models\Inventory;
use App\Models\Movie;
use App\Models\Rent;
use App\Models\RentLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CashRegisterController extends Controller
{
    protected $inventory,$movie,$rent,$rentlog;
    public function __construct()
    {
        $this->inventory=new Inventory();
        $this->movie=new Movie();
        $this->rent=new Rent();
        $this->rentlog=new RentLog();
    }
    
public function getrent($barcode,$user_id,$return)
{
    $price=14;
    $movies=$this->movie->where('barcode',$barcode)->first();
    if(!$movies)return response()->json(["message"=>"Nepostoji"],400);          
    if($return =="true")
    {
        $checkrent=$this->rent->where('user_id',$user_id)->where('movie_id',$movies->id)->where('store_id',Auth::guard('worker')->user()->store_id)->with('movies')->first();
        if(!$checkrent) return response()->json(["message"=>"Nepostoji"],400);
        $price=0;
        if(strtotime($checkrent->created_at->addDays(7)) < time())
        {
            $diff = time() - strtotime($checkrent->created_at->addDays(7));
            $days = abs(round($diff / 86400));
            $price=2*$days;
        }
    }
    else
    {
        if($this->rent->where('user_id',$user_id)->where('movie_id',$movies->id)->first())return response()->json(["message"=>"Korisnik je vec posudio taj film"],400);
    }
    $movies->price=$price;
    return response()->json($movies);
    
}

public function index()
{
    $users=User::query()->where('admin',0)->get();
    $movies=$this->movie->get();
    $rent=$this->rent->where('store_id',Auth::guard('worker')->user()->store_id)->get();
    return view('pages.terminal.cashregister',['users'=>$users ,'movies'=>$movies,'rents'=>$rent]);
}

public function create(StoreRent $request)
 {
    foreach($request->movies as $movie)
    {
        if($movie["returnal"])
        {
            $this->rent->where('store_id', Auth::guard('worker')->user()->store_id)->where('movie_id',$movie["id"])->where('user_id',$movie["user_id"])->first()->delete();
            $this->inventory->where('store_id', Auth::guard('worker')->user()->store_id)->where('movie_id',$movie["id"])->increment('rented',-1);
            
        }
        else
        {
            $this->rent->create([
                'store_id' => Auth::guard('worker')->user()->store_id,
                'movie_id' => $movie["id"],
                'user_id'=> $movie["user_id"],  
            ]);
            $this->inventory->where('store_id', Auth::guard('worker')->user()->store_id)->where('movie_id',$movie["id"])->increment('rented',1);
            Movie::query()->where('id',$movie["id"])->increment("popularity",1);
        }
        $this->rentlog->create([
            'store_id' => Auth::guard('worker')->user()->store_id,
            'movie_id' => $movie["id"],
            'user_id'=> $movie["user_id"],
            'action'=> ($movie["returnal"])?'povrat':"posudba",
        ]);
    }
        $rents=$this->rent->where('user_id',$request->movies[0]["user_id"])->get();
        User::query()->where('id',$request->movies[0]["user_id"])->update([
            "blocked"=>0,
            ]);
        foreach($rents as $rent)
        {
            if(strtotime($rent->created_at->addDays(30)) < time())
            {
                User::query()->where('id',$rent->user_id)->update([
                    "blocked"=>1,
                ]);
            }
        }
 } 
}
