<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\UpdateInvitesMembersEmail;
use App\Models\verifyinvitesmemberstoken;
use App\Jobs\InvitesMembersEmail;
use App\Models\Jobrole;
use App\Models\User;


class GuestController extends Controller
{

    public function getInviteMember($validToken){
        $validToken = User::where('usertoken', '=',$validToken)->first();
        $jobroles = Jobrole::all();
       
        if($validToken){
            $coursetoken=$validToken->usertoken;
            $getEmail= $validToken->email;
            
            return view('Admin.invite-mail.activation',compact('validToken','getEmail','jobroles'));
        }
        else{
            return view('Admin.invite-mail.invalidrequest');
        }

    }
}
