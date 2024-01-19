@extends('Admin.layout.app')
@section('admincontent')
<style>
   input.choices__input.choices__input--cloned {
    height: 0px;
}
.mess-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" />
<link href="{{asset('SuperAdmin/assets/libs/choices.js/public/assets/styles/choices.min.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('SuperAdmin/assets/js/pages/form-advanced.init.js')}}"></script>
<script src="{{asset('SuperAdmin/assets/libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>
<!-- main content section -->
<section id="main" class="d-flex flex-column">
   <div class="main-content px-md-4 px-2 py-4" style="margin-top: 57px;">
      <!-- Welcome -->
      <div class="d-block">
         <div class="d-flex justify-content-between mb-3 px-2">
            <h4>Received RFQ Details</h4>
         </div>
         <div class="d-flex flex-column gap-3">
            <div class="border bg-white px-4 py-4 text-center position-relative d-none d-md-block" style="border-color: #b4b6bd;">
               <div class="d-flex justify-content-between align-items-center ">
                  <h2 class="pb-2">{{$rfqdetail->rfq_name}}</h2>
                   <p>
                     <span class="me-1"><i class="bi bi-calendar-date pe-1"></i> <b>Start Date: {{ \Carbon\Carbon::parse($rfqdetail->created_at)->format('d-m-Y')}}  </b></span> | <span class="ms-1"><i class="bi bi-stopwatch pe-1"></i> <b>Deadline:   {{ \Carbon\Carbon::parse($rfqdetail->bid_submission_deadline)->format('d-m-Y')}}</b></span>
                  </p>
               </div>
               <!--Table  -->
               <table class="table m-0">
                  <thead>
                     <tr>
                        <th scope="col" class="text-uppercase text-start">RFQ TYPE </th>
                        <th scope="col" class="text-uppercase text-start">CATEGORY</th>
                        <th scope="col" class="text-uppercase text-start">SUB-CATEGORY </th>
                        <th scope="col" class="text-uppercase text-start">DEMAND TYPE </th>
                        <th scope="col" class="text-uppercase text-start">Company Invited</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td class="text-start"><b>{{$rfqdetail->rfq_type}}</b></td>
                        <td class="text-start"><b>{{$category ? $category->name : ' ' }}</b></td>
                        <td class="text-start"><b>{{$subcategory ? $subcategory->name : ' '}}</b></td>
                        <td class="text-start"><b>{{$rfqdetail->demandtype}}</b></td><br>
                       <td class="text-start"><b>{{$suppliersCount}}</b></td>
                     </tr>
                  </tbody>
               </table>
            </div>
             @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-top-border alert-dismissible fade show my-4" role="alert">
                       <i class="mdi mdi-check-all me-3 align-middle text-success"></i><strong>Success</strong> - {{$message}}
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                   @endif
            <div class="border bg-white px-4 py-4 text-center position-relative" style="border-color: #b4b6bd;">
               <div class="nav nav-tabs gap-3" id="nav-tab" role="tablist">
                  <button class="nav-link py-3 active" id="nav-overview-tab" data-bs-toggle="tab" data-bs-target="#nav-overview" type="button" role="tab" aria-controls="nav-overview" aria-selected="true">
                  OVERVIEW
                  </button>
                  <button class="nav-link py-3 " id="nav-action-tab" data-bs-toggle="tab" data-bs-target="#nav-action" type="button" role="tab" aria-controls="nav-actio" aria-selected="true">
                    ACTIONS
                  </button>
                  <button class="nav-link py-3 position-relative" id="nav-messaging-tab" data-bs-toggle="tab" data-bs-target="#nav-messaging" type="button" role="tab" aria-controls="nav-messaging" aria-selected="false" >
                  MESSAGING <span class="p-2 rounded-circle position-absolute" style=" top: 12px; right: -10px; height: 24px; width: 24px; line-height: 10px;">(3)</span>
                  </button>
                  <button class="nav-link py-3" id="nav-activity-tab" data-bs-toggle="tab" data-bs-target="#nav-activity" type="button" role="tab" aria-controls="nav-activity" aria-selected="false">ACTIVITY</button>
                 
               </div>
               <div class="tab-content welcomeBox" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">
                     <!-- Accordian -->
                     <div class="row">
                        <!--cover letter-->
                        <div class="d-flex flex-column gap-3  col-sm-8 my-2" >
                           <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;height:250px;">
                              <div class="d-flex justify-content-between align-items-center ">
                                 <h2 class="pb-2" style="font-weight:800;">Cover Letter</h2>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                 <div class="pro-deta-view">$biddetail->currency
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
                        <!--Document-->
                        <div class="d-flex flex-column gap-3 col-sm-4 my-2">
                           <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;height:250px;">
                              <div class="d-flex justify-content-between align-items-center ">
                                 <h2 class="pb-2" style="font-weight:800;">Document</h2>
                              </div>
                              <div class="row">
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                     <div class="pro-deta-view">
                                        <label>NDA : </label>
                                        <p>
                                           @foreach($rfqnda as $nda)
                                               @if($nda)
                                                 <a href="{{asset($nda->nda_file)}}" download>Download</a>
                                               @else
                                                  <i class="fa-solid fa-empty-set"></i>
                                               @endif
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
                                              <a href="{{asset($bidsheet->bidsheet_name)}}" download>Download</a>
                                           @endforeach
                                        </p>
                                     </div>
                                  </div>
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                     <div class="pro-deta-view">
                                        <label>Payment Terms : </label>
                                        <p>
                                            @if($rfqdetail->payment_after_delivery_file)
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
                              <div class="d-flex justify-content-between align-items-center ">
                                 <h2 class="pb-2" style="font-weight:800;">Bid Instruction</h2>
                              </div>
                              <div class="row">
                                 <div class="col-lg-6 col-md-6 col-sm-6 ">
                                    <div class="pro-deta-view" >
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
                                        <label>Recurrening - Cycle Dropdown : </label>
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
                              <div class="d-flex justify-content-between align-items-center">
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
                                       <p>{{$team->firstname}}{{$team->lastname}} {{$team->id}}</p>
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
                        <div class="d-flex flex-column gap-3 col-sm-8 my-2">
                           <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;height:350px;">
                              <div class="d-flex justify-content-between align-items-center ">
                                 <h2 class="pb-2" style="font-weight:800;">Questionnaire</h2>
                              </div>
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
                                              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                 <div class="pro-deta-view">
                                                    <p>({{$key2+1}}) {{$ques}}</p>
                                                 </div>
                                              </div>
                                          @endforeach
                                      @endif
                                  </div>
                                  @endforeach
                              </div>      
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Action Tob -->
                  <div class="tab-pane fade " id="nav-action" role="tabpanel" aria-labelledby="nav-overview-tab">
                     <!-- Accordian -->
                        <div class="row my-4">
                          <div class="col-12 col-md-5 col-xl-3 mb-3 mb-md-0">
                            <div class="border bg-white compnay-tabs-ul" style="border-color:#B4B6BD;">
                              <ul class="d-flex flex-column nav nav-tabs listing nav-RFQ" id="nav-tabs" role="tablist">
                                <li class="rfq-details">
                                    <a id="nav-product-tab" style="text-align: justify;" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-product" type="button" role="tab" aria-controls="nav-product" aria-selected="true" href="#" class=" nav-link active py-3 px-4 d-block position-relative sh">
                                         <p>
                                             @if($RfqSupplierRequest->is_nda_sign == '1')
                                                <img src="https://cdn.pixabay.com/photo/2021/08/07/22/32/verified-6529513_1280.png" style="height: 21px;position: relative; right: 14px; top: -1px;">
                                             @endif
                                            Step 1 : NDA </p>
                                    </a>
                                </li>
                                 <li class="rfq-details">
                                    <a id="nav-intend-tab" style="text-align: justify;" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-intend" type="button" role="tab" aria-controls="nav-intend" aria-selected="true" href="#" class=" nav-link  py-3 px-4 d-block position-relative sh">
                                         <p>
                                         @if($RfqSupplierRequest->nda_accepted == '1')
                                            <img src="https://cdn.pixabay.com/photo/2021/08/07/22/32/verified-6529513_1280.png" style="height: 21px;position: relative; right: 14px; top: -1px;">
                                         @endif     
                                          Step 2 : Intend to Bid</p>
                                    </a>
                                </li>
                                 <li class="rfq-details">
                                    <a id="nav-bid-sheet-tab" style="text-align: justify;" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-bid-sheet" type="button" role="tab" aria-controls="nav-bid-sheet" aria-selected="true" href="#" class=" nav-link  py-3 px-4 d-block position-relative sh">
                                        <p>
                                            @if($RfqSupplierRequest->is_bid_sign == '1')
                                                <img src="https://cdn.pixabay.com/photo/2021/08/07/22/32/verified-6529513_1280.png" style="height: 21px;position: relative; right: 14px; top: -1px;">
                                            @endif 
                                             Step 3 : Bid Sheet Upload</p>
                                    </a>
                                </li>
                                <li class="rfq-details">
                                    <a id="nav-bid-details-tab" style="text-align: justify;" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-bid-details" type="button" role="tab" aria-controls="nav-bid-details" aria-selected="true" href="#" class=" nav-link  py-3 px-4 d-block position-relative sh">
                                        <p>
                                            @if($RfqSupplierRequest->bid_details_status == '1')
                                                <img src="https://cdn.pixabay.com/photo/2021/08/07/22/32/verified-6529513_1280.png" style="height: 21px;position: relative; right: 14px; top: -1px;">
                                            @endif 
                                            Step 4 : Bid Details</p>
                                    </a>
                                </li>
                                <li class="rfq-details">
                                    <a id="nav-team-member-tab" style="text-align: justify;" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-team-membe" type="button" role="tab" aria-controls="nav-team-membe" aria-selected="true" href="#" class=" nav-link  py-3 px-4 d-block position-relative sh">
                                       <p>
                                            @if($RfqSupplierRequest->team_member_status == '1')
                                                <img src="https://cdn.pixabay.com/photo/2021/08/07/22/32/verified-6529513_1280.png" style="height: 21px;position: relative; right: 14px; top: -1px;">
                                            @endif
                                            Step 5 : Team members</p>
                                    </a>
                                </li>
                                <li class="rfq-details">
                                    <a id="nav-discont-tab" style="text-align: justify;" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-discont" type="button" role="tab" aria-controls="nav-discont" aria-selected="true" href="#" class=" nav-link  py-3 px-4 d-block position-relative sh">
                                       <p>
                                            @if($RfqSupplierRequest->payment_terms == '1')
                                                <img src="https://cdn.pixabay.com/photo/2021/08/07/22/32/verified-6529513_1280.png" style="height: 21px;position: relative; right: 14px; top: -1px;">
                                            @endif
                                            Step 6 : Discount & offers</p>
                                    </a>
                                </li>
                                <li class="rfq-details">
                                    <a id="nav-questionnaire-tab" style="text-align: justify;" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-questionnaire" type="button" role="tab" aria-controls="nav-questionnaire" aria-selected="true" href="#" class=" nav-link  py-3 px-4 d-block position-relative sh">
                                       <p>
                                            @if($RfqSupplierRequest->questionair == '1')
                                                <img src="https://cdn.pixabay.com/photo/2021/08/07/22/32/verified-6529513_1280.png" style="height: 21px;position: relative; right: 14px; top: -1px;">
                                            @endif
                                            Step 7 : Questionnaire </p>
                                    </a>
                                </li>
                                <li class="rfq-details">
                                    <a id="nav-additional-tab" style="text-align: justify;" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-additional" type="button" role="tab" aria-controls="nav-additional" aria-selected="true" href="#" class=" nav-link  py-3 px-4 d-block position-relative sh">
                                      <p>
                                           @if($RfqSupplierRequest->additional_information == '1')
                                                <img src="https://cdn.pixabay.com/photo/2021/08/07/22/32/verified-6529513_1280.png" style="height: 21px;position: relative; right: 14px; top: -1px;">
                                            @endif
                                            Step 8:Additional Information </p>
                                    </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-12 col-md-7 col-xl-9 ">
                            <div class="border bg-white p-3 px-sm-4 py-sm-4 tab-content" id="nav-tabContent"style="border-color:#B4B6BD;">
                              <!--nda-->
                              <div class="tab-pane fade show active" id="nav-product" role="tabpanel" aria-labelledby="nav-home-tab">
                                  @if(count($rfqnda)>0)
                                    <div class="d-flex flex-column ">
                                      @foreach($rfqnda as $nda)
                                        <h3 style="text-align: justify;">NDA - (<span class="{{$RfqSupplierRequest->is_nda_sign == '1' ? 'text-success' :'text-danger'}}"> {{$RfqSupplierRequest->is_nda_sign == '1' ? 'Signed' :'Request Sign'}}</span>)</h3>
                                        <a href="{{asset($nda->nda_file)}}" download class="down-bid" style=" color: #4574DD  !important;"><img src="{{asset('Admin/assets/dist/images/download-icon.svg')}}"> Download NDA</a>
                                      @endforeach
                                    </div>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                         <form action="{{Route('RFQ.NDASing',[$rfqdetail->id,'NDA'])}}" method="post" enctype="multipart/form-data"> 
                                            @csrf
                                                  @php
                                                     $ndaSigns =  App\Models\SingNda::where('rfqdetail_id',$rfqdetail->id)->where('company_id',$rfqdetail->company_id)->get();
                                                  @endphp
                                                 
                                                  <div class="upload-div"><span>Upload</span></div>
                                                    <div class="upload-drag">
                                                         @if($RfqSupplierRequest->is_nda_sign == '0')
                                                           <div class="upload-drag-box">
                                                              <label for="fileInput" class="file-input-label">
                                                                 @foreach($ndaSigns as  $ndaSigned)
                                                                    <a href="{{asset($ndaSigned->nda_file)}}" download class="down-bid"><img src="{{asset('Admin/assets/dist/images/download-icon.svg')}}"> Download NDA  : {{  $ndaSigned->nda_sign_name}}</a>]
                                                                 @endforeach   
                                                              <p>Drag and Drop Your Files Here <br> OR <br>Browse</p>
                                                              <span></span>
                                                              </label>
                                                              <input type="file" id="fileInput" name="nda_file" class="file-input" accept=".pdf,.doc,.ppt,.xlsx" style="display: none;">
                                                              <div id="fileName" class="file-name"></div>
                                                           </div>
                                                         @endif  
                                                            <h4 class="my-4" style="text-align: justify;">Your Send NDA</h4>
                                                            @foreach($SingNdas as $key=>$SingNda)
                                                             <div class="col-sm-12 my-4" >
                                                                  <figcaption style="font-size:16px; font-weight:600; color:#000;text-align: justify;"><a href="{{asset($SingNda->nda_sign_file)}}" download>{{$key+1}} : Download</a></figcaption>
                                                             </div> 
                                                           @endforeach
                                                            <h4 class="my-4" style="text-align: justify;">Comments</h4>
                                                            @foreach($SingNdaComments as $key=>$SingNdaComment)
                                                             <div class="col-sm-12 my-4" >
                                                                  <figcaption style="font-size:16px; font-weight:600; color:#000;text-align: justify;">{{$key+1}} : {{$SingNdaComment->add_commit_text}}</figcaption>
                                                             </div> 
                                                           @endforeach
                                                    </div>
                                                  <button class="btn btn-primary mt-3">Submit</button>
                                         </form>  
                                    </div>
                                @else
                                <div class="text-center">
                                    <img style="max-width: 250px" src="{{ asset('storage/no-data.jpg') }}" alt="no-data" onerror="img_onError(this)">
                                </div>
                                @endif
                              </div>
                              <!--Intend to Bid-->
                               <div class="tab-pane fade " id="nav-intend" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="d-flex flex-column ">
                                        @if($RfqSupplierRequest->nda_accepted == '1')
                                           <h2 style="text-align: justify;">Intend to Bid - (<span class="text-success'">Accepted</span>)</h3><br>
                                           @else
                                           <h2 style="text-align: justify;">Intend to Bid  </h3><br>
                                        @endif
                                    </div>
                                      <div id="collapsesTwo"  aria-labelledby="stausTwo" data-bs-parent="#accordionExample">
                                         <div class="accordion-body">
                                         @if($RfqSupplierRequest->nda_accepted == '0')  
                                            <form action="{{Route('RFQ.commentAccepted',[$rfqdetail->id,$rfqdetail->company_id,$RfqSupplierRequest->supplier_id])}}"  method="POST">  
                                               @csrf  
                                                  <button  style="color: aliceblue;" name="status"   value="supplier_Accepted" type="submit"  class=" btn btn-success" >Accepted </button>
                                                  <button style="color: aliceblue;" name ="status" value="supplier_Decline" type="submit" class="btn btn-danger">Decline </button>
                                                   
                                            </form>
                                         @endif   
                                         </div>
                                      </div>
                                </div>
                              <!--Bid Sheet Upload-->
                              <div class="tab-pane fade " id="nav-bid-sheet" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="d-flex flex-column ">
                                   <h2 style=" text-align: justify;">Bid Sheet - (<span class="{{$RfqSupplierRequest->is_bid_sign == '1' ? 'text-success' :'text-danger'}}"> {{$RfqSupplierRequest->is_bid_sign == '1' ? 'Uploaded' :'Request upload'}}</span>)</h2>
                                    @foreach($rfqbidsheet as $bidsheet)
                                      <div class="col-sm-6">
                                         <a href="{{asset($bidsheet->bidsheet_file)}}" download class="down-bid" style=" color: #4574DD  !important;"><img src="{{asset('Admin/assets/dist/images/download-icon.svg')}}">Original Bid</a>
                                      </div>
                                   @endforeach
                                </div>
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-body">
                                        @if($RfqSupplierRequest->nda_accepted == '1')
                                            <form action="{{Route('RFQ.NDASing',[$rfqdetail->id,'Bid'])}}" method="post" enctype="multipart/form-data"> 
                                                    @csrf
                                                <div class="upload-div"><span>Upload</span></div>
                                                 
                                                    <div class="upload-drag">
                                                        @if($RfqSupplierRequest->is_bid_sign == '0')
                                                            <div class="upload-drag-box">
                                                                <label for="fileInputBid" class="file-input-label">
                                                                      <p>Drag and Drop Your Files Here <br> OR <br>Browse</p>
                                                                      <span>The file must be pdf, doc, or ppt and not exceed more than 50 MB</span>
                                                                   </label>
                                                                   <input type="file" id="fileInputBid" Name="bid_file" class="file-input" accept=".pdf, .doc, .ppt" style="display: none;">
                                                                   <div id="fileNameBid" class="file-nameBid"></div>
                                                            </div>
                                                        @endif    
                                                              <h4 class="my-4" style="text-align: justify;">Your Bid Sheet </h4>
                                                               @foreach($bidSheets as $key=>$bidSheet)
                                                                 <div class="col-sm-12 my-4" >
                                                                      <figcaption style="font-size:16px; font-weight:600; color:#000;text-align: justify;"><a href="{{asset($bidSheet->bid_sign_file)}}" download>{{$key+1}} : Download</a></figcaption>
                                                                 </div> 
                                                               @endforeach
                                                               <h4 class="my-4" style="text-align: justify;">Comments</h4>
                                                                @foreach($bidSheetComments as $key=>$bidSheetComment)
                                                                 <div class="col-sm-12 my-4" >
                                                                      <figcaption style="font-size:16px; font-weight:600; text-align: justify;">{{$key+1}} : {{$bidSheetComment->add_commit_text}}</figcaption>
                                                                 </div> 
                                                               @endforeach
                                                                 @if($RfqSupplierRequest->is_bid_sign == '0')
                                                                     <button class="btn btn-primary mt-3">Submit</button>
                                                                @endif
                                                    </div>
                                                       
                                            </form>  
                                        @endif
                                  </div>
                                </div>
                              </div>
                              
                              <!-- Bid Details-->
                              <div class="tab-pane fade " id="nav-bid-details" role="tabpanel" aria-labelledby="nav-home-tab">
                                    @php
                                      $biddetail = App\Models\BidDetail::where('rfqdetail_id', $rfqdetail->id)->where('company_id', $rfqdetail->company_id)->where('supplier_id', $RfqSupplierRequest['supplier_id'])->first();
                                    @endphp
                                <div class="d-flex flex-column ">
                                  <h2 class="pb-2" style="text-align: justify;">4.Bid Details   </h2>
                                </div>
                                @if($RfqSupplierRequest->nda_accepted == '1')
                                <form action="{{Route('RFQ.commentAccepted',[$rfqdetail->id,$rfqdetail->company_id,$RfqSupplierRequest->supplier_id])}}"  method="POST"  enctype="multipart/form-data"> 
                                @csrf
                                    <div id="collapsesTwo2"  aria-labelledby="stausTwo" data-bs-parent="#accordionExample">
                                       <div class="accordion-body">
                                       <div class="row">
                                          <div class="col-12 col-xl-12 mb-0 mb-xl-6">
                                             <div class="input-wrapper" style="text-align: justify;">
                                                <b>RFQ Bid Currency </b>
                                                 <select  name="currency" id="bidautocomplete-input"> 
                                                      <option >Select</option>
                                                      @foreach($countries as $currency)
                                                         <option {{($biddetail ? $biddetail->currency : ' ') === $currency->currency.'('.$currency->currency_name.')' ? 'selected' : ''}} value="{{ $currency->currency.'('.$currency->currency_name.')' }}"> {{ $currency->currency.'('.$currency->currency_name.')' }}</option>
                                                      @endforeach   
                                                  </select>
                                                <div id="currency-options" class="list-group"></div> 
                                             </div>
                                          </div>
                                          <div class="col-12 col-xl-12 mb-0 mb-xl-6 my-4">
                                             <div class="input-wrapper" style="text-align: justify;">
                                                <b class="">Converstion Rate </b>
                                                <input type="date" id="converstion rate" value="{{$biddetail == null ? ' ' :$biddetail->converstion_rate}}" name="converstion_rate" >
                                             </div>
                                          </div>  
                                          <h4 class="my-4" style="text-align: justify;">Raw Material's Index Refernce</h4>
                                          @if($rfqdetail->raw_materials_name)
                                            <table class="table">
                                             <thead>
                                                <tr>
                                                   <th scope="col">Name</th>
                                                   <th scope="col">Value/Unit</th>
                                                   <th scope="col">Index</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                             @foreach(explode(',',$rfqdetail->raw_materials_name) as $key=>$raw_materials)
                                             @php
                                                if($biddetail){
                                                   $material_value = explode(',',$biddetail->material_value);
                                                   $material_index = explode(',',$biddetail->material_index);
                                                } 
                                             @endphp
                                                <tr>
                                                   <td>{{ $raw_materials }}
                                                     <input style=" width: 66px;" type="hidden" value="{{$raw_materials}}"  name="material_name[]" >
                                                   </td>
                                                   <td><input style=" width: 66px;" type="text"  name="material_value[]" value="{{$biddetail == null ? ' ' : $material_value[$key]}}"  ></td>
                                                   <td><input style=" width: 64px;" type="text"  name="material_index[]" value="{{$biddetail == null ? ' ' : $material_index[$key] }}"  ></td>
                                                </tr>
                                             @endforeach 
                                             </tbody>
                                          </table>
                                          @endif
                                       </div>
                                       <button  style="color: aliceblue;position: relative;top: 25px;right: left;left: 37%;" name="status"   value="Submit" type="submit"  class=" btn btn-primary " >Submit </button>
                                       </form>
                                    </div>
                                    </div>
                                @endif
                              </div>
                              <!-- Add Team members-->
                              <div class="tab-pane fade " id="nav-team-membe" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="d-flex flex-column ">
                                  <h2 class="pb-2" style="text-align: justify;">4. Add Team members</h2>
                                </div>
                                @if($RfqSupplierRequest->nda_accepted == '1')
                                <form action="{{Route('RFQ.commentAccepted',[$rfqdetail->id,$rfqdetail->company_id,$RfqSupplierRequest->supplier_id])}}"  method="POST"  enctype="multipart/form-data"> 
                                @csrf
                                    <div id="collapsesTwo9"  aria-labelledby="stausTwo9" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                           <div class="row">
                                              <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                 <div class="input-wrapper" style="text-align: justify;">
                                                    <b>Add Team members  <span class="text-danger">*</span></b>
                                                     @php
                                                       $supplierTeamMemberArrey = App\Models\RfqSupplierRequest::where('rfqdetail_id',$rfqdetail->id)->where('company_id',$rfqdetail->company_id)->where('supplier_id',$RfqSupplierRequest->supplier_id)->first();
                                                    @endphp
                                                    <select name="supplier_member[]" class="form-select" data-trigger id="add_tem_member" multiple="multiple">
                                                           @foreach($members as $key=>$member)
                                                           <option {{ in_array($member->id, explode(',', $supplierTeamMemberArrey->team_member))  ? 'selected' : '' }} value="{{ $member->id }}">{{ $member->firstname }} {{ $member->lastname }}</option>
                                                           @endforeach 
                                                    </select>
                                                    @error('add_tem_member')
                                                       <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                 </div>
                                              </div>
                                           </div>
                                           <button  style="color: aliceblue;position: relative;top: 25px;right: left;left: 37%;" name="status"   value="Submit" type="submit"  class=" btn btn-primary " >Submit </button>
                                        </div>
                                    </form>
                                     </div>
                                @endif
                              </div>
                              <!-- Discount & offers-->
                              <div class="tab-pane fade " id="nav-discont" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="d-flex flex-column ">
                                  <h2 class="pb-2" style="text-align: justify;">5. Discount & offers   </h2>
                                </div>
                                @if($RfqSupplierRequest->nda_accepted == '1')
                                <form action="{{Route('RFQ.commentAccepted',[$rfqdetail->id,$rfqdetail->company_id,$RfqSupplierRequest->supplier_id])}}"  method="POST"  enctype="multipart/form-data"> 
                                @csrf
                                  <div id="collapsesTwo3"  aria-labelledby="stausTwo3" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                   <div class="row">
                                                     @if($rfqdetail->contract_duration_terms == '1')  
                                                      <div class="col-12 col-xl-12 mb-0 mb-xl-6">
                                                         <div class="input-wrapper" style="text-align: justify;">
                                                            <b>Payment Terms  </b>
                                                            <textarea class="form-control" id="" name="payment_terms" value="{{$biddetail == null ? ' ' :  $biddetail->payment_terms}}" rows="3">{{$biddetail == null ? ' ' :  $biddetail->payment_terms}}</textarea>
                                                         </div>
                                                      </div>
                                                      @endif
                                                      @if($rfqdetail->demand_type == '1')  
                                                      <div class="col-12 col-xl-12 mb-0 mb-xl-6">
                                                         <div class="input-wrapper" style="text-align: justify;">
                                                            <b class="">Year on Year </b>
                                                            <textarea class="form-control" id="" name="year" value="{{$biddetail == null ? ' ' : $biddetail->year}}" rows="3">{{$biddetail == null ? ' ' : $biddetail->year}}</textarea>
                                                         </div>
                                                      </div>  
                                                      @endif
                                                       @if($rfqdetail->year_discount_terms == '1')  
                                                      <div class="col-12 col-xl-12 mb-0 mb-xl-6">
                                                         <div class="input-wrapper " style="text-align: justify;">
                                                            <b class="">Contract Duration</b>
                                                            <textarea class="form-control" id="" name="contract_duration" value="{{$biddetail == null ? ' ' : $biddetail->contract_duration}}" rows="3">{{$biddetail == null ? ' ' : $biddetail->contract_duration}}</textarea>
                                                         </div>
                                                      </div>
                                                       @endif
                                                   </div>
                                                    @if($rfqdetail->contract_duration_terms == '1' ||  $rfqdetail->demand_type == '1' ||  $rfqdetail->year_discount_terms == '1')  
                                                      <button  style="color: aliceblue;position: relative;top: 25px;right: left;left: 37%;" name="status"   value="Submit" type="submit"  class=" btn btn-primary " >Submit </button>
                                                   @endif
                                                </div>
                                            </form>
                                             </div>
                                @endif
                              </div>
                              <!-- Questionnaire-->
                              <div class="tab-pane fade " id="nav-questionnaire" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="d-flex flex-column ">
                                  <h2 class="pb-2" style="text-align: justify;">6. Questionnaire   </h2>
                                </div>
                                @if($RfqSupplierRequest->nda_accepted == '1')
                                <form action="{{Route('RFQ.commentAccepted',[$rfqdetail->id,$rfqdetail->company_id,$RfqSupplierRequest->supplier_id])}}"  method="POST"  enctype="multipart/form-data"> 
                                @csrf
                                  @if(count($questionairs)>0)
                                    <div id="collapsesTwo4"  aria-labelledby="stausTwo4" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                   <div class="row">
                                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                         <div class="pro-deta-view">
                                                         <h3>Questionnaire  form</h3>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                         <div class="pro-deta-view">
                                                         <label> Questionnaire  form : </label>
                                                         <p>
                                                               <?php
                                                               if ($questionairs == null) {
                                                                  echo 'The  is null.';
                                                               } else {
                                                                  if (count($questionairs) > 0) {
                                                                        echo  $questionairs[0]->form_name;
                                                                  } else {
                                                                        echo 'The   is empty.';
                                                                  }
                                                               }
                                                               ?>
                                                            </p>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                         <div class="pro-deta-view">
                                                         <label> Form Description :</label>

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
                                                            @php
                                                              $answer = App\Models\QuestionairAnswer::where('rfqdetail_id',$rfqdetail->id)->where('questionair_id',$questionair->id)->where('supplier_id',$RfqSupplierRequest->supplier_id)->first();
                                                            @endphp
                                                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                  <div class="pro-deta-view">
                                                                  <label> Question {{$key+1}}: </label> 
                                                                    <p>{{$questionair->questiona}}</p>
                                                                  </div>
                                                               </div>
                                                               @if($questionair->answer_type == 'single text') 
                                                               <div class="pro-deta-view">
                                                                  <label> Answer: </label> 
                                                                  <textarea class="form-control" id="singletext" name="text_ans[{{$questionair->id}}]" value="" rows="3">{{$answer == null ? ' ' : $answer->answer}}</textarea>
                                                               </div>
                                                               @endif
                                                               @if($questionair->answer_type == 'file upload') 
                                                               <div class="pro-deta-view">
                                                                  <label> Answer: </label>
                                                                    <input class="form-control" type="file" id="singletext" name="file_ans[{{$questionair->id}}]" ></input>
                                                               </div>
                                                               @endif
                                                               @if($questionair->answer_type == 'date') 
                                                               <div class="pro-deta-view">
                                                                  <label> Answer: </label> 

                                                                  <input class="form-control" type="date" id="singletext" name="file_date[{{$questionair->id}}]" value="{{$answer == null ? ' ' : $answer->answer}}" ></input>
                                                               </div>
                                                               @endif
                                                              @if($questionair->answer_type == 'single choice' || $questionair->answer_type == 'multiple choice') 
                                                                  @foreach(explode(',', $questionair->option_name) as $key2=>$ques)
                                                                  
                                                                     @if($key2 == '0')
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                           <div class="pro-deta-view">
                                                                           <label> Answer: </label> 
                                                                           </div>
                                                                        </div>
                                                                     @endif
                                                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                     <div class="pro-deta-view">
                                                                       <input type="radio" id="question-{{$key2}}" name="choice_ans[{{$questionair->id}}]" {{ $answer == null ? ' ' : ($answer->answer == $ques ? 'checked' : '')}} value="{{$ques}}">
                                                                       <p>{{$ques}}</p>
                                                                     </div>
                                                                  </div>
                                                                  @endforeach
                                                               @endif

                                                               @if($questionair->answer_type == 'drop-down') 
                                                                  
                                                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                     <div class="pro-deta-view">
                                                                     <label> Answer: </label> 
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                     <div class="pro-deta-view">
                                                                     <select class="form-select" aria-label="Default select example" name="drop_ans[{{$questionair->id}}]">
                                                                        <option >Select Answer</option>
                                                                        @foreach(explode(',', $questionair->option_name) as $key2=>$ques)
                                                                           <option {{ $answer == null ? ' ' : ($answer->answer == $ques ? 'selected' : '')}} value="{{$ques}}">{{$ques}}</option>
                                                                        @endforeach   
                                                                        </select>
                                                                     </div>
                                                                  </div>
                                                               @endif
                                                      @endforeach
                                                   </div>
                                                   <button  style="color: aliceblue;position: relative;top: 25px;right: left;left: 37%;" name="status"   value="Submit" type="submit"  class=" btn btn-primary " >Submit </button>
                                                </div>
                                                </form>
                                                
                                             </div>
                                  @else
                                    <div class="text-center">
                                        <img style="max-width: 250px" src="{{ asset('storage/no-data.jpg') }}" alt="no-data" onerror="img_onError(this)">
                                    </div>
                                  @endif                 
                                @endif
                              </div>
                              <!-- Additional Information-->
                              <div class="tab-pane fade " id="nav-additional" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="d-flex flex-column ">
                                  <h2 class="pb-2 " style="text-align: justify;">8. Additional Information </h2>
                                </div>
                                @if($RfqSupplierRequest->nda_accepted == '1')
                                <form action="{{Route('RFQ.commentAccepted',[$rfqdetail->id,$rfqdetail->company_id,$RfqSupplierRequest->supplier_id])}}"  method="POST"  enctype="multipart/form-data"> 
                                @csrf
                                    <div id="collapsesTwo5"  aria-labelledby="stausTwo4" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                           <div class="row">
                                                 <div class="col-12 col-xl-12 mb-0 mb-xl-6">
                                                    <div class="input-wrapper" style="text-align: justify;">
                                                       <b> Additional Information  </b>
                                                       <textarea class="form-control" id="" name="additional_Information" value="{{$biddetail == null ? ' ' : $biddetail->additional_Information}}" rows="3">{{$biddetail == null ? ' ' : $biddetail->additional_Information}}</textarea>
                                                    </div>
                                                 </div>
                                           </div>     
                                           <button  style="color: aliceblue;position: relative;top: 25px;right: left;left: 37%;" name="status"   value="Submit" type="submit"  class=" btn btn-primary " >Submit </button>
                                        </div>
                                </form>
                                     </div>
                                @endif
                              </div>
                              
                            </div>
                            
                          </div>
                        </div>
                  </div>
                  
                  <div class="tab-pane fade nav-massge" id="nav-messaging" role="tabpanel" aria-labelledby="nav-messaging-tab">
                     <!-- Chatbox -->
                     <div class="row chat-list-l">
                        <div class="col-12 col-md-3">
                           <div class="">
                              <div class="mess-title">
                                 <h3>Messages</h3>
                                 <i class="fa-regular fa-message"></i>
                                 <!--<img src="assets/dist/images/message-square.svg">-->
                              </div>
                              <div class="input-group search-chat">
                                 <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                                 <a href=""><i class="bi bi-search"></i> </a>
                              </div>
                              <div data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px" class="perfect-scrollbar ps ps--active-y">
                                 <ul class="list-unstyled mb-0 chat-small">
                                     <!-- rfq group -->
                                    @php
                                       $type = 'rfq';
                                    @endphp
                                    <x-admin.message-group :message="$rfqdetail->id" :type=$type />
                                </ul>
                                    <!--<li class="border-bottom">-->
                                    <!--   <a href="#!" class="d-flex justify-content-between">-->
                                    <!--      <div class="d-flex flex-row">-->
                                    <!--         <div class="img-list">-->
                                    <!--            <img src="assets/dist/images/table-large-iconOne.png" alt="avatar">-->
                                    <!--         </div>-->
                                    <!--         <div class="pt-1">-->
                                    <!--            <p class="fw-bold mb-0">ATG Group <span class="bid-btn">Bid Accepted</span></p>-->
                                    <!--            <p class="small text-muted">Ajay: Thanks for the information we will assess the documents...</p>-->
                                    <!--            <p class="send-time">Send on 12/05/2021 <b>04:30 PM</b></p>-->
                                    <!--         </div>-->
                                    <!--      </div>-->
                                    <!--   </a>-->
                                    <!--</li>-->
                                    <!--<li class="border-bottom">-->
                                    <!--   <a href="#!" class="d-flex justify-content-between">-->
                                    <!--      <div class="d-flex flex-row">-->
                                    <!--         <div class="img-list">-->
                                    <!--            <img src="assets/dist/images/table-large-iconOne.png" alt="avatar">-->
                                    <!--         </div>-->
                                    <!--         <div class="pt-1">-->
                                    <!--            <p class="fw-bold mb-0">ATG Group <span class="bid-btn">Bid Accepted</span></p>-->
                                    <!--            <p class="small text-muted">Ajay: Thanks for the information we will assess the documents...</p>-->
                                    <!--            <p class="send-time">Send on 12/05/2021 <b>04:30 PM</b></p>-->
                                    <!--         </div>-->
                                    <!--      </div>-->
                                    <!--   </a>-->
                                    <!--</li>-->
                                    <!--<li class="border-bottom">-->
                                    <!--   <a href="#!" class="d-flex justify-content-between">-->
                                    <!--      <div class="d-flex flex-row">-->
                                    <!--         <div class="img-list">-->
                                    <!--            <img src="assets/dist/images/table-large-iconOne.png" alt="avatar">-->
                                    <!--         </div>-->
                                    <!--         <div class="pt-1">-->
                                    <!--            <p class="fw-bold mb-0">ATG Group <span class="bid-btn">Bid Accepted</span></p>-->
                                    <!--            <p class="small text-muted">Ajay: Thanks for the information we will assess the documents...</p>-->
                                    <!--            <p class="send-time">Send on 12/05/2021 <b>04:30 PM</b></p>-->
                                    <!--         </div>-->
                                    <!--      </div>-->
                                    <!--   </a>-->
                                    <!--</li>-->
                                    <!--<li class="border-bottom">-->
                                    <!--   <a href="#!" class="d-flex justify-content-between">-->
                                    <!--      <div class="d-flex flex-row">-->
                                    <!--         <div class="img-list">-->
                                    <!--            <img src="assets/dist/images/table-large-iconOne.png" alt="avatar">-->
                                    <!--         </div>-->
                                    <!--         <div class="pt-1">-->
                                    <!--            <p class="fw-bold mb-0">ATG Group <span class="bid-btn">Bid Accepted</span></p>-->
                                    <!--            <p class="small text-muted">Ajay: Thanks for the information we will assess the documents...</p>-->
                                    <!--            <p class="send-time">Send on 12/05/2021 <b>04:30 PM</b></p>-->
                                    <!--         </div>-->
                                    <!--      </div>-->
                                    <!--   </a>-->
                                    <!--</li>-->
                                    <!--<li class="border-bottom">-->
                                    <!--   <a href="#!" class="d-flex justify-content-between">-->
                                    <!--      <div class="d-flex flex-row">-->
                                    <!--         <div class="img-list">-->
                                    <!--            <img src="assets/dist/images/table-large-iconOne.png" alt="avatar">-->
                                    <!--         </div>-->
                                    <!--         <div class="pt-1">-->
                                    <!--            <p class="fw-bold mb-0">ATG Group <span class="bid-btn">Bid Accepted</span></p>-->
                                    <!--            <p class="small text-muted">Ajay: Thanks for the information we will assess the documents...</p>-->
                                    <!--            <p class="send-time">Send on 12/05/2021 <b>04:30 PM</b></p>-->
                                    <!--         </div>-->
                                    <!--      </div>-->
                                    <!--   </a>-->
                                    <!--</li>-->
                                    <!--<li class="border-bottom">-->
                                    <!--   <a href="#!" class="d-flex justify-content-between">-->
                                    <!--      <div class="d-flex flex-row">-->
                                    <!--         <div class="img-list">-->
                                    <!--            <img src="assets/dist/images/table-large-iconOne.png" alt="avatar">-->
                                    <!--         </div>-->
                                    <!--         <div class="pt-1">-->
                                    <!--            <p class="fw-bold mb-0">ATG Group <span class="bid-btn">Bid Accepted</span></p>-->
                                    <!--            <p class="small text-muted">Ajay: Thanks for the information we will assess the documents...</p>-->
                                    <!--            <p class="send-time">Send on 12/05/2021 <b>04:30 PM</b></p>-->
                                    <!--         </div>-->
                                    <!--      </div>-->
                                    <!--   </a>-->
                                    <!--</li>-->
                                 </ul>
                                 <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                 </div>
                                 <div class="ps__rail-y" style="top: 0px; height: 400px; right: 0px;">
                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 314px;"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 col-md-6">
                           <div class="chat-view-box">
                              <!-- chat info will display here -->
                              <div id="chat-info">

                              </div>
                              <!-- end -->
                              <!-- <div class="chat-view-top">
                                 <div class="chat-view-top-l">
                                    <h2><img src="assets/dist/images/table-large-iconOne.png" alt="icon"> Paramount Displays</h2>
                                 </div>
                                 <div class="chat-view-top-r">
                                    <p>Collaborators</p>
                                    <div class="chat-view-circle">
                                       <span><img src="assets/dist/images/profile.png"></span>
                                       <span><img src="assets/dist/images/profile.png"></span>
                                       <span><img src="assets/dist/images/profile.png"></span>
                                    </div>
                                    <a href="">+3 More</a>
                                 </div>
                              </div> -->
                              <div class="chat-view-mid" id="message-box" data-id="">
                                 <!--<div class="date-chat"><span>Oct 22</span></div>-->
                                 <!--<div class="chat-view-mid-l">-->
                                 <!--   <div class="chat-mid-user">-->
                                 <!--      <img src="assets/dist/images/profile.png">-->
                                 <!--      <h2>Ashish Kumar</h2>-->
                                 <!--      <span>Buyer <b>4:30 PM</b></span>-->
                                 <!--   </div>-->
                                 <!--   <div class="chat-mid-text">-->
                                 <!--      <p>Greeting from Sunworld Systems!</p>-->
                                 <!--      <p>I am Ashish. Please reach out to me here for any clarification related to the request.</p>-->
                                 <!--   </div>-->
                                 <!--</div>-->
                                 <!--<div class="date-chat"><span>Today</span></div>-->
                                 <!--<div class="chat-view-mid-l chat-view-mid-r">-->
                                 <!--   <div class="chat-mid-user">-->
                                 <!--      <img src="assets/dist/images/profile.png">-->
                                 <!--      <h2>Hi Ajay</h2>-->
                                 <!--      <span>Buyer <b>4:30 PM</b></span>-->
                                 <!--   </div>-->
                                 <!--   <div class="chat-mid-text">-->
                                 <!--      <p>Thank for your message. We will assess the documents intenally and be back in touch for a response tommarow.</p>-->
                                 <!--   </div>-->
                                 <!--</div>-->
                                 <!--<div class="chat-view-mid-l">-->
                                 <!--   <div class="chat-mid-user">-->
                                 <!--      <img src="assets/dist/images/profile.png">-->
                                 <!--      <h2>Ashish Kumar</h2>-->
                                 <!--      <span>Buyer <b>Just Now</b></span>-->
                                 <!--   </div>-->
                                 <!--   <div class="chat-mid-text">-->
                                 <!--      <p>Greeting from Sunworld Systems!</p>-->
                                 <!--      <p>I am Ashish. Please reach out to me here for any clarification related to the request.</p>-->
                                 <!--   </div>-->
                                 <!--</div>-->
                              </div>
                              <!--<div class="chat-view-bott">-->
                              <!--   <img src="assets/dist/images/profile.png">-->
                              <!--   <div class="chat-view-input">-->
                              <!--      <input type="text" />-->
                              <!--      <a href=""><img src="assets/dist/images/attach-icon.svg"></a>-->
                              <!--      <a href=""><img src="assets/dist/images/image-icon.svg"></a>-->
                              <!--      <button type="button">Send</button>-->
                              <!--   </div>-->
                              <!--</div>-->
                              
                              <div class="chat-view-bott">
                                 <img src="{{asset(auth()->user()->img_path ?? 'Admin/assets/dist/images/profile.png')}}">
                                 <form id="group-message-form" action="{{route('group.chat.send')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="group_id" id="chat-group-id" value="" required>
                                    <div class="chat-view-input">
                                       <input type="text" name="message"/>
                                       <!-- <a href="javascript::void(0)"><img src="{{asset('Admin/assets/dist/images/attach-icon.svg')}}"></a> -->
                                       <!-- <a href="javascript::void(0)"><img src="{{asset('Admin/assets/dist/images/image-icon.svg')}}"></a> -->
                                       <a href="javascript:void(0);" class="comm-chat-img">
                                          <input type="file" name="files[]" accept="image/png, image/gif, image/jpeg" id="post-chat-file" multiple>
                                          <img src="{{asset('Admin/assets/dist/images/image-icon.svg')}}">
                                       </a>
                                       <a href="javascript:void(0);" class="comm-chat-att">
                                          <input type="file" name="attachments[]" accept="application/pdf, application/doc, application/docx" id="post-attachments">
                                          <img src="{{asset('Admin/assets/dist/images/attach-icon.svg')}}">
                                       </a>
                                       <button type="submit" class="ml-5 send-message-btn">Send</button>
                                    </div>
                                    <div class="d-flex">
                                       <div class="post-img-preview">
      
                                       </div>
                                       <div class="post-video-preview">
      
                                       </div>
                                       <div class="post-attachment-preview">

                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 col-md-3">
                           <div class="p-3">
                              <div data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px" class="perfect-scrollbar ps ps--active-y document-chat">
                                 <h3>Documents</h3>
                                 <ul class="list-unstyled mb-0" id="group-doc">
                                    
                                 </ul>
                                 <!-- <ul class="list-unstyled mb-0">
                                    <li class="border-bottom d-flex gap-2 text-start">
                                       <div>
                                          <i class="bi bi-file-earmark-arrow-down text-primary"></i>
                                          <span class="badge bg-success badge-dot"></span>
                                       </div>
                                       <div class="pt-1">
                                          <p class="fw-bold mb-0">Marie Horwitz</p>
                                          <p class="small text-muted">234kb</p>
                                       </div>
                                    </li>
                                    <li class="border-bottom d-flex gap-2 text-start">
                                       <div>
                                          <i class="bi bi-file-earmark-arrow-down text-primary"></i>
                                          <span class="badge bg-success badge-dot"></span>
                                       </div>
                                       <div class="pt-1">
                                          <p class="fw-bold mb-0">Marie Horwitz</p>
                                          <p class="small text-muted">234kb</p>
                                       </div>
                                    </li>
                                    <li class="border-bottom d-flex gap-2 text-start">
                                       <div>
                                          <i class="bi bi-file-earmark-arrow-down text-primary"></i>
                                          <span class="badge bg-success badge-dot"></span>
                                       </div>
                                       <div class="pt-1">
                                          <p class="fw-bold mb-0">Marie Horwitz</p>
                                          <p class="small text-muted">234kb</p>
                                       </div>
                                    </li>
                                    <li class="border-bottom d-flex gap-2 text-start">
                                       <div>
                                          <i class="bi bi-file-earmark-arrow-down text-primary"></i>
                                          <span class="badge bg-success badge-dot"></span>
                                       </div>
                                       <div class="pt-1">
                                          <p class="fw-bold mb-0">Marie Horwitz</p>
                                          <p class="small text-muted">234kb</p>
                                       </div>
                                    </li>
                                    <li class="border-bottom d-flex gap-2 text-start">
                                       <div>
                                          <i class="bi bi-file-earmark-arrow-down text-primary"></i>
                                          <span class="badge bg-success badge-dot"></span>
                                       </div>
                                       <div class="pt-1">
                                          <p class="fw-bold mb-0">Marie Horwitz</p>
                                          <p class="small text-muted">234kb</p>
                                       </div>
                                    </li>
                                    <li class="border-bottom d-flex gap-2 text-start">
                                       <div>
                                          <i class="bi bi-file-earmark-arrow-down text-primary"></i>
                                          <span class="badge bg-success badge-dot"></span>
                                       </div>
                                       <div class="pt-1">
                                          <p class="fw-bold mb-0">Marie Horwitz</p>
                                          <p class="small text-muted">234kb</p>
                                       </div>
                                    </li>
                                 </ul> -->
                                 <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                 </div>
                                 <div class="ps__rail-y" style="top: 0px; height: 400px; right: 0px;">
                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 314px;"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="nav-activity" role="tabpanel" aria-labelledby="nav-activity-tab">
                     <!-- Accordian -->
                     <div class="activity-tab">
                        <div class="activity-tab-l">
                           <h3>Supplier Activity</h3>
                           <h4>View Latest Updates</h4>
                           <ul>
                           
                              <li>
                                 <a href="" class="active">
                                    <span><img src="{{asset('Admin/assets/dist/images/table-large-iconOne.png')}}" alt="avatar"></span>
                                    <h3>ATG Group</h3>
                                    <span class="bid-btn">Bid Accepted</span>
                                 </a>
                              </li>

                           </ul>
                        </div>
                        <div class="activity-tab-r">
                           <div class="activity-tab-top">
                              <div class="activity-tab-topl">
                                 <img src="{{asset('Admin/assets/dist/images/table-large-iconOne.png')}}" alt="avatar">
                                 <h3>ATG Group</h3>
                                 <p>Milwaukee, W1 53226</p>
                              </div>
                              <span class="bid-btn">Bid Accepted</span>
                           </div>
                           <div class="activity-tab-bottom">
                              <ul>
                                 <li>
                                    <h4>22/08/2021 | 03:43 PM</h4>
                                    <div class="text">
                                       <p><img src="{{asset('Admin/assets/dist/images/check-icon-ac.svg')}}" alt="avatar"> Bid Sheet updated and RFQ Confirmed</p>
                                    </div>
                                 </li>
                                 <li>
                                    <h4>22/08/2021 | 03:43 PM</h4>
                                    <div class="text">
                                       <p> <img src="{{asset('Admin/assets/dist/images/bell-icon-ac.svg')}}" alt="avatar"> Reminder Send to update status</p>
                                    </div>
                                 </li>
                                 <li>
                                    <h4>22/08/2021 | 03:43 PM</h4>
                                    <div class="text">
                                       <p><img src="{{asset('Admin/assets/dist/images/check-icon-ac.svg')}}" alt="avatar"> NDA Signed and RFQ Accepted</p>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>



<!--- upload drag and drop -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    const uploadDragBox = document.querySelector('.upload-drag-box');
    const fileNameElement = document.getElementById('fileName');
    const fileInput = document.getElementById('fileInput');

    uploadDragBox.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadDragBox.classList.add('drag-over');
    });

    uploadDragBox.addEventListener('dragleave', () => {
        uploadDragBox.classList.remove('drag-over');
    });

    uploadDragBox.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadDragBox.classList.remove('drag-over');
        fileInput.files = e.dataTransfer.files;
        if (fileInput.files.length > 0) {
            fileNameElement.textContent = fileInput.files[0].name;
        }
    });

    // Listen for file input change event
    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            fileNameElement.textContent = fileInput.files[0].name;
        }
    });
</script>

<script>
  
function getCurrency(currency,currency_name) {
  var autoCompleteResult = currency;
  document.getElementById("currency-options").innerHTML = "";
  for (var i = 0, limit = 5, len = autoCompleteResult.length; i < len  && i < limit; i++) {
    document.getElementById("currency-options").innerHTML += "<a class='list-group-item list-group-item-action' href='#' onclick='setSearch(\"" + autoCompleteResult[i] + "("+currency_name+")\")'>" + autoCompleteResult[i]+ " ("+currency_name+")</a>";
  }
}

function setSearch(currency,currency_name) {
  document.getElementById('bidautocomplete-input').value = currency;
  document.getElementById("currency-options").innerHTML = "";
}

jQuery.noConflict();
jQuery(function($) {
  $('#bidautocomplete-input').autocomplete({
          source: function(request, response) {
          console.log('Autocomplete triggered');
            $.ajax({
                url: "{{route('autocomplete.bidcurrency')}}",
                method: 'GET',
                data: {
                    currency: request.term 
                },

                success: function(data) {
                      console.log('0',data[0]);
                      console.log('1',data[1]);
                  if (data.length === 0) {
                        // response(["currency not available"]);
                    } else {
                      getCurrency(data[0],data[1]) 
                    }
                }
            });
        },
    }).on('keyup', function (event) {
        var inputVal = $(this).val();        
        if (inputVal === '') {
          document.getElementById("currency-options").innerHTML = "";
        }
}); 
});
</script>

<script>
    // Get the file input element
const fileInputBid = document.getElementById("fileInputBid");

// Get the file name display element
const fileNameBid = document.getElementById("fileNameBid");

// Add an event listener to the file input element
fileInputBid.addEventListener("change", function() {
  // Check if a file is selected
  if (fileInputBid.files.length > 0) {
    // Display the selected file name in the file name display element
    fileNameBid.textContent = "Selected File: " + fileInputBid.files[0].name;
  } else {
    // Clear the file name display if no file is selected
    fileNameBid.textContent = "";
  }
});

</script>

@endsection