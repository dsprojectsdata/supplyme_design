@extends('Admin.layout.app')
@section('admincontent')
<div class="main-content px-md-4 px-2 py-4" style="margin-top:57px">
   <!-- Welcome -->
   <div class="d-block flex-wrap gap-3 welcomeBox">
      <form action="{{Route('RFQ.rfqsend',$rfqdetail->id)}}" enctype="multipart/form-data" method="POST">
         @csrf
         <!--About-->
         <div class="row">
             <!--about -->
             <div class="d-flex flex-column gap-3 col-sm-12">
                <div class="border bg-white px-4 py-4 text-center position-relative" style="border-color:#B4B6BD;">
                   <div class="d-flex justify-content-between align-items-center ">
                      <h2 class="pb-2" style="font-weight:800;">{{$rfqdetail->rfq_name}}</h2>
                      <a href="{{Route('RFQ.edit',$rfqdetail->id)}}" class="edittabs btn btn-primary">Edit</a>
                   </div>
                   <!--Table  -->
                   <div class="table-responsive d-none d-md-block">
                      <table class="table m-0">
                         <thead>
                            <tr>
                               <th scope="col" class="text-uppercase text-start">RFQ TYPE </th>
                               <th scope="col" class="text-uppercase text-start">CATEGORY</th>
                               <th scope="col" class="text-uppercase text-start">SUB-CATEGORY </th>
                               <th scope="col" class="text-uppercase text-start">DEMAND TYPE </th>
                               <th scope="col" class="text-uppercase text-start">suppliers invited</th>
                            </tr>
                         </thead>
                         <tbody>
                            <tr>
                               <td class="text-start"><b>{{$rfqdetail->rfq_type}}</b></td>
                               <td class="text-start"><b>{{$category ? $category->name : ' ' }}</b></td>
                               <td class="text-start"><b>{{$subcategory ? $subcategory->name : ' '}}</b></td>
                               <td class="text-start"><b>{{$rfqdetail->demandtype}}</b></td>
                               <td class="text-start"><b>{{$suppliersCount}}</b></td>
                            </tr>
                         </tbody>
                      </table>
                   </div>
                </div>
             </div>
             <!--cover letter-->
             <div class="d-flex flex-column gap-3  col-sm-8 my-2" >
                <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;height:250px;">
                   <div class="d-flex justify-content-between align-items-center ">
                      <h2 class="pb-2" style="font-weight:800;">Cover Letter</h2>
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="pro-deta-view">
                          <p>{!! $rfqdetail->cover_letter !!}.</p>
                        </div>
                    </div>
                    
                </div>
             </div>
             <!--deadline-->
             <div class="d-flex flex-column gap-3 col-sm-4 my-2">
                <div class="border bg-white px-4 py-4 text-center position-relative" style="border-color:#B4B6BD;height:250px">
                   <div class="d-flex justify-content-between align-items-center ">
                      <h2 class="pb-2" style="font-weight:800;">Deadline</h2>
                   </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pro-deta-view">
                                <label> Acknowledgement Deadline : </label>
                                <p>{{$rfqdetail->acknowledgement_deadline}}</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pro-deta-view">
                                <label> Query Deadline  : </label>
                                <p>{{$rfqdetail->query_deadline}}</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pro-deta-view">
                                <label> Bid Submission Deadline  : </label>
                                <p>{{$rfqdetail->bid_submission_deadline}}</p>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
              <!--supplier-->
             <div class="d-flex flex-column gap-3 col-sm-8 my-2">
                <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;height:250px;">
                   <div class="d-flex justify-content-between align-items-center">
                      <h2 class="pb-2" style="font-weight:800;">Supplier</h2>
                   </div>
                    @if(count($RfqSupplierRequest)>0)
                     <div class="row">
                      
                    @foreach($RfqSupplierRequest as $key=>$supplier)
                        @php
                            $suppliersDataCompany = App\Models\Company::with('user',)->where('id', $supplier->supplier_id)->get();
                        @endphp
                      @foreach($suppliersDataCompany as $company)
                        <div class="col-4 col-xl-4 mb-0 mb-xl-3">
                            <div class="addded-team add-slip">
                                @php
                                  $companyprofile = App\Models\CompanyProfile::where('company_id',$company->id)->first();
                                @endphp
                                <span>
                                   @if($companyprofile)    
                                        <img src="{{asset($companyprofile->company_logo)}}" alt="icon" class="w-auto img-fluid">
                                        @else
                                        <img src="{{asset('Admin/assets/dist/images/sun.png')}}" alt="icon" class="w-auto img-fluid">
                                   @endif 
                                </span>
                                <div class="addded-iner">
                                   <a id="companyname" href="{{ route('company.profile.show', $company->id) }}"><h1 style=" position: relative; right:18px;">{{$company->company_name}}</h1></a>
                                    <label class="addded-text">
                                      <b style=" position: relative; right:1px; font-size: 11px;">{{$company->City ? $company->City->name : ' '}}, {{$company->State ? $company->State->name : ' '}}</b>
                                    </label>
                                </div>    
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                    </div>
                    @else
                    <div class="text-center row" >
                        <img style="max-width: 250px;height: 163px" class="col-sm-8" src="{{ asset('storage/no-data.jpg') }}" alt="no-data" onerror="img_onError(this)">
                    </div>
                    @endif
                </div>
             </div>
             <!--Document-->
             <div class="d-flex flex-column gap-3 col-sm-4 my-2">
                <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;height:250px;">
                   <div class="d-flex justify-content-between align-items-center">
                      <h2 class="pb-2" style="font-weight:800;">Document</h2>
                   </div>
                   <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pro-deta-view">
                                <label>NDA : </label>
                                <p>
                                    @foreach($rfqnda as $nda)
                                       <a href="{{asset($nda->nda_file)}}" download>Download</a>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pro-deta-view">
                                <label>Contract : </label>
                                <p>
                                    @foreach($rfqcontract as $contract)
                                        <a href="{{asset($contract->contract_file)}}" download>Download</a>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pro-deta-view">
                                <label>Bid Sheet : </label>
                                <p>
                                    @foreach($rfqbidsheet as $bidsheet)
                                        <a href="{{asset($bidsheet->bidsheet_file)}}" download>Download</a>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pro-deta-view">
                                <label>Payment Terms : </label>
                                <p>
                                    @if($rfqdetail->payment_after_delivery_fil)
                                      <a href="{{asset($rfqdetail->payment_after_delivery_file)}}" Download>Download</a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
             <!--Bid Instruction-->
             <div class="d-flex flex-column gap-3 col-sm-8 my-2">
                <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;height:250px;">
                   <div class="d-flex justify-content-between align-items-center">
                      <h2 class="pb-2" style="font-weight:800;">Bid Instruction</h2>
                   </div>
                   <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 ">
                            <div class="pro-deta-view">
                                <label> RFQ Bid Currency </label>
                                <p>{{$rfqdetail->rfq_bid_currency ? $rfqdetail->rfq_bid_currency : 'Null'}}</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 ">
                            <div class="pro-deta-view">
                                <label> Exchange Rate Refrence </label>
                                <p>{{$rfqdetail->exchange_rate_refrence}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row my-4">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="pro-deta-view">
                        <h3>Raw Materials </h3>
                        </div>
                    </div>
                    @if($rfqdetail->raw_materials_name)
                    @foreach(explode(',',$rfqdetail->raw_materials_name) as $key=>$raw_materials)
                        @php
                            $refrence_date = explode(',',$rfqdetail->refrence_date);
                        @endphp
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="pro-deta-view">
                            <label>{{$key+1}}.  Raw Materials Name</label>
                            <p>{{$raw_materials}}</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="pro-deta-view">
                            <div class="pro-deta-view">
                                <label> Refrence Date </label>
                                <p>{{$refrence_date[$key]}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    </div>
                </div>
             </div>
              <!--Terms-->
             <div class="d-flex flex-column gap-3 col-sm-4 my-2">
                <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;height:250px;">
                   <div class="d-flex justify-content-between align-items-center ">
                      <h2 class="pb-2" style="font-weight:800;">Terms</h2>
                   </div>
                   <div class="row">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pro-deta-view">
                                <label>Recurrening - Cycle : </label>
                                <p>
                                    {{$rfqdetail->recurrening}}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pro-deta-view">
                                <label>Delivery/Packing Standard : </label>
                                <p>
                                    {{$rfqdetail->delivery}}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pro-deta-view">
                                <label>Import Terms : </label>
                                <p>
                                   {{$rfqdetail->import_terms}}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pro-deta-view">
                                <label>Days to make Payment After Delivery : </label>
                                <p>
                                    {{$rfqdetail->payment_after_delivery}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
             <!--Team-->
             <div class="d-flex flex-column gap-3 col-sm-4 my-2">
                <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;height:250px;">
                   <div class="d-flex justify-content-between align-items-center ">
                      <h2 class="pb-2" style="font-weight:800;">Team</h2>
                   </div>
                   <div class="row">
                        @foreach($teams as $team)
                          @php
                             $Jobrole =  App\Models\Jobrole::where('id',$team->Jobrole_id)->first();
                          @endphp
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                <div class="pro-deta-view">
                                    <label>Name </label>
                                    <p>{{$team->firstname}} {{$team->lastname}}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                <div class="pro-deta-view">
                                    <label>Job Role </label>
                                      <p>{{$Jobrole ? $Jobrole->role_name : 'no data'}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
             </div>
             <!--Conditional Offers & Discount-->
             <div class="d-flex flex-column gap-3 col-sm-4 my-2">
                <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;height:250px;">
                   <div class="d-flex justify-content-between align-items-center ">
                      <h2 class="pb-2" style="font-weight:800;">Conditional Offers</h2>
                   </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="pro-deta-view">
                            <label>Year on year benefit : </label>
                            <p>
                                {{$rfqdetail->demand_type == '1' ? 'Yes' : 'No'}}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="pro-deta-view">
                            <label>Contract duration discount : </label>
                            <p>
                                {{$rfqdetail->year_discount_terms == '1' ? 'Yes' : 'No'}}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="pro-deta-view">
                            <label>Payment term : </label>
                            <p>
                               {{$rfqdetail->contract_duration_terms == '1' ? 'Yes' : 'No'}}
                            </p>
                        </div>
                    </div>
                </div>
             </div>
             <!--Location-->
             <div class="d-flex flex-column gap-3 col-sm-4 my-2">
                <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;height:250px;">
                   <div class="d-flex justify-content-between align-items-center ">
                      <h2 class="pb-2" style="font-weight:800;">Location</h2>
                   </div>
                    @foreach($rfqlocation as $key=>$location)
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pro-deta-view">
                                <p>{{$key+1}}. {{$location->City ? $location->City->name : ' '}} , {{$location->State ? $location->State->name : ' '}}, {{$location->Countrie ? $location->Countrie->name : ' '}}, {{$location->zipcode }}</p>
                            </div>
                        </div>
                    @endforeach    
                </div>
             </div>
             <!--Questionnaire-->
             <div class="d-flex flex-column gap-3 col-sm-12 my-2">
                <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;height:350px;">
                   <div class="d-flex justify-content-between align-items-center ">
                      <h2 class="pb-2" style="font-weight:800;">Questionnaire</h2>
                   </div> 
                   @if(count($questionairs)>0)
                   <div class="row">
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="pro-deta-view">
                                <label> Questionair form : </label>
                                <p>
                                    <?php
                                    if ($questionairs == null) {
                                    echo 'The  is null.';
                                    } else {
                                    if (count($questionairs) > 0) {
                                            echo  $questionairs[0]->form_name;
                                    } else {
                                            echo 'The is empty.';
                                    }
                                    }
                                    ?>
                                </p>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="pro-deta-view">
                                <label> Form Description : </label>
                                <p>
                                    <?php
                                    if ($questionairs == null) {
                                    echo 'The  is null.';
                                    } else {
                                    if (count($questionairs) > 0) {
                                            echo  $questionairs[0]->description;
                                    } else {
                                            echo 'The is empty.';
                                    }
                                    }
                                    ?>
                                </p>
                                </div>
                            </div>
                            
                            @foreach($questionairs as $key=>$questionair)
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="pro-deta-view">
                                            <label> Question {{$key+1}}: </label>
                                            <p>{{$questionair->questiona}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                @if($questionair->answer_type == 'single choice' || $questionair->answer_type == 'multiple choice') 
                                        @foreach(explode(',', $questionair->option_name) as $key2=>$ques)
                                        
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <div class="pro-deta-view">
                                                  <p><span>({{$key2+1}})</span> {{$ques}}</p>
                                                </div>
                                            </div>
                                        
                                        @endforeach
                                    @endif
                                    </div>
                            @endforeach
                            </div>
                </div>
                @else
                <div class="text-center">
                    <img style="max-width: 250px" src="{{ asset('storage/no-data.jpg') }}" alt="no-data" onerror="img_onError(this)">
                </div>
                @endif
             </div>
         </div>
   </div>
</div>
   <div class="d-none d-md-flex py-3 border bg-white justify-content-between position-fixed bottom-0 w-100 px-5" style="border-color:#B4B6BD;">
       <div class="col-12 col-md-10 " style=" text-align: end;">
        @if((count($rfqlocation) > 0) && ($rfqdetail->cover_letter) && ($rfqdetail->bid_submission_deadline) && (count($teams) > 0) && (count($RfqSupplierRequest) > 0)) 
            <button class="btn px-4 text-white" id="formid" value="submit" type="submit" style="background: #D39D36;">Send</button>
        @endif
       </div>
    </form>
  </div>
</div>
@endsection