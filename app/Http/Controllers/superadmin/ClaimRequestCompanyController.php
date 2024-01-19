<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use App\Models\CompanyType;
use App\Models\RequestCompany;
use App\Models\CompanyDocument;
use Log;
use DB;

class ClaimRequestCompanyController extends Controller   
{
    
  public function __construct()
  {
      $this->middleware('auth:superadmin');
  }
  
    public function claimRequestCompanyIndex(){
        $companiesWithCount = RequestCompany::select('company_id', \DB::raw('count(company_id) as company_count')) ->groupBy('company_id')->where('claimed_status' , '!=' , '1' )->get();
        $companies = Company::with(['requestCompanies', 'user' => function ($query) {
                        $query->where('status', 1);
                    }])->orderBy('created_at', 'desc')->get();
        return view('SuperAdmin.claim-request-company.index', compact('companiesWithCount', 'companies'));
    }


  



     public function editClaimRequestCompany($id){
        $resource = Company::where('id', $id)->first();
        $getClaimUser  = RequestCompany::where('company_id', $id)->get();
        // $company = Company::where('id', $id)->first();
        $requestCompanies = RequestCompany::where('company_id', $id)->get();
        $gettingUserDetails = [];
    
        foreach ($requestCompanies as $requestCompany) {
            $user = $requestCompany->user;
            $gettingUserDetails[] = $user;
        }

        $requestCompanies = RequestCompany::where('company_id', $id)->get();
        $userIds = $requestCompanies->pluck('user_id')->toArray();
        $userDocuments = CompanyDocument::whereIn('user_id', $userIds)->get();
        Log::info('Company documents for multiple users: ' . print_r($userDocuments, true));
        return view('SuperAdmin.claim-request-company.edit', compact('resource', 'gettingUserDetails','userDocuments'));
      }   

      public function delClaimRequest($id){
      $delClaim = RequestCompany::find($id);
      $delClaim->delete();
      return redirect()->route('claim.request.index')->with('danger', 'Claim Request deleted successfully !');
    }

    public function rejectClaimRequestUser(Request $request, $id){
         $input = $request->all();
          $claimUserReject = RequestCompany::where('user_id',$id)->first();
        if ($request->claimed_status == 1) {
            Log::info('if condition main 1 aya');
            $claimUserReject->claimed_status = $request->claimed_status;
            $claimUserReject->save();
            $userFindBlock = User::find($id);
            Log::info('user id is coming'. $userFindBlock);
            $userFindBlock->usertype = 'rejected';
            $userFindBlock->save();
            Log::info('rejected vaues store ho gaya');
        } elseif ($request->claimed_status == 0) {
            Log::info('else if condition main 0 aya');
            $claimUserReject->claimed_status = $request->claimed_status;
            $claimUserReject->save();
            $userAccepted = User::where('id', $id)->first();
            $userAccepted->usertype = 'admin';
            $userAccepted->save();
            return redirect()->route('claim.request.index')->with('success', 'Claim updated successfully');
        }
        return redirect()->route('claim.request.index')->with('success', 'Claim updated successfully');
      }
}
