<?php

namespace App\Traits;

use App\Models\RfqDetail;
use App\Models\Group; // chat group model
use App\Events\GroupCreated; // group created event
use App\Models\Company;
use App\Models\RfqSupplierRequest;
use Illuminate\Support\Facades\Log;

trait RfqTrait {

    public static function createGroup($rfqId, $supplierId)
    {
        $rfqDetails = RfqDetail::find($rfqId);
        $identifier = "group-" . $rfqId . "-" .$supplierId;
        try {
            //code...
            $newGroup = Group::where('identifier', $identifier)->first();
            if (!$newGroup) {
                $newGroup = new Group();
                $newGroup->identifier = "group-" . $rfqId . "-" .$supplierId;
                $newGroup->display_name = Company::find($supplierId)->company_name;
                $newGroup->rfq_id = $rfqId;
                $newGroup->supplier_id = $supplierId;
                $newGroup->partner_id = $rfqDetails->company_id;
                $newGroup->partner_id_1 = $supplierId;
                $newGroup->partner_name = $rfqDetails->company->company_name;
                $newGroup->partner_name_1 = Company::find($supplierId)->company_name;
                $newGroup->save();
            }
            $memberIds = empty(trim($rfqDetails->add_tem_member)) ? [] : explode(',', $rfqDetails->add_tem_member);
            $rfqSupplier = RfqSupplierRequest::where('rfqdetail_id',$rfqId)->where('supplier_id',$supplierId)->first();
            $supplierMemeberIds = empty(trim($rfqSupplier->team_member)) ? [] : explode(',', $rfqSupplier->team_member);
            array_push($memberIds, $rfqDetails->user_id);
            $allMembers = array_merge($memberIds, $supplierMemeberIds);
            self::updateGroupMembers($newGroup->id, $allMembers);

        } catch (\Throwable $th) {
            //throw $th;
            Log::debug($th->getMessage());

            return false;
        }
        
        return true;
    }
    
    public static function createOpenGroup($supplierId)
    {
        $initiaterId = auth()->user()->company_id;
        $dataValue = array($initiaterId, $supplierId);
        sort($dataValue);
        $identifier = "general-" . $dataValue[0] . "-" .$dataValue[1];

        try {
            //code...
            $newGroup = Group::where('identifier', $identifier)->first();
            if (!$newGroup) {
                $newGroup = new Group();
                $newGroup->identifier = $identifier;
                $newGroup->display_name = null;
                $newGroup->supplier_id = $dataValue[0];
                $newGroup->partner_id = $dataValue[0];
                $newGroup->partner_id_1 = $dataValue[1];
                $newGroup->partner_name = Company::find($dataValue[0])->company_name;
                $newGroup->partner_name_1 = Company::find($dataValue[1])->company_name;
                $newGroup->save();
            }

            $teamMembers0 = Company::find($dataValue[0])->teamMembers->pluck('id')->toArray();
            $teamMembers1 = Company::find($dataValue[1])->teamMembers->pluck('id')->toArray();
            array_push($teamMembers0, auth()->id());
            $allMembers = array_merge($teamMembers0, $teamMembers1);
            self::updateGroupMembers($newGroup->id, $allMembers);
            $group = Group::find($newGroup->id);
            return $group;
        } catch (\Throwable $th) {
            //throw $th;
            Log::debug($th->getMessage());

            return false;
        }
    }

    public static function updateGroupMembers(int $groupId, array $userIds = [])
    {
        $group = Group::find($groupId);
        $users = collect($userIds);
        $users->push(auth()->user()->id);
        $group->users()->sync($users, true);
        broadcast(new GroupCreated($group))->toOthers();

        return true;
    }
}