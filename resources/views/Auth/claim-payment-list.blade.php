@extends('Auth.layout')
@section('content')
<style>
    .h-pricing-card__discount[data-v-b19b8049] {
    min-height: 32px;
}.h-price[data-v-6508a6ad] {
    display: inline-flex;
}.h-price--text-gray .h-price__currency[data-v-6508a6ad], .h-price--text-gray .h-price__number[data-v-6508a6ad], .h-price--text-gray .h-price__suffix[data-v-6508a6ad] {
    color: #727586;
}

.t-body-strikethrough, .t-price-strikethrough {
    text-decoration-line: line-through;
}
.t-body-2, .t-body-3, .t-body-strikethrough {
    font-size: 14px;
}.h-price--text-gray .h-price__currency[data-v-6508a6ad], .h-price--text-gray .h-price__number[data-v-6508a6ad], .h-price--text-gray .h-price__suffix[data-v-6508a6ad] {
    color: #727586;
}

.t-body-strikethrough, .t-price-strikethrough {
    text-decoration-line: line-through;
}
.t-body-2, .t-body-3, .t-body-strikethrough {
    font-size: 14px;
}.h-pricing-card__discount--tag[data-v-b19b8049] {
    margin-left: 4px;
}
.h-discount-tag-text-danger-dark[data-v-cba67550] {
    color: #d63163;
}
.h-discount-tag-bg-danger-light[data-v-cba67550] {
    background-color: #ffe8ef;
}
.h-discount-tag[data-v-cba67550] {
    border-radius: 20px;
    display: inline-block;
    padding: 4px 12px;
}
.t-body-2, .t-body-3, .t-body-strikethrough {
    font-size: 14px;
}
.t-body-2, .t-body-4, .t-body-uppercase, .t-button, .t-h1, .t-h2, .t-h3, .t-h4, .t-h5, .t-header-currency, .t-header-currency-long, .t-headline-pt, .t-overline, .t-price-header, .t-price-pt, a, b, h1, h2, h3, h4, h5, strong {
    font-weight: 700;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="login claim-payment-list">
    <div class="login-page">
        
      <div class="login-logo"><a href=""><img src="{{asset('Admin/assets/dist/images/login-logo.png')}}"></a></div>
      <h3>Select a Listing Tier</h3>
      <p>Drive More Opportunity than Your Competiton with a Paid Supply Me Listing</p>
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
                                
                                $price_total_inr = ($monthly_price_inr) - ($monthly_price_inr * $discount / 100);
                                $price_total_usd = ($monthly_price_usd) - ($monthly_price_usd * $discount / 100);
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
                                <form action="{{Route('auth.ClaimPaymentFree')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input  type="hidden" class="form-control text-dark" name="company_id" value="{{$companyId}}">
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
@endsection