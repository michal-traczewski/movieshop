<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class UserService
{
    public function getUser($id)
    {
        $users = DB::table('users')
                ->where('id', '=', $id)
                ->get();
        
        foreach ($users as $user){
            return $user;
        }
        
        return 0;
    }
    
    public function updateUser($id, $data)
    {
        return DB::table('users')
                ->where('id', '=', $id)
                ->update([
                    'first_name'    => $data['firstName'],
                    'name'          => $data['lastName'],
                    'address'       => $data['address'],
                    'city'          => $data['city'],
                    'postal_code'   => $data['postalCode'],
                    'phone'         => $data['phoneNumber']
                ]);
    }
}