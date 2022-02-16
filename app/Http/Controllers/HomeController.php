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
        //update offer status based on valid_until date
        $date = Carbon::today();
        $end = Offer::where('valid_until','<',$date)->get();
        foreach($end as $change){
            $change->status = 'Deactive';
            $change->save();
        }

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
        // $allOff = Offer::all();
        //offer_history
        // $byOffer = OfferHistory::groupBy('offer_id')->selectRaw('count(id) as total, offer_id')->get();

        // $nameOff = null;
        // foreach ($allOff as $alls => $val){
        //     $nameOff = $val->id;
        // }

       
        // dd($idBy);
        

         //offer_history
        // $byOffer = OfferHistory::groupBy('offer_id')->selectRaw('count(id) as total, offer_id')->get();
 
        ////////////////////////////////////////////////
        //promo
        $allOff = Offer::all();
        //offer_history
        $byOffer = OfferHistory::groupBy('offer_id')->selectRaw('count(id) as total, offer_id')->get();
        foreach ($byOffer as $data => $vals){
            $idBy = $vals->offer_id;
        }
        
        

        return view('home', compact('userNum', 'proNum', 'offerNum', 'bookNum', 'bygroup', 'byOffer', 'allOff', 'idBy'));
    }
}
