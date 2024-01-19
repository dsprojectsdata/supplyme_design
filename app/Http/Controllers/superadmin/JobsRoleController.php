<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jobrole;

class JobsRoleController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:superadmin');
  }
    public function index(){
        $getJobsRoles = Jobrole::orderBy('id','desc')->get();
        return view('SuperAdmin.jobs-roles.index',compact('getJobsRoles'));
    }

    public function createJobs(){
        return view('SuperAdmin.jobs-roles.create');
    }

    public function storeJobs(Request $request){
        
        $jobs = new Jobrole();
        $jobs->role_name = $request->role_name;
        $jobs->description = $request->description;
        $jobs->save();
        return redirect()->route('jobs.roles.index')->with('success', 'Job role added successfully.');
    }
    

    public function editJobs($id){
        $findJobrole = Jobrole::find($id);
        return view('SuperAdmin.jobs-roles.edit',compact('findJobrole'));
      }

      public function updateJobs(Request $request,$id){
        $updateJobrole = Jobrole::find($id);
        $updateJobrole->role_name =$request->role_name;
        $updateJobrole->description =$request->description;
        $updateJobrole->save();
        return redirect()->route('jobs.roles.index')->with('success' , 'Job role edited successfully.');
      }

      public function deleteJobrole($id){
        Jobrole::destroy($id); 
        return redirect()->route('jobs.roles.index')->with('danger' , 'jobs rolles deleted successfully');
      }

}
