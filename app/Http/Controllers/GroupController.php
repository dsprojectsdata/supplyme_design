<?php

namespace App\Http\Controllers;

use App\Events\GroupCreated;
use App\Models\Group;
use App\Models\RfqDetail;
use App\View\Components\Admin\MessageGroup;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        // $groups = Group::all();

        return view('Admin.messages');
    }

    public function store()
    {
        $group = Group::create(['name' => request('name')]);

        $users = collect(request('users'));
        $users->push(auth()->user()->id);

        $group->users()->attach($users);

        broadcast(new GroupCreated($group))->toOthers();

        return $group;
    }
    
    public function getGroup(Group $group)
    {
        $chatGroups[] = $group;
        $html =  view('components.admin.message-group', compact('chatGroups'), ['toOthers' => false])->render();

        return response()->json(['status' => SUCCESS, 'message' => 'Chat Initiated', 'data' => $html], 200);
    }
    
    public function getRfqGroups($rfqId)
    {
        if (RfqDetail::find($rfqId)) {

            $obj = new MessageGroup($rfqId, 'rfq');
            $html = view(
                    'components.admin.message-group',
                    [
                        'chatGroups' => $obj->chatGroups,
                        'toOthers' => $obj->toOthers,
                    ]
                )->render();

            return response()->json(['status' => SUCCESS, 'message' => 'rfq groups fetched successfully', 'data' => $html], 200);
        } else {

            return response()->json(['status' => SUCCESS, 'message' => 'rfq groups fetched successfully', 'data' => ''], 404);
        }


        // dd($html);
    }
}
