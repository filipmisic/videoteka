<?php

namespace App\Http\Controllers\User\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserReview;
use App\Models\Movie;
use App\Models\OnlineRent;
use App\Models\Review;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserReviewController extends Controller
{
    public $review;
    public function __construct()
    {
        $this->review=new Review();
    }
    public function CheckRent($movieId)
    {
        return OnlineRent::query()->where('user_id',Auth::user()->id)->where('movie_id',$movieId)->first();
    }

    public function write($movieId)
    {
        if($movie=$this->CheckRent($movieId))
        {
            if(Review::query()->where('user_id',Auth::user()->id)->where('movie_id',$movieId)->first()) return redirect('/user/review/edit/'.$movieId);
            return view('pages.user.reviews.create',['movie' => $movie]);
        }
        return redirect('/');
    }
    public function insert(CreateUserReview $request)
    {

        if(!$this->CheckRent($request->movie_id)) return redirect('user');
        if($osvrt = $this->review->where('movie_id',$request->movie_id)->where('user_id',Auth::user()->id)->first()) return redirect("/user/review/edit/".$osvrt->movie_id);
        
        $this->review->create(array_merge($request->validated(),[
            "user_id" => Auth::user()->id
            ]));
        
        return redirect('user/review');
    }
    public function index()
    {
        $reviews=$this->review->where('user_id',Auth::user()->id)->with('movies')->paginate(5);
        return view('pages.user.reviews.index',['reviews'=>$reviews]);
    }
    public function edit($movieId)
    {
        $rev=$this->review->where('movie_id',$movieId)->where('user_id',Auth::user()->id)->first();
        return view('pages.user.reviews.edit',['review'=>$rev]);
    }
    public function update(CreateUserReview $request)
    {
        $params=$request->validated();
        if(!$this->review->where('movie_id',$request->movie_id)->where('user_id',Auth::user()->id)->first()) return redirect('user');
        $this->review->where('movie_id',$request->movie_id)->where('user_id',Auth::user()->id)->update([
            'title' => $params['title'],
            'body' => $params['body'],
            'score' => $params['score'],
        ]);

        return redirect('/user/review');
    }
    public function delete($reviewId)
    {
        
        $osvrt=$this->review->where('id',$reviewId)->where('user_id',Auth::user()->id)->first();
        $osvrt->delete();
        return redirect('/user/review/');
    }
}
