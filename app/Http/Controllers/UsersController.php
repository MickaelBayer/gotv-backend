<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getAllUsers()
    {
        $user = User::with('usr_role', 'usr_votes')->get();
        return $user;
    }

    public function getUserById(int $id)
    {
        $user = User::with('usr_role', 'usr_votes')->find($id);
        return $user;
    }

    public function postUser(Request $request)
    {
        // validation des champs
        try {
            $this->validate($request, [
                'usr_pseudo' => 'required',
                'usr_email' => 'required',
                'password' => 'required',
                'usr_firstname' => 'required',
                'usr_lastname' => 'required',
                'usr_roe_id' => 'required|integer',
                'usr_sun_id' => 'required|integer'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => '3000'], 500);
        }

        $user = new User();
        $user->usr_email = strtolower($request->usr_email);
        $user->usr_pseudo = strtolower($request->usr_pseudo);
        $user->password = password_hash($request->password, PASSWORD_BCRYPT);
        $user->usr_firstname = $request->usr_firstname;
        $user->usr_lastname = $request->usr_lastname;
        $user->usr_roe_id = $request->usr_roe_id;
        $user->usr_sun_id = $request->usr_sun_id;
        $user->usr_activ = $request->usr_activ;
        $user->save();
        return $user;
    }

    public function putUserById(Request $request, int $id)
    {
        $user = User::find($id);
        $user->usr_lastname = $request->usr_lastname;
        $user->usr_firstname = $request->usr_firstname;
        $user->usr_phone = $request->usr_phone;
        $user->usr_city = $request->usr_city;
        $user->usr_country = $request->usr_country;
        $user->usr_postal_code = $request->usr_postal_code;
        $user->usr_address = $request->usr_address;
        
        $user->save();
        return $user;
    }

    public function deleteUserById(int $id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['message' => 'Deleted !']);
    }
}
