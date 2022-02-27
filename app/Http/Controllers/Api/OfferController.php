<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;

class OfferController extends Controller
{
    public function index()
    {
        $data = Offer::orderBy('created_at' , 'DESC')->get();

        return response([
            'status' => '200',
            'message' => 'Successfully fetch offer data',
            'data' => $data
        ]);
    }

    public function guestIndex()
    {
        $data = Offer::orderBy('created_at' , 'DESC')->get();

        return response([
            'status' => '200',
            'message' => 'Successfully fetch offer data guest',
            'data' => $data
        ]);
    }
}
