<?php
namespace App\Helper;
use App\Models\Role;
use App\Models\Plan;
use App\Models\Company;
use App\Models\User;
use App\Models\CompanySubscriptionHistory;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\Checkout\Session;
use Auth;

class Helper
{
    function customHeaderFunction(){
        $user = Auth::user();
        if($user->role_id){
             $role = Role::where('id',$user->role_id)->first();
             if($role){
                $data = explode(',', $role->permission);
                return $data;
             }
        }
        else{
            $data = [];
        }
    }
    
    function subscriptionHistories(){
        $user = Auth::user();
        $Company = Company::where('id',$user->company_id)->first();
        if($Company){
            $plan = CompanySubscriptionHistory::where('user_id',$Company->user_id)->first();
            return  $plan;
        }
       
    }
    
    function subscriptionHistoriesHeader(){
        $user = Auth::user();
        $Company = Company::where('id',$user->company_id)->first();
        if($Company){
            $plan = Plan::where('id',$Company->plan_id)->first();
            if($plan){
                 $planPermission  = explode(',',$plan->permission);
                 return $planPermission ;
            }
        }
    }
    
  

    public function payment($data)
    {
       
        $amount = $data['total_price_payment'] * 100; 
        $currency = $data['currency'];
        $user = Auth::user();
        $name = $user->firstname . ' ' . $user->lastname;
        $email = $user->email;
        $plan = $data['stripe_plan'];
        $planName = $data['stripe_plan_name'];
        $stripeToken = $data['stripeToken'];
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        
        $jsonStr = file_get_contents('php://input'); 
        $jsonObj = json_decode($jsonStr);
        
    try {
       
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
        
    } catch (\Exception $e) {
        
        $api_error = $e->getMessage();
        dd('error 5 ',$api_error);
    }

    if (empty($api_error) && $customer) {
        try {
            $price = \Stripe\Price::create([
                'unit_amount' => $amount,
                'currency' => $currency,
                'recurring' => ['interval' => 'month'], 
                'product' => $plan,
            ]);
            } catch (\Exception $e) {
                dd('error 4 ',$api_error);
                $api_error = $e->getMessage();
            }
            if (empty($api_error) && $price) {
                try {
                    $subscription = \Stripe\Subscription::create([
                    'customer' => $customer->id,
                    'items' => [
                        [
                            'price' => $price->id,
                        ],
                    ],
                    'payment_behavior' => 'default_incomplete',
                    'payment_settings' => ['save_default_payment_method' => 'on_subscription'], 
                    'expand' => ['latest_invoice.payment_intent'],
                ]);
                } catch (\Exception $e) {
                    $api_error = $e->getMessage();
                }
        
                if (empty($api_error) && $subscription) {
                    $output = [
                        'subscriptionId' => $subscription->id,
                        'clientSecret' => $subscription->latest_invoice->payment_intent->client_secret,
                        'customerId' => $customer->id,
                    ];
                     return  json_encode($output); 
                    
                } else {
                    dd('error 1 ',$api_error);
                    return response()->json(['error' => $api_error]);
                }
            } else {
                  dd('error 2 ',$api_error);
                return response()->json(['error' => $api_error]);
            }
        } else {
             dd('error 3',$api_error);
            return response()->json(['error' => $api_error]);
        }
        
    }
}  
?>