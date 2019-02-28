<?php

namespace Movies;

use Illuminate\Database\Eloquent\Model;

class BasketFilm extends Model
{
    protected $primaryKey = [
        'film_id',
        'basket_id',
    ];
    protected $incrementing = false;
    protected $table = 'basket_film';
}
