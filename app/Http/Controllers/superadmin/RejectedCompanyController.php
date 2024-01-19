<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyType;
use App\Models\CompanyDocument;
use App\Models\User;
use Log;

class RejectedCompanyController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth:superadmin');
    }
    
  public function rejectedCompanyIndex(){
    $claimreject = Company::where('company_approve_status', 'rejected')->get();
    return view('SuperAdmin.rejected-company.index',compact('claimreject'));  
  }



  public function rejectedCompanyEdit($id){

        $resource = Company::where('id', $id)->first();
        $requestCompanies = Company::where('user_id', $resource->user_id)->get();
        $userDocuments = CompanyDocument::where('company_id', $resource->user_id)->get();
        $userD = User::where('id', $resource->user_id)->first();
        return view('SuperAdmin.rejected-company.edit', compact('resource', 'userD' ,'userDocuments'));
  }

  public function rejectedCompanyUpdate(Request $request,$id){
    $rejectUpdate = Company::where('id', $id)->first();
    $rejectUpdate->company_approve_status = $request->company_approve_status;
    $rejectUpdate->update();
    return redirect()->route('rejected.company.index')->with('success', 'rejected company  restore ');
  }
  
  public function rejectedCompanyDel (Request $request,$id){
    $rejectUpdate = Company::where('id', $id)->first();
    $rejectUpdate->delete();
    return redirect()->route('rejected.company.index')->with('success', 'rejected company Delete ');
  }
}
