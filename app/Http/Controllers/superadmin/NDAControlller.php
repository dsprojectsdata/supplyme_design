<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NDA;
use Illuminate\Support\Facades\Storage;
use Log;

class NDAControlller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }
    
    public function index(){
        $ndafile = NDA::all();
       
        $icons = [
            'pdf' => 'fa fa-file-pdf',
            'doc' => 'fa fa-file-word',
            'docx' => 'fa fa-file-word',
            'xls' => 'fa fa-file-excel',
            'xlsx' => 'fa fa-file-excel',
            'ppt' => 'fa fa-file-powerpoint',
            'pptx' => 'fa fa-file-powerpoint',
            'zip' => 'fa fa-file-archive',
            'rar' => 'fa fa-file-archive',
            'txt' => 'fa fa-file-alt',
            'png' => 'fa fa-file-image',
            'jpg' => 'fa fa-file-image',
            'jpeg' => 'fa fa-file-image',
            'gif' => 'fa fa-file-image',
        ];

        return view('SuperAdmin.nda.index',compact('ndafile','icons'));
    }

    public function ndaCreate(){
        return view('SuperAdmin.nda.create');
    }

    public function ndaStore(Request $request){
        $validator =$request->validate ([
            'nda_file_name' => "required",
            'nda_file_title' => "required",
        ]);

        $ndsfile = new NDA();
        if($request->hasFile('nda_file_name')){
            $file = $request->file('nda_file_name');
            $file->store('public/nda_file_name');
            $ndsfile['nda_file_name'] = 'storage/nda_file_name/'.$file->hashName();
         }
        $ndsfile->nda_file_title = $request->nda_file_title;
        $ndsfile->save();
        return redirect()->route('nda.index')->with('success', 'file upload successfully !');
    }

    public function ndaEdit (Request $request,$id){
        $ndaedit = NDA::find($id);
        return view('SuperAdmin.nda.edit',compact('ndaedit'));  
    }
    public function ndaUpdate(Request $request,$id){
        
        $ndaedit = NDA::find($id);
        if($request->hasFile('nda_file_name')){
            $request->file('nda_file_name')->store('public/nda_file_name');
            $ndaedit['nda_file_name'] = 'storage/nda_file_name/'.$request->file('nda_file_name')->hashName();
         }
         $ndaedit->nda_file_title = $request->nda_file_title;
         $ndaedit->update();
         return redirect()->route('nda.index')->with('success', 'file upload successfully !');
    }

    public function ndaDelete($id){
        $ndadelete = NDA::find($id);
        $ndadelete->delete();
        return redirect()->route('nda.index')->with('danger', 'file deleted successfully !');
    }

   

}
