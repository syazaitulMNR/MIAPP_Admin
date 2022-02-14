<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EBook;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Program;
use App\Models\User;
use App\Models\OfferProduct;
use App\Models\OfferHistory;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //user
        $userNum = User::where('role', 'user')->count();
        // $userNum = count($user);

        //event
        $proNum = Program::where('status', 'Active')->count();
        // $proNum = count($program);

        //ebook
        $ebook = EBook::all();
        $bookNum = count($ebook);


        $offerNum = Offer::where('status', 'Active')->count();
        // $offerNum = count($offer);
        $bygroup = Offer::where('status', 'Active')->groupBy('type')->selectRaw('count(id) as total, type')->get();
        // dd($bygroup);

        ////////////////////////////////////////////////
        //promo
        $allOff = Offer::all();
        //offer_history
        $byOffer = OfferHistory::groupBy('offer_id')->selectRaw('count(id) as total, offer_id')->get();

        $nameOff = null;
        foreach ($allOff as $alls => $val){
            $nameOff = $val->id;
        }

        foreach ($byOffer as $data => $vals){
            $idBy = $vals->offer_id;
        }
        // dd($idBy);
        

         //offer_history
        $byOffer = OfferHistory::groupBy('offer_id')->selectRaw('count(id) as total, offer_id')->get();
 
        ////////////////////////////////////////////////
        // //promo
        // $allOff = Offer::all();
        // //offer_history
        // $byOffer = OfferHistory::groupBy('offer_id')->selectRaw('count(id) as total, offer_id')->get();
        
        

        return view('home', compact('nameOff', 'userNum', 'proNum', 'offerNum', 'bookNum', 'bygroup', 'byOffer', 'allOff', 'idBy'));
    }
}
