<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use App\Models\OfferProduct;
use App\Models\Program;
// use App\Models\ApplicableTo;
use App\Models\OfferProgram;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = Offer::latest()->paginate(15);

        return view('pages.offers.all',compact('data'))->with('i');
    }

    public function create()
    {
        $product = Product::all();
        $program = Program::all();

        return view('pages.offers.create',compact('product', 'program'));
    }

    public function store(Request $request)
    {
        $filename = $request->file('img_path');

        ///// Start Upload /////
        $extension = $filename->getClientOriginalExtension();
        $name_img = $filename->getClientOriginalName();
        $uniqe_img = 'PROMO_'. uniqid() . '.' . $extension;
        $dirpath = public_path('assets/Offers/');
        $filename->move($dirpath, $uniqe_img);

        $img_path = 'assets/Offers/'.$uniqe_img;
        ///// End Upload /////

        $new = Offer::create([
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

        $newId = $new->id; //get offer latest id

        //// Start Bridge process for Offer_Product & Offer_Program
        $input = $request->all();
        
        $productlist = $input['product'];
        $count_product = count($productlist);
       
        $programlist = $input['program'];
        $count_program = count($programlist);

        if(empty($input['product']) && empty($input['program']) )
        {
            return redirect('pages.offers.edit')->with('success', 'The promotion details is added successfully.');

        } elseif(empty($input['program'])) {
           
            $productlist = $input['product'];
            $offer->products()->sync($productlist); 
            $offer->programs()->detach();

        } elseif(empty($input['product'])) {
            
            $productlist = $input['program'];
            $offer->programs()->sync($productlist); 
            $offer->products()->detach();

        } else {
            $productlist = $input['product'];
            $programlist = $input['program'];
            
            $offer->products()->sync($productlist);
            $offer->programs()->sync($programlist);
        }

        for($i=0; $i<$count_product; $i++) {
            OfferProduct::create([
                'product_id' => $input['product'][$i],
                'offer_id' => $newId,
            ]);
        }

        for($i=0; $i<$count_program; $i++) {
            OfferProgram::create([
                'program_id' => $input['program'][$i],
                'offer_id' => $newId,
            ]);
        }
        
        //success go to all list
        return redirect('promotions')->with('success', 'The promotion details is added successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        $apply = OfferProduct::where('offer_id',$id)->get();
        $applyProgram = OfferProgram::where('offer_id',$id)->get();
        $product = Product::all();
        $program = Program::all();

        return view('pages.offers.edit', compact('offer', 'product', 'apply', 'applyProgram', 'program'));
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::where('id',$id)->first();
        $input = $request->all();
        $filename = $request->file('img_path');
        $offer->offer_id = $request->offer_id;
        $offer->offer_name = $request->offer_name;
        $offer->desc = $request->desc;
        $offer->type = $request->type;
        $offer->tnc = $request->tnc;
        $offer->valid_until = $request->valid_until;
        $offer->onpay_link = $request->onpay_link;
        $offer->promo_code = $request->promo_code;
        $offer->status = $request->status;

        if($filename != '')
        {  
            $extension = $filename->getClientOriginalExtension();
            $name_img = $filename->getClientOriginalName();
            $uniqe_img = 'POSTER_'. uniqid() . '.' . $extension;
            $dirpath = public_path('assets/Offers/');
            $filename->move($dirpath, $uniqe_img);
            $img_path = 'assets/Offers/'.$uniqe_img;
            $offer->img_path = $img_path;
        }

        if(empty($input['product']) && empty($input['program']) )
        {
            $offer->programs()->detach();
            $offer->products()->detach();
        } elseif(empty($input['program'])) {
            // dd('john');
            $productlist = $input['product'];
            $offer->products()->sync($productlist); 
            $offer->programs()->detach();
        } elseif(empty($input['product'])) {
            // dd('john');
            $productlist = $input['program'];
            $offer->programs()->sync($productlist); 
            $offer->products()->detach();
        } else {
            $productlist = $input['product'];
            $programlist = $input['program'];
            
            $offer->products()->sync($productlist);
            $offer->programs()->sync($programlist);
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
