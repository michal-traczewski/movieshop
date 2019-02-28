<?php

namespace Movies;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'user_id',
        'created',
        'status',
    ];
    
    public function statuses()
    {
        return $this->belongsTo('\Movies\DctOrderStatus', 'status');
    }
    
    public function user()
    {
        return $this->belongsTo('\Movies\User');
    }
    
    public function films()
    {
        return $this->belongsToMany('\Movies\Film', 'order_film', 'order_id', 'film_id');
    }
}
