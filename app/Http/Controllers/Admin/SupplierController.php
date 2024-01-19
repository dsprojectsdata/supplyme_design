<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyCollaboratorsGroup;
use App\Models\GroupSupplier;
use App\Models\GroupTeamMember;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $buyer_group = CompanyCollaboratorsGroup::where('company_id', $user->company_id)->get();
        return view('Admin.company-group.index')->with('buyer_list', $buyer_group);
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = auth()->user();
            $group = new CompanyCollaboratorsGroup();
            $group->name = $request->input('group_name');
            $group->description = $request->input('description');
            $group->company_id = $user->company_id;
            $group->created_by = $user->id;
            $group->save();

            $teamMembers = $request->input('team_member', []);
            foreach ($teamMembers as $teamMemberId) {
                $groupTeamMember = new GroupTeamMember();
                $groupTeamMember->company_id = $user->company_id;
                $groupTeamMember->group_id = $group->id;
                $groupTeamMember->team_member_id = $teamMemberId;
                $groupTeamMember->save();
            }

            $suppliers = $request->input('supplier', []);
            foreach ($suppliers as $supplierId) {
                $groupSupplier = new GroupSupplier();
                $groupSupplier->supplier_id = $supplierId;
                $groupSupplier->group_id = $group->id;
                $groupSupplier->status = 2;
                $groupSupplier->save();
            }

            DB::commit();

            return back()->with('success', 'Supplier network group created successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'An error occurred while creating the supplier network group.');
        }
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

            return back()->with('success', 'Supplier network group updated successfully.');
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
    
    public function getAll(Request $request)
    {
        $query = Company::query();
        if ($request->supplier_name) {
            $query =$query->where('company_name', 'like', '%' . $request->supplier_name . '%');
        }
        $suppliers = $query->where('id' , '<>', auth()->user()->company_id)->select('id', 'company_name')->get();

        return response()->json(['status' => SUCCESS, 'data' => $suppliers, 'message' => 'Suppliers retrieved']);
    }
}
