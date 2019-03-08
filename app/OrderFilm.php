<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderFilm extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    
    protected $table = 'order_film';
    protected $primaryKey = [
        'order_id',
        'film_id',
    ];
}
