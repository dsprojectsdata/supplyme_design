<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\CompanyCollaboratorsGroup;
use App\Models\Companyprofilecustomerandclient;
use App\Models\GroupSupplier;
use App\Models\GroupTeamMember;
use App\Models\AnnualRevenue;
use App\Models\User;
use App\Models\SupplierGroup;
use App\Models\Follows;
use App\Models\NewsFeed;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class SupplierGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = auth()->user();
        $user_id = Auth::user()->id;
        $company_id = Company::where('id',$user->company_id)->first();
        $buyer_group = SupplierGroup::where('company_id',$company_id->id)->get();
        //$buyer_group = SupplierGroup::where('company_id', $user->company_id)->get();
        return view('Admin.supplier-group.index')->with('buyer_list', $buyer_group);
    }
  
    public function store(Request $request)
    {
        $user = auth()->user();
        $group = new SupplierGroup();
        $group->name = $request->input('group_name');
        $group->company_id = $user->company_id;
        $group->created_by = $user->id;
        $group->supplier_id = implode(',', $request->supplier);
        $group->save();
         return redirect()->route('admin.supplier.group')->with('success', 'Supplier group is created.');
        
    }
  
  
      public function create()
      {
         
          $buyer_list = SupplierGroup::all();
          return view('Admin.supplier-group.create', compact('buyer_list'));
      }
  
    public function updateBuyerGroup(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $user = auth()->user();

            $group = CompanyCollaboratorsGroup::find($id);

            if (!$group) {
                return back()->with('error', 'Supplier network group not found.');
            }

            $editTeamMembers = $request->input('edit_team_member', []);

            foreach ($editTeamMembers as $teamMemberId) {
                $groupTeamMember = new GroupTeamMember();
                $groupTeamMember->company_id = $user->company_id;
                $groupTeamMember->group_id = $group->id;
                $groupTeamMember->team_member_id = $teamMemberId;
                $groupTeamMember->save();
            }

            $editSuppliers = $request->input('edit_supplier', []);

            foreach ($editSuppliers as $supplierId) {
                $groupSupplier = new GroupSupplier();
                $groupSupplier->supplier_id = $supplierId;
                $groupSupplier->group_id = $group->id;
                $groupSupplier->status = 2;
                $groupSupplier->save();
            }

            DB::commit();

            return back()->with('success', 'Supplier  group updated successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'An error occurred while updating the supplier network group.');
        }
    }

    public function suppliers()
    {
        $companyId = auth()->user()->company_id;

        // dd($companyId);
        $groupsWithSuppliers = CompanyCollaboratorsGroup::whereHas('collaboratorsGroups', function ($query) use ($companyId) {
            $query->where('supplier_id', $companyId);
            $query->whereIn('status', [1, 2]);
        })->with(['supplierStatus' => function ($query) use ($companyId) {
            $query->where('supplier_id', $companyId);
        }])->get();
        // dd($groupsWithSuppliers->toArray());
        return view('Admin.company-group.supplier')->with('supplier_list', $groupsWithSuppliers);
    }
  
    public function supplierReject($id)
    {
        try {
            $companyId = auth()->user()->company_id;

            $group = GroupSupplier::where(['group_id' => $id, 'supplier_id' => $companyId])->first();

            if ($group) {
                $group->status = 0;
                $group->save();

                return redirect()->back()->with('success', 'Group rejected successfully.');
            } else {
                return redirect()->back()->with('error', 'Group not found or you do not have permission to reject it.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while rejecting the group.');
        }
    }
  
    public function storeSupplierTeam(Request $request, $id)
    {
        try {
            $company_id = auth()->user()->company_id;

            foreach ($request->input('team_member') as $team_member_id) {
                $groupTeamMember = new GroupTeamMember();
                $groupTeamMember->group_id = $id;
                $groupTeamMember->company_id = $company_id;
                $groupTeamMember->team_member_id = $team_member_id;
                $groupTeamMember->save();
            }

            $group = GroupSupplier::where(['group_id' => $id, 'supplier_id' => $company_id])->first();

            if ($group) {
                $group->status = 1;
                $group->save();
            }

            return redirect()->back()->with('success', 'Team member added successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while adding the team member.');
        }
    }

    public function save_group_infoSupplier(Request $request)
    {
        try {
            $groupId = $request->input('group_id');
            $companyId = auth()->user()->company_id;

            $groupWithSuppliers = SupplierGroup::where('id', $groupId)
                ->where('company_id', $companyId)
                ->first();

            if (!$groupWithSuppliers) {
                throw new Exception('Group not found or unauthorized');
            }

            if ($request->has('group_name')) {
                $groupWithSuppliers->name = $request->input('group_name');
            }

            $groupWithSuppliers->save();

            return response()->json(['success' => true, 'message' => 'Group information updated successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteSupplierTeamMember_Supplier($id)
    {
        $teamMember = SupplierGroup::where('company_id', auth()->user()->company_id)->find($id);

        if (!$teamMember) {
            return response()->json(['error' => 'Team member not found.'], 404);
        }
        try {
            $teamMember->delete();
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the team member.'], 500);
        }
    }

    public function buyer_info_Supplier(Request $request)
    {
        $groupId = $request->group_id;
        $companyId = auth()->user()->company_id;
        $groupWithSuppliers = SupplierGroup::where('id',$groupId)->first();
        
        $suppli = explode(',',$groupWithSuppliers['supplier_id']);
        $Company = Company::whereIn('id', $suppli)->get(); 
        $htmlContent = view('Admin.supplier-group.getSuppler', compact('Company', 'groupWithSuppliers', 'suppli'))->render();

        return response()->json(['html' => $htmlContent]);
        
       
    }
  
  
    public function companyProfileShow($id)
    {
        try {
            DB::beginTransaction();
            $company = Company::where('id', $id)
                ->with('user', 'companyprofile', 'companyLocations', 'companyproductandservices', 'companyprofilebrandlogos', 'companyproductandservicesWithRelationships','companyprofilecustomerandclients')
                ->first();
            $user_id = Auth::user()->id;
            $user = Auth::user();
            $company_id = Company::with('user')->where('id', $user->company_id)->first();
            $follows = Follows::where('user_id', $user_id)->where('company_id', $company_id->id)->where('follow_id', $id)->first();
            $followsCount = Follows::where('follow_id',$user->company_id)->get()->count();
            $companyprofile = CompanyProfile::where('company_id',$id)->first();
            $posts =  NewsFeed::where('company_id',$id)->limit(5)->get();
            if ($company) {
                DB::commit();
                return view('Admin.company-profile.company-view', compact('company', 'follows','companyprofile','followsCount','posts'));
            } else {
                DB::commit();
                return back()->with('error', 'Company not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'An error occurred.$e->getMessage()');
        }
    }


    public function viewProductCatelog()
    {   
        $catelog = CompanyProfile::all();
        return view('Admin.company-profile.view-product-catelog',compact('catelog'));
    }
    
    
    
    public function companyProfileDelete(Request $request)
    {
        $groupId = $request->group_id;
        $group = SupplierGroup::find($groupId);
    
        if (!$group) {
            // return response()->json(['error' => 'Record not found'], 404);
            return back()->with('error', 'Record not found');
        }
    
        $supplierIds = explode(',', $group->supplier_id);
        $updatedSupplierIds = array_diff($supplierIds, [$request->company_id]);
        $group->supplier_id = implode(',', $updatedSupplierIds);
    
        if (empty($updatedSupplierIds)) {
            $group->forceDelete();
            // return response()->json(['success' => 'Record deleted successfully']);
            return back()->with('success', 'Record deleted successfully');
        } else {
            $group->save();
            // return response()->json(['success' => 'Supplier removed from the group']);
            return back()->with('success', 'Supplier removed from the group');
        }
    }
    
    
    public function supplierGroupCompanyAdd(Request $request)
    {
        // dd($request->all());
        $user = auth()->user();
        $group = SupplierGroup::findOrFail($request->group_id);
        $oldCompanies = explode(',', $group->supplier_id);
        $newCompanies = $request->input('supplier');
        $combinedCompanies = array_merge($oldCompanies, $newCompanies);
        $uniqueCompanies = array_unique($combinedCompanies);
        $group->supplier_id = implode(',', $uniqueCompanies);
        $group->save();
        return back()->with('success', 'New company added successfully.');
    }


    










    

}
