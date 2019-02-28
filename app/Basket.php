<?php

namespace Movies;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $primaryKey = 'basket_id';
    protected $table = 'basket';
    
    protected $fillable = [
        'user_id',
        'created',
    ];
    
    public function films()
    {
        return $this->belongsToMany('Movies\Film', 'basket_film', 'basket_id', 'film_id');
    }
}
