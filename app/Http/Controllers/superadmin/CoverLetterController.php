<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coverletter;
use Log;

class CoverLetterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }
    
    public function index(){
        $coverletters = Coverletter::all();
        return view('SuperAdmin.cover-letter.index',compact('coverletters'));
    }

    public function create(){
        return view('SuperAdmin.cover-letter.create');
    }

    public function store(Request $request){
        $validator = $request->validate([
            'description' => 'required',
            'title' => 'required',
        ]); 
        $desc = new Coverletter();
        $desc->description = $request->description;
        $desc->title = $request->title;
        $desc->save();
        return redirect()->route('cover-letter.index')->with('success', 'cover letter added successfully !');

    }

    public function edit(Request $request,$id){
        $coverEdit = Coverletter::find($id);
        return view('SuperAdmin.cover-letter.edit',compact('coverEdit'));
    }

    public function update(Request $request,$id){
           $coverUpdate =  Coverletter::find($id);
           $coverUpdate->description = $request->description;
           $coverUpdate->title = $request->title;
           $coverUpdate->save();
           return redirect()->route('cover-letter.index')->with('success', 'cover letter edit successfully !');
    }

    public function coverLetterDelete($id){
        $coverDel =  Coverletter::find($id);
        $coverDel->delete();
        return redirect()->route('cover-letter.index')->with('danger', 'cover letter deleted successfully !');
    }
}
