<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DctOrderStatus extends Model
{
    protected $table = 'dct_order_status';
    protected $fillable = [
        'description'
    ];
    
    public function orders()
    {
        return $this->hasMany('\App\Order', 'status');
    }
}
