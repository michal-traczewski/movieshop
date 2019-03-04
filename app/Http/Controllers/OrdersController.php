<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class OrdersController extends Controller
{    
    private $service, $pdo, $viewData;

    public function __construct()
    {
        $this->service = new OrderService;
        $this->pdo = DB::connection()->getPdo();
        $this->viewData = [];
    }
    
    private function assignUserOrders($order_id = 0)
    {
        $user_id = (Auth::check()) ? Auth::user()->id : 0 ;
        $orders = $this->service->getUserOrders($user_id);
        
        if ($order_id){
            $order_details = $this->service->getOrderDetails($user_id, $order_id);
        } else {
           $order_details = [];
        }
        
        $this->viewData['user_id'] = $user_id;
        $this->viewData['orders'] = $orders;
        $this->viewData['order_details'] = $order_details;
        $this->viewData['nav_selection'] = 'myorders';
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
        $this->assignUserOrders();
        
        $result = $this->pdo->query("CALL procCancelOrder(" .$this->viewData['user_id']. ", " .$order_id. ")");
        $procResult = $result->fetch();
        
        if ($procResult['returnValue']){
            $message = 'You have succesfully cancelled your order.';
        } else {
            $message = 'Failed to cancel order.';
        }
        
        $this->viewData['message'] = $message;
        $this->viewData['nav_selection'] = 'myorders';
        
        return view('message', $this->viewData);
    }
    
    public function showCart()
    {
        $this->assignUserOrders();
        $cart = $this->service->getCart($this->viewData['user_id']);
        
        $this->viewData['nav_selection'] = 'cart';
        $this->viewData['cart'] = $cart;
        
        return view('my_cart', $this->viewData);
    }
    
    public function addToCart(Request $request, $film_id)
    {
        $this->assignUserOrders();
        $result = $this->pdo->query("CALL procAddToBasket(" .$this->viewData['user_id']. "," .$film_id. ")");
        $procResult = $result->fetch();
        
        if ($procResult['returnValue']){
            $message = 'You have succesfully added item to your basket.';
        } else {
            $message = 'Failed to add item to your basket.';
        }
        
        $this->viewData['message'] = $message;
        $this->viewData['nav_selection'] = 'cart';
        
        return view('message', $this->viewData);
    }
    
    public function clearCart()
    {
        $this->assignUserOrders();
        $result = $this->pdo->query("CALL procClearBasket(" .$this->viewData['user_id']. ")");
        $procResult = $result->fetch();
        
         if ($procResult['returnValue']){
            $message = 'You have succesfully removed all items from basket.';
        } else {
            $message = 'Failed to clear basket.';
        }
        
        $this->viewData['message'] = $message;
        $this->viewData['nav_selection'] = 'cart';
        
        return view('message', $this->viewData);
    }
    
    public function checkout()
    {
        $this->assignUserOrders();
        $result = $this->pdo->query("CALL procAddOrder(" .$this->viewData['user_id']. ")");
        $procResult = $result->fetch();
        
         if ($procResult['returnValue']){
            $message = 'You have succesfully placed an order.';
        } else {
            $message = 'Failed to place order.';
        }
        
        $this->viewData['message'] = $message;
        $this->viewData['nav_selection'] = 'cart';
        
        return view('message', $this->viewData);
    }
    
}
