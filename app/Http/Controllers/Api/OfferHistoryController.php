<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferHistory;

class OfferHistoryController extends Controller
{
    public function index()
    {
        $data = OfferHistory::where('user_id' , auth()->user()->id)->orderby('created_at', 'DESC')->with('historyOffer')->get();

        return response([
            'status' => '200',
            'message' => 'Successfully fetch offer history data',
            'data' => $data
        ]);
    }


}
