<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use URL;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = Product::latest()->paginate(15);
        
        return view('pages.products.all',compact('data'))->with('i');
    }

    public function create()
    {
        return view('pages.products.create');
    }

    public function store(Request $request)
    {
        $filename = $request->file('img_path');

        if ($filename != '')
        {
            $validatedData = $request->validate([
                'img_path' => 'image|mimes:jpeg,png,jpg|max:1000',
            ]);

            if($validatedData)
            {
                ///// End Upload /////
                $extension = $filename->getClientOriginalExtension();
                $name_img = $filename->getClientOriginalName();
                $uniqe_img = 'POSTER_'. uniqid() . '.' . $extension;
                $dirpath = public_path('assets/Products/');
                $filename->move($dirpath, $uniqe_img);

                $img_path = '/assets/Products/'.$uniqe_img;
                ///// End Upload /////
            }
        } else {
            $img_path = NULL;
        }
        

        Product::create([
            'product_id' => strtoupper(request('product_id')),
            'product_name' => ucwords(request('product_name')),
            'img_path' => ''.URL::to('').$img_path.'',
            'desc' => ucfirst(request('desc')),
        ]);
        
        //success go to all list
        return redirect('products')->with('success', 'The product details is added successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::where('id',$id)->first();

        return view('pages.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('id',$id)->first();

        $filename = $request->file('img_path');
        if($filename != '')
        {  
            $validatedData = $request->validate([
                'img_path' => 'image|mimes:jpeg,png,jpg|max:1000',
            ]);

            if($validatedData) 
            {
                ///// End Upload /////
                $extension = $filename->getClientOriginalExtension();
                $name_img = $filename->getClientOriginalName();
                $uniqe_img = 'PRODUCT_'. uniqid() . '.' . $extension;
                $dirpath = public_path('assets/Products/');
                $filename->move($dirpath, $uniqe_img);

                $img_path = '/assets/Products/'.$uniqe_img;
                ///// End Upload /////

                $product->product_id = strtoupper($request->product_id);
                $product->product_name = ucwords($request->product_name);
                $product->desc = ucfirst($request->desc);
                $product->img_path = ''.URL::to('').$img_path.'';
            }
        } else {
            $product->product_id = strtoupper($request->product_id);
            $product->product_name = ucwords($request->product_name);
            $product->desc = ucfirst($request->desc);
        }

        $product->save();

        return redirect('product/edit/'.$id)->with('success', 'Product details is successfully updated.');

    }

    public function destroy($id)
    {
        $del = Product::findOrFail($id);
        $del->delete();

        return redirect()->back()->with('success', 'Product is successfully deleted');
    }
}
