<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class superadminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }
  
    public function SuperAdminDashboad(){
        return view('SuperAdmin.dashboard');
    }
 

    public function SuperAdminlogout(){
        Auth::guard('superadmin')->logout();
        return redirect()->route('superadmin.login');
    }
}
