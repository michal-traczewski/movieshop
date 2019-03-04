<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderFilm extends Model
{
    protected $table = 'order_film';
    protected $primaryKey = [
        'order_id',
        'film_id',
    ];
    protected $incrementing = false;
}
