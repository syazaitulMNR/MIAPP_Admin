<?php

namespace App\Http\Controllers\Api;

use App\Models\EBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EBookController extends Controller
{
    public function index()
    {
        $data = EBook::orderBy('created_at' , 'DESC')->get();

        return response([
            'status' => '200',
            'message' => 'Successfully fetch ebook data',
            'data' => $data
        ]);
    }

    public function guestIndex()
    {
        $data = EBook::orderBy('created_at' , 'DESC')->get();

        return response([
            'status' => '200',
            'message' => 'Successfully fetch ebook data guest',
            'data' => $data
        ]);
    }
}
