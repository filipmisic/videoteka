<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';
    protected $fillable = [
        'title',
        'year',
        'director',
        'popularity',
        'path',
        'barcode',
    ];

    public function genres()
    {
        return $this->hasMany('App\Models\MovieGenre','movie_id');
    }


}
