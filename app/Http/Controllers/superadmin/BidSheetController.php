<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bidsheet;

class BidSheetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }
    public function index(){
        $bidsheet  = Bidsheet::all();
        return view('SuperAdmin.bid-sheet.index',compact('bidsheet'));
    }

    public function bidsheetCreate(){
        return view('SuperAdmin.bid-sheet.create');
    }

    public function bidsheetStore(Request $request){
        $validator =$request->validate ([
            'bidsheet_img' => "required|mimes:pdf|max:10000"
        ]);
        $contractfile = new Bidsheet();
        if($request->hasFile('bidsheet_img')){
            $request->file('bidsheet_img')->store('public/bidsheet_img');
            $contractfile['bidsheet_img'] = 'storage/bidsheet_img/'.$request->file('bidsheet_img')->hashName();
         }
         $contractfile->name = $request->name;
        $contractfile->save();
        return redirect()->route('bidsheet.index')->with('success', 'file upload successfully !');
    }

    public function bidsheetEdit (Request $request,$id){
        $bidsheetdit = Bidsheet::find($id);
        return view('SuperAdmin.bid-sheet.edit',compact('bidsheetdit'));
    }
    public function bidsheetUpdate(Request $request,$id){
        $bidsheetdit = Bidsheet::find($id);
        if($request->hasFile('bidsheet_img')){
            $request->file('bidsheet_img')->store('public/bidsheet_img');
            $bidsheetdit['bidsheet_img'] = 'storage/bidsheet_img/'.$request->file('bidsheet_img')->hashName();
         }
         $bidsheetdit->name = $request->name;
         $bidsheetdit->update();
         return redirect()->route('bidsheet.index')->with('success', 'file upload successfully !');
    }

    public function bidsheetDelete($id){
        $bidsheetdelete = Bidsheet::find($id);
        $bidsheetdelete->delete();
        return redirect()->route('bidsheet.index')->with('danger', 'file deleted successfully !');
    }

}