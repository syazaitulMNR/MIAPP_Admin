<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use App\Models\OfferProduct;
use App\Models\Program;
use App\Models\OfferProgram;
use Illuminate\Http\Request;
use URL;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = Offer::latest()->paginate(10);

        return view('pages.offers.all',compact('data'))->with('i');
    }

    public function create()
    {
        $product = Product::latest()->paginate(15);
        $program = Program::all();

        return view('pages.offers.create',compact('product', 'program'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'img_path' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        if($validatedData)
        {
            $filename = $request->file('img_path');

            ///// Start Upload /////
            $extension = $filename->getClientOriginalExtension();
            $name_img = $filename->getClientOriginalName();
            $uniqe_img = 'PROMO_'. uniqid() . '.' . $extension;
            $dirpath = public_path('assets/Offers/');
            $filename->move($dirpath, $uniqe_img);

            $img_path = '/assets/Offers/'.$uniqe_img;
            ///// End Upload /////

            $new = Offer::create([
                'offer_id' => strtoupper(request('offer_id')),
                'offer_name' => ucwords(request('offer_name')),
                'desc' => ucfirst(request('desc')),
                'type' => request('type'),
                'tnc' => request('tnc'),
                'valid_until' => request('valid_until'),
                'onpay_link' => request('onpay_link'),
                'img_path' => ''.URL::to('').$img_path.'',
                'promo_code' => strtoupper(request('promo_code')),
                'status' => request('status'),
            ]);

            $newId = $new->id; //get offer latest id

            //// Start Bridge process for Offer_Product & Offer_Program
            $input = $request->all();

            if(empty($input['product']) && empty($input['program']) )
            {
                return redirect('promotion/edit/'.$newId)->withInput(['pill' => 'v-pills-apply'])->with('success', 'The promotion details is added successfully. Please Select Product or Event.');
                
            } elseif(empty($input['program'])) {

                $count_product = count($input['product']);
            
                for($i=0; $i<$count_product; $i++) {
                    OfferProduct::create([
                        'product_id' => $input['product'][$i],
                        'offer_id' => $newId,
                    ]);
                }

            } elseif(empty($input['product'])) {

                $count_program = count($input['program']);
                
                for($i=0; $i<$count_program; $i++) {
                    OfferProgram::create([
                        'program_id' => $input['program'][$i],
                        'offer_id' => $newId,
                    ]);
                }

            } else {

                $count_product = count($input['product']);
                for($i=0; $i<$count_product; $i++) {
                    OfferProduct::create([
                        'product_id' => $input['product'][$i],
                        'offer_id' => $newId,
                    ]);
                }

                $count_program = count($input['program']);
                for($i=0; $i<$count_program; $i++) {
                    OfferProgram::create([
                        'program_id' => $input['program'][$i],
                        'offer_id' => $newId,
                    ]);
                }
            }
            /////////end bridge/////
            
            //success go to all list
            return redirect('promotions')->with('success', 'The promotion details is added successfully.');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        $applyProduct = OfferProduct::where('offer_id',$id)->get();
        $applyProgram = OfferProgram::where('offer_id',$id)->get();
        $product = Product::all();
        $program = Program::all();

        return view('pages.offers.edit', compact('offer', 'product', 'applyProduct', 'applyProgram', 'program'));
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::where('id',$id)->first();
        $input = $request->all(); //for selecting product & program process
        $filename = $request->file('img_path');
        $offer->offer_id = strtoupper($request->offer_id);
        $offer->offer_name = ucwords($request->offer_name);
        $offer->desc = ucfirst($request->desc);
        $offer->type = $request->type;
        $offer->tnc = $request->tnc;
        $offer->valid_until = $request->valid_until;
        $offer->onpay_link = $request->onpay_link;
        $offer->promo_code = strtoupper($request->promo_code);
        $offer->status = $request->status;

        if($filename != '')
        {  
            $validatedData = $request->validate([
                'img_path' => 'required|image|mimes:jpeg,png,jpg',
            ]);
    
            if($validatedData)
            {
                $extension = $filename->getClientOriginalExtension();
                $name_img = $filename->getClientOriginalName();
                $uniqe_img = 'POSTER_'. uniqid() . '.' . $extension;
                $dirpath = public_path('assets/Offers/');
                $filename->move($dirpath, $uniqe_img);
                $img_path = '/assets/Offers/'.$uniqe_img;

                $offer->img_path = ''.URL::to('').$img_path.'';
            }
        }

        if(empty($input['product']) && empty($input['program']) )
        {
            $offer->programs()->detach();
            $offer->products()->detach();

        } elseif(empty($input['program'])) {
            
            $productlist = $input['product'];
            $offer->products()->sync($productlist); 
            $offer->programs()->detach();

        } elseif(empty($input['product'])) {
           
            $programlist = $input['program'];
            $offer->programs()->sync($programlist); 
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
