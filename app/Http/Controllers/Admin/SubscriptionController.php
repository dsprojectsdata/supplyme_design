<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Company;
use App\Models\User;
use App\Models\Plan;
use  Auth;
use Stripe\Subscription;
use App\Models\CompanySubscriptionHistory;

class SubscriptionController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        $Company = Company::where('id',$user->company_id)->first();
        
         $ipAddress = $request->ip();

            $apiUrl = "http://ip-api.com/json/{$ipAddress}";
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            if ($httpCode === 200) {
                $data = json_decode($response, true);
                $country = $data['country'];
            } else {
                $country = 'India';
            }
            curl_close($ch);
           $plans = Plan::where('status','1')->get();
           $companyId = $Company->id;
         $CompanySubscriptionHistorys = CompanySubscriptionHistory::where('company_id',$Company->id)->where('user_id',$Company->user_id)->get();
        return view('Admin.Subscription.index',compact('CompanySubscriptionHistorys','plans','country','companyId','user'));
    }
    
    public function paymentUpdate(Request $request){
       // return $request->all();
        $user = Auth::user();
        $Company = Company::where('id',$user->company_id)->first();
        $subscriptionId = $Company->transaction_id; 
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        $subscription = Subscription::retrieve($subscriptionId);
        $CompanySubscriptionHistory = CompanySubscriptionHistory::where('user_id',$user->id)->where('company_id',$Company->id)->orderBy('created_at','DESC')->first();
        try {
                $newPriceId = $CompanySubscriptionHistory->payment_plan_id; 
            
                $subscription->items->data[0]->price = $newPriceId;
                $subscription->save();
            
                $subscriptionId = $subscription->id;
                $customerId = $subscription->customer;
                $planId = $subscription->items->data[0]->plan->id;
                $planName = $subscription->items->data[0]->plan->nickname;
                $planAmount = $subscription->items->data[0]->plan->amount / 100; 
                $subscriptionStartDate = $subscription->start_date;
                $subscriptionStartDate = \Carbon\Carbon::createFromTimestamp($subscription->start_date);
                $subscriptionEndDate = \Carbon\Carbon::createFromTimestamp($subscription->current_period_end);
                $planDuration = now()->diffInMonths($subscriptionStartDate);
                
                if($subscriptionId){
                    $payment = new CompanySubscriptionHistory();
                    $payment->company_id = $user->company_id; 
                    $payment->user_id = $user->id;
                    $payment->plan_id = $request->plan_id;
                    $payment->payment_plan_id = $planId;
                    $payment->plan_name = $request->plan_name;
                    $payment->plan_price = $planAmount;
                    $payment->customer_id = $customerId;
                    $payment->plan_duration = $planDuration;
                    $payment->subscription_date = now(); 
                    $payment->subscription_start_date = $subscriptionStartDate;
                    $payment->subscription_end_date = $subscriptionEndDate;
                    $payment->transaction_id = $subscriptionId;
                    $payment->payment_gateway_name = 'Stripe'; 
                    $payment->payment_gateway_status = 'success'; 
                    $payment->save();
                    
                    $companyUpdate = Company::where('user_id',$user->id)->where('id',$Company->id)->first();
                    $companyUpdate->plan_id = $request->plan_id;
                    $companyUpdate->plan_name = $request->plan_name;
                    $companyUpdate->plan_price = $request->plan_price;
                    $companyUpdate->plan_duration = $request->plan_duration;
                    $companyUpdate->transaction_id = $subscriptionId;
                    $companyUpdate->subscription_date = now(); 
                    $companyUpdate->update();
                }
                
                
                
            
            return redirect()->route('admin.dashboard')->with('success', 'Subscription plan changed successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Error changing subscription plan: ' . $e->getMessage());
        }
    }
}
