<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::orderBy('created_at' , 'DESC')->get();

        return response([
            'status' => '200',
            'message' => 'Successfully fetch product data',
            'data' => $data
        ]);
    }

    public function guestIndex()
    {
        $data = Product::orderBy('created_at' , 'DESC')->get();

        return response([
            'status' => '200',
            'message' => 'Successfully fetch product data guest',
            'data' => $data
        ]);
    }
}
