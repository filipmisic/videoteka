<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOnlineRent;
use App\Models\Movie;
use App\Models\OnlineRent;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class FrontendMovieController extends Controller
{
    public $movie,$rent;
    public function __construct()
    {
        $this->movie=new Movie();
        $this->rent=new OnlineRent();
        $this->review=new Review();
    }
    public function index(Request $search)
    {
        $getMovie=$this->movie->where('title','LIKE','%'.$search->serchTitle.'%')->with('genres')->paginate(10);
        return view('pages.main.index',['movies'=> $getMovie],['search'=>$search]);

    }

    public function getSingle($movieId)
    {
        return $this->movie->where('id',$movieId)->with('genres')->first();
    }

    public function single($movieId)
    {
        $getSingle=$this->getSingle($movieId);
        $getRewive=$this->review->where('movie_id',$movieId)->with('users')->paginate(5);
        $average =$this->review->where('movie_id',$movieId)->avg('score');
        return view('pages.main.movie_single',['movie'=>$getSingle ,'reviews'=>$getRewive ,'average'=>$average]);
    }
    public function rent($movieId)
    {
        $getSingle=$this->getSingle($movieId);
        if($getSingle) return view('pages.main.rent',['movie'=>$getSingle]);
        return redirect('/');
    }
    public function payment(Request $request)
    {
        $getSingle=$this->getSingle($request->movie_id);
        if($getSingle) return view('pages.main.payment',['data'=>$request]);
        return redirect('/');
    }
    public function blocked()
    {
        return view('pages.main.blocked');
    }

}
