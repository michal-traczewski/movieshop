<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    public $timestamps = false;
    
    protected $primaryKey = 'basket_id';
    protected $table = 'basket';
    
    protected $fillable = [
        'user_id',
        'created',
    ];
    
    public function films()
    {
        return $this->belongsToMany('App\Film', 'basket_film', 'basket_id', 'film_id');
    }
}
