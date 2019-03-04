<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

use Auth;

class UserController extends Controller
{    
    private $service, $viewData;
    
    public function __construct()
    {
        $this->service = new UserService;
        $this->viewData = ['nav_selection' => 'profile'];
    }
    
    private function assignUser()
    {
        $user_id = (Auth::check()) ? Auth::user()->id : 0 ;
        $user = $this->service->getUser($user_id);
        
        $this->viewData['user_id'] = $user_id;
        $this->viewData['user'] = $user;
    }

    public function editUser()
    {
        $this->assignUser();

        if (!$this->viewData['user']){
            $this->viewData['message'] = 'Nothing to display';
            return view('message', $this->viewData);
        } else {
            return view('my_profile', $this->viewData);
        }
    }
    
    public function updateUser(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postalCode' => 'required',
            'phoneNumber' => 'required|numeric',
        ]);
        
        $this->assignUser();
        
        if($this->service->updateUser($this->viewData['user_id'], $request->all()) !== 1){
            $this->viewData['message'] = 'Failed to update user profile';
        } else {
            $this->viewData['message'] = 'You have succesfully updated your profile';
        }
        
        return view('message', $this->viewData);
    }
}
