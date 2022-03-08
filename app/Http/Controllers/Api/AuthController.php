<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'status' => 'authenticated',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function register(Request $request)
    {
        $registerData = $request->validate([
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255',
            'password' => ['required', 'confirmed'],
        ]);

        $user = New User;
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role = 'User';
        $user->save();

        Auth::login($user);

        $user = $request->user();

        $tokenName = $request->user()->createToken('authToken')->plainTextToken;

        return response([
            'status' => 'authenticated',
            'user' => $user,
            'token' => $token
        ]);
    }


    public function authenticate(Request $request)
    {
        $authData = $request->validate([
            'authToken' => 'required',
        ]);
     
        $user = User::find(auth()->user()->id);

        return response([
            'status' => 'authenticated',
            'user' => $user,
            'token' => $request->authToken
        ]);
    }
   
}
