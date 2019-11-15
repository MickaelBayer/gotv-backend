<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function errorHttp($err)
    {
        return response()->json([
            'error', 'message' => $err
        ], 404);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get response from http request on Json format.
     *
     * @param  string $url
     *
     * @return mixed
     */
    protected function getResJsonFormat(string $url)
    {
        $res = file_get_contents($url);
        return json_decode($res, true);
    }
}
