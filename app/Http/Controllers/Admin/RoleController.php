<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\user;
use Auth;

class RoleController extends Controller
{
    public function create(){
        
       return view('Admin.Role.create');
    }
    
    public function index(){
        $user =Auth::user();
       $roles = Role::where('company_id',$user->company_id)->get();
       return view('Admin.Role.index',compact('roles'));
    }
    
    public function store(Request $request){
        $user =Auth::user();
        $role = new Role();
        $role->role_name = $request->role_name;
        $role->company_id = $user->company_id;
        $role->permission = implode(',',$request->permission);
        $role->save();
        return redirect()->route('role.index');
    }
    
    public function Edit($id){
        $role = Role::Find($id);
       return view('Admin.Role.edit',compact('role'));
    }
    
    public function Update(Request $request,$id){
        $user =Auth::user();
        $role = Role::find($id);
        $role->role_name = $request->role_name;
        $role->company_id = $user->company_id;
        $role->permission = implode(',',$request->permission);
        $role->update();
        return redirect()->route('role.index');
    }
}
