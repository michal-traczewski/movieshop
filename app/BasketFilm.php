<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasketFilm extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    
    protected $primaryKey = [
        'film_id',
        'basket_id',
    ];
    protected $table = 'basket_film';
}
