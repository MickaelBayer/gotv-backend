<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\JWTAuth;

class TmdbController extends Controller
{
    public function testTmdb()
    {
        $token = new \Tmdb\ApiToken('cf4fe60a904bbb135ef155c21e68d143');
        $client = new \Tmdb\Client($token);


        $movie = $client->getTvApi()->getPopular();
        print_r($movie);
    }
}
