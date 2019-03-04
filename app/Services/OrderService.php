<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class OrderService
{
    public function getUserOrders($user_id)
    {
        return DB::table('VOrders')
                ->where('user_id', '=', $user_id)
                ->get();
    }
    
    public function getOrderDetails($user_id, $order_id)
    {
        return DB::table('VOrderFilms')
                ->where('order_id', '=', $order_id)
                ->where('user_id', '=', $user_id)
                ->select('title', 'description', 'price', 'order_id')
                ->get();
    }
    
    public function getCart($user_id)
    {
        return DB::table('VBasket')
                ->where('user_id', '=', $user_id)
                ->get();
    }
}