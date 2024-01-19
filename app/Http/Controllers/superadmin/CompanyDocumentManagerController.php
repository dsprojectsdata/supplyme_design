<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Countrie;
use Log;
use App\Models\CompanyDocumentManager;

class CompanyDocumentManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }

    public function index(){
        $companyDocManager = CompanyDocumentManager::with('Countrie')->get();
        return view('SuperAdmin.company-document-manager.index',compact('companyDocManager'));

    }

    public function create(){
        $countries = Countrie::all();
        return view('SuperAdmin.company-document-manager.create',compact('countries'));
    }

    public function editCompanyDoc($id){
        $countries = Countrie::all();
        $finddoc = CompanyDocumentManager::find($id);
        return view('SuperAdmin.company-document-manager.edit',compact('finddoc','countries'));
    }

    public function updateDocment(Request $request,$id){
        $updateJobrole = CompanyDocumentManager::find($id);
        Log::info('updateJobrole' . $updateJobrole);
        $updateJobrole->country_id =$request->country_id;
        $updateJobrole->description =$request->description;
        $updateJobrole->document_name =$request->document_name;
        $updateJobrole->document_type = implode(',',$request->document_type);
        $updateJobrole->document_required =$request->document_required;
        $updateJobrole->save();
        Log::info('comapny document update ');
        return redirect()->route('comapny.document.manager')->with('success' , ' company document type edit  successfully');  
    }

    public function storeComapnyDocument(Request $request){
        $this->validate($request, [
            'country_id'   => 'required',
            'document_name'  => 'required'
      ]);
        $company_document = new CompanyDocumentManager();
        $company_document->country_id = $request->country_id;
        $company_document->document_name = $request->document_name;
        $company_document->description = $request->description;
        $company_document->document_type = implode(',',$request->document_type);
        $company_document->document_required =$request->document_required;
        $company_document->save();
        return redirect()->route('comapny.document.manager')->with('success', 'company document type added successfully !');
    }



    public function deleteCompanyDoc($id){
        CompanyDocumentManager::destroy($id); 
        return redirect()->route('comapny.document.manager')->with('danger' , 'Company Document type deleted successfully');
      }

}
