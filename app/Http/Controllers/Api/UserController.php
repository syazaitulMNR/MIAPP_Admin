<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        return response([
            'status' => 'success',
            'user' => $user,
            'token' => '',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = User::find($id);

        $request->validate([
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'email|required|unique:users,email,'.$update->id,
            'phone' => 'required|string|max:255',
		]); 

        $update->username = $request->username;
        $update->name = $request->name;
        $update->email = $request->email;
        $update->phone = $request->phone;
        $update->save();

        return response([
            'status' => 'success',
            'user' => $update,
            'token' => '',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changePassword(Request $request){

        $request->validate([
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::find(auth()->user()->id); 
        
        if (Hash::check($request->current_password, $user->password)) {

            $user->password = Hash::make($request->password);

            $user->save();

            return response([
                'status' => 'success'
            ]);

        }
        else{
            return response([
                'message' => 'Current Password is not match',
            ]);
        }

    }
}
