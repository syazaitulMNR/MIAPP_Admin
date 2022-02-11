<?php

namespace App\Http\Controllers;

use App\Models\EBook;
use Illuminate\Http\Request;

class EBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = EBook::latest()->paginate(15);

        return view('pages.ebooks.all',compact('data'))->with('i');
    }

    public function create()
    {
        return view('pages.ebooks.create');
    }

    public function store(Request $request)
    {
        $cover = $request->file('ebook_cover');
        $pdf = $request->file('ebook_pdf');

        ///// End Upload /////
        // ebook_cover
        $ext_cover = $cover->getClientOriginalExtension();
        $name_cover = $cover->getClientOriginalName();
        $uniqe_cover = 'COVER_'. uniqid() . '.' . $ext_cover;
        $dirpath = public_path('assets/EBooks/');
        $cover->move($dirpath, $uniqe_cover);

        $cover_path = 'assets/EBooks/'.$uniqe_cover;

        // ebook_pdf
        $ext_pdf = $pdf->getClientOriginalExtension();
        $name_pdf = $pdf->getClientOriginalName();
        $uniqe_pdf = 'PDF_'. uniqid() . '.' . $ext_pdf;
        $dirpath = public_path('assets/EBooks/');
        $pdf->move($dirpath, $uniqe_pdf);

        $pdf_path = 'assets/EBooks/'.$uniqe_pdf;
    
        ///// End Upload /////

        EBook::create([
            'ebook_name' => request('ebook_name'),
            'desc' => request('desc'),
            'type' => request('type'),
            'ebook_cover' => $cover_path,
            'ebook_pdf' => $pdf_path,
        ]);
        
        //success go to all list
        return redirect('ebooks')->with('success', 'The EBook details is added successfully.');
    }

    public function show(EBook $id)
    {
        //
    }

    public function edit($id)
    {
        $book = EBook::findOrFail($id);

        return view('pages.ebooks.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = EBook::findOrFail($id);

        // Start Image
        $cover = $request->file('ebook_cover');
        $pdf = $request->file('ebook_pdf');
            
        if($cover == '' && $pdf == '')
        {   
            $book->ebook_name = $request->ebook_name;
            $book->desc = $request->desc;

            $book->save();

            return redirect('ebook/edit/'.$id)->with('success', 'EBook details is successfully updated.');

        } else {

            $book->ebook_name = $request->ebook_name;
            $book->desc = $request->desc;

            if($cover != '') {
                // ebook_cover
                $ext_cover = $cover->getClientOriginalExtension();
                $name_cover = $cover->getClientOriginalName();
                $uniqe_cover = 'COVER_'. uniqid() . '.' . $ext_cover;
                $dirpath = public_path('assets/EBooks/');
                $cover->move($dirpath, $uniqe_cover);

                $cover_path = 'assets/EBooks/'.$uniqe_cover;
                
                $book->ebook_cover = $cover_path;

            } elseif ($pdf != ''){ 
                // ebook_pdf
                $ext_pdf = $pdf->getClientOriginalExtension();
                $name_pdf = $pdf->getClientOriginalName();
                $uniqe_pdf = 'PDF_'. uniqid() . '.' . $ext_pdf;
                $dirpath = public_path('assets/EBooks/');
                $pdf->move($dirpath, $uniqe_pdf);

                $pdf_path = 'assets/EBooks/'.$uniqe_pdf;
                
                $book->ebook_pdf = $pdf_path;
            }

            $book->save();

            return redirect('ebook/edit/'.$id)->with('success', 'EBook details is successfully updated.');

        }
    }

    public function destroy($id)
    {
        $del = EBook::findOrFail($id);
        $del->delete();

        return redirect('ebooks')->with('success', 'EBook is successfully deleted');
    }
}
