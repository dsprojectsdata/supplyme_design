<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Company;
use App\Models\User;
use App\Models\CompanySubscriptionHistory;
use App\Models\CompanyProfile;
use App\Models\Follows;
use App\Models\Plan;
use App\Models\Countrie;
use App\Helper\Helper;
use App\Models\RfqDetail;
use App\Models\RfqSupplierRequest;
use Stripe\Customer;
use Stripe\PaymentMethod;
use Stripe\Price;
use Stripe\Subscription;
use Stripe\Invoice;
use Stripe\PaymentIntent;

use Log;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function dashboard(Request $request){
          $user = Auth::user();
          $CompanyAuth = Company::where('id',$user->company_id)->first();
        
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
           $companyId = $CompanyAuth->id;
           
          $user_id = \Auth::guard('web')->user();
          $company = Company::where('id',$user_id->company_id)->first();
          $teams = User::where('company_id',$company->id)->limit(5)->get();
          $limitedTeams  = User::where('company_id',$company->id)->get()->count();
          $limitedTeamsCount = $limitedTeams - $teams->count();
          $ompanyProfile = CompanyProfile::where('company_id', $user_id->company_id)->first();
          $followingArray = Follows::where('company_id',$user_id->company_id)->where('user_id',$user_id->id)->pluck('follow_id')->toArray();
          $companyFollwing = Company::whereIn('id',$followingArray)->get();
          $following = Follows::where('company_id',$user_id->company_id)->where('user_id',$user_id->id)->get()->count();
          
          $followers = Follows::where('follow_id',$user_id->company_id)->get()->count();
          $followersArray = Follows::where('follow_id',$user_id->company_id)->pluck('company_id')->toArray();
          $companyfollowers = Company::whereIn('id',$followersArray)->get();
          $userId = \Auth::guard('web')->id();
          $rfqdetails = RfqDetail::orderBy('created_at','desc')->where('status', 1)->whereRaw("FIND_IN_SET(?, add_tem_member) > 0", [$userId])->limit(5)->get();

        $user = Auth::user();
        $RfqSupplierRequest = RfqSupplierRequest::where('supplier_id',$user->company_id)->whereRaw("FIND_IN_SET(?,team_member) > 0", [$user->id])->pluck('rfqdetail_id')->toArray();
        $rfqdetails_received = RfqDetail::orderBy('created_at','desc')->where('status', 1)->whereIn('id', $RfqSupplierRequest)->limit(5)->get();
        return view('Admin.dashboard',compact('rfqdetails_received','rfqdetails','company','teams','ompanyProfile','following','followers','limitedTeamsCount','companyFollwing','companyfollowers','plans','country','companyId'));
    }

    public function admin_logout()
    {
       Auth::guard('web')->logout();
       return redirect()->route('auth.claim_your_company');
    }
    
    public function subscriptionPlan(Request $request){
          $Company = Company::where('id',$request->company_id)->first();
            if($Company){
                $Company->plan_id = $request->plan_id;
                $Company->plan_name = $request->plan_name;
                $Company->plan_duration = $request->plan_duration;
                $Company->plan_price = $request->plan_price ?? '0';
                $Company->subscription_date = $request->subscription_date;
                $Company->update();
                
                $CompanySubscriptionHistory = new CompanySubscriptionHistory();
                $CompanySubscriptionHistory->company_id = $request->company_id;
                $CompanySubscriptionHistory->user_id = $Company->user_id;
                $CompanySubscriptionHistory->plan_id = $request->plan_id;
                $CompanySubscriptionHistory->plan_duration = $request->plan_duration;
                $CompanySubscriptionHistory->plan_name = $request->plan_name;
                $CompanySubscriptionHistory->plan_price = $request->plan_price ?? '0';
                $CompanySubscriptionHistory->subscription_date = $request->subscription_date;
                $CompanySubscriptionHistory->save();
                return redirect()->route('admin.dashboard');
            }
    }
    
    public function purchaseSubscriptionPlan(Request $request ,$plan_id){
           $user = Auth::user();
           $CompanyAuth = Company::where('id',$user->company_id)->first();
        
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
        $plan = Plan::where('id',$plan_id)->first();
        $countries = Countrie::all();
       return  view('Admin.payment_form',compact('plan','country','countries'));
        
    }
    
   public function purchaseSubscriptionPlanGateway(Request $request){
        // Get authenticated user
        $user = Auth::user();
        
        $amount = $request['total_price_payment'] * 100; 
        $currency = $request['currency'];
        $user = Auth::user();
        $name = $user->firstname . ' ' . $user->lastname;
        $email = $user->email;
        $plan = $request['stripe_plan'];
        $planName = $request['stripe_plan_name'];
        $stripeToken = $request['stripeToken'];
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
       try {
              $stripeCustomer = $this->getOrCreateStripeCustomer($user);
                
                    $customer = \Stripe\Customer::create([
                        'name' => $name,
                        'email' => $email,
                    ]);
                
                    $paymentMethod = \Stripe\PaymentMethod::create([
                        'type' => 'card',
                        'card' => [
                            'token' => $stripeToken,
                        ],
                    ]);
                
                    $paymentMethod->attach(['customer' => $customer->id]);
                
                    $customer->invoice_settings = [
                        'default_payment_method' => $paymentMethod->id,
                    ];
                    
                    $customer->save();
                    $validDurations = ['month', 'year', 'week', 'day'];
                    $selectedDuration = $request->plan_duration;
                    
                    if (!in_array($selectedDuration, $validDurations)) {
                        return response()->json(['error' => 'Invalid plan duration.'], 400);
                    }

                    
                    $price = \Stripe\Price::create([
                        'unit_amount' => $amount,
                        'currency' => $currency,
                        'recurring' => ['interval' => $selectedDuration], 
                        'product' => $plan,
                ]);
            
                // Create a new subscription in Stripe
                $subscription = \Stripe\Subscription::create([
                    'customer' => $customer->id,
                    'items' => [
                        [
                            'price' => $price->id,
                        ],
                    ],
                ]);
        
                // Update the subscription settings
                \Stripe\Subscription::update($subscription->id, [
                    'collection_method' => 'send_invoice',
                    'days_until_due' => 7, 
                ]);
                
                    $json_payload= $subscription;
                    $str = "payment Intent subscription-". date('d-m-Y H:i:s') . "subscription: ----------------------" . PHP_EOL;
                    $str .= 'payment Intent subscription: ' . print_r($json_payload, true) . PHP_EOL;
                    
                    Log::channel('daily')->info($str);
                 
                 
                $subscriptionId = $subscription->id;
                $customerId = $subscription->customer;
                $planId = $subscription->items->data[0]->plan->id;
                $planName = $subscription->items->data[0]->plan->nickname;
                $planAmount = $subscription->items->data[0]->plan->amount / 100; 
                $subscriptionStartDate = $subscription->start_date;
                $subscriptionStartDate = \Carbon\Carbon::createFromTimestamp($subscription->start_date);
                $subscriptionEndDate = \Carbon\Carbon::createFromTimestamp($subscription->current_period_end);
                $planDuration = now()->diffInMonths($subscriptionStartDate);
                
                
                $payment = new CompanySubscriptionHistory();
                $payment->company_id = $user->company_id; 
                $payment->user_id = $user->id;
                $payment->plan_id = $request->plan_id;
                $payment->plan_name = $request->stripe_plan_name;
                $payment->payment_plan_id = $planId;
                $payment->plan_price = $request->total_price_payment;
                $payment->customer_id = $customerId;
                $payment->plan_duration = $planDuration;
                $payment->subscription_date = now(); 
                $payment->subscription_start_date = $subscriptionStartDate;
                $payment->subscription_end_date = $subscriptionEndDate;
                $payment->transaction_id = $subscriptionId;
                $payment->payment_gateway_name = 'Stripe'; 
                $payment->payment_gateway_status = 'success'; 
                $payment->save();
                
                $companyUpdate = Company::where('user_id',$user->id)->where('id',$user->company_id)->first();
                $companyUpdate->plan_id = $request->plan_id;
                $companyUpdate->plan_name = $request->stripe_plan_name;
                $companyUpdate->plan_price = $request->total_price_payment;
                $companyUpdate->plan_duration = $request->plan_duration;
                $companyUpdate->transaction_id = $subscriptionId;
                $companyUpdate->subscription_date = now(); 
                $companyUpdate->update();
                
                 return redirect()->route('admin.dashboard')->with(['success' => 'Your Payment has been successful.']);
        
            } catch (\Stripe\Exception\CardException $e) {
                // Handle card errors
                $error = $e->getError();
                $paymentGatewayStatus = 'card_error';
        
            } catch (\Stripe\Exception\SubscriptionCreate $e) {
                // Handle other subscription creation errors
                $error = $e->getError();
                $paymentGatewayStatus = 'subscription_error';
        
            } catch (\Exception $e) {
                // Handle general exceptions
                $error = $e->getMessage();
                $paymentGatewayStatus = 'error';
        
            }
        
            // Handle errors or return response based on your application's logic for failed subscriptions
            return response()->json(['error' => $error, 'status' => $paymentGatewayStatus], 400);
    }
    
    
    public function getOrCreateStripeCustomer($user)
    {
        if ($user->stripe_id) {
            return \Stripe\Customer::retrieve($user->stripe_id);
        }
    
        return \Stripe\Customer::create([
            'email' => $user->email,
        ]);
    }
     
    
    public function success()
    {
        return "Thanks for you order You have just completed your payment. The seeler will reach out to you as soon as possible";
    }
    
    public function canceled(){
        return "Thanks for you order You have just not completed your payment. The seeler will reach out to you as soon as possible";
    }
    
}
