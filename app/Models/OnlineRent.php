<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineRent extends Model
{
    use HasFactory;
    protected $table = 'online_rents';
    protected $fillable = [
        'movie_id',
        'user_id',
        'borrowed',
        'days_rented',
        'movie_link',
    ];
    public function movies()
    {
        return $this->belongsTo(Movie::class,'movie_id','id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
