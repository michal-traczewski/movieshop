<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class FilmsController extends Controller
{    
    private $viewData;
    private $orderService;
    
    public function __construct()
    {
        // TODO
    }
    
    private function assignUserData()
    {
        $user_id = (Auth::check()) ? Auth::user()->id : 0 ;     
        $basket = \App\Basket::where('user_id', '=', $user_id)->first();
        $filmsInBasket = [];
        
        if ($basket) {
            foreach($basket->films as $film) {
                $filmsInBasket [] = $film->film_id;
            }    
        }
        
        $this->viewData['films_in_basket'] = $filmsInBasket;
        $this->viewData['user_id'] = $user_id;
    }
    
    public function details(Request $request, $id)
    {     
        $this->assignUserData();
        
        $this->viewData['film'] = \App\Film::find($id);
        
        return view('film_details', $this->viewData);
    }
}
