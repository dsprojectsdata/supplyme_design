<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;

class PlanController extends Controller
{
    public function index(){
        $plans = Plan::all();
        return view('SuperAdmin.plans.index',compact('plans'));
    }
    
    public function create(){
        return view('SuperAdmin.plans.create');
    }
    
    public function store(Request $request ){
       $plan = new Plan();
       $plan->name = $request->name;
       $plan->monthly_price_usd = $request->monthly_price_usd;
       $plan->number_of_user = $request->number_of_user;
       $plan->monthly_price_inr = $request->monthly_price_inr;
       $plan->discount = $request->discount;
       $plan->number_of_rfq = $request->number_of_rfq;
       $plan->description = $request->description;
       $plan->stripe_plan = $request->stripe_plan;
       $plan->permission = implode(',',$request->permission);
       $plan->save();
       return redirect()->route('paymant.plans.index');
       
    }
    
    public function edit($id){
         $plan = Plan::where('id',$id)->first();
        return view('SuperAdmin.plans.edit',compact('plan'));
    }
    
    public function update(Request $request ,$id){
       $plan = Plan::where('id',$id)->first();
       $plan->name = $request->name;
       $plan->monthly_price_usd = $request->monthly_price_usd;
       $plan->number_of_user = $request->number_of_user;
       $plan->monthly_price_inr = $request->monthly_price_inr;
       $plan->discount = $request->discount;
       $plan->stripe_plan = $request->stripe_plan;
       $plan->number_of_rfq = $request->number_of_rfq;
       $plan->description = $request->description;
       $plan->status = $request->status;
       $plan->subscription_type = $request->subscription_type;
       $plan->permission = implode(',',$request->permission);
       $plan->update();
       return redirect()->route('paymant.plans.index');
    }
}
