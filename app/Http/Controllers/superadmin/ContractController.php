<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contract;

class ContractController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }
    public function index(){
        $contarct  = Contract::all();
        return view('SuperAdmin.contract.index',compact('contarct'));
    }

    public function contractCreate(){
        return view('SuperAdmin.contract.create');
    }

    public function contractStore(Request $request){
        $validator =$request->validate ([
            'contract_img' => "required|mimes:pdf|max:10000"
        ]);

        $contractfile = new Contract();
        if($request->hasFile('contract_img')){
            $file = $request->file('contract_img'); // Use file, not hasfile
            $originalNameNda = $file->getClientOriginalName();
            $file->store('public/contract_img');
            $contractfile['contract_img'] = 'storage/contract_img/'.$file->hashName();
         }
         $contractfile->file_name = $request->file_name;
        $contractfile->save();
        return redirect()->route('contract.index')->with('success', 'file upload successfully !');
    }

    public function contractEdit (Request $request,$id){
        $contractdit = Contract::find($id);
        return view('SuperAdmin.contract.edit',compact('contractdit'));
    }
    public function contractUpdate(Request $request,$id){
        $contractdit = Contract::find($id);
        if($request->hasFile('contract_img')){
            $request->file('contract_img')->store('public/contract_img');
            $contractdit['contract_img'] = 'storage/contract_img/'.$request->file('contract_img')->hashName();
         }
         $contractdit->file_name = $request->file_name;
         $contractdit->update();
         return redirect()->route('contract.index')->with('success', 'file upload successfully !');
    }

    public function contractDelete($id){
        $ndadelete = Contract::find($id);
        $ndadelete->delete();
        return redirect()->route('contract.index')->with('danger', 'file deleted successfully !');
    }

}
