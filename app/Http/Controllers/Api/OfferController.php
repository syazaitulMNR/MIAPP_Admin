<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\OfferHistory;

class OfferController extends Controller
{
    public function index()
    {
        $data = Offer::where('status', 'Active')->orderBy('created_at' , 'DESC')->with('products','programs')->get();
  
        $data->map(function ($item) {

            $offer_histories =  $item->offerHistory->where('user_id' , auth()->user()->id);
            if(count($offer_histories) > 0){
                $item['click'] = true;
                return $item;
            }
            else{
                $item['click'] = false;
                return $item;
            }
        });
     
        return response([
            'status' => '200',
            'message' => 'Successfully fetch offer data',
            'data' => $data
        ]);
    }

    public function guestIndex()
    {
        $data = Offer::where('status', 'Active')->orderBy('created_at' , 'DESC')->with('products','programs')->get();

        $data->map(function ($item) {
            $item['click'] = false;
            return $item;
        });

        return response([
            'status' => '200',
            'message' => 'Successfully fetch offer data guest',
            'data' => $data
        ]);
    }

    public function offerClick($id){

        $offer = Offer::find($id);
        
        if($offer)
        {
            $offerHistory = New OfferHistory();
            $offerHistory->user_id = auth()->user()->id;
            $offerHistory->offer_id =  $offer->id;
            $offerHistory->save();

            return response([
                'status' => '200',
                'message' => 'Successfully add offer history',
                'data' => $offerHistory
            ]);
        }
        else{
            return response([
                'status' => '200',
                'message' => 'Offer not exist',
                'data' => ''
            ]);
        }
    }
}
