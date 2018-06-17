<?php

namespace Movies\Http\Controllers;

use Movies\Services\FilmService;
use Movies\Services\OrderService;
use Auth;

class IndexController extends Controller
{
    private $filmService, $orderService, $viewData;
    
    public function __construct()
    {
        $this->filmService = new FilmService;
        $this->orderService = new OrderService;
        $this->viewData = ['nav_selection' => 'home'];
    }
    
    private function assignUserData()
    {
        $user_id = (Auth::check()) ? Auth::user()->id : 0 ;        
        $filter = $this->filmService->setFilmsListParams($_GET);
        $films = $this->filmService->getFilteredList($filter);
        $cart = $this->orderService->getCart($user_id);
        
        $this->viewData['user_id'] = $user_id;
        $this->viewData['filter'] = $filter;
        $this->viewData['films'] = $films;
        $this->viewData['cart'] = $cart;
    }
    
    public function index()
    {
        $this->assignUserData();
        
        return view('index', $this->viewData);
    }
}
