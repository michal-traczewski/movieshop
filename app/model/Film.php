<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{    
    protected $table = 'film';
    protected $primaryKey = 'film_id';
    protected $fillable = [
        'title',
        'description',
        'release_year',
        'language_id',
        'original_language_id',
        'rental_duration',
        'rental_rate',
        'price',
        'length',
        'replacement_cost',
        'rating',
        'special_features',
        'last_update',
    ];
    
    public function baskets()
    {
        return $this->belongsToMany(
                'App\Basket',
                'basket_film',
                'film_id', 'basket_id'
                );
    }
    
    public function orders()
    {
        return $this->belongsToMany(
                '\App\Order',
                'order_film',
                'film_id',
                'order_id'
                );
    }
    
    public function language()
    {
        return $this->belongsTo(
                '\App\Language',
                'language_id',
                'language_id'
                );
    }
    
    public function original_language()
    {
        return $this->belongsTo(
                '\App\Language',
                'original_language_id',
                'language_id'
                );
    }
}
