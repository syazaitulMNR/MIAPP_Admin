<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $data = Program::latest()->paginate(15);

        return view('pages.programs.all',compact('data'))->with('i');
    }

    public function create()
    {
        return view('pages.programs.create');
    }

    public function store(Request $request)
    {
        $filename = $request->file('img_path');

        ///// End Upload /////
        $extension = $filename->getClientOriginalExtension();
        $name_img = $filename->getClientOriginalName();
        $uniqe_img = 'POSTER_'. uniqid() . '.' . $extension;
        $dirpath = public_path('assets/Programs/');
        $filename->move($dirpath, $uniqe_img);

        $img_path = 'assets/Programs/'.$uniqe_img;
        ///// End Upload /////

        Program::create([
            'program_id' => request('program_id'),
            'program_name' => request('program_name'),
            'date_start' => request('date_start'),
            'date_end' => request('date_end'),
            'page_link' => request('page_link'),
            'img_path' => $img_path,
            'status' => request('status'),
        ]);
        
        //success go to all list
        return redirect('programs')->with('success', 'The program details is added successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        // $program = Program::findOrFail($program_id);
        $program = Program::where('id',$id)->first();

        return view('pages.programs.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $program = Program::where('id',$id)->first();

        $filename = $request->file('img_path');
        if($filename != '')
        {  
            ///// End Upload /////
            $extension = $filename->getClientOriginalExtension();
            $name_img = $filename->getClientOriginalName();
            $uniqe_img = 'POSTER_'. uniqid() . '.' . $extension;
            $dirpath = public_path('assets/Programs/');
            $filename->move($dirpath, $uniqe_img);

            $img_path = 'assets/Programs/'.$uniqe_img;
            ///// End Upload /////

            $program->program_id = $request->program_id;
            $program->program_name = $request->program_name;
            $program->date_start = $request->date_start;
            $program->date_end = $request->date_end;
            $program->page_link = $request->page_link;
            $program->status = $request->status;
            $program->img_path = $img_path;

        } else {

            $program->program_id = $request->program_id;
            $program->program_name = $request->program_name;
            $program->date_start = $request->date_start;
            $program->date_end = $request->date_end;
            $program->page_link = $request->page_link;
            $program->status = $request->status;
        }

        $program->save();

        return redirect('program/edit/'.$id)->with('success', 'Program details is successfully updated.');

    }

    public function destroy($id)
    {
        $del = Program::findOrFail($id);
        $del->delete();

        return redirect('programs')->with('success', 'Program is successfully deleted');
    }
}
