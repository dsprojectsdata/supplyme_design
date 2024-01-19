@extends('Admin.layout.app')
@section('admincontent')


<link rel="stylesheet" href="{{asset('Admin/assets/dist/css/custome-invite.css')}}">

<link rel="stylesheet" href="{{ asset('Admin/assets/dist/css/bootstrap-tagsinput.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<style>
    span.tag.label.label-info {
        color: black;
        background-color: #5bc0de;
        margin-right: 2px;
        color: white;
        display: inline;
        padding: 0.2em 0.6em 0.3em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25em;
}

.dark{
    color:black !important;
}
.bootstrap-tagsinput input{
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    margin-top: 10px;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.memberImg{
    height:40px;
    width:45px;
    float:left;
    padding: 6px;
}
</style>
<!-- message close -->
<section id="page">
    <section class="wrapper w-100 d-flex">
        <section id="main" class="d-flex flex-column">
            <div class="main-content px-md-4 px-2 py-4" style="margin-top:57px">
                <!-- Welcome -->
                <div class="d-md-block d-none flex-wrap gap-3 welcomeBox">
                    <!-- <div class="title pb-4 d-flex flex-column w-50 gap-2 flr">
                        <h2>Invites Members </h2>
                    </div> -->
                    <div class="title pb-4 d-flex flex-column w-100 gap-2">
                        <div class="text-btn">
                        <h2 class=" position-relative">Subscription History</h2>
                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#teamModal">Renew plans</a>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                </div>
                <!-- Table -->
                <div class="nav nav-tabs row newtab gap-3 gap-md-0" id="nav-tab" role="tablist">


                </div>
                <div class="d-flex justify-content-between align-items-center px-3">
                </div>
                <div class="border bg-white my-4" style="border-color:#B4B6BD;">
                    <h5 class="px-3 pt-3"> Invites Members LIst </h5>
                    <div class="tab-content px-3 py-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover " style="border-color:#B4B6BD;padding-top: 10px;" id="myTable">
                                 <thead style="background: #E2E8EA;">
                                    <tr>
                                       <th>S.No</th>
                                       <th>Name</th>
                                       <th>Duration</th>
                                       <th>Price</th>
                                       <th>Subscription Date</th>
                                       <th>Transaction Id</th>
                                    </tr>
                                 </thead>
                                 <!--team momber-->
                                 <tbody>
                                    @foreach($CompanySubscriptionHistorys as $key=>$Company)
                                     <tr>
                                       <td>{{$key+1}}</td>
                                       <td>{{$Company->plan_name}}</td>
                                       <td>{{$Company->plan_duration}}</td>
                                       <td>{{$Company->plan_price}}</td>
                                       <td>{{$Company->subscription_date}}</td>
                                       <td>{{$Company->transaction_id}}</td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Upcoming -->

            </div>
            </div>
        </section>
    </section>
</section>
<!-- ===============================  model open  ================================ -->
 <div class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="teamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="team-member-box">
                    <div class="team-member-input">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="add-team-titile">
                               <h4>Select Subscription New plans</h4>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($plans as $plan)   
                              <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="payment-list-one">
                                  <div class="payment-list-three-bg">
                                    <div class="payment-list-img">
                                      <img src="{{asset('Admin/assets/dist/images/payment-3.png')}}">
                                    </div>
                                    <h2 style="  margin-bottom: 20px;">{{$plan->name}} </h2>
                                    <div data-v-b19b8049="" class="h-pricing-card__discount">
                                    @if($plan->monthly_price_inr || $plan->monthly_price_usd)
                                        @if($country =='India')
                                            <span data-v-6508a6ad="" data-v-b19b8049="" class="h-price h-price--text-gray" dir="ltr" country-code="IN">
                                                <span data-v-6508a6ad="" class="h-price__currency t-body-strikethrough">₹</span><span data-v-6508a6ad="" class="h-price__number t-body-strikethrough">
                                                  {{number_format($plan->monthly_price_inr)}}
                                                </span>
                                            </span>
                                        @else
                                            <span data-v-6508a6ad="" data-v-b19b8049="" class="h-price h-price--text-gray" dir="ltr" country-code="IN">
                                                <span data-v-6508a6ad="" class="h-price__currency t-body-strikethrough">$</span><span data-v-6508a6ad="" class="h-price__number t-body-strikethrough">
                                                  {{number_format($plan->monthly_price_usd)}}
                                                </span>
                                            </span>
                                        @endif        
                                        <span data-v-cba67550="" data-v-b19b8049="" class="h-discount-tag t-body-2 h-discount-tag-text-danger-dark h-discount-tag-bg-danger-light h-pricing-card__discount--tag" dir="ltr">
                                                  SAVE {{$plan->discount}}% 
                                        </span>
                                    @else
                                    <span data-v-cba67550="" data-v-b19b8049="" class="h-discount-tag t-body-2 h-discount-tag-text-danger-dark h-discount-tag-bg-danger-light h-pricing-card__discount--tag" dir="ltr">
                                                  Free
                                    </span>
                                    @endif        
                                    </div>
                                    @if($country =='India')
                                     <h6>
                                         <?php
                                            $monthly_price_inr = is_numeric($plan->monthly_price_inr) ? $plan->monthly_price_inr : 0;
                                            $monthly_price_usd = is_numeric($plan->monthly_price_usd) ? $plan->monthly_price_usd : 0;
                                            $discount = is_numeric($plan->discount) ? $plan->discount : 0;
                                            
                                            $price_total_inr = ($monthly_price_inr) ;
                                            $price_total_usd = ($monthly_price_usd) ;
                                         ?>
                                      <b>Start at</b>
                                        ₹{{number_format($price_total_inr)}}
                                      <b>Per Month</b>
                                    </h6>
                                    @else
                                    <h6>
                                      <b>Start at</b>
                                        ${{number_format($price_total_usd)}}
                                      <b>Per Month</b>
                                    </h6>
                                    @endif
                                        <div class="card-body bg-light rounded-bottom" style=" text-align: left;">
                    						<ul class="list-unstyled mb-4">
                    						       @if(in_array('Company', explode(',',  $plan->permission)))
                        						    <li class="mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-check text-success"></i></span>Company Profile</li>
                        						   @else 
                        						    <li class="text-muted mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-times text-danger"></i></span>Company Profile</li>
                        						   @endif 
                        						   @if(in_array('Newfeed', explode(',',  $plan->permission)))
                        						    <li class="mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-check text-success"></i></span>Newfeed</li>
                        						   @else 
                        						    <li class="text-muted mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-times text-danger"></i></span>Newfeed</li>
                        						   @endif 
                        						   @if(in_array('RFQ Events', explode(',',  $plan->permission)))
                        						    <li class="mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-check text-success"></i></span>RFQ Events{{ $plan->number_of_rfq ? '['.$plan->number_of_rfq.']' : '' }}</li>
                        						   @else 
                        						    <li class="text-muted mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-times text-danger"></i></span>RFQ Events</li>
                        						   @endif 
                        						   @if(in_array('Supplier Group', explode(',',  $plan->permission)))
                        						    <li class="mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-check text-success"></i></span>Supplier Group</li>
                        						   @else 
                        						    <li class="text-muted mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-times text-danger"></i></span>Supplier Group</li>
                        						   @endif 
                        						   @if(in_array('Collaborators', explode(',',  $plan->permission)))
                        						    <li class="mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-check text-success"></i></span>Collaborators</li>
                        						   @else 
                        						    <li class="text-muted mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-times text-danger"></i></span>Collaborators</li>
                        						   @endif
                        						   @if(in_array('User', explode(',',  $plan->permission)))
                        						    <li class="mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-check text-success"></i></span>User {{$plan->number_of_user ? '['.$plan->number_of_user.']' : ' ' }}</li>
                        						   @else 
                        						    <li class="text-muted mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-times text-danger"></i></span>User</li>
                        						   @endif
                        						   @if(in_array('Role', explode(',',  $plan->permission)))
                        						    <li class="mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-check text-success"></i></span>Role</li>
                        						   @else 
                        						    <li class="text-muted mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-times text-danger"></i></span>Role</li>
                        						   @endif
                    						</ul>
                    					</div>
                                    </div>
                                    <p>{{$plan->description}} </p>
                                    @if($plan->subscription_type == '0')
                                            <a href="{{Route('auth.claimPaymentList')}}" class="btn btn-primary">Select Plan</a>
                                        @else
                                            <form action="{{Route('subscription.paymentUpdate')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input  type="hidden" class="form-control text-dark" name="company_id" value="{{$companyId}}">
                                                <input  type="hidden" class="form-control text-dark" name="user_id" value="{{$user->id}}">
                                                <input  type="hidden" class="form-control text-dark" name="plan_id"    value="{{$plan->id}}">
                                                <input  type="hidden" class="form-control text-dark" name="plan_name"   value="{{$plan->name}}">
                                                @if($country =='India')
                                                   <input  type="hidden" class="form-control text-dark" name="plan_price"   value="{{$plan->monthly_price_inr}}">
                                                @else
                                                   <input  type="hidden" class="form-control text-dark" name="plan_price"   value="{{$plan->monthly_price_usd}}">
                                                @endif
                                                <input  type="hidden" class="form-control text-dark" name="plan_duration" value="Free">
                                                <input  type="hidden" class="form-control text-dark" name="subscription_date" value="{{date('Y-m-d')}}">
                                                <button type="submit" class="btn btn-primary">Select Plan</button>
                                            </form>
                                        @endif   
                                  </div>
                              </div>
                            @endforeach  
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>

  <!-- Modal -->
<!-- ===============================  model close ================================ -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js" ></script>

<!-- // email group  close -->

<script>
   
    $(document).ready(function () {
      
        $('#openModalBtn').on('click', function () {
             $('#myModal').modal('show');
        });
        $('#cancleModel').on('click', function() {
              console.log('cancel model clicked');
              $('#teamModal').modal('hide'); 
              $('#processingMessage').text('');
        });

    });
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
      <script>
          jQuery(document).ready(function() {
            jQuery('#myTable').DataTable({
               "pageLength": 50,
            });
          });
      </script>
@endsection
