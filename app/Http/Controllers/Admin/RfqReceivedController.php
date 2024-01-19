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
use App\Models\RfqAdditional;
use Illuminate\Support\Facades\Auth;

class RfqReceivedController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
       $rfqdetails = RfqDetail::where('status','2')->get();
       return view('Admin.RFQ-received.RFQ-Create',compact('rfqdetails'));
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
       $user_id = Auth::User()->id;
       $company = Company::where('user_id',$user_id)->first();
       $members = User::where('company_id',$company->id)->get();
       return view('Admin.RFQ-received.RFQ-Events',compact('category','countries','coverletters','ndas','contracts','bidsheets','members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


         $request->validate([
        'rfq_name' => 'required',
        'rfq_type' => 'required',
        'category_id' => 'required',
        'subcategory_id' => 'required',
        'demandtype' => 'required',
        'bidsheet_file' => 'required',
        'supplier_add ' => 'required',
        'rfq_bid_currency ' => 'required',
        'exchange_rate_refrence ' => 'required',
        'raw_materials_name ' => 'required',
        'add_tem_member ' => 'required',
        'one_time ' => 'required',
        'recurrening ' => 'required',
        'delivery ' => 'required',
        'import_terms ' => 'required',
        'payment_after_delivery ' => 'required',
        'ticketDesc ' => 'required',
        'demand_type ' => 'required',
        'year_discount_terms ' => 'required',
        'contract_duration_terms ' => 'required',
        'radio-group ' => 'required',
        'acknowledgement_deadline ' => 'required',
        'query_deadline ' => 'required',
        'bid_submission_deadline ' => 'required',
        'additional_file ' => 'required',
        'additional_information ' => 'required',
        'refrence_date ' => 'required',
     ]);

        //dd($request->all());
        $user_id = Auth::guard('web')->user()->id;
        $company = Company::where('user_id',$user_id)->first();
        $company_id = $company->id;

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
        $rfqDetail->raw_materials_name = $request->raw_materials_name;
        $rfqDetail->refrence_date = $request->refrence_date;
        // Point of Contact     
        // $rfqDetail->add_tem_member = implode(',',$request->add_tem_member); // off
        // Delivery Terms
        $rfqDetail->one_time = $request->one_time;
        $rfqDetail->recurrening = $request->recurrening;
        $rfqDetail->delivery = implode(',',$request->delivery) ;
        $rfqDetail->import_terms = $request->import_terms;
        //Standrad Payment Terms
        $rfqDetail->payment_after_delivery = $request->payment_after_delivery;
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
        $rfqDetail->additional_information = $request->additional_information;
        // supplier_add
        $rfqDetail->supplier_add = implode(',',$request->supplier_add);
        $rfqDetail->save();
        $RFQ = RfqDetail::latest()->first();
        //Location save
        if($request->zipcode){
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
            $rfqNda = new RfqNda();
            $rfqNda->nda_file = 'storage/nda_file/' . $filename; // Save the relative path in the database
            $rfqNda->rfqdetail_id = $RFQ->id;
            $rfqNda->save();
        }
        }
 
        //contract_file

        $files = [];
        if ($request->hasfile('contract_file')) {
        foreach ($request->file('contract_file') as $key => $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('public/contract_file', $name); // Use the Storage facade to store the file
            $files[$key] = $name;
        }
        }

        if (!empty($files)) {
        foreach ($files as $key => $filename) {
            $rfqcontract = new RfqContract();
            $rfqcontract->contract_file = 'storage/contract_file/' . $filename; // Save the relative path in the database
            $rfqcontract->rfqdetail_id = $RFQ->id;
            $rfqcontract->save();
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
            $rfqbidsheet = new RfqBidsheet();
            $rfqbidsheet->bidsheet_file = 'storage/bidsheet_file/' . $filename; // Save the relative path in the database
            $rfqbidsheet->rfqdetail_id = $RFQ->id;
            $rfqbidsheet->save();
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
                    $rfqadditional = new RfqAdditional();
                    $rfqadditional->additional_file = 'storage/additional_file/' . $filename; // Save the relative path in the database
                    $rfqadditional->additional_name = $filename;
                    $rfqadditional->rfqdetail_id = $RFQ->id;
                    $rfqadditional->save();
                }
            }
       
     
     
       return redirect()->route('RFQ-received.index');
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
        $category = Category::where('id',$rfqdetail->category_id)->first();
        $subcategory = Category::where('id',$rfqdetail->subcategory_id)->first();
        $rfqlocation = RfqLocation::with('Countrie','State','City')->where('rfqdetail_id',$id)->get();
        $rfqcontract = RfqContract::where('rfqdetail_id',$id)->get();
        $rfqnda = RfqNda::where('rfqdetail_id',$id)->get();
        $rfqbidsheet = RfqBidsheet::where('rfqdetail_id',$id)->get();
        $rfqadditionals = RfqAdditional::where('rfqdetail_id',$id)->get();
        return view('Admin.RFQ-received.RFQ-View',compact('rfqdetail','rfqlocation','rfqcontract','rfqnda','category','subcategory','rfqbidsheet','rfqadditionals'));
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
        $coverletters = Coverletter::limit(5)->get(); 
        $ndas = NDA::limit(5)->get();
        $contracts = Contract::limit(5)->get();
        $bidsheets = Bidsheet::limit(5)->get();
        $user_id = Auth::User()->id;
        $company = Company::where('user_id',$user_id)->first();
        $members = User::where('company_id',$company->id)->get();

        $rfqdetail = RfqDetail::with('Category')->find($id);
        $category_date = Category::where('id',$rfqdetail->category_id)->first();
        $subcategory = Category::where('id',$rfqdetail->subcategory_id)->first();
        $rfqlocation = RfqLocation::with('Countrie','State','City')->where('rfqdetail_id',$id)->get();
        $rfqcontract = RfqContract::where('rfqdetail_id',$id)->get();
        $rfqnda = RfqNda::where('rfqdetail_id',$id)->get();
        $rfqbidsheet = RfqBidsheet::where('rfqdetail_id',$id)->get();
        $rfqadditionals = RfqAdditional::where('rfqdetail_id',$id)->get();
        return view('Admin.RFQ-received.RFQ-Edit',compact('rfqdetail','rfqlocation','rfqcontract','rfqnda','category','subcategory','rfqbidsheet','rfqadditionals','countries','coverletters','ndas','contracts','bidsheets','members','category_date'));;
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
       //dd($request->all());
       $user_id = Auth::guard('web')->user()->id;
       $company = Company::where('user_id',$user_id)->first();
       $company_id = $company->id;

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
       $rfqDetail->raw_materials_name = $request->raw_materials_name;
       $rfqDetail->refrence_date = $request->refrence_date;
       // Point of Contact     
       $rfqDetail->add_tem_member = implode(',',$request->add_tem_member);
       // Delivery Terms
       $rfqDetail->one_time = $request->one_time;
       $rfqDetail->recurrening = $request->recurrening;
       $rfqDetail->delivery = implode(',',$request->delivery) ;
       $rfqDetail->import_terms = $request->import_terms;
       //Standrad Payment Terms
       $rfqDetail->payment_after_delivery = $request->payment_after_delivery;
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
       $rfqDetail->additional_information = $request->additional_information;
       $rfqDetail->status = $request->status;
    
       $rfqDetail->save();
       //Location save
       if($request->zipcode){
           foreach($request->country_id as $key=>$coutry){
               $rfqlocation =  RfqLocation::where('rfqdetail_id',$id)->first();
               $rfqlocation->countrie_id = $coutry;
               $rfqlocation->state_id = $request->state_id[$key];
               $rfqlocation->city_id = $request->city_id[$key];
               $rfqlocation->rfqdetail_id = $id;
               $rfqlocation->zipcode = $request->zipcode[$key];
               $rfqlocation->save();
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
           $rfqNda->nda_file = 'storage/nda_file/' . $filename; // Save the relative path in the database
           $rfqNda->rfqdetail_id = $id;
           $rfqNda->save();
       }
       }

       //contract_file

       $files = [];
       if ($request->hasfile('contract_file')) {
       foreach ($request->file('contract_file') as $key => $file) {
           $name = time() . rand(1, 100) . '.' . $file->extension();
           $file->storeAs('public/contract_file', $name); // Use the Storage facade to store the file
           $files[$key] = $name;
       }
       }

       if (!empty($files)) {
       foreach ($files as $key => $filename) {
           $rfqcontract = RfqContract::where('rfqdetail_id',$id)->first();
           $rfqcontract->contract_file = 'storage/contract_file/' . $filename; // Save the relative path in the database
           $rfqcontract->rfqdetail_id = $id;
           $rfqcontract->save();
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
           $rfqbidsheet = RfqBidsheet::where('rfqdetail_id',$id)->first();;
           $rfqbidsheet->bidsheet_file = 'storage/bidsheet_file/' . $filename; // Save the relative path in the database
           $rfqbidsheet->rfqdetail_id = $id;
           $rfqbidsheet->save();
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
               $rfqadditional->additional_file = 'storage/additional_file/' . $filename; // Save the relative path in the database
               $rfqadditional->additional_name = $filename;
               $rfqadditional->rfqdetail_id = $id;
               $rfqadditional->save();
           }
           }
      
    
    
      return redirect()->route('RFQ-received.index');
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
        $html = view('Admin.RFQ-received.select-cover-text', compact('return'))->render();
        echo  $html;
    }

    public function SelectCompanys(Request $request){
        $return = Company::where('company_name',$request->searchautocomplete)->get();
        $html = view('Admin.RFQ-received.select-company', compact('return'))->render();
        echo  $html;
    }
}
