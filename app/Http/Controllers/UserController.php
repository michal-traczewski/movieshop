<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class UserController extends Controller
{    
    private $service, $viewData;
    
    public function __construct()
    {
        $this->viewData = ['nav_selection' => 'profile'];
    }
    
    private function assignUser()
    {
        $user_id = (Auth::check()) ? Auth::user()->id : 0 ;
        $user = \App\User::find($user_id);
        
        $this->viewData['user_id'] = $user_id;
        $this->viewData['user'] = $user;
        
        return $user_id;
    }

    public function editUser()
    {
        $this->assignUser();

        if (!$this->viewData['user']){
            return view('message', 'Nothing to display');
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
        
        $user_id = $this->assignUser();
        
        $user = \App\User::find($user_id);
        $user->first_name = $request->firstName;
        $user->name = $request->lastName;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->postal_code = $request->postalCode;
        $user->phone = $request->phoneNumber;
        $user->save();
        
        $this->viewData['message'] = 
                'You have succesfully updated your profile';
        
        return view('message', $this->viewData);
    }
}
