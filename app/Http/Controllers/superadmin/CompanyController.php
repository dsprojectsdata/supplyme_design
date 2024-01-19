<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\AnnualRevenue;
use App\Models\Certification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Countrie;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use App\Models\CompanyType;
use App\Models\CompanyDocument;
use App\Models\Currency;
use App\Models\Industry;
use App\Models\Follows;
use App\Models\NumberOfEmployees;
use App\Models\ProfilePositions;
use App\Models\TypeOfOffering;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Toastr;


class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companys = Company::orderBy('id', 'desc')->where('company_approve_status', 'accepted')->get();
        return view('SuperAdmin.company.index', compact('companys'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $company = Company::with(['user', 'City', 'State', 'Countrie', 'companyLocations', 'companyprofile', 'companyprofilebrandlogos', 'companyproductandservices','companyprofilecustomerandclients'])->find($id);
        $image = CompanyDocument::where('company_id', $company->id)->get();
        $followers = Follows::where('follow_id',$id)->get()->count();
        if($company->user){
            $teamMembers = User::where('company_id', $company->id)->where('id','!=',$company->user->id)->where('status','0')->get();
        }
        else{
            $teamMembers = [];
        }
        return view('SuperAdmin.company.view', compact('company', 'image','teamMembers','followers'));
    }
    

    public function edit($id)
    {
        //    
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function claimed_status($id)
    {
        $Company = Company::find($id);
        if ($Company->claimed_status == 1) {
            $Company->claimed_status = 0;
        } else {
            $Company->claimed_status = 1;
        }
        $Company->save();
        return $Company->claimed_status;
    }

    public function status($id)
    {
        $Company = Company::find($id);
        if ($Company->enabled == 1) {
            $Company->enabled = 0;
        } else {
            $Company->enabled = 1;
        }
        $Company->save();
        return $Company->enabled;
    }

    public function Approved_Status($id)
    {
        $Company = Company::find($id);
        if ($Company->company_approve_status == 1) {
            $Company->company_approve_status = 0;
        } else {
            $Company->company_approve_status = 1;
        }
        $Company->save();
        return $Company->company_approve_status;
    }


    public function companyType()
    {
        $getCompanyType = CompanyType::orderBy('type_name')->get();
        return view('SuperAdmin.company-type.index', compact('getCompanyType'));
    }

    public function createCompanyType()
    {
        return view('SuperAdmin.company-type.create');
    }

    public function storeCompanyType(Request $request)
    {
        $validator = $request->validate([
            'type_name' => 'required',

        ]);
        $companyType = new CompanyType();
        $companyType->type_name = $request->type_name;
        $companyType->save();
        Log::info('data store successsfully');
        return redirect()->route('company.companyType')->with('success', 'company type store successfully');
    }

    public function editCompanyType($id)
    {
        $findCompanyType = CompanyType::find($id);
        return view('SuperAdmin.company-type.edit', compact('findCompanyType'));
    }

    public function updateCompanyType(Request $request, $id)
    {
        $updateCompanyType = CompanyType::find($id);
        $updateCompanyType->type_name = $request->type_name;
        $updateCompanyType->save();
        return redirect()->route('company.companyType')->with('success', 'company type update successfully');
    }

    public function deleteCompanyType($id)
    {
        $CompanyType = CompanyType::find($id);
        $CompanyType->delete();
        return redirect()->route('company.companyType')->with('danger', 'company type deleted successfully');
    }

    // Annual Revenue

    public function annualRevenue($slug = '')
    {
        $single_info = new AnnualRevenue();
        if ($slug) {
            $single_info = AnnualRevenue::where('slug', $slug)->firstOrFail();
            return view('SuperAdmin.store.annual-revenue.index', compact('single_info'));
        } else {
            $all_info = AnnualRevenue::orderBy('created_at', 'DESC')->get();
            return view('SuperAdmin.store.annual-revenue.index', compact('all_info', 'single_info'));
        }
    }

    public function annualRevenueSave(Request $req, $slug = '')
    {
        if ($slug) {
            $req->validate(
                [
                    'name' => 'required|max:15',
                ]
            );
        } else {
            $req->validate(
                [
                    'name' => 'required|max:15',
                ]
            );
        }

        $input = $req->input();
        if ($slug) {
            $data = AnnualRevenue::where('slug', $slug)->firstOrFail();
            $msg = 'Data has been Update successfully!';
        } else {
            $data = new AnnualRevenue;
            $msg = "Data has been saved successfully!";
        }

        $data->annual_revenue = $input['name'];
        $data->slug = Str::of($input['name'])->slug('-');

        if ($data->save()) {
            toastr()->success($msg);
            return redirect()->route('company.getStoreAnnualRevenue');
        } else {
            toastr()->error('Oops! Something went wrong!');
            return redirect()->back();
        }
    }
    public function deleteAnnualRevenue($id = null)
    {
        $data = AnnualRevenue::findOrFail($id);
        if ($data) {
            $data->delete();
            toastr()->success('Data Delete Successfully');
            return redirect()->route('company.getStoreAnnualRevenue');
        }
        toastr()->success('Error in Delete Data');
        return redirect()->route('company.getStoreAnnualRevenue');
    }

    // Certificate

    public function certificate($slug = '')
    {
        $single_info = new Certification();
        if ($slug) {
            $single_info = Certification::where('slug', $slug)->firstOrFail();
            return view('SuperAdmin.store.certification.index', compact('single_info'));
        } else {
            $all_info = Certification::orderBy('created_at', 'DESC')->get();
            return view('SuperAdmin.store.certification.index', compact('all_info', 'single_info'));
        }
    }

    public function certificateSave(Request $req, $slug = '')
    {
        if ($slug) {
            $req->validate(
                [
                    'name' => 'required|max:15',
                ]
            );
        } else {
            $req->validate(
                [
                    'name' => 'required|max:15',
                ]
            );
        }

        $input = $req->input();
        if ($slug) {
            $data = Certification::where('slug', $slug)->firstOrFail();
            $msg = 'Data has been Update successfully!';
        } else {
            $data = new Certification;
            $msg = "Data has been saved successfully!";
        }

        $data->certification = $input['name'];
        $data->slug = Str::of($input['name'])->slug('-');

        if ($data->save()) {
            toastr()->success($msg);
            return redirect()->route('company.getStoreCertificate');
        } else {
            toastr()->error('Oops! Something went wrong!');
            return redirect()->back();
        }
    }
    public function deleteCertificate($id = null)
    {
        $data = Certification::findOrFail($id);
        if ($data) {
            $data->delete();
            toastr()->success('Data Delete Successfully');
            return redirect()->route('company.getStoreCertificate');
        }
        toastr()->success('Error in Delete Data');
        return redirect()->route('company.getStoreCertificate');
    }

    // Currencies

    public function currencies($slug = '')
    {
        $single_info = new Currency();
        if ($slug) {
            $single_info = Currency::where('slug', $slug)->firstOrFail();
            return view('SuperAdmin.store.currencies.index', compact('single_info'));
        } else {
            $all_info = Currency::orderBy('created_at', 'DESC')->get();
            return view('SuperAdmin.store.currencies.index', compact('all_info', 'single_info'));
        }
    }

    public function currenciesSave(Request $req, $slug = '')
    {
        if ($slug) {
            $req->validate(
                [
                    'name' => 'required|max:15',
                ]
            );
        } else {
            $req->validate(
                [
                    'name' => 'required|max:15',
                ]
            );
        }

        $input = $req->input();
        if ($slug) {
            $data = Currency::where('slug', $slug)->firstOrFail();
            $msg = 'Data has been Update successfully!';
        } else {
            $data = new Currency;
            $msg = "Data has been saved successfully!";
        }

        $data->currency = $input['name'];
        $data->slug = Str::of($input['name'])->slug('-');

        if ($data->save()) {
            toastr()->success($msg);
            return redirect()->route('company.getStoreCurrencies');
        } else {
            toastr()->error('Oops! Something went wrong!');
            return redirect()->back();
        }
    }
    public function deleteCurrencies($id = null)
    {
        $data = Currency::findOrFail($id);
        if ($data) {
            $data->delete();
            toastr()->success('Data Delete Successfully');
            return redirect()->route('company.getStoreCurrencies');
        }
        toastr()->success('Error in Delete Data');
        return redirect()->route('company.getStoreCurrencies');
    }

    // Industries

    public function industries($slug = '')
    {
        $single_info = new Industry();
        if ($slug) {
            $single_info = Industry::where('slug', $slug)->firstOrFail();
            return view('SuperAdmin.store.industries.index', compact('single_info'));
        } else {
            $all_info = Industry::orderBy('created_at', 'DESC')->get();
            return view('SuperAdmin.store.industries.index', compact('all_info', 'single_info'));
        }
    }

    public function industriesSave(Request $req, $slug = '')
    {
        if ($slug) {
            $req->validate(
                [
                    'name' => 'required|max:15',
                ]
            );
        } else {
            $req->validate(
                [
                    'name' => 'required|max:15',
                ]
            );
        }

        $input = $req->input();
        if ($slug) {
            $data = Industry::where('slug', $slug)->firstOrFail();
            $msg = 'Data has been Update successfully!';
        } else {
            $data = new Industry;
            $msg = "Data has been saved successfully!";
        }

        $data->industry = $input['name'];
        $data->slug = Str::of($input['name'])->slug('-');

        if ($data->save()) {
            toastr()->success($msg);
            return redirect()->route('company.getStoreIndustries');
        } else {
            toastr()->error('Oops! Something went wrong!');
            return redirect()->back();
        }
    }
    public function deleteIndustries($id = null)
    {
        $data = Industry::findOrFail($id);
        if ($data) {
            $data->delete();
            toastr()->success('Data Delete Successfully');
            return redirect()->route('company.getStoreIndustries');
        }
        toastr()->success('Error in Delete Data');
        return redirect()->route('company.getStoreIndustries');
    }
    // NumberOfEmployee

    public function numberOfEmployee($slug = '')
    {
        $single_info = new NumberOfEmployees();
        if ($slug) {
            $single_info = NumberOfEmployees::where('slug', $slug)->firstOrFail();
            return view('SuperAdmin.store.number-of-employee.index', compact('single_info'));
        } else {
            $all_info = NumberOfEmployees::orderBy('created_at', 'DESC')->get();
            return view('SuperAdmin.store.number-of-employee.index', compact('all_info', 'single_info'));
        }
    }

    public function numberOfEmployeeSave(Request $req, $slug = '')
    {
        if ($slug) {
            $req->validate(
                [
                    'name' => 'required|max:15',
                ]
            );
        } else {
            $req->validate(
                [
                    'name' => 'required|max:15',
                ]
            );
        }

        $input = $req->input();
        if ($slug) {
            $data = NumberOfEmployees::where('slug', $slug)->firstOrFail();
            $msg = 'Data has been Update successfully!';
        } else {
            $data = new NumberOfEmployees;
            $msg = "Data has been saved successfully!";
        }

        $data->number_of_employee = $input['name'];
        $data->slug = Str::of($input['name'])->slug('-');

        if ($data->save()) {
            toastr()->success($msg);
            return redirect()->route('company.getStoreNumberOfEmployee');
        } else {
            toastr()->error('Oops! Something went wrong!');
            return redirect()->back();
        }
    }
    public function deleteNumberOfEmployee($id = null)
    {
        $data = NumberOfEmployees::findOrFail($id);
        if ($data) {
            $data->delete();
            toastr()->success('Data Delete Successfully');
            return redirect()->route('company.getStoreNumberOfEmployee');
        }
        toastr()->success('Error in Delete Data');
        return redirect()->route('company.getStoreNumberOfEmployee');
    }
    // ProfilePositions

    public function profilePositions($slug = '')
    {
        $single_info = new ProfilePositions();
        if ($slug) {
            $single_info = ProfilePositions::where('slug', $slug)->firstOrFail();
            return view('SuperAdmin.store.profile-position.index', compact('single_info'));
        } else {
            $all_info = ProfilePositions::orderBy('created_at', 'DESC')->get();
            return view('SuperAdmin.store.profile-position.index', compact('all_info', 'single_info'));
        }
    }

    public function profilePositionsSave(Request $req, $slug = '')
    {
        if ($slug) {
            $req->validate(
                [
                    'name' => 'required|max:15',
                ]
            );
        } else {
            $req->validate(
                [
                    'name' => 'required|max:15',
                ]
            );
        }

        $input = $req->input();
        if ($slug) {
            $data = ProfilePositions::where('slug', $slug)->firstOrFail();
            $msg = 'Data has been Update successfully!';
        } else {
            $data = new ProfilePositions;
            $msg = "Data has been saved successfully!";
        }

        $data->profile_position = $input['name'];
        $data->slug = Str::of($input['name'])->slug('-');

        if ($data->save()) {
            toastr()->success($msg);
            return redirect()->route('company.getStoreProfilePositions');
        } else {
            toastr()->error('Oops! Something went wrong!');
            return redirect()->back();
        }
    }
    public function deleteProfilePositions($id = null)
    {
        $data = ProfilePositions::findOrFail($id);
        if ($data) {
            $data->delete();
            toastr()->success('Data Delete Successfully');
            return redirect()->route('company.getStoreProfilePositions');
        }
        toastr()->success('Error in Delete Data');
        return redirect()->route('company.getStoreProfilePositions');
    }
    
    
    public function statusTeamMember($id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }
        $teamMembers = User::where('company_id', $company->id)->where('id', '!=', $company->user->id)->get();
        if (!$teamMembers) {
            return response()->json(['error' => 'Team members not found'], 404);
        }
        foreach ($teamMembers as $teamMember) {
            if ($teamMember->team_member_status == 1) {
                $teamMember->team_member_status = 0;
            } else {
                $teamMember->team_member_status = 1;
            }
            $teamMember->save();
        }
        return response()->json(['team_member_status' => $teamMembers->pluck('team_member_status')]);
    }


}
