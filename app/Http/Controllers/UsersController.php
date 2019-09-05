<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController
{
    public function getAllUsers(){
        $user = User::all();
        return response()->json($user);
    }
}
