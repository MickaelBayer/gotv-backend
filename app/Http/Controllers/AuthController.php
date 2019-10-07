<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use ReallySimpleJWT\Token;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\UsersController;

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
        //echo(strtolower($request->input('usr_pseudo')));

        $isActiv = User::where('usr_pseudo', strtolower($request->input('usr_pseudo')))->first();
        if($isActiv->getIsActiv() == 0 )
        {
            return response()->json([
                "error" => "2000"
            ]);
        }

        if (!$token = $this->jwt->attempt($credentials)) {
            return response()->json(['error' => 'Bad credentials'], 400);
        }

        return response()->json([
            "token" => $token,
            "message" => "token_generated"
        ]);
    }

    /**
     * Fonction permettant à l'utilisateur de se déconnecter
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            $this->jwt->parseToken()->invalidate();
            return response()->json(['message' => 'Successfully logout']);
        } catch (JWTException $e) {
            return response()->json(['message' => $e]);
        }
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
        echo(sizeof($isEmail) == 0);
        if(sizeof($isEmail) != 0){
            return response()->json(['error' => '3001'], 500);
        }

        // vérification de la présence du pseudo dans la base de donnée
        $isPseudo = User::where('usr_pseudo', strtolower($request->input('usr_pseudo')))->get();
        echo(sizeof($isPseudo) == 0);
        if(sizeof($isPseudo) != 0){
            return response()->json(['error' => '3002'], 500);
        }
        try {
            $this->validate($request, [
                'usr_pseudo' => 'required',
                'usr_email' => 'required',
                'password' => 'required',
                'usr_firstname' => 'required',
                'usr_lastname' => 'required'
            ]);
        } catch (ValidationException $e) {
            return response()-> json(['error' => '3000'], 500);
        }

        $data = [
            'usr_pseudo' => strtolower($request->input('usr_pseudo')),
            'usr_email' => strtolower($request->input('usr_email')),
            'password' => password_hash($request->input('password'), PASSWORD_BCRYPT),
            'usr_firstname' => $request->input('usr_firstname'),
            'usr_lastname' => $request->input('usr_lastname')
        ];

        $user = User::create($data);
        $userId = $user->id;
        $secret = getenv('JWT_SECRET');
        $expiration = time() + 3600;
        $issuer = 'localhost';

        $token = Token::create($userId, $secret, $expiration, $issuer);
        $message = "Successfully registered !";

        return response()->json(compact('user', 'token', 'message'), 201);
    }
}
