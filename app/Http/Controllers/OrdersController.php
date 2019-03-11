<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class OrdersController extends Controller
{    
    private $service, $pdo, $viewData;

    public function __construct()
    {
        $this->pdo = DB::connection()->getPdo();
        $this->viewData = [];
    }
    
    private function assignUserOrders($order_id = 0)
    {
        $user_id = (Auth::check()) ? Auth::user()->id : 0 ;
        $orders = \App\Order::where('user_id', '=', $user_id)
                ->orderBy('order_id', 'desc')
                ->get();
        
        if ($order_id){
            $order_details = \App\Order::find($order_id);
        } else {
           $order_details = [];
        }
        
        $this->viewData['user_id'] = $user_id;
        $this->viewData['orders'] = $orders;
        $this->viewData['order_details'] = $order_details;
        
        return $user_id;
    }

    public function show()
    {
        $this->assignUserOrders();
        $this->viewData['nav_selection'] = 'myorders';
        
        return view('my_orders', $this->viewData);
    }
    
    public function showDetails(Request $request, $order_id)
    {
        $this->assignUserOrders($order_id);
        $this->viewData['current_order'] = $order_id;
        $this->viewData['nav_selection'] = 'myorders';
                
        return view('my_orders', $this->viewData);
    }
    
    public function cancel(Request $request, $order_id)
    {
        $order = \App\Order::find($order_id);
        $order->status = 3;
        $order->save();
        
        $message = 'You have succesfully cancelled your order.';

        $this->viewData['message'] = $message;
        $this->viewData['nav_selection'] = 'myorders';
        
        return view('message', $this->viewData);
    }
    
    public function showCart()
    {
        $user_id = $this->assignUserOrders();
        $cart = \App\Basket::where('user_id', '=', $user_id)
                ->first();
        
        $this->viewData['films'] = $cart ? $cart->films : [] ;
        $this->viewData['nav_selection'] = 'cart';
        
        return view('my_cart', $this->viewData);
    }
    
    public function addToCart(Request $request, $film_id)
    {
        $this->assignUserOrders();
        
        $basket = \App\Basket::where(
                'user_id', '=', $this->viewData['user_id'])
                ->first();
        
        if (!$basket) {
            $new_basket = new \App\Basket;
            $new_basket->user_id = $this->viewData['user_id'];
            $new_basket->save();
            
            $basket = \App\Basket::where(
                'user_id', '=', $this->viewData['user_id'])
                ->first();
        }
        
        $message = '';
        
        try {
            $basket_film = new \App\BasketFilm;
            $basket_film->film_id = $film_id;
            $basket_film->basket_id = $basket->basket_id;
            $basket_film->save();
        } catch (Exception $ex) {
            $message = 'Failed to add item to your basket.';
        }
        
        if (!$message) {
            $message = 'You have succesfully added item to your basket.';
        }
        
        $this->viewData['message'] = $message;
        $this->viewData['nav_selection'] = 'cart';
        
        return view('message', $this->viewData);
    }
    
    public function clearCart()
    {
        $this->assignUserOrders();
        
        DB::transaction(function () {
            $basket = \App\Basket::where(
                'user_id', '=', $this->viewData['user_id'])
                ->first();
            
            \App\BasketFilm::where('basket_id', '=', $basket->basket_id)
                    ->delete();
            
            \App\Basket::where('basket_id', '=', $basket->basket_id)
                    ->delete();
        });
        
        $message = 'You have succesfully removed all items from basket.';
        
        $this->viewData['message'] = $message;
        $this->viewData['nav_selection'] = 'cart';
        
        return view('message', $this->viewData);
    }
    
    public function checkout()
    {
        $this->assignUserOrders();
        
        DB::transaction(function () {
            $user_id = $this->viewData['user_id'];
            
            $newOrder = new \App\Order;
            $newOrder->user_id = $user_id;
            $newOrder->status = 1;
            $newOrder->save();

            $order_id = $newOrder->order_id;

            $basket = \App\Basket::where('user_id', $user_id)->first();
            $basket_id = $basket->basket_id;

            $myFilms = $basket->films;
            foreach ($myFilms as $film) {
                $newRow = new \App\OrderFilm;
                $newRow->order_id = $order_id;
                $newRow->film_id = $film->film_id;
                $newRow->save();
            }

            \App\BasketFilm::where('basket_id', $basket_id)
                    ->delete();

            \App\Basket::where('basket_id', $basket_id)
                    ->delete();
        });
        
        $message = 'You have succesfully placed an order.';
        
        $this->viewData['message'] = $message;
        $this->viewData['nav_selection'] = 'cart';
        
        return view('message', $this->viewData);
    }
    
}
