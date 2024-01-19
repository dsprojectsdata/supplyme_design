@extends('Admin.layout.app')
@section('admincontent')
<!-- main content section -->
<style>
   .activity-tab-a {
   display: none;
   }
   .mess-title {
   display: flex;
   align-items: center;
   justify-content: space-between;
   }
</style>
<section id="main" class="d-flex flex-column">
   <div class="main-content px-md-4 px-2 py-4" style="margin-top: 57px;">
   <div class="d-block flex-wrap gap-3 welcomeBox">
      @if ($message = Session::get('success2'))
      <div class="d-flex flex-column gap-3">
         <div class="border bg-white px-4 py-5 text-center position-relative"
            style="border-color:#B4B6BD; z-index: -1;">
            <div class="d-flex flex-column align-items-center gap-4">
               <div class="cricle-ripper">
                  <span><i class="bi bi-check text-white"></i></span>
               </div>
               <div>
                  <h2 class="pb-2">Your RFQ is successfully generated and sent to all invited companies.</h2>
                  <p>You can now keep track of all updates and messages related to this event under the RFQ
                     Events section
                  </p>
               </div>
            </div>
         </div>
      </div>
      @endif
      <!--Welcome -->
      <div class="d-block">
         <!-- <div class="d-flex justify-content-between mb-3 px-2">
            <h4>{{$rfqdetail->rfq_name}}</h4>
            <span class="badge border border-success text-success" style="background: #19875414;">Recurring Event</span>
            </div> -->
         <div class="d-flex flex-column gap-3">
            <div class="border bg-white px-4 py-4 text-center position-relative d-none d-md-block"
               style="border-color: #b4b6bd;">
               <div class="d-flex justify-content-between align-items-center ">
                  <h2 class="pb-2">{{$rfqdetail->rfq_name}}</h2>
                  <p>
                     <span class="me-1"><i class="bi bi-calendar-date pe-1"></i> <b>Start Date:
                     {{ \Carbon\Carbon::parse($rfqdetail->created_at)->format('d-m-Y')}}
                     </b></span> | <span class="ms-1"><i class="bi bi-stopwatch pe-1"></i>
                     <b>Deadline:
                     {{ \Carbon\Carbon::parse($rfqdetail->bid_submission_deadline)->format('d-m-Y')}}</b></span>
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
                        <th scope="col" class="text-uppercase text-start">suppliers invited</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td class="text-start"><b>{{$rfqdetail->rfq_type}}</b></td>
                        <td class="text-start"><b>{{$category ? $category->name : ' ' }}</b></td>
                        <td class="text-start"><b>{{$subcategory ? $subcategory->name : ' '}}</b></td>
                        <td class="text-start"><b>{{$rfqdetail->demandtype}}</b></td>
                        <br>
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
            <div class="border bg-white px-4 py-4 text-center position-relative"
               style="border-color: #b4b6bd;">
               <div class="nav nav-tabs gap-3" id="nav-tab" role="tablist">
                  <button class="nav-link py-3 active" id="nav-overview-tab" data-bs-toggle="tab"
                     data-bs-target="#nav-overview" type="button" role="tab" aria-controls="nav-overview"
                     aria-selected="true">
                  OVERVIEW
                  </button>
                  <button class="nav-link py-3" id="nav-suppliers-tab" data-bs-toggle="tab"
                     data-bs-target="#nav-suppliers" type="button" role="tab"
                     aria-controls="nav-suppliers" aria-selected="false">
                  SUPPLIERS
                  </button>
                  <button class="nav-link py-3 position-relative" id="nav-messaging-tab"
                     data-bs-toggle="tab" data-bs-target="#nav-messaging" type="button" role="tab"
                     aria-controls="nav-messaging" aria-selected="false">
                  MESSAGING <span class="p-2 rounded-circle position-absolute"
                     style=" top: 12px; right: -10px; height: 24px; width: 24px; line-height: 10px;">(3)</span>
                  </button>
                  <button class="nav-link py-3" id="nav-activity-tab" data-bs-toggle="tab"
                     data-bs-target="#nav-activity" type="button" role="tab" aria-controls="nav-activity"
                     aria-selected="false">ACTIVITY</button>
               </div>
               <div class="tab-content welcomeBox" id="nav-tabContent">
                   
                   <!--overview-->
                  <div class="tab-pane fade show active" id="nav-overview" role="tabpanel"
                     aria-labelledby="nav-overview-tab">
                     <!-- Accordian -->
                     <div class="row">
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
                        <!--supplier-->
                        <div class="d-flex flex-column gap-3 col-sm-8 my-2">
                           <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;height:250px;">
                              <div class="d-flex justify-content-between align-items-center ">
                                 <h2 class="pb-2" style="font-weight:800;">Supplier</h2>
                              </div>
                              <div class="row">
                              @foreach($suppliersArray as $key=>$supplier)
                              @php
                              $suppliersDataCompany = App\Models\Company::with('user',)->where('id', $supplier->supplier_id)->get();
                              @endphp
                                @foreach($suppliersDataCompany as $company)
                                  <div class="col-5 col-xl-5 mb-0 mb-xl-3">
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
                                              <a id="companyname" href="{{ route('company.profile.show', $company->id) }}"><h1 style=" position: relative; right:   43px;">{{$company->company_name}}</h1></a>
                                              <label class="addded-text">
                                                <b style=" position: relative; right: 7px; font-size: 11px;">{{$company->City ? $company->City->name : ' '}}, {{$company->State ? $company->State->name : ' '}}</b>
                                              </label>
                                          </div>    
                                      </div>
                                  </div>
                                  @endforeach
                              @endforeach
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
                                       <p>{{$team->firstname}}{{$team->lastname}} </p>
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
                  <!--MESSAGING-->
                  <div class="tab-pane fade" id="nav-suppliers" role="tabpanel" aria-labelledby="nav-suppliers-tab">
                     <div class="row">
                        <div class="col-12 col-md-5 col-xl-3 mb-3 mb-md-0 my-4">
                           <div class="border bg-white compnay-tabs-ul" style="border-color:#B4B6BD;">
                              <ul class="d-flex flex-column nav nav-tabs listing nav-RFQ" id="nav-tabs" role="tablist">
                                 @foreach($suppliersData as $key=>$supplier) 
                                 <li class="rfq-details"><a  style="text-align: justify;" id="nav-product-tab-{{$supplier->id}}" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-product-{{$supplier->id}}"
                                    type="button" role="tab" aria-controls="nav-product-{{$supplier->id}}" aria-selected="true" href="#"
                                    class=" nav-link {{$key == '0' ? ' active' : ' '}} py-3 px-4 d-block position-relative sh">
                                    @php
                                      $suppliersArrays = App\Models\RfqSupplierRequest::where('rfqdetail_id',$rfqdetail->id)->where('company_id',$rfqdetail->company_id)->where('supplier_id',$supplier->id)->first();
                                    @endphp
                                    {{$supplier->company_name}} <span style="padding: 4px;position: relative;left: 12px;background-color: #378f21;">{{$suppliersArrays->status == null ? 'RFQ Send' : $suppliersArrays->status}}</span></a>
                                 </li>
                                 @endforeach 
                              </ul>
                           </div>
                        </div>
                        <div class="col-12 col-md-7 col-xl-9 my-4">
                           <div class="border bg-white p-3 px-sm-4 py-sm-4 tab-content"   style="border-color:#B4B6BD;">
                              @foreach($suppliersData as $key=>$supplier) 
                                    @php
                                      $suppliersArrays2 = App\Models\RfqSupplierRequest::where('rfqdetail_id',$rfqdetail->id)->where('company_id',$rfqdetail->company_id)->where('supplier_id',$supplier->id)->first();
                                    @endphp
                              <div class="tab-pane fade {{$key == '0' ? 'show active' : ' '}}" id="nav-product-{{$supplier->id}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                 <div class="d-flex flex-column ">
                                    <h2 class="pb-2" style="text-align: justify;">  {{$supplier->company_name}} <span style="padding: 4px;position: relative;left: 12px;background-color: #378f21;color: white">{{$suppliersArrays2->status == null ? 'RFQ Send' : $suppliersArrays2->status}}</span>  </h2>
                                 </div>
                                 <div class="row">
                                    @php
                                      $SingBidSheets =  App\Models\SingBidSheet::where('rfqdetail_id',$rfqdetail->id)->where('company_id',$supplier->id)->get();
                                      $ndaSigns =  App\Models\SingNda::where('rfqdetail_id',$rfqdetail->id)->where('company_id',$supplier->id)->get();
                                      $biddetail = App\Models\BidDetail::where('rfqdetail_id',$rfqdetail->id)->where('supplier_id',$supplier->id)->first();  
                                      $suppliersChackdata = App\Models\RfqSupplierRequest::where('rfqdetail_id',$rfqdetail->id)->where('company_id',$rfqdetail->company_id)->where('supplier_id',$supplier->id)->first();
                                      $SingNdaComments  = App\Models\NdaComments::where('rfqdetail_id',$rfqdetail->id)->where('supplier_id',$supplier->id)->where('status','1')->get();
                                      $bidSheetComments  = App\Models\NdaComments::where('rfqdetail_id',$rfqdetail->id)->where('supplier_id',$supplier->id)->where('status','0')->get();
                                    @endphp
                                    <div class="d-flex flex-column gap-3 col-sm-6 my-2">
                                       <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;">
                                          <div class="d-flex justify-content-between align-items-center  ">
                                             <h2 class="pb-2" style="font-weight:800;">NDA</h2>
                                             @foreach($rfqnda as $nda)
                                                 @if($nda)
                                                    <a style=" position: relative;top: -13px;" href="{{asset($nda->nda_file)}}" download>Original NDA<i class="fa fa-download" aria-hidden="true"></i></a>
                                                 @else
                                                   <i class="fa-solid fa-empty-set"></i>
                                                 @endif
                                             @endforeach
                                          </div>
                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                             @if(count($ndaSigns) > 0)
                                             <div class="pro-deta-view">
                                                @foreach($ndaSigns as $key=>$ndaSigned)
                                                @if($key == '0')
                                                <h3>
                                                @endif
                                                
                                                <a href="{{ asset($ndaSigned->nda_sign_file)}}"  class="down-bid" style="color: #4c4ce1 !important;" download><img src="{{asset('Admin/assets/dist/images/download-icon.svg')}}" >{{$key+1}} :Download</a>
                                                
                                                @endforeach
                                                <h4 class="my-4" style="text-align: justify;">Comments</h4>
                                                    @foreach($SingNdaComments as $key=>$SingNdaComment)
                                                     <div class="col-sm-12 my-4" >
                                                          <figcaption style="font-size:16px; font-weight:600; color:#000;text-align: justify;">{{$key+1}} : {{$SingNdaComment->add_commit_text}}</figcaption>
                                                     </div> 
                                                   @endforeach
                                                @if($suppliersChackdata->is_nda_sign == '0')
                                                <form action="{{Route('RFQ.commentAccepted',[$rfqdetail->id,$rfqdetail->company_id,$supplier->id])}}" id="rfqdata" enctype="multipart/form-data" method="POST">
                                                   @csrf  
                                                   <div class="row">
                                                      <textarea class="form-control" id="" name="add_commit_text[]" rows="3"></textarea>
                                                   </div>
                                                   <br>
                                                   <div class="row" >
                                                      <button  style="color: aliceblue;   padding: 8px 12px;" name="status"    value="nda_accepted" type="submit"  class=" btn btn-success col-sm-3" >Accepted</button>
                                                      <button style="color: aliceblue;   padding: 8px 12px;" name ="status" value="nda_decline" type="submit" class="btn btn-danger col-sm-3">Decline</button>
                                                      <button style="color: aliceblue; padding: 8px 12px;" name ="status" value="nda_send" type="submit" class="btn btn-info col-sm-3 ">Send</button>
                                                   </div>
                                                </form>
                                                @endif
                                             </div>
                                             @endif
                                          </div>
                                       </div>
                                    </div>
                                    <div class="d-flex flex-column gap-3 col-sm-6 my-2">
                                       <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;">
                                          <div class="d-flex justify-content-between align-items-center  ">
                                             <h2 class="pb-2" style="font-weight:800;">Bid Sheet</h2>
                                             @foreach($rfqbidsheet as $bidsheet)
                                                 @if($bidsheet)
                                                    <a href="{{asset($bidsheet->bidsheet_name)}}" style=" position: relative; top: -13px;"  download >Original Bid Sheet</a>
                                                 @else
                                                    <i class="fa-solid fa-empty-set"></i>
                                                 @endif
                                             @endforeach
                                          </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                @if(count($SingBidSheets) > 0)
                                                    <div class="pro-deta-view">
                                                        @foreach($SingBidSheets as $key=>$SingBidSheet)
                                                        @if($key == '0')
                                                        <h3>
                                                        @endif
                                                        <a href="{{asset($SingBidSheet->bid_sign_file)}}" download class="down-bid" style="color: #4c4ce1 !important;"><img src="{{asset('Admin/assets/dist/images/download-icon.svg')}}">{{$key+1}} : Download</a>
                                                        @endforeach
                                                        <h4 class="my-4" style="text-align: justify;">Comments</h4>
                                                            @foreach($bidSheetComments as $key=>$bidSheetComment)
                                                             <div class="col-sm-12 my-4" >
                                                                  <figcaption style="font-size:16px; font-weight:600; color:#000;text-align: justify;">{{$key+1}} : {{$bidSheetComment->add_commit_text}}</figcaption>
                                                             </div> 
                                                           @endforeach
                                                        @if($suppliersChackdata->is_bid_sign == '0')
                                                        <form action="{{Route('RFQ.commentAccepted',[$rfqdetail->id,$rfqdetail->company_id,$supplier->id])}}" id="rfqdata" enctype="multipart/form-data" method="POST">
                                                           @csrf  
                                                           <div class="row">
                                                              <textarea class="form-control" id="" name="add_commit_text[]" rows="3"></textarea>
                                                           </div>
                                                           <br>
                                                           <div class="row" >
                                                              <button  style="color: aliceblue;   padding: 8px 12px;" name="status"    value="bid_sign_accepted" type="submit"  class=" btn btn-success col-sm-3" >Accepted</button>
                                                              <button style="color: aliceblue;   padding: 8px 12px;" name ="status" value="bid_signd_decline" type="submit" class="btn btn-danger col-sm-3">Decline</button>
                                                              <button style="color: aliceblue; padding: 8px 12px;" name ="status" value="bid_sign_send" type="submit" class="btn btn-info col-sm-3 ">Send</button>
                                                           </div>
                                                        </form>
                                                        @endif
                                                    </div>
                                                 @endif
                                            </div>
                                       </div>
                                    </div>
                                    @if($suppliersChackdata->nda_accepted == '1')
                                        <div class="d-flex flex-column gap-3 col-sm-6 my-2">
                                           <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;">
                                              <div class="d-flex justify-content-between align-items-center  ">
                                                 <h2 class="pb-2" style="font-weight:800;">  Bid Details</h2>
                                              </div>
                                              <div class="row">
                                                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                 <div class="card-body">
                                                    <h5 class="card-title  " style=" text-align: justify;">RFQ Bid Currency :</h5>
                                                    <p class="card-text" style=" text-align: justify;">{{$biddetail == null ? ' ' : $biddetail->currency}}</p>
                                                 </div>
                                                 <div class="card-body">
                                                    <h5 class="card-title" style=" text-align: justify;">Converstion Rate :</h5>
                                                    <p class="card-text" style=" text-align: justify;">{{$biddetail == null ? ' ' : $biddetail->converstion_rate}}</p>
                                                 </div>
                                                 <div class="card-body">
                                                    <h4 class="my-4">Raw Material's Index Refernce</h4>
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
                                                             <td>{{ $raw_materials }} </td>
                                                             <td>{{$biddetail == null  ? ' ' : $material_value[$key]}}</td>
                                                             <td>{{$biddetail == null  ? ' ' : $material_index[$key] }}</td>
                                                          </tr>
                                                          @endforeach 
                                                       </tbody>
                                                    </table>
                                                 </div>
                                              </div>
                                              </div>
                                           </div>
                                        </div>
                                        <div class="d-flex flex-column gap-3 col-sm-6 my-2">
                                           <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;">
                                              <div class="d-flex justify-content-between align-items-center  ">
                                                 <h2 class="pb-2" style="font-weight:800;">Discount  offers</h2>
                                              </div>
                                              <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                 <div class="card-body">
                                                    <h5 class="card-title" style=" text-align: justify;">Payment Terms:</h5>
                                                    <p class="card-text" style=" text-align: justify;">{{$biddetail == null ? ' ' : $biddetail->payment_terms}}</p>
                                                 </div>
                                                 <div class="card-body">
                                                    <h5 class="card-title" style=" text-align: justify;">Year on Year:</h5>
                                                    <p class="card-text" style=" text-align: justify;">{{$biddetail == null ? ' ' : $biddetail->year}}</p>
                                                 </div>
                                                 <div class="card-body">
                                                    <h5 class="card-title" style=" text-align: justify;">Contract Duration:</h5>
                                                    <p class="card-text" style=" text-align: justify;">{{$biddetail == null ? ' ' : $biddetail->contract_duration}}</p>
                                                 </div>
                                              </div>
                                              </div>
                                           </div>
                                        </div>
                                        <div class="d-flex flex-column gap-3 col-sm-12 my-2">
                                           <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;">
                                              <div class="d-flex justify-content-between align-items-center ">
                                                 <h2 class="pb-2" style="font-weight:800;">Questionair form</h2>
                                              </div>
                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                                                      echo 'The   is empty.';
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
                                                 @php
                                                 $answer = App\Models\QuestionairAnswer::where('rfqdetail_id',$rfqdetail->id)->where('questionair_id',$questionair->id)->where('supplier_id',$supplier->id)->first();
                                                 @endphp
                                                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" text-align: justify;">
                                                    <div class="pro-deta-view">
                                                       <label> Question {{$key+1}}: </label> 
                                                       <p>{{$questionair->questiona}}</p>
                                                    </div>
                                                 </div>
                                                 @if($questionair->answer_type == 'single text') 
                                                 <div class="pro-deta-view" style=" text-align: justify;">
                                                    <label> Answer: </label> 
                                                    <p >{{$answer == null ? ' ' : $answer->answer}}</p>
                                                 </div>
                                                 @endif
                                                 @if($questionair->answer_type == 'single choice' || $questionair->answer_type == 'multiple choice') 
                                                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" text-align: justify;">
                                                    <div class="pro-deta-view">
                                                       <label> Answer: </label> 
                                                       <p>{{$answer == null ? ' ' : $answer->answer}}</p>
                                                    </div>
                                                 </div>
                                                 @endif
                                                 @endforeach
                                              </div>
                                           </div>
                                        </div>
                                        <div class="d-flex flex-column gap-3 col-sm-12 my-2">
                                           <div class="border bg-white px-4 py-4 text-center position-relative" style="overflow-x: auto;border-color:#B4B6BD;">
                                              <div class="d-flex justify-content-between align-items-center ">
                                                 <h2 class="pb-2" style="font-weight:800;">Additional Information</h2>
                                              </div>
                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                 <div class="card-body" style=" text-align: justify;">
                                                    <h5 class="card-title">Additional Information</h5>
                                                    <p class="card-text">{{$biddetail == null ? ' ' : $biddetail->additional_Information}}</p>
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                    @endif
                                 </div>
                              </div>
                              @endforeach 
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade nav-massge" id="nav-messaging" role="tabpanel"
                     aria-labelledby="nav-messaging-tab">
                     <!-- Chatbox -->
                     <div class="row chat-list-l">
                        <div class="col-12 col-md-3">
                           <div class="">
                              <div class="mess-title">
                                 <h3>Messages</h3>
                                 <!--<img src="assets/dist/images/message-square.svg">-->
                                 <i class="fa-regular fa-message"></i>
                              </div>
                              <div class="input-group search-chat">
                                 <input type="search" class="form-control rounded"
                                    placeholder="Search" aria-label="Search"
                                    aria-describedby="search-addon">
                                 <a href=""><i class="bi bi-search"></i> </a>
                              </div>
                              <div data-mdb-perfect-scrollbar="true"
                                 style="position: relative; height: 400px"
                                 class="perfect-scrollbar ps ps--active-y">
                                 <ul class="list-unstyled mb-0 chat-small" id="group-list-{{$rfqdetail->id}}">
                                    <!-- rfq group -->
                                    @php
                                        $type = 'rfq';
                                    @endphp
                                    <x-admin.message-group :message="$rfqdetail->id" :type=$type />
                                 </ul>
                                 
                                 <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                    <div class="ps__thumb-x" tabindex="0"
                                       style="left: 0px; width: 0px;"></div>
                                 </div>
                                 <div class="ps__rail-y"
                                    style="top: 0px; height: 400px; right: 0px;">
                                    <div class="ps__thumb-y" tabindex="0"
                                       style="top: 0px; height: 314px;"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 col-md-6">
                           <div class="chat-view-box">
                              <!-- chat info will display here -->
                              <div id="chat-info">
                              </div>
                              
                              <div class="chat-view-mid" id="message-box" data-id=""></div>
                              
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
                              <div data-mdb-perfect-scrollbar="true"
                                 style="position: relative; height: 400px"
                                 class="perfect-scrollbar ps ps--active-y document-chat">
                                 <h3>Documents</h3>
                                 <ul class="list-unstyled mb-0" id="group-doc">
                                 </ul>
                                 
                                 <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                    <div class="ps__thumb-x" tabindex="0"
                                       style="left: 0px; width: 0px;"></div>
                                 </div>
                                 <div class="ps__rail-y"
                                    style="top: 0px; height: 400px; right: 0px;">
                                    <div class="ps__thumb-y" tabindex="0"
                                       style="top: 0px; height: 314px;"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="nav-activity" role="tabpanel"
                     aria-labelledby="nav-activity-tab">
                     <!-- Accordian -->
                     <div class="activity-tab">
                        <div class="activity-tab-l">
                           <h3>Supplier Activity</h3>
                           <h4>View Latest Updates</h4>
                           <ul>
                              @foreach($suppliersData as $key=>$suppliers)
                              <li>
                                 <a href="" id="company-data-{{$suppliers->id}}"
                                    class="{{$key == '0' ? 'active' : ' '}}">
                                    <span><img
                                       src="{{asset('Admin/assets/dist/images/table-large-iconOne.png')}}"
                                       alt="avatar"></span>
                                    <h3>{{$suppliers->company_name}}</h3>
                                    <span
                                       class="bid-btn">{{$suppliersArray ? $suppliersChackdata->status :' '}}</span>
                                 </a>
                              </li>
                              @endforeach
                           </ul>
                        </div>
                        <div class="activity-tab-r">
                           @foreach($suppliersData as $key=>$suppliers)
                           <div class="activity-tab-top {{$key == '0' ? '' : 'activity-tab-a'}}"
                              id="activity-tab-top-{{$suppliers->id}}">
                              <div class="activity-tab-topl">
                                 <img src="{{asset('Admin/assets/dist/images/table-large-iconOne.png')}}"
                                    alt="avatar">
                                 <h3>{{$suppliers->company_name}}</h3>
                                 <p>Milwaukee, W1 53226</p>
                              </div>
                              <span class="bid-btn"
                                 style="position: relative;top: -15px;">{{$suppliersArray ? $suppliersChackdata->status :' '}}</span>
                           </div>
                           @endforeach
                           <div class="activity-tab-bottom">
                              <ul>
                                 @if($activities)
                                 @foreach($activities as $key=>$activitie)
                                 <li id="is_activies-{{$activitie->id}}" class="is_activies">
                                    <h4>{{ \Carbon\Carbon::parse($activitie->created_at)->format('d/m/Y g:i:sA')}}
                                    </h4>
                                    <div class="text">
                                       <p><img src="{{asset('Admin/assets/dist/images/check-icon-ac.svg')}}"
                                          alt="avatar"> {{$activitie->is_activies}}</p>
                                    </div>
                                 </li>
                                 @endforeach
                                 @endif
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
<script>
   document.addEventListener("DOMContentLoaded", function() {
       var companyDataElements = document.querySelectorAll('[id^="company-data-"]');
       var profileElements = document.querySelectorAll('.activity-tab-top');
       var activies = document.querySelectorAll('.is_activies');
       var activies_add = document.querySelectorAll('[id^="is_activies-"]');
       companyDataElements.forEach(function(element, index) {
           element.addEventListener("click", function(event) {
               event.preventDefault();
               companyDataElements.forEach(function(el) {
                   el.classList.remove('active');
               });
               profileElements.forEach(function(profile) {
                   profile.style.display = 'none';
               });
               element.classList.add('active');
               profileElements[index].style.display = 'block';
               activies.forEach(function(el) {
                   el.classList.remove('active');
               });
               activies_add.forEach(function(profile) {
                   profile.style.display = 'none';
               });
               element.classList.add('active');
               activies_add[index].style.display = 'block';
           });
       });
   });
</script>
@endsection