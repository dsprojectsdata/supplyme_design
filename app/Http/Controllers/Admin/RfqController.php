<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Company;
use App\Models\Countrie;
use App\Models\RfqDetail;
use App\Models\RfqLocation;
use App\Models\RfqContract;
use App\Models\RfqNda;
use App\Models\Coverletter;
use App\Models\NDA;
use App\Models\User;
use App\Models\Bidsheet;
use App\Models\Contract;
use App\Models\RfqBidsheet;
use App\Models\State;
use App\Models\City;
use App\Models\RfqAdditional;
use App\Models\RfqSupplierRequest;
use App\Models\SingNda;
use App\Models\SingBidSheet;
use App\Models\BidDetail;
use App\Models\RfqActivity;
use App\Models\NdaComments;
use App\Models\SupplierGroup;
use App\Models\Questionair;
use App\Models\QuestionairAnswer;
use App\Traits\RfqTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
 


class RfqController extends Controller
{
    use RfqTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();
        $company_id = Company::where('user_id',$user_id)->first();
        $rfqdetails2 = RfqDetail::orderBy('created_at','desc')->where('company_id',$user->company_id)->get();
        $rfqdetails_team = RfqDetail::orderBy('created_at','desc')->where('company_id',$user->company_id)->get();
        $rfqdetails = RfqDetail::orderBy('created_at','desc')->whereRaw("FIND_IN_SET(?, add_tem_member) > 0", [$user_id])->get();

        //  $rfqdetails_suppliers = RfqDetail::where('status', 0)->whereRaw("FIND_IN_SET(?, supplier_add)", [$company_id->id])->get();
        //  return $rfqdetails_suppliers;
       return view('Admin.RFQ.RFQ-Create',compact('rfqdetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $category = Category::where('parent_id',0)->get();
       $countries = Countrie::all();
       $coverletters = Coverletter::limit(5)->get(); 
       $ndas = NDA::limit(5)->get();
       $contracts = Contract::limit(5)->get();
       $bidsheets = Bidsheet::limit(5)->get();
       $user_id = Auth::User();
       $company = Company::where('id',$user_id->company_id)->first();
       $members = User::where('company_id',$company->id)->get();

       $suppliergroups = SupplierGroup::where('company_id',$user_id->company_id)->get();

       return view('Admin.RFQ.RFQ-Events',compact('category','countries','coverletters','ndas','contracts','bidsheets','members','suppliergroups'));
    }

    public function sentIndex()
    {
        $user_id = Auth::user()->id;
        $company_id = Company::where('user_id',$user_id)->first();
        $rfqdetails = RfqDetail::where('status', 1)->where('user_id', $user_id)->get();
        // $rfqdetails_suppliers = RfqDetail::where('status', 1)->whereRaw("FIND_IN_SET(?, supplier_add)", [$company_id->id])->get();
        
        return view('Admin.RFQ.RFQ-sent-create',compact('rfqdetails'));
    }

    public function individualIndex($id)
    {
        $rfqdetail = RfqDetail::with('Category')->find($id);
        // $suppliers = $rfqdetail->supplier_add;
        // $suppliersArray = explode(",", $suppliers);
        $user_id = Auth::user()->id;
        $company_id = Company::where('user_id',$user_id)->first();
        $teamMember = $rfqdetail->add_tem_member;
        $teamMemberArray = explode(",", $teamMember); 
        $teams = User::whereIn('id', $teamMemberArray)->get();
        $suppliersArray = RfqSupplierRequest::where('rfqdetail_id',$id)->get();
        $suppliersCount = $suppliersArray->count();
        $supplierIds = $suppliersArray->pluck('supplier_id')->toArray();
        

        
        $suppliersData = Company::with('user')->whereIn('id', $supplierIds)->get();
        $activities =  RfqActivity::where('rfqdetail_id', $id)->where('company_id', $supplierIds)->get();
        
        $ndaSigneds =  SingNda::where('rfqdetail_id',$id)->where('company_id',$supplierIds)->get();
        
        $category = Category::where('id',$rfqdetail->category_id)->first();
        $subcategory = Category::where('id',$rfqdetail->subcategory_id)->first();
        $rfqlocation = RfqLocation::with('Countrie','State','City')->where('rfqdetail_id',$id)->get();
        $rfqcontract = RfqContract::where('rfqdetail_id',$id)->get();
        $rfqnda = RfqNda::where('rfqdetail_id',$id)->get();
        $rfqbidsheet = RfqBidsheet::where('rfqdetail_id',$id)->get();
        $rfqadditionals = RfqAdditional::where('rfqdetail_id',$id)->get();
        $questionairs = Questionair::where('rfqdetail_id',$id)->get();
        
       

        return view('Admin.RFQ.RFQ-individual-send',compact('rfqdetail','rfqlocation','rfqcontract','rfqnda','category','subcategory','rfqbidsheet','rfqadditionals','suppliersCount','teams','suppliersData','suppliersArray','activities','ndaSigneds','questionairs'));
    }
    

     public function productAndServices(Request $request){
        $rfqType = $request->input('rfq_type');
        
        $category = Category::where('category_type',$rfqType)->where('parent_id','0')->get();
        $response =[
            'message' => 'Value received successfully',
            'data' => $category,
            'success' =>true,
        ];
        return response()->json($response,200);
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        
        $user_id = Auth::guard('web')->user()->id;
        $company_user_id = Auth::guard('web')->user();
        $company_id = $company_user_id->company_id;

        $rfqDetail = new RfqDetail();
        // About FRQ
        $rfqDetail->rfq_name = $request->rfq_name;
        $rfqDetail->rfq_type = $request->rfq_type;
        $rfqDetail->demandtype = $request->demandtype;
        $rfqDetail->subcategory_id = $request->subcategory_id;
        $rfqDetail->category_id = $request->category_id;
        $rfqDetail->company_id = $company_id;
        $rfqDetail->user_id = $user_id;
        //cover letter
        $rfqDetail->cover_letter = $request->cover_letter;
        //  Bid Currency                 
        $rfqDetail->rfq_bid_currency = $request->rfq_bid_currency;
        $rfqDetail->exchange_rate_refrence = $request->exchange_rate_refrence;
        // Raw Materials         
        $rfqDetail->raw_materials_name = implode(',',$request->raw_materials_name);
        $rfqDetail->refrence_date = implode(',',$request->refrence_date);
        // Point of Contact 
        if($request->add_tem_member){
            $rfqDetail->add_tem_member = implode(',',$request->add_tem_member);
        }    
        if($request->has('nda_auto_approval') == true){
            $rfqDetail->nda_auto_approval = '1';
        }
        if($request->has('nda_auto_approval') == false){
            $rfqDetail->nda_auto_approval = '0';
        }
        // Delivery Terms
        $rfqDetail->one_time = $request->one_time;
        $rfqDetail->recurrening = $request->recurrening;
        $rfqDetail->delivery = $request->delivery ;
        $rfqDetail->import_terms = $request->import_terms;
        //Standrad Payment Terms
        $rfqDetail->payment_after_delivery = $request->payment_after_delivery;
        if ($request->hasfile('payment_after_delivery_file')) {
            $file = $request->file('payment_after_delivery_file');
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('public/payment_after_delivery_file', $name); 
            $rfqDetail->payment_after_delivery_file = 'storage/payment_after_delivery_file/' .$name;
       }

        //  Other Bid Instruction             
       
        //Conditional Offers & Discount
        $rfqDetail->demand_type = $request->demand_type;
        $rfqDetail->year_discount_terms = $request->year_discount_terms;
        $rfqDetail->contract_duration_terms = $request->contract_duration_terms;
        

        //  Dealines
        $rfqDetail->acknowledgement_deadline = $request->acknowledgement_deadline;
        $rfqDetail->query_deadline = $request->query_deadline;
        $rfqDetail->bid_submission_deadline = $request->bid_submission_deadline;
        // $rfqDetail->additional_information = $request->additional_information;
        
        $rfqDetail->save();

        
        $RFQ = RfqDetail::latest()->first();
        // Questionair
        if($request->form_name){
            foreach ($request->questiona as $key=>$q) {
                $questionair = new Questionair();
                $questionair->form_name = $request->form_name;
                $questionair->rfqdetail_id = $RFQ->id;
                $questionair->description = $request->questionair_description;
                $questionair->answer_type = $request->answer_type[$key];
                $questionair->questiona = $q;
                $data = [] ;
                foreach($request->option_name as $o){
                    $data [] =  implode(',',$o); 
                   
                }
                $questionair->option_name =$data[$key];
                $questionair->save();
                
            }
        }
        // supplier_add
        
        if($request->supplier_add){
            foreach($request->supplier_add as $supplier){
                $RfqSupplierRequest = new RfqSupplierRequest();
                $RfqSupplierRequest->rfqdetail_id = $RFQ->id;
                $RfqSupplierRequest->company_id = $company_id;
                $RfqSupplierRequest->supplier_id = $supplier;
                $user_supplier = Company::where('id',$supplier)->first();
                $RfqSupplierRequest->team_member = $user_supplier->user_id; 
                $RfqSupplierRequest->save();
            }
        }
        //Location save
        if($request->country_id){
            foreach($request->country_id as $key=>$coutry){
                   $rfqlocation = new RfqLocation();
                    $rfqlocation->countrie_id = $coutry;
                    $rfqlocation->state_id = $request->state_id[$key];
                    $rfqlocation->city_id = $request->city_id[$key];
                    $rfqlocation->rfqdetail_id = $RFQ->id;
                    $rfqlocation->zipcode = $request->zipcode[$key];
                    $rfqlocation->save();
            }
        }
    //  Nda
        if ($request->hasFile('nda_file')) { // Use hasFile, not hasfile
            $file = $request->file('nda_file'); // Use file, not hasfile
            $originalNameNda = $file->getClientOriginalName();
            $file->storeAs('public/nda_file',  $originalNameNda); // Use the Storage facade to store the file
            $rfqNda = new RfqNda();
            $rfqNda->nda_file = 'storage/nda_file/' .  $originalNameNda; // Save the relative path in the database
            $rfqNda->rfqdetail_id = $RFQ->id;
            $rfqNda->nda_name = $originalNameNda;
            $rfqNda->company_id = $company_id;
            $rfqNda->save();
        }
        
 
        //contract_file

        $files = [];
        if ($request->hasfile('contract_file')) {
            foreach ($request->file('contract_file') as $key => $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('public/contract_file', $name); // Use the Storage facade to store the file
                $originalNameContract = $file->getClientOriginalName();
                $rfqcontract = new RfqContract();
                $rfqcontract->contract_file = 'storage/contract_file/' . $name; // Save the relative path in the database
                $rfqcontract->rfqdetail_id = $RFQ->id;
                $rfqcontract->contract_name = $originalNameContract;
                $rfqcontract->save();
            }
        }

        //bidsheet_file

        $files = [];
        if ($request->hasfile('bidsheet_file')) {
            foreach ($request->file('bidsheet_file') as $key => $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('public/bidsheet_file', $name); // Use the Storage facade to store the file
                $originalNameBidsheet = $file->getClientOriginalName();
                $rfqbidsheet = new RfqBidsheet();
                $rfqbidsheet->bidsheet_file = 'storage/bidsheet_file/' . $name; // Save the relative path in the database
                $rfqbidsheet->rfqdetail_id = $RFQ->id;
                $rfqbidsheet->bidsheet_name = $originalNameBidsheet;
                $rfqbidsheet->save();
            }
        }

            //Additional Information
           
            $files = [];
            if ($request->hasfile('additional_file')) {
                foreach ($request->file('additional_file') as $key => $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->storeAs('public/additional_file', $name); // Use the Storage facade to store the file
                    $originalNameAdditional = $file->getClientOriginalName();
                    $rfqadditional = new RfqAdditional();
                    $rfqadditional->additional_file = 'storage/additional_file/' . $name; // Save the relative path in the database
                    $rfqadditional->additional_name = $originalNameAdditional;
                    $rfqadditional->rfqdetail_id = $RFQ->id;
                    $rfqadditional->save();
                }
            }

            if($request->preview == null){
                return redirect()->route('RFQ.index');
                
            }
            else{
                return redirect()->route('RFQ.show',$RFQ->id);
            }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rfqdetail = RfqDetail::with('Category')->find($id);
        $suppliers = $rfqdetail->supplier_add;
        
        $suppliersArray = RfqSupplierRequest::where('rfqdetail_id',$id)->get();
        $suppliersCount = $suppliersArray->count();
         $supplierIds = $suppliersArray->pluck('supplier_id')->toArray();

        $teamMember = $rfqdetail->add_tem_member;
        $teamMemberArray = explode(",", $teamMember); 
        $teams = User::whereIn('id', $teamMemberArray)->get();
        $RfqSupplierRequest = RfqSupplierRequest::where('rfqdetail_id',$id)->get();
        $suppliersData = Company::with('user')->whereIn('id', $supplierIds)->get(); 

        $category = Category::where('id',$rfqdetail->category_id)->first();
        $subcategory = Category::where('id',$rfqdetail->subcategory_id)->first();
        $rfqlocation = RfqLocation::with('Countrie','State','City')->where('rfqdetail_id',$id)->get();
        $rfqcontract = RfqContract::where('rfqdetail_id',$id)->get();
        $rfqnda = RfqNda::where('rfqdetail_id',$id)->get();
        $rfqbidsheet = RfqBidsheet::where('rfqdetail_id',$id)->get();
        
        $rfqadditionals = RfqAdditional::where('rfqdetail_id',$id)->get();
        $questionairs = Questionair::where('rfqdetail_id',$id)->get();

       
        return view('Admin.RFQ.RFQ-View',compact('rfqdetail','rfqlocation','rfqcontract','rfqnda','category','subcategory','rfqbidsheet','rfqadditionals','suppliersCount','teams','suppliersData','RfqSupplierRequest','questionairs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('parent_id',0)->get();
        $countries = Countrie::all();
        $states = State::all();
        $citys = City::all();
        $coverletters = Coverletter::limit(5)->get(); 
        $ndas = NDA::limit(5)->get();
        $contracts = Contract::limit(5)->get();
        $bidsheets = Bidsheet::limit(5)->get();
        $user_id = Auth::User()->id;
        $company = Company::where('user_id',$user_id)->first();
        $members = User::where('company_id',$company->id)->get();

        $rfqdetail = RfqDetail::with('Category')->find($id);

        $suppliersArray =  RfqSupplierRequest::where('rfqdetail_id',$id)->pluck('supplier_id')->toArray();
        
        $suppliersData = Company::with('user')->whereIn('id', $suppliersArray)->get(); 
        $category_date = Category::where('id',$rfqdetail->category_id)->first();
        $subcategory = Category::where('id',$rfqdetail->subcategory_id)->first();
        $rfqlocation = RfqLocation::with('Countrie','State','City')->where('rfqdetail_id',$id)->get();
        $rfqcontract = RfqContract::where('rfqdetail_id',$id)->get();
        $rfqnda = RfqNda::where('rfqdetail_id',$id)->get();
        $rfqbidsheet = RfqBidsheet::where('rfqdetail_id',$id)->get();
        $rfqadditionals = RfqAdditional::where('rfqdetail_id',$id)->get();
        $suppliergroups = SupplierGroup::all();
        
        $questionas =Questionair::where('rfqdetail_id',$id)->get();

        return view('Admin.RFQ.RFQ-Edit',compact('rfqdetail','rfqlocation','rfqcontract','rfqnda','category','subcategory','rfqbidsheet','rfqadditionals','countries','coverletters','ndas','contracts','bidsheets','members','category_date','states','citys','suppliersData','suppliergroups','questionas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    // return $request->all();
       $user_id = Auth::guard('web')->user()->id;
       $company_user_id = Auth::guard('web')->user();
       $company_id = $company_user_id->company_id;

       $rfqDetail =  RfqDetail::find($id);
       // About FRQ
       $rfqDetail->rfq_name = $request->rfq_name;
       $rfqDetail->rfq_type = $request->rfq_type;
       $rfqDetail->demandtype = $request->demandtype;
       $rfqDetail->subcategory_id = $request->subcategory_id;
       $rfqDetail->category_id = $request->category_id;
       $rfqDetail->company_id = $company_id;
       $rfqDetail->user_id = $user_id;
       //cover letter
       $rfqDetail->cover_letter = $request->cover_letter;
       //  Bid Currency                 
       $rfqDetail->rfq_bid_currency = $request->rfq_bid_currency;
       $rfqDetail->exchange_rate_refrence = $request->exchange_rate_refrence;
       // Raw Materials         
       $rfqDetail->raw_materials_name = implode(',',$request->raw_materials_name);
       $rfqDetail->refrence_date = implode(',',$request->refrence_date);
       // Point of Contact     
       if($request->add_tem_member){
         $rfqDetail->add_tem_member = implode(',',$request->add_tem_member);
       }
       
       // Delivery Terms
       $rfqDetail->one_time = $request->one_time;
       $rfqDetail->recurrening = $request->recurrening;
       $rfqDetail->delivery = $request->delivery ;
       $rfqDetail->import_terms = $request->import_terms;
       //Standrad Payment Terms
       $rfqDetail->payment_after_delivery = $request->payment_after_delivery;
       if ($request->hasfile('payment_after_delivery_file')) {
           $file = $request->file('payment_after_delivery_file');
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('public/payment_after_delivery_file', $name); 
            $files = $name;
            $rfqDetail->payment_after_delivery_file = 'storage/payment_after_delivery_file/' .$name;
       }
       //  Other Bid Instruction             
       $rfqDetail->ticketDesc = $request->ticketDesc;
       //Conditional Offers & Discount
       $rfqDetail->demand_type = $request->demand_type;
       $rfqDetail->year_discount_terms = $request->year_discount_terms;
       $rfqDetail->contract_duration_terms = $request->contract_duration_terms;
       //  Dealines
       $rfqDetail->acknowledgement_deadline = $request->acknowledgement_deadline;
       $rfqDetail->query_deadline = $request->query_deadline;
       $rfqDetail->bid_submission_deadline = $request->bid_submission_deadline;
    //   $rfqDetail->additional_information = $request->additional_information;
       $rfqDetail->status = $request->status;
    
       $rfqDetail->update();
       //Location save
       if(count($request->zipcode)>0){
           foreach($request->country_id as $key=>$coutry){
               $rfqlocation =  RfqLocation::where('id',$request->rfqlocation_id[$key])->where('rfqdetail_id',$id)->first();
               if($rfqlocation){
                   $rfqlocation->countrie_id = $coutry;
                   $rfqlocation->state_id = $request->state_id[$key] ?? ' ';
                   $rfqlocation->city_id = $request->city_id[$key] ?? ' ';
                   $rfqlocation->rfqdetail_id = $id;
                   $rfqlocation->zipcode = $request->zipcode[$key] ?? ' ';
                   $rfqlocation->update();
               }
               else{
                    $rfqlocation_id = new RfqLocation();
                    $rfqlocation_id->countrie_id = $coutry;
                    $rfqlocation_id->state_id = $request->state_id[$key] ?? ' ';
                    $rfqlocation_id->city_id = $request->city_id[$key] ?? ' ';
                    $rfqlocation_id->rfqdetail_id = $id;
                    $rfqlocation_id->zipcode = $request->zipcode[$key];
                    $rfqlocation_id->save();
               }
               
           }
       }
// 
       
            // Questionair
            if($request->form_name){
                foreach ($request->questiona as $key=>$q) {
                    $questionair = Questionair::where('id',$request->questiona_id[$key])->first();
                    if($questionair){
                        $questionair->form_name = $request->form_name;
                        $questionair->description = $request->questionair_description;
                        $questionair->answer_type = $request->answer_type[$key];
                        $questionair->questiona = $q;
                        $data = [] ;
                        foreach($request->option_name as $o){
                            $data [] =  implode(',',$o); 
                        
                        }
                        $questionair->option_name =$data[$key];
                        $questionair->update();
                    }
                    else{
                        $questionair_add = new Questionair();
                        $questionair_add->form_name = $request->form_name;
                        $questionair_add->rfqdetail_id = $id;
                        $questionair_add->description = $request->questionair_description;
                        $questionair_add->answer_type = $request->answer_type[$key];
                        $questionair_add->questiona = $q;
                        $data = [] ;
                        foreach($request->option_name as $o){
                            $data [] =  implode(',',$o); 
                           
                        }
                        $questionair_add->option_name =$data[$key];
                        $questionair_add->save();
                    }
                    
                }
            }
            // supplier_add
            if($request->supplier_add){
                foreach($request->supplier_add as $supplier){
                    $update = RfqSupplierRequest::where('rfqdetail_id',$id)->where('company_id',$company_id)->where('supplier_id',$supplier)->first();
                    
                    if($update){
                        $update->rfqdetail_id = $id;
                        $update->company_id = $company_id;
                        $update->supplier_id = $supplier;
                        $user_supplier = Company::where('id',$supplier)->first();
                        $update->team_member =$user_supplier->user_id; 
                        $update->update();
                    }
                    else{
                        $RfqSupplierRequest = new RfqSupplierRequest();
                        $RfqSupplierRequest->rfqdetail_id = $id;
                        $RfqSupplierRequest->company_id = $company_id;
                         $RfqSupplierRequest->supplier_id = $supplier;
                        $user_supplier = Company::where('id',$supplier)->first();
                        $RfqSupplierRequest->team_member = $user_supplier->user_id; 
                        $RfqSupplierRequest->save();
                    }
                   
                }
            }

   //  Nda
       $files = [];
       if ($request->hasfile('nda_file')) {
           foreach ($request->file('nda_file') as $key => $file) {
               $name = time() . rand(1, 100) . '.' . $file->extension();
               $file->storeAs('public/nda_file', $name); // Use the Storage facade to store the file
               $files[$key] = $name;
           }
       }

       if (!empty($files)) {
           foreach ($files as $key => $filename) {
               $rfqNda =  RfqNda::where('rfqdetail_id',$id)->first();
               if($rfqNda){
                   $rfqNda->nda_file = 'storage/nda_file/' . $filename; 
                   $rfqNda->rfqdetail_id = $id;
                   $rfqNda->save();
               }
               else{
                   $rfqNda =  new RfqNda ();
                   $rfqNda->nda_file = 'storage/nda_file/' . $filename; 
                   $rfqNda->rfqdetail_id = $id;
                   $rfqNda->save();
               }
               
           }
       }

       //contract_file

       $files = [];
       if ($request->hasfile('contract_file')) {
           foreach ($request->file('contract_file') as $key => $file) {
               $name = time() . rand(1, 100) . '.' . $file->extension();
               $file->storeAs('public/contract_file', $name); 
               $files[$key] = $name;
           }
       }

       if (!empty($files)) {
       foreach ($files as $key => $filename) {
           $rfqcontract = RfqContract::where('rfqdetail_id',$id)->first();
           if($rfqcontract){
                $rfqcontract->contract_file = 'storage/contract_file/' . $filename; 
                $rfqcontract->rfqdetail_id = $id;
                $rfqcontract->save();
           }
           else{
               $rfqcontract = new RfqContract ();
               $rfqcontract->contract_file = 'storage/contract_file/' . $filename; 
                $rfqcontract->rfqdetail_id = $id;
                $rfqcontract->save();
           }
       }
       }
 
       //bidsheet_file

       $files = [];
       if ($request->hasfile('bidsheet_file')) {
       foreach ($request->file('bidsheet_file') as $key => $file) {
           $name = time() . rand(1, 100) . '.' . $file->extension();
           $file->storeAs('public/bidsheet_file', $name); // Use the Storage facade to store the file
           $files[$key] = $name;
       }
       }

       if (!empty($files)) {
           foreach ($files as $key => $filename) {
               $rfqbidsheet = RfqBidsheet::where('rfqdetail_id',$id)->first();
               if($rfqbidsheet){
                   $rfqbidsheet->bidsheet_file = 'storage/bidsheet_file/' . $filename; // Save the relative path in the database
                   $rfqbidsheet->rfqdetail_id = $id;
                   $rfqbidsheet->save();
               }
               else{
                   $rfqbidsheet = new RfqBidsheet ();
                   $rfqbidsheet->bidsheet_file = 'storage/bidsheet_file/' . $filename; // Save the relative path in the database
                   $rfqbidsheet->rfqdetail_id = $id;
                   $rfqbidsheet->save();
               }
               
           }
       }

           //Additional Information
          
           $files = [];
           if ($request->hasfile('additional_file')) {
           foreach ($request->file('additional_file') as $key => $file) {
               $name = time() . rand(1, 100) . '.' . $file->extension();
               $file->storeAs('public/additional_file', $name); // Use the Storage facade to store the file
               $files[$key] = $name;
           }
           }

           if (!empty($files)) {
           foreach ($files as $key => $filename) {
               $rfqadditional = RfqAdditional::where('rfqdetail_id',$id)->first();
               if($rfqadditional){
                    $rfqadditional->additional_file = 'storage/additional_file/' . $filename; // Save the relative path in the database
                   $rfqadditional->additional_name = $filename;
                   $rfqadditional->rfqdetail_id = $id;
                   $rfqadditional->save();
               }
               else{
                   $rfqadditional = new RfqAdditional ();
                    $rfqadditional->additional_file = 'storage/additional_file/' . $filename; // Save the relative path in the database
                   $rfqadditional->additional_name = $filename;
                   $rfqadditional->rfqdetail_id = $id;
                   $rfqadditional->save();
               }
              
           }
           }
      
    
           if($request->preview == null){
            return redirect()->route('RFQ.index');
            
        }
        else{
            return redirect()->route('RFQ.show',$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function SelectSubCategory(Request $request){
        $return = Category::where('parent_id',$request->category)->get();
        $html = view('Admin.select-sub-category', compact('return'))->render();
        echo  $html;
    }
    public function SelectCoverImg(Request $request){
        $return = Coverletter::where('id',$request->coverimg_id)->first();
        $html = view('Admin.RFQ.select-cover-text', compact('return'))->render();
        echo  $html;
    }

    public function SelectCompanys(Request $request){
        $search = $request->searchautocomplete;
        $company_id = Auth()->user()->company_id;
        if($search){
           $return = Company::where('enabled',1)->where('id','!=',$company_id)->where('company_name', 'LIKE', "%{$search}%")->get();
           $html = view('Admin.RFQ.select-company', compact('return'))->render();
           echo  $html ;
        }
        else{
           $html = ' '; 
           echo  $html ;
        }
    }


     // autocomplete bidcurrency open
    public function bidCurrencySearch(Request $request)
    {
        $currencies = $request->input('currency');
        Log::info('$currencies : ' .$currencies);
        $results = Countrie::where('currency', 'LIKE', '%' . $currencies . '%')->distinct()->pluck('currency');
        $results_name = Countrie::where('currency', 'LIKE', '%' . $currencies . '%')->distinct()->pluck('currency_name');
        return response()->json([$results,$results_name]);
    }

    public function rfqsend(Request $request ,$id){
        $rfqDetail =  RfqDetail::find($id);
        $rfqDetail->status = 1;
        $rfqDetail->update();
        return redirect()->route('RFQ.individualIndex',$id)->with('success2','You are not access this page ');
    }


    public function ReceivedIndex()
    {
        $user = Auth::user();
        $RfqSupplierRequest = RfqSupplierRequest::where('supplier_id',$user->company_id)->whereRaw("FIND_IN_SET(?,team_member) > 0", [$user->id])->pluck('rfqdetail_id')->toArray();
        $rfqdetails_received = RfqDetail::orderBy('created_at','desc')->where('status', 1)->whereIn('id', $RfqSupplierRequest)->get();
         
       

        return view('Admin.RFQ-received.RFQ-Create',compact('rfqdetails_received'));
    }   

    public function individualReceived($id)
    {
        $rfqdetail = RfqDetail::with('Category')->find($id);
        $suppliersArray = RfqSupplierRequest::where('rfqdetail_id',$id)->get();
        $suppliersCount = $suppliersArray->count();
         $supplierIds = $suppliersArray->pluck('supplier_id')->toArray();

        $teamMember = $rfqdetail->add_tem_member;
        
        $teamMemberArray = explode(",", $teamMember); 
        $teams = User::whereIn('id', $teamMemberArray)->get();

        $suppliersData = Company::with('user')->whereIn('id',$supplierIds)->get(); 
        
        $category = Category::where('id',$rfqdetail->category_id)->first();
        $subcategory = Category::where('id',$rfqdetail->subcategory_id)->first();
        $rfqlocation = RfqLocation::with('Countrie','State','City')->where('rfqdetail_id',$id)->get();
        $rfqcontract = RfqContract::where('rfqdetail_id',$id)->get();
        $rfqnda = RfqNda::where('rfqdetail_id',$id)->get();
        $rfqbidsheet = RfqBidsheet::where('rfqdetail_id',$id)->get();
        $rfqadditionals = RfqAdditional::where('rfqdetail_id',$id)->get();
        $user_id = Auth::user();
        $CompanyId = Company::where('id',$user_id->company_id)->first();
        $members = user::where('company_id',$CompanyId->id)->get();
        $countries = Countrie::all();
        $RfqSupplierRequest = RfqSupplierRequest::where('rfqdetail_id',$id)->where('supplier_id',$CompanyId->id)->first();
        $bidSheets  = SingBidSheet::where('rfqdetail_id',$id)->where('company_id',$CompanyId->id)->get();
        $SingNdas  = SingNda::where('rfqdetail_id',$id)->where('company_id',$CompanyId->id)->get();
        $SingNdaComments  = NdaComments::where('rfqdetail_id',$id)->where('supplier_id',$CompanyId->id)->where('status','1')->get();
        $bidSheetComments  = NdaComments::where('rfqdetail_id',$id)->where('supplier_id',$CompanyId->id)->where('status','0')->get();
        $questionairs = Questionair::where('rfqdetail_id',$id)->get();
        return view('Admin.RFQ-received.individual-rfq-received',compact('rfqdetail','rfqlocation','rfqcontract','rfqnda','category','subcategory','rfqbidsheet','rfqadditionals','suppliersCount','teams','suppliersData','RfqSupplierRequest','bidSheets','questionairs','members','SingNdas','SingNdaComments','bidSheetComments','countries'));
    }

    public function  NDASing(Request $request,$id,$type){
        $user_id = Auth::user()->id;
        $user = Auth::user();
        $CompanyId = Company::where('id',$user->company_id)->first();
        $rfqDetail = RfqDetail::where('id',$id)->first();
        if($type == 'NDA'){
            if ($request->hasFile('nda_file')) { // Use hasFile, not hasfile
                $file = $request->file('nda_file'); // Use file, not hasfile
                $newFileName = $file->getClientOriginalName();
                $timestamp = date('Y-m-d_H-i-s'); 
                $originalNameNda = $timestamp . '_' . $newFileName;
                $file->storeAs('public/nda_file', $originalNameNda); // Use the Storage facade to store the file
               
                $rfqNdaSing = new SingNda();
                $rfqNdaSing->nda_sign_file = 'storage/nda_file/' . $originalNameNda; // Save the relative path in the database
                $rfqNdaSing->rfqdetail_id = $id;
                $rfqNdaSing->nda_sign_name = $originalNameNda;
                $rfqNdaSing->company_id = $CompanyId->id;
                $rfqNdaSing->save();
    
                $RfqSupplierRequest = RfqSupplierRequest::where('rfqdetail_id',$id)->where('supplier_id',$CompanyId->id)->first();
                if($rfqDetail->nda_auto_approval == '1'){
                    $RfqSupplierRequest->is_nda_sign = '1';
                    $RfqSupplierRequest->status = 'NDA Sign Accepted';
                }
                else {
                    $RfqSupplierRequest->is_nda_sign = '0';
                    $RfqSupplierRequest->status = 'NDA Sign ';
                }
                 
                $RfqSupplierRequest->update();

                $rfqActivity = new RfqActivity();
                $rfqActivity->rfqdetail_id = $id;
                $rfqActivity->is_activies = 'NDA Signed and RFQ Accepted';
                $rfqActivity->company_id = $CompanyId->id;
                $rfqActivity->save();
                //return redirect()->route('RFQ.ReceivedIndex',$id)->with('success','NDA Sign successfully');
                return redirect()->route('RFQ.individualReceived',$id)->with('success','NDA Sign successfully');
            }
        }
        if($type == 'Bid'){
            if ($request->hasFile('bid_file')) { 

                $file = $request->file('bid_file'); 
                $newFileName = $file->getClientOriginalName();
                $timestamp = date('Y-m-d_H-i-s'); 
                $originalNameNda = $timestamp . '_' . $newFileName;
                $file->storeAs('public/bid_file', $originalNameNda); 
                $bidSing = new SingBidSheet();
                $bidSing->bid_sign_file = 'storage/bid_file/' . $originalNameNda;
                $bidSing->rfqdetail_id = $id;
                $bidSing->bid_sign_name = $originalNameNda;
                $bidSing->company_id = $CompanyId->id;
                $bidSing->save();

                $RfqSupplierRequest = RfqSupplierRequest::where('rfqdetail_id',$id)->where('supplier_id',$CompanyId->id)->first();
                $RfqSupplierRequest->is_bid_sign = '0';
                $RfqSupplierRequest->status = 'Bid Sheet Upload';
                $RfqSupplierRequest->update();

                $rfqActivity = new RfqActivity();
                $rfqActivity->rfqdetail_id = $id;
                $rfqActivity->is_activies = ' Bid Sheet updated and RFQ Confirmed';
                $rfqActivity->company_id = $CompanyId->id;
                $rfqActivity->save();
                return redirect()->route('RFQ.individualReceived',$id)->with('success','Bid Sheet updated successfully');

            }
                    
        }

    }

    public function  commentAccepted(Request $request,$rfqdetail_id,$company_id,$supplier_id){
        if($request->status == 'add_commit')
        {
           if($request->add_commit_text){
                $ndaComments = new NdaComments();
                $ndaComments->company_id = $company_id;   
                $ndaComments->supplier_id = $supplier_id;
                $ndaComments->rfqdetail_id = $rfqdetail_id;
                
                $ndaComments->status = 'commit box';
                $ndaComments->comment = $request->add_commit_text;
                $ndaComments->save();
            return redirect()->route('RFQ.individualIndex',$rfqdetail_id)->with('success','Commit Box Add');

           }
        }
        //    NDA Accepted
        if($request->status == 'nda_decline'){
            $ndaComments = new NdaComments();
            $ndaComments->company_id = $company_id;   
            $ndaComments->supplier_id = $supplier_id;
            $bidComments->add_commit_text = implode(',',$request->add_commit_text);
            $ndaComments->rfqdetail_id = $rfqdetail_id;
            $ndaComments->comment = 'NDA Sign Decline';
            $ndaComments->save();

            $RfqSupplierRequest = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
            $RfqSupplierRequest->status = 'NDA Sign Decline';
            $RfqSupplierRequest->update();
            return redirect()->route('RFQ.individualIndex',$rfqdetail_id)->with('success','NDA Sign Decline');
        }
        
        if($request->status == 'nda_accepted'){
            
            $ndaComments = new NdaComments();
            $ndaComments->company_id = $company_id;   
            $ndaComments->supplier_id = $supplier_id;
            $ndaComments->rfqdetail_id = $rfqdetail_id;
            $ndaComments->add_commit_text = implode(',',$request->add_commit_text);
            $ndaComments->comment = 'NDA Sign  Accepted  ';
            
            $ndaComments->save();
            $RfqSupplierRequest = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
            $RfqSupplierRequest->is_nda_sign = '1';
            $RfqSupplierRequest->status = 'NDA Sign  Accepted  ';
            $RfqSupplierRequest->update();
            return redirect()->route('RFQ.individualIndex',$rfqdetail_id)->with('success','NDA Sign  Accepted  successfully');
        }
        if($request->status == 'nda_send'){
            
            $ndaComments = new NdaComments();
            $ndaComments->company_id = $company_id;   
            $ndaComments->supplier_id = $supplier_id;
            $ndaComments->rfqdetail_id = $rfqdetail_id;
            $ndaComments->add_commit_text = implode(',',$request->add_commit_text);
            $ndaComments->comment = 'NDA Comment  ';
            $ndaComments->status = '1';
            $ndaComments->save();
            return redirect()->route('RFQ.individualIndex',$rfqdetail_id)->with('success','NDA Sign  Comment  Successfully');
        }
            //    bid Accepted
            if($request->status == 'bid_sign_accepted'){
                $bidComments = new NdaComments();
                $bidComments->company_id = $company_id;   
                $bidComments->supplier_id = $supplier_id;
                $bidComments->rfqdetail_id = $rfqdetail_id;
                $bidComments->add_commit_text = implode(',',$request->add_commit_text);
                $bidComments->comment = 'Bid Sign Accepted';
                $bidComments->save();

                $RfqSupplierRequestbid = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                $RfqSupplierRequestbid->is_bid_sign = '1';
                $RfqSupplierRequestbid->status = 'Bid Sign Accepted';
                $RfqSupplierRequestbid->update();
                return redirect()->route('RFQ.individualIndex',$rfqdetail_id)->with('success','Bid Sign Accepted');
            }
            if($request->status == 'bid_signd_decline'){
                $bidComments = new NdaComments();
                $bidComments->company_id = $company_id;   
                $bidComments->supplier_id = $supplier_id;
                $bidComments->rfqdetail_id = $rfqdetail_id;
                $bidComments->add_commit_text = implode(',',$request->add_commit_text);
                $bidComments->comment = 'Bid Sign Decline';
                $bidComments->save();

                $RfqSupplierRequestbid = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                $RfqSupplierRequestbid->status = 'Bid Sign Decline';
                $RfqSupplierRequestbid->update();
                return redirect()->route('RFQ.individualIndex',$rfqdetail_id)->with('success','Bid Sign Decline');
            }
            if($request->status == 'bid_sign_send'){
                $bidComments = new NdaComments();
                $bidComments->company_id = $company_id;   
                $bidComments->supplier_id = $supplier_id;
                $bidComments->rfqdetail_id = $rfqdetail_id;
                $bidComments->add_commit_text = implode(',',$request->add_commit_text);
                $bidComments->comment = 'Bid Sign Commit';
                $bidComments->status = '0';
                $bidComments->save();

                return redirect()->route('RFQ.individualIndex',$rfqdetail_id)->with('success','Bid Sign Commit');
            }
         
         //    Intend to Bid Decline and Accepted
        if($request->status == 'supplier_Decline'){
            $ndaComments = new NdaComments();
            $ndaComments->company_id = $company_id;   
            $ndaComments->supplier_id = $supplier_id;
            $ndaComments->rfqdetail_id = $rfqdetail_id;
            $ndaComments->comment = 'Intend to Bid Decline';
            $ndaComments->update();

            $RfqSupplierRequest = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
            $RfqSupplierRequest->status = 'Intend to Bid Decline';
            $RfqSupplierRequest->update();
            return redirect()->route('RFQ.individualReceived',$rfqdetail_id)->with('success','Intend to Bid Decline');
        }

        if($request->status == 'supplier_Accepted'){
            $ndaComments = new NdaComments();
            $ndaComments->company_id = $company_id;   
            $ndaComments->supplier_id = $supplier_id;
            $ndaComments->rfqdetail_id = $rfqdetail_id;
            $ndaComments->comment = 'Intend to Bid ';
            $ndaComments->update();

            $RfqSupplierRequest = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
            $RfqSupplierRequest->nda_accepted = '1';
            $RfqSupplierRequest->status = 'Intend to Bid ';
            $RfqSupplierRequest->update();
            return redirect()->route('RFQ.individualReceived',$rfqdetail_id)->with('success','Intend to Bid  successfully');
        }
        // Bid Detail upload
        if($request->status == 'Submit'){   
            $ndaComments = new NdaComments();
            $ndaComments->company_id = $company_id;   
            $ndaComments->supplier_id = $supplier_id;
            $ndaComments->rfqdetail_id = $rfqdetail_id;
            $ndaComments->comment = 'Bid Detail upload';
            $ndaComments->update();
            if($request->supplier_member){
                $rfqDetail = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                $rfqDetail->team_member = implode(',',$request->supplier_member);
                $rfqDetail->team_member_status = '1';
                $rfqDetail->update();
            }
            RfqTrait::createGroup($rfqdetail_id, $supplier_id);
            $BidDetail_update = BidDetail::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
            if($BidDetail_update){
                $BidDetail_update->company_id = $company_id;   
                $BidDetail_update->supplier_id = $supplier_id;
                $BidDetail_update->rfqdetail_id = $rfqdetail_id;
                if($request->currency){
                    $rfqDetail_currency = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                    $rfqDetail_currency->bid_details_status = '1';
                    $BidDetail_update->currency = $request->currency;
                    $BidDetail_update->converstion_rate = $request->converstion_rate;
                    $rfqDetail_currency->update();
                }
                
                if($request->material_name){
                    $BidDetail_update->material_name = implode(',',$request->material_name);
                    $BidDetail_update->material_value = implode(',',$request->material_value);
                    $BidDetail_update->material_index = implode(',',$request->material_index);
                }
                if($request->payment_terms)
               {
                    $rfqDetail_payment = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                    $rfqDetail_payment->payment_terms = '1';
                    $rfqDetail_payment->update();
                    $BidDetail_update->payment_terms = $request->payment_terms;
                    $BidDetail_update->year = $request->year;
                    $BidDetail_update->contract_duration = $request->contract_duration;
               }
                if($request->additional_Information){
                    $rfqDetail_additional = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                    $rfqDetail_additional->additional_information = '1';
                    $rfqDetail_additional->update();
                    $BidDetail_update->additional_Information = $request->additional_Information;
                }
                $BidDetail_update->update();
                if($request->text_ans){
                     foreach($request->text_ans as $key=>$text_Questiona_id){
                        if($text_Questiona_id){
                            $answer_text =  QuestionairAnswer::where('rfqdetail_id',$rfqdetail_id)->where('supplier_id',$supplier_id)->where('questionair_id',$key)->first();
                            if($answer_text){
                                 $answer_text->answer =$text_Questiona_id;
                                 $answer_text->update();
                                 $rfqDetail_Questionair = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                                $rfqDetail_Questionair->questionair = '1';
                                $rfqDetail_Questionair->update();
                            }
                            else{
                                $answer_text =  new QuestionairAnswer ();
                                $answer_text->answer =$text_Questiona_id;
                                $answer_text->rfqdetail_id =$rfqdetail_id;
                                $answer_text->supplier_id =$supplier_id;
                                $answer_text->questionair_id =$key;
                                $answer_text->save();
                                $rfqDetail_Questionair = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                                $rfqDetail_Questionair->questionair = '1';
                                $rfqDetail_Questionair->update();
                            }
                           
                        }
                        
                        
                    }
                }
                   if($request->choice_ans){
                           foreach($request->choice_ans as $Questiona_id=>$choice_Questiona_id){
                            if($choice_Questiona_id){
                                $answer_choice = QuestionairAnswer::where('rfqdetail_id',$rfqdetail_id)->where('supplier_id',$supplier_id)->where('questionair_id',$Questiona_id)->first();
                                if($answer_choice){
                                    $answer_choice->answer =$choice_Questiona_id;
                                   $answer_choice->update();
                                    $rfqDetail_Questionair = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                                $rfqDetail_Questionair->questionair = '1';
                                $rfqDetail_Questionair->update();
                                }
                                else{
                                    $answer_choice =  new QuestionairAnswer ();
                                    $answer_choice->answer =$choice_Questiona_id;
                                    $answer_choice->rfqdetail_id =$rfqdetail_id;
                                    $answer_choice->supplier_id =$supplier_id;
                                    $answer_choice->questionair_id =$Questiona_id;
                                    $answer_choice->save();
                                     $rfqDetail_Questionair = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                                $rfqDetail_Questionair->questionair = '1';
                                $rfqDetail_Questionair->update();
                                }
                                
                            }
                            
                        }
                   }
                   
                   if($request->drop_ans){
                            foreach($request->drop_ans as $Questiona_id=>$drop_Questiona_id){
                            if($drop_Questiona_id){
                                $answer_drop = QuestionairAnswer::where('rfqdetail_id',$rfqdetail_id)->where('supplier_id',$supplier_id)->where('questionair_id',$Questiona_id)->first();
                                if($answer_drop){
                                    $answer_drop->answer =$drop_Questiona_id;
                                    $answer_drop->update();
                                     $rfqDetail_Questionair = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                                $rfqDetail_Questionair->questionair = '1';
                                $rfqDetail_Questionair->update();
                                }
                                else{
                                    $answer_drop =  new QuestionairAnswer ();
                                    $answer_drop->answer =$drop_Questiona_id;
                                    $answer_drop->rfqdetail_id =$rfqdetail_id;
                                    $answer_drop->supplier_id =$supplier_id;
                                    $answer_drop->questionair_id =$Questiona_id;
                                    $answer_drop->save();
                                     $rfqDetail_Questionair = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                                $rfqDetail_Questionair->questionair = '1';
                                $rfqDetail_Questionair->update();
                                }
                                
                            }
                        }
                   }
                    if($request->file_date){
                        foreach($request->file_date as $Questiona_id=>$date_Questiona_id){
                            if($date_Questiona_id){
                                $answer_date = QuestionairAnswer::where('rfqdetail_id',$rfqdetail_id)->where('supplier_id',$supplier_id)->where('questionair_id',$Questiona_id)->first();
                                $answer_date->answer =$date_Questiona_id;
                                $answer_date->update();
                                 $rfqDetail_Questionair = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                                $rfqDetail_Questionair->questionair = '1';
                                $rfqDetail_Questionair->update();
                            }
                             else{
                                $answer_date =  new QuestionairAnswer ();
                                $answer_date->answer =$date_Questiona_id;
                                $answer_date->rfqdetail_id =$rfqdetail_id;
                                $answer_date->supplier_id =$supplier_id;
                                $answer_date->questionair_id =$Questiona_id;
                                $answer_date->save();
                                 $rfqDetail_Questionair = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                                $rfqDetail_Questionair->questionair = '1';
                                $rfqDetail_Questionair->update();
                            }
                        }
                    }
                    if($request->file_ans){
                         foreach($request->file_ans as $Questiona_id=>$file_Questiona_id){
                        if($file_Questiona_id){
                            $answer_file = QuestionairAnswer::where('rfqdetail_id',$rfqdetail_id)->where('supplier_id',$supplier_id)->where('questionair_id',$Questiona_id)->first();
                            $file = $file_Questiona_id; 
                            $newFileName = $file->getClientOriginalName();
                            $timestamp = date('Y-m-d_H-i-s'); 
                            $originalNameNda = $timestamp . '_' . $newFileName;
                            $file->storeAs('public/questiona_file', $originalNameNda); 
                            $answer_file->answer ='storage/questiona_file/' . $originalNameNda;
                            $answer_file->update();
                        }
                    }
                    }
                   
                
            }
            else {
                $BidDetail = new BidDetail ();
                $BidDetail->company_id = $company_id;   
                $BidDetail->supplier_id = $supplier_id;
                $BidDetail->rfqdetail_id = $rfqdetail_id;
                $BidDetail->currency = $request->currency;
                $BidDetail->converstion_rate = $request->converstion_rate;
                if($request->material_name){
                    $BidDetail->material_name = implode(',',$request->material_name);
                    $BidDetail->material_value = implode(',',$request->material_value);
                    $BidDetail->material_index = implode(',',$request->material_index);
                }
                $rfqDetail_Questionair = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                $rfqDetail_Questionair->bid_details_status = '1';
                $rfqDetail_Questionair->update();
                $BidDetail->payment_terms = $request->payment_terms;
                $BidDetail->year = $request->year;
                $BidDetail->contract_duration = $request->contract_duration;
                if( $request->additional_Information){
                    $BidDetail->additional_Information = $request->additional_Information;
                }
                
                $BidDetail->status = '1';
                if($request->text_ans){
                     foreach($request->text_ans as $key=>$text_Questiona_id){
                        if($text_Questiona_id){
                            $answer_text = new QuestionairAnswer ();
                            $answer_text->rfqdetail_id = $rfqdetail_id;
                            $answer_text->supplier_id = $supplier_id;
                            $answer_text->questionair_id = $key;
                            $answer_text->answer =$text_Questiona_id;
                            $answer_text->save();
                        }
                        
                    }
                }
                if($request->choice_ans){
                    foreach($request->choice_ans as $Questiona_id=>$choice_Questiona_id){
                        if($choice_Questiona_id){
                            $answer_choice = new QuestionairAnswer ();
                            $answer_choice->rfqdetail_id = $rfqdetail_id;
                            $answer_choice->supplier_id = $supplier_id;
                            $answer_choice->questionair_id = $Questiona_id;
                            $answer_choice->answer =$choice_Questiona_id;
                            $answer_choice->save();
                        }
                        
                    }
                }
                    
                    if($request->drop_ans){
                            foreach($request->drop_ans as $Questiona_id=>$drop_Questiona_id){
                            if($drop_Questiona_id){
                                $answer_drop = new QuestionairAnswer ();
                                $answer_drop->answer = $drop_Questiona_id;
                                $answer_drop->rfqdetail_id = $rfqdetail_id;
                                $answer_drop->supplier_id = $supplier_id;
                                $answer_drop->questionair_id = $Questiona_id;
                                $answer_drop->save();
                            }
                        }
                    }
                    if($request->file_date){
                           foreach($request->file_date as $Questiona_id=>$date_Questiona_id){
                            if($date_Questiona_id){
                                $answer_date = new QuestionairAnswer ();
                                $answer_date->answer =$date_Questiona_id;
                                $answer_date->rfqdetail_id = $rfqdetail_id;
                                $answer_date->supplier_id = $supplier_id;
                                $answer_date->questionair_id = $Questiona_id;
                                $answer_date->save();
                            }
                        } 
                    }
                    if($request->file('file_ans')){
                      $files = $request->file('file_ans');
                        foreach($files as $Questiona_id=>$file_Questiona_id){
                            if($file_Questiona_id){
                                $answer_file = new QuestionairAnswer ();
                                $data = $request->file('file_ans');
                                $file = $data[$Questiona_id];
                                $newFileName = $file->getClientOriginalName();
                                $timestamp = date('Y-m-d_H-i-s'); 
                                $originalNameNda = $timestamp . '_' . $newFileName;
                                $file->storeAs('public/questiona_file', $originalNameNda); 
                                $answer_file->answer ='storage/questiona_file/' . $originalNameNda;
                                $answer_file->rfqdetail_id = $rfqdetail_id;
                                $answer_file->supplier_id = $supplier_id;
                                $answer_file->questionair_id = $Questiona_id;
                                $answer_file->save();
                            }
                        }  
                    }
                
                $BidDetail->save();

                $RfqSupplierRequest = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                $RfqSupplierRequest->status = 'Bid Detail upload';
                $RfqSupplierRequest->update();
            }


            
            return redirect()->route('RFQ.individualReceived',$rfqdetail_id)->with('success','Bid Detail upload  successfully');
        }

        if($request->status == 'Preview'){
            $ndaComments = new NdaComments();
            $ndaComments->company_id = $rfqdetail_id;
            $ndaComments->supplier_id = $company_id;
            $ndaComments->rfqdetail_id = $supplier_id;
            $ndaComments->comment = 'Bid Detail upload';
            $ndaComments->update();

            $BidDetail_update = BidDetail::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
            if($BidDetail_update){
                $BidDetail_update->company_id = $rfqdetail_id;
                $BidDetail_update->supplier_id = $company_id;
                $BidDetail_update->rfqdetail_id = $supplier_id;
                $BidDetail_update->currency = $request->currency;
                $BidDetail_update->converstion_rate = $request->converstion_rate;
                $BidDetail_update->material_name = implode(',',$request->material_name);
                $BidDetail_update->material_value = implode(',',$request->material_value);
                $BidDetail_update->material_index = implode(',',$request->material_index);
                $BidDetail_update->payment_terms = $request->payment_terms;
                $BidDetail_update->year = $request->year;
                $BidDetail_update->contract_duration = $request->contract_duration;
                if($request->additional_Information){
                     $BidDetail_update->additional_Information = $request->additional_Information;
                }
               
                $BidDetail_update->update();
                if($request->supplier_member){
                    $rfqDetail = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                    $rfqDetail->team_member = implode(',',$request->supplier_member);
                    $rfqDetail->update();
                }

                if($request->text_ans){
                    foreach($request->text_ans as $key=>$text_Questiona_id){
                        if($text_Questiona_id){
                            $answer_text =  QuestionairAnswer::where('rfqdetail_id',$rfqdetail_id)->where('supplier_id',$supplier_id)->where('questionair_id',$key)->first();
                            $answer_text->answer =$text_Questiona_id;
                            $answer_text->update();
                        }
                        else{
                            $answer_text =  new QuestionairAnswer ();
                            $answer_text->answer =$text_Questiona_id;
                            $answer_text->rfqdetail_id =$rfqdetail_id;
                            $answer_text->supplier_id =$supplier_id;
                            $answer_text->questionair_id =$key;
                            $answer_text->save();
                        }
                    }
                }
                if($request->choice_ans){
                     foreach($request->choice_ans as $Questiona_id=>$choice_Questiona_id){
                        if($choice_Questiona_id){
                            $answer_choice = QuestionairAnswer::where('rfqdetail_id',$rfqdetail_id)->where('supplier_id',$supplier_id)->where('questionair_id',$Questiona_id)->first();
                            $answer_choice->answer =$choice_Questiona_id;
                            $answer_choice->update();
                        }
                        else{
                            $answer_choice =  new QuestionairAnswer ();
                            $answer_choice->answer =$choice_Questiona_id;
                            $answer_choice->rfqdetail_id =$rfqdetail_id;
                            $answer_choice->supplier_id =$supplier_id;
                            $answer_choice->questionair_id =$key;
                            $answer_choice->save();
                        }
                    }
                }
                
               if($request->drop_ans){
                    foreach($request->drop_ans as $Questiona_id=>$drop_Questiona_id){
                        if($drop_Questiona_id){
                            $answer_drop = QuestionairAnswer::where('rfqdetail_id',$rfqdetail_id)->where('supplier_id',$supplier_id)->where('questionair_id',$Questiona_id)->first();
                            $answer_drop->answer =$drop_Questiona_id;
                            $answer_drop->update();
                        }
                         else{
                            $answer_drop =  new QuestionairAnswer ();
                            $answer_drop->answer =$drop_Questiona_id;
                            $answer_drop->rfqdetail_id =$rfqdetail_id;
                            $answer_drop->supplier_id =$supplier_id;
                            $answer_drop->questionair_id =$key;
                            $answer_drop->save();
                        }
                    }
               }
               if($request->file_date){
                   foreach($request->file_date as $Questiona_id=>$date_Questiona_id){
                        if($date_Questiona_id){
                            $answer_date = QuestionairAnswer::where('rfqdetail_id',$rfqdetail_id)->where('supplier_id',$supplier_id)->where('questionair_id',$Questiona_id)->first();
                            $answer_date->answer =$date_Questiona_id;
                            $answer_date->update();
                        }
                        else{
                            $answer_date =  new QuestionairAnswer ();
                            $answer_date->answer =$date_Questiona_id;
                            $answer_date->rfqdetail_id =$rfqdetail_id;
                            $answer_date->supplier_id =$supplier_id;
                            $answer_date->questionair_id =$key;
                            $answer_date->save();
                        }
                    }
               }
                if($request->file('file_ans')){
                     $files = $request->file('file_ans');
                    foreach($files as $Questiona_id=>$file_Questiona_id){
                        if($file_Questiona_id){
                            $answer_file = QuestionairAnswer::where('rfqdetail_id',$rfqdetail_id)->where('supplier_id',$supplier_id)->where('questionair_id',$Questiona_id)->first();
                            $data = $request->file('file_ans');
                            $file = $data[$Questiona_id];
                            $newFileName = $file->getClientOriginalName();
                            $timestamp = date('Y-m-d_H-i-s'); 
                            $originalNameNda = $timestamp . '_' . $newFileName;
                            $file->storeAs('public/questiona_file', $originalNameNda); 
                            $answer_file->answer ='storage/questiona_file/' . $originalNameNda;
                            $answer_file->update();
                        }
                    }
                }
               
            }
            else {
                $BidDetail = new BidDetail ();
                $BidDetail->company_id = $rfqdetail_id;
                $BidDetail->supplier_id = $company_id;
                $BidDetail->rfqdetail_id = $supplier_id;
                $BidDetail->currency = $request->currency;
                $BidDetail->converstion_rate = $request->converstion_rate;
                $BidDetail->material_name = implode(',',$request->material_name);
                $BidDetail->material_value = implode(',',$request->material_value);
                $BidDetail->material_index = implode(',',$request->material_index);
                $BidDetail->payment_terms = $request->payment_terms;
                $BidDetail->year = $request->year;
                $BidDetail->contract_duration = $request->contract_duration;
                if($request->additional_Information){
                     $BidDetail->additional_Information = $request->additional_Information;
                }
               
                $BidDetail->save();

                
                $RfqSupplierRequest = RfqSupplierRequest::where('rfqdetail_id',$rfqdetail_id)->where('company_id',$company_id)->where('supplier_id',$supplier_id)->first();
                $RfqSupplierRequest->status = 'Bid Detail upload';
                $RfqSupplierRequest->update();
                if($request->text_ans){
                    foreach($request->text_ans as $key=>$text_Questiona_id){
                        if($text_Questiona_id){
                            $answer_text = new QuestionairAnswer ();
                            $answer_text->rfqdetail_id = $rfqdetail_id;
                            $answer_text->supplier_id = $supplier_id;
                            $answer_text->questionair_id = $key;
                            $answer_text->answer =$text_Questiona_id;
                            $answer_text->save();
                        }
                        
                    }
                }
                if($request->choice_ans){
                    foreach($request->choice_ans as $Questiona_id=>$choice_Questiona_id){
                        if($choice_Questiona_id){
                            $answer_choice = new QuestionairAnswer ();
                            $answer_choice->rfqdetail_id = $rfqdetail_id;
                            $answer_choice->supplier_id = $supplier_id;
                            $answer_choice->questionair_id = $Questiona_id;
                            $answer_choice->answer =$choice_Questiona_id;
                            $answer_choice->save();
                        }
                        
                    }
                }
                if($request->drop_ans){
                     foreach($request->drop_ans as $Questiona_id=>$drop_Questiona_id){
                        if($drop_Questiona_id){
                            $answer_drop = new QuestionairAnswer ();
                            $answer_drop->answer = $drop_Questiona_id;
                            $answer_drop->rfqdetail_id = $rfqdetail_id;
                            $answer_drop->supplier_id = $supplier_id;
                            $answer_drop->questionair_id = $Questiona_id;
                            $answer_drop->save();
                        }
                    }
                }
               if($request->file_date){
                    foreach($request->file_date as $Questiona_id=>$date_Questiona_id){
                        if($date_Questiona_id){
                            $answer_date = new QuestionairAnswer ();
                            $answer_date->answer =$date_Questiona_id;
                            $answer_date->rfqdetail_id = $rfqdetail_id;
                            $answer_date->supplier_id = $supplier_id;
                            $answer_date->questionair_id = $Questiona_id;
                            $answer_date->save();
                        }
                    }
               }
               if($request->file('file_ans')){
                    $files = $request->file('file_ans');
                    foreach($files as $Questiona_id=>$file_Questiona_id){
                        if($file_Questiona_id){
                            $answer_file = new QuestionairAnswer ();
                            $data = $request->file('file_ans');
                            $file = $data[$Questiona_id];
                            $newFileName = $file->getClientOriginalName();
                            $timestamp = date('Y-m-d_H-i-s'); 
                            $originalNameNda = $timestamp . '_' . $newFileName;
                            $file->storeAs('public/questiona_file', $originalNameNda); 
                            $answer_file->answer ='storage/questiona_file/' . $originalNameNda;
                            $answer_file->rfqdetail_id = $rfqdetail_id;
                            $answer_file->supplier_id = $supplier_id;
                            $answer_file->questionair_id = $Questiona_id;
                            $answer_file->save();
                        }
                    }
               }
               
            
            }
            
            return redirect()->route('RFQ.individualReceived',$rfqdetail_id)->with('success','Bid Detail upload successfully');
        }
    }

    public function rfqSupplerGroup(Request $request){
        $groupId = $request->group_id;
        $companyId = auth()->user()->company_id;
        $groupWithSuppliers = SupplierGroup::where('id',$groupId)->first();
        
       
        $htmlContent = view('Admin.RFQ.RFQ-suppler-group', compact('Company', 'groupWithSuppliers', 'suppli'))->render();

        return response()->json(['html' => $htmlContent]);
    }
    
    public function createRfqMessageGroup(Request $request, RfqDetail $rfqDetail)
    {
        // create message group and add team member to access chat group
        $response = RfqTrait::createGroup($rfqDetail->id, explode(',', $rfqDetail->supplier_add));

        if ($response) {
            return redirect()->route('RFQ.sentIndex')->withError('Failed');
        } else {
            return redirect()->route('RFQ.sentIndex')->withSuccess('Success');
        }
    }
    
    public function getMemberRoles(Request $request){
        $user = User::where('id',$request->user_id)->first();
        return  'dfjgbdifg';
        
    }
    
    public function nda_remove(Request $request){
       $rfqNda =  RfqNda::where('id',$request->nda_id)->delete(); 
       return $rfqNda ;
    }
    
    public function contractRmove(Request $request){
       $RfqContract =  RfqContract::where('id',$request->contract_id)->delete(); 
       return $RfqContract ;
    }
    
    public function bidsheet_remove(Request $request){
       $RfqBidsheet =  RfqBidsheet::where('id',$request->bidsheet_id)->delete(); 
       return $RfqBidsheet ;
    }
    
    public function location_remove(Request $request){
       $RfqLocation =  RfqLocation::where('id',$request->location_id)->delete(); 
       return $RfqLocation ;
    }
    
    public function adddelete_company(Request $request){
       $RfqLocation =  RfqSupplierRequest::where('id',$request->card_id)->delete(); 
       return $RfqLocation ;
    }


}
