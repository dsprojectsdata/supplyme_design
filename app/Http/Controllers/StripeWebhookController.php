<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Event;
use App\Models\Payment;
use Log;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('stripe.webhook');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\Exception $e) {
                $json_payload= $e->getMessage();
                $str = "payment Intent-". date('d-m-Y H:i:s') . "payment: ----------------------" . PHP_EOL;
                $str .= 'payment Intent: ' . print_r($json_payload, true) . PHP_EOL;
                
                Log::channel('daily')->info($str);
            return response()->json(['error' => $e->getMessage()], 403);
        }

        switch ($event->type) {
            case 'invoice.payment_succeeded':
                $paymentIntent = $event->data->object;
                    $json_payload= $paymentIntent;
                    $str = "payment Intent-". date('d-m-Y H:i:s') . "Deal: ----------------------" . PHP_EOL;
                    $str .= 'payment Intent: ' . json_encode($json_payload, true) . PHP_EOL;
                    Log::channel('daily')->info($str);
                    
                   if (property_exists($paymentIntent, 'subscription')) {
                        $subscription = $paymentIntent->subscription;
                        $subscriptionId = $subscription->id;
                        $customerId = $subscription->customer;
                        $planId = $subscription->items->data[0]->plan->id;
                        $planName = $subscription->items->data[0]->plan->nickname;
                        $planAmount = $subscription->items->data[0]->plan->amount / 100;
                        $subscriptionStartDate = \Carbon\Carbon::createFromTimestamp($subscription->start_date);
                        $subscriptionEndDate = \Carbon\Carbon::createFromTimestamp($subscription->current_period_end);
                        
                        $CompanySubscriptionHistory = CompanySubscriptionHistory::where('transaction_id',$subscriptionId)->where('customer_id',$customerId)->first();
                        
                        if($CompanySubscriptionHistory){
                                $payment = new CompanySubscriptionHistory();
                                $payment->company_id = $CompanySubscriptionHistory->company_id; 
                                $payment->user_id = $CompanySubscriptionHistory->user_id;
                                $payment->plan_id = $planId;
                                $payment->plan_name = $planName;
                                $payment->plan_price = $planAmount;
                                $payment->customer_id = $customerId;
                                $payment->subscription_date = now(); 
                                $payment->subscription_start_date = $subscriptionStartDate;
                                $payment->subscription_end_date = $subscriptionEndDate;
                                $payment->transaction_id = $subscriptionId;
                                $payment->payment_gateway_name = 'Stripe 2'; 
                                $payment->payment_gateway_status = 'success'; 
                                $payment->save();
                        }
                        // Now you can use these variables as needed
                    } else {
                        // Handle the case where the subscription property is not present
                        Log::channel('daily')->error('Subscription property not found in Payment Intent');
                    }
                break;
    
            default:
                    $json_payload= $event->type;
                    $str = "payment Intent-". date('d-m-Y H:i:s') . "Deal: ----------------------" . PHP_EOL;
                    $str .= 'payment Intent: ' . print_r($json_payload, true) . PHP_EOL;
                    
                    Log::channel('daily')->info($str);
                break;
        }
    
        return response()->json(['success' => true]);
    }
}
