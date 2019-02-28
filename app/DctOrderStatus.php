<?php

namespace Movies;

use Illuminate\Database\Eloquent\Model;

class DctOrderStatus extends Model
{
    protected $table = 'dct_order_status';
    protected $fillable = [
        'description'
    ];
    
    public function orders()
    {
        return $this->hasMany('\Movies\Order', 'status');
    }
}
