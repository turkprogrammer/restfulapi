<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class LoginController extends Controller
{
    public function login(Request $request){

        $creds = $request->only(['email', 'password']);
        if (! $token = auth()->attempt($creds)) {
            return response()->json(['error' => 'true', 'message'=>'Incorrect login/Password'], 401);
        }
            return response()->json(['token'=>$token]);

    }
    /**
     * Refresh a token, which invalidates the current one
     * Pass true as the first param to force the token to be blacklisted "forever"
     * The second parameter will reset the claims for the new token
     */
    public function refresh(){
        try{
            $token = auth()->refresh();
        } catch (TokenInvalidException $e){
            return response()->json(['error'=>true, 'message'=>$e->getMessage()], 401);
        }
        return response()->json(['token'=>$token]);
    }
}
