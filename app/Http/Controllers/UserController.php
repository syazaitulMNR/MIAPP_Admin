<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OfferHistory;
use App\Models\Offer;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = User::where('role', 'user')->latest()->paginate(15);

        return view('pages.users.all',compact('data'))->with('i');
    }

    public function view($id)
    {
        $user = User::where('id',$id)->first();
        $userOffer = OfferHistory::where('user_id',$id)->get();
        $offers = Offer::all();

        return view('pages.users.view', compact('user', 'userOffer', 'offers'))->with('i');
    }
}
