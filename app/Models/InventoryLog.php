<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    use HasFactory;
    protected $table = 'inventory_logs';
    protected $fillable = [
        'movie_id',
        'store_id',
        'worker_id',
        'amount',
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
    public function workers()
    {
        return $this->belongsTo(Worker::class,'worker_id','id');
    }

}
