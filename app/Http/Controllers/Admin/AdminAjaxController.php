<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CcgFeed;
use App\Models\Company;
use App\Models\CompanyCollaboratorsGroup;
use App\Models\GroupSupplier;
use App\Models\GroupTeamMember;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AdminAjaxController extends Controller
{
    public function search_company(Request $request)
    {
        $query = $request->input('query');
        $user = Auth::user();
        $user = auth()->user();
        if ($request->has('buyer_group_id')) {
            $buyer_group_id = $request->input('buyer_group_id');
            
            $supplierIds = GroupSupplier::where('group_id', $buyer_group_id)->pluck('supplier_id');

            $queryBuilder = Company::where('id','!=',$user->company_id)->where('enabled',1)->where('id', '<>', $user->company_id) ->where('company_name', 'LIKE', "%$query%")->whereNotIn('id', $supplierIds);
        } else {
            $queryBuilder = Company::where('id','!=',$user->company_id)->where('enabled',1)->where('id', '<>', $user->company_id)
                ->where('company_name', 'LIKE', "%$query%");
        }

        $results = $queryBuilder->distinct()->pluck('id', 'company_name');

        return response()->json($results);
    }
    public function search_team_member(Request $request)
    {
        $user = auth()->user();
        $query = $request->input('query');

        if ($request->has('buyer_group_id')) {
            $buyer_group_id = $request->input('buyer_group_id');

            $teamMembersInGroup = GroupTeamMember::where(
                ['group_id' => $buyer_group_id, 'company_id' => $user->company_id]
            )->pluck('team_member_id');
            $queryBuilder = User::where('company_id', $user->company_id)
                ->where('id', '<>', $user->id)
                ->where('Jobrole_id', '<>', NULL)
                ->where(DB::raw("CONCAT(firstname,' ',lastname)"), 'LIKE', "%$query%")
                ->whereNotIn('id', $teamMembersInGroup);
        } else {
            $queryBuilder = User::where('company_id', $user->company_id)
                ->where('id', '<>', $user->id)
                ->where('Jobrole_id', '<>', NULL)
                ->where(DB::raw("CONCAT(firstname,' ',lastname)"), 'LIKE', "%$query%");
        }

        $results = $queryBuilder->distinct()
            ->pluck('id', DB::raw("CONCAT(firstname,' ',lastname)"));

        return response()->json($results);
    }

    public function validateGroup(Request $request)
    {
        $request->validate([
            'group_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'team_member' => 'required|array',
            'team_member.*' => 'required|integer|exists:users,id',
            'supplier' => 'required|array',
            'supplier.*' => 'required|integer|exists:companies,id',
        ]);

        return response()->json(['success' => true]);
    }
    public function validateSupplierTeam(Request $request)
    {
        $request->validate([
            'team_member' => 'required|array',
            'team_member.*' => 'required|integer|exists:users,id',
        ]);

        return response()->json(['success' => true]);
    }
    public function supplier_info(Request $request)
    {
        $groupId = $request->input('group_id');
        $companyId = auth()->user()->company_id;

        $groupWithSuppliers = CompanyCollaboratorsGroup::with([
            'collaboratorsGroups' => function ($query) use ($companyId) {
                $query->where('supplier_id', $companyId);
            },
            'suppliers:id,group_suppliers.id as group_suppliers_id,company_name',
            'company:id,company_name',
            'supplierTeamMembers:group_team_members.id,firstname,lastname'
        ])
            ->where('id', $groupId)
            ->first();
        $buyerTeamMembers = GroupTeamMember::with('teamMembers:id,firstname,lastname')
            ->where(['company_id' => $groupWithSuppliers->company_id, 'group_id' => $groupId])
            ->get();

        $collaboratorsGroups = $groupWithSuppliers->collaboratorsGroups;

        $statusOneExists = false;

        foreach ($collaboratorsGroups as $collaboratorsGroup) {
            if ($collaboratorsGroup->status === 1) {
                $statusOneExists = true;
                break;
            }
        }
        if ($statusOneExists) {
            $htmlContent = View::make(
                'Admin.company-group.component.supplier',
                [
                    'supply' => $groupWithSuppliers,
                    'buyer_team_member' => $buyerTeamMembers ?? [],
                ]
            )->render();
        } else {
            $htmlContent = View::make('Admin.company-group.component.supplier-request', ['supply' => $groupWithSuppliers])->render();
        }

        $ccg_feeds = CcgFeed::where(['company_collaborator_group_id' => $groupId])->get();

        $htmlFeed = view('components.admin.group-feed', compact('ccg_feeds'))->render();

        return response()->json(['html' => $htmlContent, 'feedHtml' => $htmlFeed]);
    }
    public function deleteSupplierTeamMember($id)
    {
        $teamMember = GroupTeamMember::where('company_id', auth()->user()->company_id)->find($id);

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
    public function deleteBuyerTeamMember($id)
    {
        $teamMember = GroupTeamMember::where('company_id', auth()->user()->company_id)->find($id);

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
    public function deleteSupplier(Request $request)
    {
        try {
            $group_id = $request->input('group_id');
            $supplier_id = $request->input('supplier_id');

            $deleteSupplier = GroupSupplier::where('group_id', $group_id)
                ->where('id', $supplier_id)
                ->first();
            if ($deleteSupplier) {
                GroupTeamMember::where('group_id', $group_id)
                    ->where('company_id', $deleteSupplier->supplier_id)
                    ->delete();
            }

            $deleteSupplier->delete();

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }


    public function buyer_info(Request $request)
    {
        $groupId = $request->input('group_id');
        $companyId = auth()->user()->company_id;

        $groupWithSuppliers = CompanyCollaboratorsGroup::with([
            'company:id,company_name',
            'buyerTeamMembers:group_team_members.id,firstname,lastname'
        ])
            ->where('id', $groupId)
            ->first();
        // dd($groupWithSuppliers->toArray());
        $suppliers = GroupSupplier::with(['supplier'])
            ->where('group_id', $groupId)
            ->where('supplier_id', '<>', $companyId)
            ->get()
            ->groupBy('status');

        $pendingSuppliers = $suppliers->get(2, collect());
        $approvedSuppliers = $suppliers->get(1, collect());
        $rejectedSuppliers = $suppliers->get(0, collect());

        // dd($pendingSuppliers->toArray());
        $ccg_feeds = CcgFeed::where(['company_collaborator_group_id' => $groupId])->latest('id')->get();
        
        $questionnaireLink = route('feed.questionnaires', [$groupId]);

        $htmlFeed = view('components.admin.group-feed', compact('ccg_feeds'))->render();
        
        $htmlContent = View::make(
            'Admin.company-group.component.buyer-modify',
            [
                'buyer' => $groupWithSuppliers,
                'pendingSuppliers' => $pendingSuppliers,
                'rejectedSuppliers' => $rejectedSuppliers,
                'approvedSuppliers' => $approvedSuppliers
            ]
        )->render();

        return response()->json(['html' => $htmlContent, 'feedHtml' => $htmlFeed, 'questionnaireLink' => $questionnaireLink]);
    }
    public function save_group_info(Request $request)
    {
        try {
            $groupId = $request->input('group_id');
            $companyId = auth()->user()->company_id;

            $groupWithSuppliers = CompanyCollaboratorsGroup::where('id', $groupId)
                ->where('company_id', $companyId)
                ->first();

            if (!$groupWithSuppliers) {
                throw new Exception('Group not found or unauthorized');
            }

            if ($request->has('group_name')) {
                $groupWithSuppliers->name = $request->input('group_name');
            }

            if ($request->has('group_description')) {
                $groupWithSuppliers->description = $request->input('group_description');
            }
            $groupWithSuppliers->save();

            return response()->json(['success' => true, 'message' => 'Group information updated successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
