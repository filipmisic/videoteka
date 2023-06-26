<?php

namespace App\Http\Controllers\Admin\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMovie;
use App\Http\Requests\UpdateMovie;
use App\Models\Inventory;
use App\Models\Movie;
use App\Models\MovieGenre;
use App\Models\RentLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class MovieController extends Controller
{
    public $model,$genre;
    public function __construct()
    {
        $this->model=new Movie();
    }
    public function mapGenres($genres)
    {
        $zanr=[];
        foreach($genres as $genre)
        {
            $zanr[]=['genre' => $genre];
        }
        return $zanr;
    }
    public function insertGenres($newMovie,$request)
    {
        $newMovie->genres()->createMany($this->mapGenres($request->genre));
    }
    

    public function insert (CreateMovie $request)
    {
        $request->file('movie')->storeAs(
            'public/movies', $request->title.'.'.$request->file('movie')->getClientOriginalExtension()
        );
        
        $newMovie=$this->model->create(array_merge($request->except('genre'),
        ['path'=>'/storage/movies/'.$request->title.".".$request->file('movie')->getClientOriginalExtension()
        ]));
        
        $this->insertGenres($newMovie,$request);
        return redirect('/admin/movie');
    }
    public function getMovie($movieId)
    {
        return $this->model->where('id', $movieId)->with('genres')->first();

    }
    public function index()
    {
        $getMovie=$this->model->with('genres')->paginate(10);
        return view('pages.admin.movie.index',['movies'=> $getMovie]);
    }

    public function edit($movieId)
    {
        return view('pages.admin.movie.edit', ['movie' => $this->getMovie($movieId), 'genres' => $this->model->where('id', $movieId)->first()->genres()->pluck('genre')->toArray()]);
    }

   public function update(UpdateMovie $request)
    {
        $params = $request->validated();
        if(!$newMovie=$this->getMovie($request->movieId)) return redirect('/admin/movie/');

        $this->model->where('id', $request->movieId)->update([
            'title' => $params['title'],
            'year' => $params['year'],
            'director' => $params['director'],
            'barcode'=>$params['barcode'],
        ]);
        MovieGenre::query()->where('movie_id',$request->movieId)->delete();
        $this->insertGenres($newMovie,$request);
        return redirect('/admin/movie/');
    }
    public function inventory ($movieId)
    {
        $inventory=Inventory::query()->where('movie_id',$movieId)->with("stores")->with("movies")->paginate(10);
        return view('pages.admin.movie.inventory', ["inventories"=>$inventory]);
    }
    public function delete($movieId)
    {
        
        $movie=$this->getMovie($movieId);
        $path=substr($movie->path, 8);
        Storage::delete('public'.$path);
        $movie->delete();
        return redirect('/admin/movie/');
    }

}
