<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventories';
    protected $fillable = [
        'movie_id',
        'store_id',
        'amount',
    ];
    public function stores()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }
    public function movies()
    {
        return $this->belongsTo(Movie::class,'movie_id','id');
    }

}
