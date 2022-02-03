<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($loginData)) { //try login
            return response(['message' => 'Invalid Credentials']);
        }

        $user = User::find(auth()->user()->id);

        $token = $request->user()->createToken('authToken')->plainTextToken;
        // $token = $request->user()->createToken('authToken')->accessToken->tokenable_id;

        return response([
            'status' => '200' ,
            'user' => $user,
            'token' => $token
        ]);
    }
   
}
