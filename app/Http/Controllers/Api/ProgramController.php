<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;

class ProgramController extends Controller
{
    public function index()
    {
        $data = Program::where('status', 'Active')->orderBy('created_at' , 'DESC')->get();

        return response([
            'status' => '200',
            'message' => 'Successfully fetch program data',
            'data' => $data
        ]);
    }

    public function guestIndex()
    {
        $data = Program::where('status', 'Active')->orderBy('created_at' , 'DESC')->get();

        return response([
            'status' => '200',
            'message' => 'Successfully fetch program data guest',
            'data' => $data
        ]);
    }

    public function threeLatest()
    {
        $data = Program::orderBy('created_at' , 'DESC')->take(3)->get();

        return response([
            'status' => '200',
            'message' => 'Successfully fetch program data guest',
            'data' => $data
        ]);
    }
}
