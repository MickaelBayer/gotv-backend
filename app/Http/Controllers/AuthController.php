<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Utils\JwtUtils;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * Fonction permettant l'authentification de l'utilisateur
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $user = User::where('usr_pseudo', strtolower($request->input('usr_pseudo')))->first();

        if ($user->getIsActiv() == 0) {
            return response()->json([
                "error" => "2000"
            ]);
        }

        if (password_verify($request->input('password'), $user->password)) {
            $expire = time() + 3600;

            $token = JwtUtils::CreateToken($user, $expire);

            if ($token) {
                return $this->respondWithToken($token, $expire, $user);
            }
        }

        return response()->json([
            "status" => 401,
            'error' => 'invalid_credentials'
        ], 401);
    }

    /**
     * Fonction permettant la création d'un utilisateur
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // vérification de la présence de l'email dans la base de donnée
        $isEmail = User::where('usr_email', strtolower($request->input('usr_email')))->get();
        if (sizeof($isEmail) != 0) {
            return response()->json(['error' => '3001'], 500);
        }

        // vérification de la présence du pseudo dans la base de donnée
        $isPseudo = User::where('usr_pseudo', strtolower($request->input('usr_pseudo')))->get();
        if (sizeof($isPseudo) != 0) {
            return response()->json(['error' => '3002'], 500);
        }

        // validation des champs
        try {
            $this->validate($request, [
                'usr_pseudo' => 'required',
                'usr_email' => 'required',
                'password' => 'required',
                'usr_firstname' => 'required',
                'usr_lastname' => 'required'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => '3000'], 500);
        }

        $data = [
            'usr_pseudo' => strtolower($request->input('usr_pseudo')),
            'usr_email' => strtolower($request->input('usr_email')),
            'password' => password_hash($request->input('password'), PASSWORD_BCRYPT),
            'usr_firstname' => $request->input('usr_firstname'),
            'usr_lastname' => $request->input('usr_lastname')
        ];
        $role = Role::find(3);
        $user = User::create($data);
        $user->role()->associate($role);
        $user->save();
        $expire = time() + 3600;

        $token = JwtUtils::CreateToken($user, $expire);

        return $this->respondWithToken($token, $expire, $user);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }
}
