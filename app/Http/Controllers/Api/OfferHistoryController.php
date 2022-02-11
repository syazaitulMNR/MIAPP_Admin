<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferHistory;

class OfferHistoryController extends Controller
{
    public function index()
    {
        $data = OfferHistory::all();

        return response([
            'status' => '200',
            'message' => 'Successfully fetch offer history data',
            'data' => $data
        ]);
    }

    public function guestIndex()
    {
        $data = OfferHistory::all();

        return response([
            'status' => '200',
            'message' => 'Successfully fetch offer history data guest',
            'data' => $data
        ]);
    }
}
