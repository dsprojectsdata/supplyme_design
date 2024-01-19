<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function dashboard(){
        return view('Admin.dashboard');
    }

    public function admin_logout()
    {
       Auth::guard('web')->logout();
       return redirect()->route('auth.claim_your_company');
    }
}
