<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Worker extends Authenticatable
{
    use HasFactory;

    protected $table = 'workers';
    protected $fillable = [
        'number',
        'password',
        'name',
        'surname',
        'store_id',
        'status'
    ];
    public function stores()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }
}
