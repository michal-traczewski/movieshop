<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    
    protected $table = 'order';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'user_id',
        'created',
        'status',
    ];
    
    public function statuses()
    {
        return $this->belongsTo('\App\DctOrderStatus', 'status');
    }
    
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
    
    public function films()
    {
        return $this->belongsToMany('\App\Film', 'order_film', 'order_id', 'film_id');
    }
}
