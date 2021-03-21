<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;


class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /**
         * проверка токена на существование каким либо исключением
         */

        try{
            $user = JWTAuth::parseToken()->authenticate();
        }catch(Exception $e){
            if ($e instanceof TokenInvalidException) {
                return response()->json(['error'=>true, 'message'=>'Token is Invalid']);
            }elseif ($e instanceof TokenExpiredException){
                return response()->json(['error'=>true, 'message'=>'Token is Expired']);
            }else {
                return response()->json(['error'=>true, 'message'=>'Token not found']);
            }


        }

        return $next($request);
    }
}
