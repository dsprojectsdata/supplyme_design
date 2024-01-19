<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inviteteam;
use App\Models\verifyinvitesmemberstoken;
use App\Jobs\InvitesMembersEmail;
use App\Jobs\UpdateInvitesMembersEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Countrie;
use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use Log;
use Hash;
use App\Models\Jobrole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log as FacadesLog;

class InviteteamController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }


    public function index()
    {
        $user = Auth::user();
        $verifyUser = VerifyInvitesMembersToken::where('authorized_id', Auth::user()->id)->where('status','0')->get();
        $teams =  User::where('company_id',$user->company_id)->where('status','!=','1')->get();
        foreach($teams as $team){
            if($team->Jobrole_id){
                $Jobrole = Jobrole::where('id',$team->Jobrole_id)->first();
                if($team->role_id){
                    $roles = Role::where('id',$team->role_id)->first();
                    $team->userrole_name = $roles->role_name ?? ' ';
                }
                else{
                    $team->userrole_name = ' ';
                    $roles = [];
                }
                $team->jobrole_name = $Jobrole->role_name ?? '';
                
            }
            else{
                $team->jobrole_name = '' ;
                $roles = [];
            }
            
        }
        return view('Admin.invite-members.index', compact('verifyUser','teams','roles'));
    }

    public function invitesMembers(Request $request)
    {
         $company_id = Auth::user()->company_id;
          $emails = $request->email;
          $email_user = explode(',',$emails);
          foreach($email_user as $key=>$email){
              $validToken = sha1(time()) . rand();
              $user = User::where('email',$email)->first();
              if($user ){
                  return back()->with('success', 'this '.$email.' address is already registered');
              }
              else{
                  $user = new User();
                  $user->email = $email;
                  $user->company_id = $company_id;
                  $user->usertype = 'subadmin';
                  $user->usertoken = $validToken;
                  $user->save();
                  
                $to = $email;
                $view = view('Admin.invite-mail.invite-email-template', compact('validToken'))->render();
                $subject = "Supply-me";
                $txt = $view;
                $from_email = "info@supplyme.com"; // Change this to your valid domain
        
                $headers = "From: $from_email" . "\r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
                echo $txt;
                mail($to, $subject, $txt, $headers);
              }
          }
          
        // InvitesMembersEmail::dispatch($validToken,$demail)->delay(now()->addSeconds(10));

       
        return redirect()->route('invites-members.create')->with('success', 'Mail has been sent successfully!');
    }

    public function getInviteMember($validToken)
    {

        $validToken = verifyinvitesmemberstoken::where('token', '=', $validToken)->first();

        if ($validToken) {
            $coursetoken = $validToken->token;
            $getEmail = $validToken->email;

            return view('Admin.invite-mail.activation', compact('validToken', 'getEmail'));
        } else {
            return view('Admin.invite-mail.invalidrequest');
        }
    }


    public function updateInvitesMembers(Request $request, $id)
    {
        $getNameEmail = Auth::user()->email;
        $parts = explode('@', $getNameEmail);
        $updateName = $parts[0];
        $updateValidToken = sha1(time()) . rand();
        $editToken = verifyinvitesmemberstoken::find($id);
        $editToken->token =  $updateValidToken;
        $editToken->email =  $request->email;
        $editToken->status =  '0';
        $editToken->authorized_id = Auth::user()->id;
        $editToken->authorized_email =  Auth::user()->email;
        $editToken->authorized_name =  $updateName;
        $editToken->save();
        $updateEmail = $request->email;
        // UpdateInvitesMembersEmail::dispatch($updateValidToken,$updateEmail)->delay(now()->addSeconds(10));

        $to = $updateEmail;
        $view = view('Admin.invite-mail.update-invite-email-template', compact('updateValidToken'))->render();
        $subject = "Supply-me";
        $txt = $view;
        $from_email = "info@supplyme.com"; // Change this to your valid domain

        $headers = "From: $from_email" . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
        echo $txt;
        mail($to, $subject, $txt, $headers);

        return redirect()->route('invites-members.create')->with('success', 'update Invites Members successfully');
    }

    public function editInvitesMembers(Request $request, $id)
    {
        $user = Auth::user();
        $userProfile =  user::find($id);
        $jobroles = Jobrole::get();
        $roles = Role::where('company_id',$user->company_id)->get();
        return view('Admin.invite-members.edit', compact('userProfile','jobroles','roles'));
    }

    public function deleteInvitesMembers(Request $request, $id)
    {
        $delinvites = verifyinvitesmemberstoken::find($id);
        $delinvites->delete();
        Log::info('delelte ho gaya' . $id);
        return redirect()->route('invites-members.create')->with('success', 'Invites Members delete');
    }


    public function editByAdminUserProfile($id)
    {

        $countries = Countrie::all();
        $userProfile = User::where('email', $id)->first();

        $getcompany =  verifyinvitesmemberstoken::where('email', $id)->first();
        $getCompanyId = $getcompany->company_id;
        $getting_user_id =  $userProfile['authorized_id'];
        $userCompany = Company::where('id', $getCompanyId)->first();

        return view('Admin.invite-members.user-profile-admin-edit', compact('userProfile', 'countries', 'userCompany'));
    }


    public function updateByAdminUserProfile(Request $request, $id)
    {

        $user_profile = User::find($id);
        $old_image_path = $user_profile->img_path; // Store the old image path
        // If a new image is  uploaded image path
        if ($request->hasFile('img_path')) {
            $new_image_path = $request->file('img_path')->store('public/user_profile');
            $user_profile->img_path = 'storage/user_profile/' . $request->file('img_path')->hashName();
        }

        $user_profile->firstname = $request->firstname;
        $user_profile->lastname = $request->lastname;
        $user_profile->dicipline = $request->dicipline;
        $user_profile->Jobrole_id = $request->Jobrole_id;

        // If a new image is not uploaded, retain the old image path
        if (!isset($new_image_path)) {
            $user_profile->img_path = $old_image_path;
        }

        $user_profile->update();

        // test close
        // $findCompany = Company::find($id);
        // $findCompany->company_type = $request->company_type;
        // $findCompany->company_name = $request->company_name;
        // $findCompany->company_email = $request->company_email;
        // $findCompany->website = $request->website;
        // $findCompany->countrie_id = $request->country_id;
        // $findCompany->zipcode = $request->zipcode;
        // $findCompany->phone_number = $request->phone_number;
        // $findCompany->update();
        // Log::info('user with company update in compay profile');
        // return redirect()->route('invites-members.create')->with('success', 'user profile update successfully');
        return back()->with('success', 'Update successful!');
    }
    
    public function update(Request $request, $id){
        $user_profile = User::find($id);
        $old_image_path = $user_profile->img_path;  
        if ($request->hasFile('img_path')) {
            $new_image_path = $request->file('img_path')->store('public/user_profile');
            $user_profile->img_path = 'storage/user_profile/' . $request->file('img_path')->hashName();
        }

        $user_profile->firstname = $request->firstname;
        $user_profile->lastname = $request->lastname;
        $user_profile->phone_number = $request->phone_number;
        $user_profile->Jobrole_id = $request->Jobrole_id;
        $user_profile->role_id = $request->role_id;
        $user_profile->member_status = $request->member_status;
        if($request->password){
             $user_profile->password = Hash::make($request->password);
        }

        if (!isset($new_image_path)) {
            $user_profile->img_path = $old_image_path;
        }

        $user_profile->update();
        return redirect()->route('invites-members.create')->with('success', 'user profile update successfully');
    }
    
    
}
