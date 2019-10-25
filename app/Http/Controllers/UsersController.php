<?php

namespace App\Http\Controllers;


use App\User;

class UsersController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAllUsers()
    {
        $user = User::all();
        return response()->json($user);
    }
}
