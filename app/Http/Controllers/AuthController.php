<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\RequestCompany;
use App\Models\Jobrole;
use App\Models\CompanyDocument;
use App\Models\CompanyProfile;
use App\Models\CompanyType;
use App\Models\CompanyDocumentManager;
use App\Models\Countrie;
use App\Models\City;
use App\Models\State;
use App\Models\Verifyotp;
use Session, Mail;
use App\Mail\SendOtp;
use App\Mail\OtpSendMail;
use App\Models\CompanySubscriptionHistory;
use App\Models\Plan;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\verifyinvitesmemberstoken;
use Log;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{

   public function ClaimYourCompany()
   {
      $companys = Company::all();
      Session::forget('company_id');
      return view('Auth.claim-your-company',compact('companys'));
   }
   
   
   public function CompanySearch(Request $request){
         $search = $request->searchautocomplete;
         if($search){
            $return = Company::where('enabled',1)->where('company_name', 'LIKE', "%{$search}%")->get();
            $html = view('Auth.sreach-company', compact('return'))->render();
            echo  $html ;
         }
         else{
            $html = ' '; 
            echo  $html ;
         }
   }

   public function ClaimProfileCompany()
   {
      $company_id = Session::get('company_id');
      $company = Company::with('user')->where('id',$company_id)->where('enabled',1)->first();
      return view('Auth.claim-company-profile',compact('company'));
   }

   public function loginShow(Request $request){
      $company_id = Session::get('company_id');
         return view('Auth.login');
   }
   public function loginMemberShow(){
   
         return view('Auth.member-verify-login');
   }

   public function login(Request $request){
         $admin_data = array(
               'email'  => $request->get('email'),
               'password' => $request->get('password'),
               'member_status' => "1",
         );
         if(Auth::guard('web')->attempt($admin_data))
         {
            
            return redirect()->route('admin.dashboard');
         }
         else
         {
            return back()->with('error', 'Wrong Login Details');
         }
   }

   public function ListYourCompany()   // step- 1
   {
      $companytypes = CompanyType::all();
      $countries = Countrie::all();
      $WebsiteSite = Session::get('WebsiteSite');
      return view('Auth.list-your-company',compact('companytypes','WebsiteSite','countries'));
   }


   public function CompanyAdd(Request $request) // step-2
   {  
      
        $request->validate([
             'Company_name' => 'required',
             'company_email' => 'required',
             'Phone_number' => 'required|min:2|max:12',
        ]);
            
         $Company = new Company ();
         $Company->company_name = $request->Company_name;
         $Company->company_type = $request->company_type;
         $Company->company_email = $request->company_email;
         $Company->address = $request->address;
         $Company->address2 = $request->address2;
         $Company->city_id = $request->city_id;
         $Company->countrie_id = $request->country_id;
         $Company->state_id = $request->state_id;
         $Company->zipcode = $request->P_zipcode;
         $Company->country_code = $request->country_code;
         $Company->phone_number = $request->Phone_number;
         $Company->website = $request->Website;
         $Company->company_category = implode(',',$request->company_category);
         $Company->save();
         $Company_latest_id = Company::latest()->first();
         $Company_profile = new CompanyProfile();
         $Company_profile->company_id = $Company->id;
         $Company_profile->save();
         
         $company_id = $Company->id;
         $encodedCompanyId = base64_encode($company_id);
         return redirect()->route('auth.create_an_account',['company_id'=>$encodedCompanyId]);
   }
   
    public function CreateAnAccount($encodedCompanyId)  //step =3
   {
      $companyids = base64_decode($encodedCompanyId);
      $jobroles = Jobrole::all();
      return view('Auth.create-an-account',compact('jobroles','companyids'));
   }

   public function CreateAccountUser(Request $request){    //step =4
      $company_id = $request->company_id;
      $userChack = User::where('email',$request->email)->first();
      if($userChack){
          return back()->with('error', 'your email address is already registered');
      }
      else{
            $user = new User();
            $user->firstname = $request->FirstName;
            $user->lastname = $request->LastName;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->primary_use = $request->Primary_Use_our_network_for;
            $user->Jobrole_id = $request->JobRole;
            $user->website = $request->WebsiteSite;
            $user->company_id = $company_id;
            $user->usertype = 'admin';
            $user->member_status = '1';
            $user->password = Hash::make($request->password);
            $user->save();
            $Company_add = Company::where('id',$company_id)->first();
            if($Company_add->user_id == null){
                 $Company_add->user_id = $user->id;
                 $Company_add->update();
            }
            else{
                 $RequestCompany = new RequestCompany ();
                 $RequestCompany->company_id = $company_id;
                 $RequestCompany->user_id = $user->id;
                 $RequestCompany->save();
                 $userClaim = user::where('id',$user->id)->first();
                 $userClaim->status = '1';
                 $userClaim->update();
            }
           
            $otp = mt_rand(100000, 999999);
            $verifyOtp = new Verifyotp();
            $verifyOtp->user_email = $request->email;
            $verifyOtp->user_id = $user->id;
            $verifyOtp->user_WebsiteSite = $request->WebsiteSite;
            $verifyOtp->otp = $otp;
            $verifyOtp->save();
            
            $userSendMail = array(
              'email' => $request->email,
              'user_id' => $user->id,
              'user_WebsiteSite' => $request->WebsiteSite,
              'otp' => $otp, );
            $otpSendMail = $request->email;
            Log::info('what  mail ' . $otpSendMail);
            
            $to = $otpSendMail;
            $view = view('Auth.otpmail',compact('otp','otpSendMail'))->render();
            $subject = "Supply-me OTP";
            $txt = $view;
            $from_email = "info@supplyme.com";
            $headers = "From: $from_email" . "\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
            echo $txt;
            mail($to, $subject, $txt, $headers);
             
             $encodedCompanyId = base64_encode($company_id);
             $user_id = base64_encode($user->id);
            
            return redirect()->route('opt.verify',['company_id'=>$encodedCompanyId,'user_id'=>$user_id]);
            
      }
   }
   
    public function EmailOtpVerification(Request $request,$company_id,$user_id) //step =5
      {
              
            $user_id = base64_decode($user_id);
            $company_id = base64_decode($company_id);
            $user = User::where('id',$user_id)->first();
            $verifyOtp = Verifyotp::where('user_id',$user_id)->first();
            echo '<pre>' ;
            echo $verifyOtp->otp ;
            echo '</pre>';
            return view('Auth.otpverify',compact('company_id','user_id','user'));
      }
      
      public function byMailcheckotp(Request $request,$company_id,$user_id){   //step =6
               $user_id = base64_decode($user_id);
               $company_id = base64_decode($company_id);
              $otp = Verifyotp::where('otp',$request->otp)->where('user_id',$user_id)->where('otp_status', 0)->first();
                if ($otp) {
                     $encodedCompanyId = base64_encode($company_id);
                     $userId = base64_encode($user_id);
                     return redirect()->route('auth.company_document_page',['company_id'=>$encodedCompanyId,'user_id'=>$userId]);
                } 
                else {
                      $encodedCompanyId = base64_encode($company_id);
                      $userId  = base64_encode($user_id);
                      return redirect()->route('opt.verify',['company_id'=>$encodedCompanyId,'user_id'=>$userId])->with('error',"Your OTP Does't Match");
                }
      
         }
      
      public function Resendotp($company_id,$user_id){     //step =7
              $user_id = base64_decode($user_id);
               $company_id = base64_decode($company_id);
            $user = User::where('id',$user_id)->first();
            $oldotp =  Verifyotp::where('user_id',$user->id)->first();
            if($oldotp){
                $oldotp->delete();
            }
             Session::put('company_id',$user->company_id);
            $otp = mt_rand(100000, 999999);
            $verifyOtp = new Verifyotp();
            $verifyOtp->user_email =  $user->email;
            $verifyOtp->user_id = $user->id;
            $verifyOtp->user_WebsiteSite =  $user->website;
            $verifyOtp->otp = $otp;
            $verifyOtp->save();
            $otpSendMail = $user->email;
            // Mail::to($otpSendMail)->send(new OtpSendMail($otpSendMail,$otp));
                
            $userSendMail = array(
              'email' =>  $user->email,
              'user_id' => $user->id,
              'user_WebsiteSite' =>  $user->website,
              'otp' => $otp, );
            $otpSendMail =  $user->email;
            Log::info('what  mail ' . $otpSendMail);
            $to = $otpSendMail;
            $cc = 'nitesh@3edgetechnologies.com';  // CC recipient's email address
            $bcc = 'niteshjaat0859@gmail.com';
            $view = view('Auth.otpmail',compact('otp','otpSendMail'))->render();
            $subject = "Supply-me OTP";
            $txt = $view;
            $from_email = "niteshjaat0859@gmail.com";
            $headers = "From: $from_email" . "\r\n";
            $headers .= "Cc: $cc\r\n";  // Add CC recipient
            $headers .= "Bcc: $bcc\r\n";  // Add BCC recipient
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            echo $txt;
            mail($to, $subject, $txt, $headers);
           $user_id = base64_encode($user_id);
           $company_id = base64_encode($company_id);
            return redirect()->route('opt.verify',['company_id'=>$company_id,'user_id'=>$user_id]);
      }
     
       public function CompanyDocumentPage($company_id,$user_id){    //step =8
            $userId = base64_decode($user_id);
            $companyId = base64_decode($company_id);
          if( $companyId){
              $company = Company::where('id',$companyId)->first();
              $document_manager = CompanyDocumentManager::where('country_id',$company->countrie_id)->get();
              if($document_manager){
                  return view('Auth.company-ducument-submit',compact('document_manager','company_id','user_id'));
              }
              else{
                   return redirect()->route('auth.verificationSMS');
              }
          }
          else{
              $encodedCompanyId = base64_encode($company_id);
              $userId  = base64_encode($user_id);
              return redirect()->route('opt.verify',['company_id'=>$encodedCompanyId,'user_id'=>$userId])->with('error'," ");
          }
          
          
       }
       
       public function CompanyDocumentAdd(Request $request){                  //step =9
            $userId = base64_decode($request->user_id);
            $companyId = base64_decode($request->company_id);
            $company_document = new CompanyDocument();
            if($request->document_name){
                 foreach ($request->document_name as $key => $documentname) {
                    if ($request->hasFile('document') && isset($request->document[$key])) {
                        $uploadedFile = $request->file('document')[$key];
                        $path = $uploadedFile->store('public/company_documents');
                        
                        $company_document = new CompanyDocument();
                        $company_document->document_path = 'storage/' . substr($path, strlen('public/'));
                        $company_document->company_id = $companyId;
                        $company_document->user_id = $userId;
                        $company_document->documnet_name = $request->document_name[$key];
                        $company_document->save();
                    }
                }
            }
        return redirect()->route('auth.ClaimPayment',$request->company_id);
        //   return redirect()->route('auth.verificationSMS');
       }
       
       public function verificationSMS(){               //step =10
          return view('Auth.verification-superadmin');
       }


//    // super admin login
    public function SuperLogin(){
      return view('SuperAdmin.login');
   }
   public function SuperAdminlogin(Request $request){
         $this->validate($request, [
            'email'   => 'required|email',
            'password'  => 'required|alphaNum|min:3'
      ]);
      $admin_data = array(
            'email'  => $request->get('email'),
            'password' => $request->get('password'),
      );
      if(Auth::guard('superadmin')->attempt($admin_data))
      {
         return redirect()->route('superadmin.dashboard');
      }
      else
      {
         return back()->with('error', 'Wrong Login Details');
      }
   }




   public function SearchState(Request $request){
       $States =State::where('country_id',$request->country)->get();
       $html = view('Auth.sreach-state', compact('States'))->render();
       echo $html;
   }
   public function getStateCity(Request $request)
   {
      $data = [
         "status" => false
      ];
      // if (isset($request->country) && isset($request->state)) {
      $selected_state = $request->state_id;
      $selected_city = $request->city_id;
      $States = State::where('country_id', $request->country)->get();
      $citys = City::where('state_id', $selected_state)->get();
      $state_html = view('Auth.search-set-state', compact('States', 'selected_state'))->render();
      $city_html = view('Auth.search-set-city', compact('citys', 'selected_city'))->render();
      $data = [
         "status" => true,
         "state" => [
            "status" => true,
            'selected_state' => $selected_state,
            "html" => $state_html
         ],
         "city" => [
            'status' => true,
            'selected_city' => $selected_city,
            "html" => $city_html
         ]
      ];
      // }
      return response()->json($data);
   }
   public function LocationSearchState(Request $request){
       $States =State::where('country_id',$request->country)->get();
       $html = view('Auth.sreach-state', compact('States'))->render();
       echo $html;
   }

   public function SearchCity(Request $request){
      $citys =City::where('state_id',$request->state)->get();
      $html = view('Auth.sreach-city', compact('citys'))->render();
      echo $html;
  }


  // token verification open
    public function CreateAccountUserWithToken(Request $request){
      $userChack = User::where('email',$request->email)->first();
       if($userChack){
            $userChack->firstname = $request->FirstName;
            $userChack->lastname = $request->LastName;
            $userChack->email = $request->email;
            $userChack->primary_use = $request->Primary_Use_our_network_for;
            $userChack->Jobrole_id = $request->JobRole;
            $userChack->website = $request->WebsiteSite;
            $userChack->usertype = 'subadmin';
            $userChack->password = Hash::make($request->password);
            $userChack->usertoken = null;
            $userChack->update();
            return redirect()->route('auth.claim_your_company')->with('success', 'account verify successfully please login to continue');
         
       }
       else{
            return back()->with('error', 'your email address is not already registered');
       }
    }
    
    public function ClaimPayment(Request $request,$campany_id){
         $companyId = base64_decode($campany_id);
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
           return view('Auth.claim-payment-list',compact('plans','country','companyId'));
   }
   
   public function claimPaymentList(){
       return view('Auth.claim-payment');
   }
    
    public function ClaimPaymentFree(Request $request){
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
            // $CompanySubscriptionHistory->transaction_id = $request->company_id;
            // $CompanySubscriptionHistory->payment_gateway_name = 'free';
            // $CompanySubscriptionHistory->payment_gateway_status = '1';
              return redirect()->route('auth.verificationSMS');
            
        }
        
    }
  
}
