<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $data = Offer::latest()->paginate(15);

        return view('pages.offers.all',compact('data'))->with('i');
    }

    public function create()
    {
        $product = Product::all();

        return view('pages.offers.create',compact('product'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $hobby = $input['product'];
        $input['product'] = implode(',', $hobby);

        dd($input['product']);


        $filename = $request->file('img_path');

        ///// End Upload /////
        $extension = $filename->getClientOriginalExtension();
        $name_img = $filename->getClientOriginalName();
        $uniqe_img = 'PROMO_'. uniqid() . '.' . $extension;
        $dirpath = public_path('assets/Offers/');
        $filename->move($dirpath, $uniqe_img);

        $img_path = 'assets/Offers/'.$uniqe_img;
        ///// End Upload /////

        Offer::create([
            'offer_id' => request('offer_id'),
            'offer_name' => request('offer_name'),
            'desc' => request('desc'),
            'type' => request('type'),
            'tnc' => request('tnc'),
            'valid_until' => request('valid_until'),
            'onpay_link' => request('onpay_link'),
            'img_path' => $img_path,
            'promo_code' => request('promo_code'),
            'status' => request('status'),
        ]);
        
        //success go to all list
        return redirect('promotions')->with('success', 'The promotion details is added successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $offer = Offer::where('id',$id)->first();

        return view('pages.offers.edit', compact('offer'));
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::where('id',$id)->first();

        $filename = $request->file('img_path');
        if($filename != '')
        {  
            ///// End Upload /////
            $extension = $filename->getClientOriginalExtension();
            $name_img = $filename->getClientOriginalName();
            $uniqe_img = 'POSTER_'. uniqid() . '.' . $extension;
            $dirpath = public_path('assets/Offers/');
            $filename->move($dirpath, $uniqe_img);

            $img_path = 'assets/Offers/'.$uniqe_img;
            ///// End Upload /////

            $offer->offer_id = $request->offer_id;
            $offer->offer_name = $request->offer_name;
            $offer->desc = $request->desc;
            $offer->type = $request->type;
            $offer->tnc = $request->tnc;
            $offer->valid_until = $request->valid_until;
            $offer->onpay_link = $request->onpay_link;
            $offer->promo_code = $request->promo_code;
            $offer->status = $request->status;
            $offer->img_path = $img_path;

        } else {

            $offer->offer_id = $request->offer_id;
            $offer->offer_name = $request->offer_name;
            $offer->desc = $request->desc;
            $offer->type = $request->type;
            $offer->tnc = $request->tnc;
            $offer->valid_until = $request->valid_until;
            $offer->onpay_link = $request->onpay_link;
            $offer->promo_code = $request->promo_code;
            $offer->status = $request->status;
        }

        $offer->save();

        return redirect('promotion/edit/'.$id)->with('success', 'Promotion details is successfully updated.');

    }

    public function destroy($id)
    {
        $del = Offer::findOrFail($id);
        $del->delete();

        return redirect('promotions')->with('success', 'Promotion is successfully deleted');
    }
}
