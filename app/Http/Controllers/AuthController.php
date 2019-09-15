<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use ReallySimpleJWT\Token;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    protected $jwt;

    /**
     * AuthController constructor.
     * @param JWTAuth $jwt
     */
    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * Fonction permettant l'authentification de l'utilisateur
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('usr_pseudo', 'password');

        if (! $token = $this->jwt->attempt($credentials)) {
            return response()->json(['error' => 'Bad credentials'], 400);
        }

        return response()->json([
            "token" => $token,
            "message" => "token_generated"
        ]);
    }

//    /**
//     * @param Request $request
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function register(Request $request)
//    {
//        try {
//            $this->validate($request, [
//                'pseudo' => 'required',
//                'email' => 'required',
//                'password' => 'required',
//                'firstname' => 'required',
//                'lastname' => 'required'
//            ]);
//        } catch (ValidationException $e) {
//            return $this->errorHttp($e);
//        }
//
//        $data = [
//            'pseudo' => $request->input('pseudo'),
//            'email' => $request->input('email'),
//            'password' => password_hash($request->input('password'), PASSWORD_BCRYPT),
//            'firstname' => $request->input('firstname'),
//            'lastname' => $request->input('lastname')
//        ];
//
//        $user = User::create($data);
//
//        $userId = $user->id;
//        $secret = getenv('JWT_SECRET');
//        $expiration = time() + 3600;
//        $issuer = 'localhost';
//
//        $token = Token::create($userId, $secret, $expiration, $issuer);
//        $message = "Successfully registered !";
//
//        return response()->json(compact('user','token', 'message'),201);
//    }
//
//    /**
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function logout()
//    {
//        try {
//            $this->jwt->parseToken()->invalidate();
//            return response()->json(['message' => 'Successfully logout']);
//        } catch (JWTException $e) {
//            return response()->json(['message' => $e]);
//        }
//    }
}
