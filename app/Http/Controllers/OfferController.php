<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use App\Models\ApplicableTo;
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
        $plist = $input['product'];
        $count_owner = count($plist);

        // dd($count_owner);

        $filename = $request->file('img_path');

        ///// End Upload /////
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

        $newId = $new->id;

        for($i=0; $i<$count_owner; $i++) {

            ApplicableTo::create([
                'product_id' => $input['product'][$i],
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

//     public function editexample($id)
// {
//   $role = Role::where('id', $id)->with('permissions')->first();
//   $permissions = Permission::all();
//   return view('admin.manage.roles.edit')->withRole($role)->withPermissions($permissions);
// }

    public function edit($id)
    {
        $offer = Offer::where('id',$id)->first();
        // $apply = ApplicableTo::where('offer_id',$id)->get();
        $product = Product::all();
        // $apply = $offer->offer()->where('id',$id)->get();
        dd($offer->offer()->where('id',$id));

        return view('pages.offers.edit', compact('offer', 'apply', 'product'));
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::where('id',$id)->first();
        $apply = ApplicableTo::where('offer_id',$id)->get();
        $product = Product::all();

        $input = $request->all();
        $plist = $input['product'];
        $count_owner = count($plist);

        // <td class="text-center"><input type="checkbox" name="status[{{ $banner->id }}]" 
        //  @if($banner->is_checked) checked @endif ></td>

        // $banners = $user->banners()->get();
       
        // foreach($banners as $banner) {
        //     $banner->is_checked = $request->has('status.' . $banner->id);
        //     $banner->save();
        // }
        // dd($request->product);
        dd($apply->product());

        if(is_array($plist)) {
            foreach($request->product as $newlist) {
                $apply->product()->sync($request->product);
            }
        }

        // foreach($apply as $applicable) {
        //     for($i=0; $i<$count_owner; $i++) {
        //     // $applicable->product_id = $request->has('product.' . $applicable->id);
            
        //     dd($input['product'][$i]);
        //     $applicable->product_id=$plist;
        //     $applicable->save();
        //     }
        // }       

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
