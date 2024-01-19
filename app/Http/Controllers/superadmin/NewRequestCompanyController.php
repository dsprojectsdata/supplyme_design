<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyType;
use App\Models\Countrie;
use App\Models\City;
use App\Models\State;
use App\Models\CompanyDocument;
use App\Models\JobRole;
use Log;

class NewRequestCompanyController extends Controller
{
      public function __construct()
      {
          $this->middleware('auth:superadmin');
      }
      
    public function newRequestIndex(){
      $newrequest = Company::orderBy('id','desc')->where('company_approve_status', 'new')->where('is_delete', '0')->orwhere('company_approve_status', 'pending')->get();
        return view('SuperAdmin.new-request-company.index',compact('newrequest'));
      }

    public function editNewReq($id){
        $company = Company::with('User')->find($id);
        $image = CompanyDocument::where('company_id',$company->id)->get();
        return view('SuperAdmin.new-request-company.edit',compact('company','image'));
    }

      public function acceptORrejectNewReq(Request $request,$id){
        $acceptAndrejected = Company::find($id);
        $acceptAndrejected->company_approve_status = $request->company_approve_status;
        $acceptAndrejected->save();
        return redirect()->route('new.request.index')->with('success' , 'Company status '.$request->company_approve_status.' updated successfully.');
      }
      
        public function delNewReq($id){
            $newCompany = Company::find($id);
            $newCompany->is_delete = '1'; 
            $newCompany->update();
        return redirect()->route('new.request.index')->with('danger', 'New requested Company deleted successfully !');
      }
}

