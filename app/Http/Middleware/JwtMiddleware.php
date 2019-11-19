<?php


namespace App\Http\Middleware;

use App\Utils\JwtUtils;
use Closure;
use Illuminate\Http\Request;

class JwtMiddleware
{
    /**
     * Vérifie si le token en param est
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next, $rank = 0)
    {
        $token = $request->header('authorization');
        if ($token) {
            if (JwtUtils::VerifyToken($token)) {
                $request->request->add(['decoded' => json_decode(JwtUtils::GetJWS($token)->getPayload(), true)]);
                if ($request->decoded['rank'] != null) {
                    if ($rank != 0) {
                        if ($request->decoded['rank'] != 1) {
                            if ($request->decoded['rank'] != $rank) {
                                return response()->json([
                                    'message' => "invalid_rank"
                                ]);
                            }
                            return $next($request);
                        }
                        return $next($request);
                    }
                    return $next($request);
                }
                return response()->json([
                    'message' => "no_rank_provided"
                ]);
            }
            return response()->json([
                'message' => "invalid_token"
            ]);
        }
        return response()->json([
            'message' => "no_token_provided"
        ]);
    }
}
