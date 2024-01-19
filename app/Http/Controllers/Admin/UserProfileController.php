<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Countrie;
use App\Models\Jobrole;
use Log;
use Auth;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(){
        $countries = Countrie::all();
        $userProfile = User::where('id',Auth::user()->id)->first();
        $jobroles = Jobrole::all();
        return view('Admin.user-profile.index',compact('userProfile','countries','jobroles'));
    }

    public function updateUserProfile(Request $request,$id){
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

        // If a new image is not uploaded, retain the old image path
        if (!isset($new_image_path)) {
            $user_profile->img_path = $old_image_path;
        }

        $user_profile->update();
        return redirect()->route('user.profile')->with('success', 'user profile update successfully');

    }

    public function viewUserProfile(){
        $countries = Countrie::all();
        $userProfile = User::where('id',Auth::user()->id)->first();
        $userCompany = Company::where('user_id', Auth::user()->id)->first();
        return view('Admin.user-profile.user-profile-view',compact('userProfile','userCompany','countries'));
    }

}
