<?php

namespace Movies\Http\Controllers;

use Movies\Services\FilmService;
use Movies\Services\OrderService;
use Illuminate\Http\Request;
use Auth;

class IndexController extends Controller
{
    private $orderService, $viewData;
    
    public function __construct()
    {
        $this->orderService = new OrderService;
        $this->viewData = ['nav_selection' => 'home'];
    }
    
    private function assignUserData()
    {
        $user_id = (Auth::check()) ? Auth::user()->id : 0 ;        
        $this->viewData['user_id'] = $user_id;
        $this->viewData['cart'] = $this->orderService->getCart($user_id);
    }
    
    public function index(Request $request)
    {

        $this->assignUserData();
        
        $searchPhrase = $request->input('searchPhrase') ?: '';
        
        if ($searchPhrase) {
            $films = \Movies\Film::where('title', 'like', '%' .$searchPhrase. '%')
                    ->orWhere('description', 'like', '%' .$searchPhrase. '%')
                    ->paginate(FILMS_ON_PAGE);
        } else {
            $films = \Movies\Film::paginate(FILMS_ON_PAGE);
        }
        
        $films->withPath('?searchPhrase=' .$searchPhrase);
        
        $this->viewData['films'] = $films;
        $this->viewData['searchPhrase'] = $searchPhrase;
        
        return view('index', $this->viewData);
    }
}
