<?php

namespace App\Http\Controllers;

use App\Services\FilmService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Auth;

class FilmsController extends Controller
{    
    private $filmService, $orderService;
    
    public function __construct()
    {
        $this->filmService = new FilmService;
        $this->orderService = new OrderService;
    }
    
    public function details(Request $request, $id)
    {     
        $film = $this->filmService->getFilmById($id);
        $user_id = (Auth::check()) ? Auth::user()->id : 0 ;
        $cart = $this->orderService->getCart($user_id);
        
        return view('film_details', [
            'film' => $film,
            'user_id' => $user_id,
            'cart' => $cart
                ]);
    }
}
