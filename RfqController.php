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
use Illuminate\Support\Facades\Auth;
 


class RfqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
       $rfqdetails = RfqDetail::all();
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
       $user_id = Auth::User()->id;
       $company = Company::where('user_id',$user_id)->first();
       $members = User::where('company_id',$company->id)->get();
       return view('Admin.RFQ.RFQ-Events',compact('category','countries','coverletters','ndas','contracts','bidsheets','members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
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
        $rfqDetail->add_tem_member = $request->add_tem_member;
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
        // $rfqDetail->additional_image = $request->additional_image;
        $rfqDetail->additional_information = $request->additional_information;
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
        if($request->nda_file){
            $files = [];

            if ($request->hasfile('nda_file')) {
                foreach ($request->file('nda_file') as $key => $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('nda'), $name);
                    $files[$key] = $name;
                }
            }

            if (!empty($files)) {
                foreach ($files as $key => $filename) {
                    $rfqNda = new RfqNda();
                    $rfqNda->nda_file = 'storage/nda/' . $filename; // Use 'nda' or 'storage/nda' depending on your setup.
                    $rfqNda->rfqdetail_id = $RFQ->id;
                    $rfqNda->save();
                }
            }

        }
        if($request->contract_file){
            $files = [];

            if ($request->hasfile('contract_file')) {
                foreach ($request->file('contract_file') as $key => $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('contract'), $name);
                    $files[$key] = $name;
                }
            }

            if (!empty($files)) {
                foreach ($files as $key => $filename) {
                    $rfqNda = new RfqContract();
                    $rfqNda->contract_file = 'storage/contract/' . $filename; // Use 'nda' or 'storage/nda' depending on your setup.
                    $rfqNda->rfqdetail_id = $RFQ->id;
                    $rfqNda->save();
                }
            }
        }

        if($request->bidsheet_file){
            $files = [];

            if ($request->hasfile('bidsheet_file')) {
                foreach ($request->file('bidsheet_file') as $key => $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('bidsheet_img'), $name);
                    $files[$key] = $name;
                }
            }

            if (!empty($files)) {
                foreach ($files as $key => $filename) {
                    $rfqNda = new RfqBidsheet();
                    $rfqNda->bidsheet_file = 'storage/bidsheet_img/' . $filename; // Use 'nda' or 'storage/nda' depending on your setup.
                    $rfqNda->rfqdetail_id = $RFQ->id;
                    $rfqNda->save();
                }
            }
        }
     
     
       return redirect()->route('RFQ.index');
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
        return view('Admin.RFQ.RFQ-View',compact('rfqdetail','rfqlocation','rfqcontract','rfqnda','category','subcategory','rfqbidsheet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
        $return = Company::where('company_name',$request->searchautocomplete)->get();
        $html = view('Admin.RFQ.select-company', compact('return'))->render();
        echo  $html;
    }
}
