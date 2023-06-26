<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentLog extends Model
{
    use HasFactory;
    protected $table = 'rent_logs';
    protected $fillable = [
        'movie_id',
        'store_id',
        'user_id',
        'action',
    ];
    public function stores()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }
    public function movies()
    {
        return $this->belongsTo(Movie::class,'movie_id','id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
