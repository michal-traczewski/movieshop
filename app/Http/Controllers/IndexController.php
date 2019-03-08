<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class IndexController extends Controller
{
    private $viewData;
    
    public function __construct()
    {
        $this->viewData = ['nav_selection' => 'home'];
    }
    
    private function assignUserData()
    {
        $user_id = (Auth::check()) ? Auth::user()->id : 0;
        $basket = \App\Basket::where('user_id', '=', $user_id)->first();
        $filmsInBasket = [];
        
        if ($basket) {
            foreach($basket->films as $film) {
                $filmsInBasket [] = $film->film_id;
            }    
        }
        
        $this->viewData['user_id'] = $user_id;
        $this->viewData['films_in_basket'] = $filmsInBasket;
    }
    
    public function index(Request $request)
    {

        $this->assignUserData();
        
        $searchPhrase = $request->input('searchPhrase') ?: '';
        
        if ($searchPhrase) {
            $films = \App\Film::where('title', 'like', '%' .$searchPhrase. '%')
                    ->orWhere('description', 'like', '%' .$searchPhrase. '%')
                    ->paginate(FILMS_ON_PAGE);
        } else {
            $films = \App\Film::paginate(FILMS_ON_PAGE);
        }
        
        $films->withPath('?searchPhrase=' .$searchPhrase);
        
        $this->viewData['films'] = $films;
        $this->viewData['searchPhrase'] = $searchPhrase;
        
        return view('index', $this->viewData);
    }
}
