<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EBook;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Program;
use App\Models\User;
use App\Models\OfferProduct;
use App\Models\OfferProgram;
use App\Models\OfferHistory;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $date = Carbon::today();
        //user
        $userNum = User::where('role', 'user')->count();
        //event
        $proNum = Program::where('status', 'Active')->count();
        //ebook
        $ebook = EBook::all();
        $bookNum = count($ebook);

        $offerNum = Offer::where('status', 'Active')->count();
        $bygroup = Offer::where('status', 'Active')->groupBy('type')->selectRaw('count(id) as total, type')->get();
       
        //promo
        $allOff = Offer::all();
        $offYear = Offer::whereYear('created_at',$date->year)->get();
        //offer_history
        $byOffer = OfferHistory::groupBy('offer_id')->selectRaw('count(id) as total, offer_id')->get();
        $countByOffer = count($byOffer);
        
        /////////////////////////////////////////////////////////////////////////////
        // for CHART
        $labelist = [];
        foreach($offYear as $lists => $list) {
            $labelist[] =  $list->offer_name;
        }

        $selectid = [];
        foreach($offYear as $numering => $num) {
            $selectid[] =  $num->id;
        }

        $number = [];
        foreach ($selectid as $value => $val) {
            $number[] = OfferHistory::where(\DB::raw("offer_id"),$val)->count();
        }
        

        return view('home', compact('labelist', 'date', 'number', 'userNum', 'proNum', 'offerNum', 'bookNum', 'bygroup', 'byOffer', 'allOff',  'countByOffer'));
    }
}
