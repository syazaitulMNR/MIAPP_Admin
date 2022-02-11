<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $data = User::all();

        return response([
            'status' => '200',
            'message' => 'Successfully fetch profile data',
            'data' => $data
        ]);
    }

    public function guestIndex()
    {
        $data = User::all();

        return response([
            'status' => '200',
            'message' => 'Successfully fetch profile data guest',
            'data' => $data
        ]);
    }
}
