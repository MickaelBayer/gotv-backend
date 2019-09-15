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
}
