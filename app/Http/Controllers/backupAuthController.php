<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\RequestCompany;
use App\Models\Jobrole;
use App\Models\CompanyDocument;
use App\Models\CompanyType;
use App\Models\Countrie;
use App\Models\CompanyProfile;
use App\Models\City;
use App\Models\State;
use App\Models\CompanyDocumentManager;
use Session, Mail;
use App\Mail\SendOtp;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\verifyinvitesmemberstoken;

class AuthController extends Controller
{

   public function ClaimYourCompany()
   {
      $companys = Company::all();
      Session::forget('company_id');
      return view('Auth.claim-your-company',compact('companys'));
   }

   public function ClaimProfileCompany()
   {
      $company_id = Session::get('company_id');
      $company = Company::where('id',$company_id)->where('enabled',1)->first();
      return view('Auth.claim-company-profile',compact('company'));
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
   public function loginShow(Request $request){
       $company_id = Session::get('company_id');
       $company = Company::where('id',$company_id)->where('enabled',1)->first();
         return view('Auth.login',compact('company'));
   }

   public function login(Request $request){

         $this->validate($request, [
               'email'   => 'required|email',
               'password'  => 'required|alphaNum|min:3'
         ]);
         $admin_data = array(
               'email'  => $request->get('email'),
               'password' => $request->get('password'),
               'usertype' => "admin",
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

   public function CreateAnAccount()
   {
      $user_id = Session::get('user_id');
      $email = Session::get('email');
      $WebsiteSite = Session::get('WebsiteSite');
      $jobroles = Jobrole::all();
      return view('Auth.create-an-account',compact('email','jobroles','WebsiteSite'));
   }

   public function CreateAccountUser(Request $request){
      $company_id = Session::get('company_id');
      $userChack = User::where('email',$request->email)->first();
      if($userChack){
         return back()->with('error', 'your email address is already registered');
      }
      else{
            $user = new User();
            $user->firstname = $request->FirstName;
            $user->lastname = $request->LastName;
            $user->email = $request->email;
            $user->primary_use = $request->Primary_Use_our_network_for;
            $user->Jobrole_id = $request->JobRole;
            $user->website = $request->WebsiteSite;
            $user->company_id = $company_id;
            $user->usertype = 'admin';
            $user->password = Hash::make($request->password);
            $user->save();
            $otp = mt_rand(100000, 999999);
            \Session::put('email', $request->email);
            \Session::put('user_id',  $user->id);
            \Session::put('otp', $otp);
            \Session::put('WebsiteSite',$request->WebsiteSite);
         
            $to = $request->email;
            $subject = "My subject";
            $txt = "Your otp is ".$otp;
            $headers = "From: niteshjaat0859@gamil.com" . "\r\n";
         
            mail($to, $subject, $txt, $headers);

            $Company = Company::where('id',$company_id)->first();
            $Company->user_id = $user->id;
            $Company->update();

            return redirect('email-verification');
      }

     
   }


      // token verification open
      public function CreateAccountUserWithToken(Request $request){
         $userChack = User::where('email',$request->email)->first();
         if($userChack){
            return back()->with('error', 'your email address is already registered');
         }
         else{
            $newtken = verifyinvitesmemberstoken::where('token', $request->token)->first();
            $newtken->token = 'verify';
            $newtken->status = '1';
            $newtken->save();
            $user_id = User::where('id',$newtken->authorized_id)->first();
               $user = new User();
               $user->firstname = $request->FirstName;
               $user->lastname = $request->LastName;
               $user->email = $request->email;
               $user->primary_use = 'invite-members';
               $user->Jobrole_id = 'invite-members';
               $user->website = 'invite-members';
               $user->usertype = 'admin';
               $user->company_id = $user_id->company_id;
               $user->password = Hash::make($request->password);
               $user->save();
               $otp = mt_rand(100000, 999999);
               \Session::put('email', $request->email);
               \Session::put('user_id',  $user->id);
               \Session::put('otp', $otp);
               \Session::put('WebsiteSite','invite-members');
            
               $to = $request->email;
               $subject = "My subject";
               $txt = "Your otp is ".$otp;
               $headers = "From: niteshjaat0859@gamil.com" . "\r\n";
            
         
               return redirect()->route('member.auth.loginShow')->with('success', 'account verify successfully please login to continue');
         }
      // token verification close
      }

       public function loginMemberShow(){
         
               return view('Auth.member-verify-login');
         }

      public function EmailVerification()
      {
         $email = Session::get('email');
         $otp = Session::get('otp');
         $company_id = Session::get('company_id');
         echo 'otp',$otp;
         echo 'company_id' ,$company_id;
         return view('Auth.email-verification');
      }
   public function checkotp(Request $request){
      $email = Session::get('email');
      $otp = Session::get('otp');
      $newcompany = Session::get('newcompany');
      $company_id = Session::get('company_id');
      $user = User::where('email',$email)->first();
      if($request->otp == $otp){
         $company = Company::where('id',$company_id)->first();
         if($newcompany == 'new company'){
           \Session::put('user_id',  $user->id);
           Session::forget('newcompany');
           return redirect('company_document_page');
          
         }
         else{
            $RequestCompany = new RequestCompany ();
            $RequestCompany->company_id = $company->id;
            $RequestCompany->user_id = $user->id;
            $RequestCompany->save();
            return redirect('company_document_page');
         }
      }
      else{
         return redirect('email-verification')->with('error',"Your OTP Does't Match");
      }
   }

   public function CompanyDocumentPage(){
      $company_id = Session::get('company_id');
      $company = Company::where('id',$company_id)->first();
      $document_manager = CompanyDocumentManager::where('country_id',$company->countrie_id)->get();
      return view('Auth.company-ducument-submit',compact('document_manager'));
   }
   public function CompanyDocumentAdd(Request $request){
      $user_id = Session::get('user_id');
      $company_id = Session::get('company_id');
      $files = [];
      if ($request->hasfile('document')) {
         foreach ($request->file('document') as $key => $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('public/document', $name); // Use the Storage facade to store the file
            $files[$key] = $name;
         }
      }

      if (!empty($files)) {
         foreach ($files as $key => $filename) {
            $company_document = new CompanyDocument();
            $company_document->document_path = 'storage/document/' . $filename; // Save the relative path in the database
            $company_document->company_id = $company_id;
            $company_document->user_id = $user_id;
            $company_document->save();
         }
      }

      Session::forget('company_id');
      return redirect()->route('auth.verificationSMS');
   }
   public function verificationSMS(){
      return view('Auth.verification-superadmin');
   }

   public function ListYourCompany()
   {
      $companytypes = CompanyType::all();
      $countries = Countrie::all();
      $WebsiteSite = Session::get('WebsiteSite');
      return view('Auth.list-your-company',compact('companytypes','WebsiteSite','countries'));
   }


   public function CompanyAdd(Request $request){
       $request->validate([
         'Company_name' => 'required',
         'company_email' => 'required',
         'address' => 'required',
         'address2' => 'required',
         'P_zipcode' => 'required',
         'Phone_number' => 'required|min:2|max:12',
         'Website' => 'required',
     ]);
       
         $user_id = Session::get('user_id');
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
         $Company->phone_number = $request->Phone_number;
         $Company->website = $request->Website;
         $Company->company_category = implode(',',$request->company_category);
         $Company->user_id = $user_id;
         $Company->save();
         $Companyprofile = new CompanyProfile();
         $Companyprofile->company_id = $Company->id;
         $Companyprofile->user_id = $user_id;
         $Companyprofile->save();
         \Session::put('user_id',  $user_id);
         \Session::put('company_id',  $Company->id);
         return redirect()->route('auth.create_an_account');
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

   public function SearchCity(Request $request){
      $citys =City::where('state_id',$request->state)->get();
      $html = view('Auth.sreach-city', compact('citys'))->render();
      echo $html;
  }
  
}
