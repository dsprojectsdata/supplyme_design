@extends('Admin.layout.app')
@section('admincontent')

<link rel="stylesheet" href="{{ asset('Admin/assets/dist/css/style.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<style>
    .user-profileR {
        background: #efefef;
        padding: 15px;
        display: inline-block;
        width: 90%;
        height: 550px;
        border-radius: 10px;
        float: right;
    }
    .choices {
        margin-top: 9px;
    }

</style>
 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" />
<link href="{{asset('SuperAdmin/assets/libs/choices.js/public/assets/styles/choices.min.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('SuperAdmin/assets/js/pages/form-advanced.init.js')}}"></script>
<script src="{{asset('SuperAdmin/assets/libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>
<section id="page" class="quote">
    <section class="wrapper w-100 d-flex">
        <section id="main" class="d-flex flex-column">
            <!-- navbar -->
                <div class="main-content px-md-4 px-2 py-4 mess-overflow" style="margin-top:57px">
                    <!-- Welcome -->
                    <div class="d-block flex-wrap gap-3 welcomeBox">
                        <div class="title pb-4 d-flex flex-column w-100 gap-2">
                            <h2 class=" position-relative">Payment Details</h2>
                        </div>
                        <form action="{{Route('admin.purchaseSubscriptionPlanGateway')}}" method="post" id="payment-form">
                          @csrf
                            <div class="saved-suppliers saved-suppliers-page user-profile-page">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="row">
                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                              <div class="biling-cycle">
                                                  <h3>Billing Cycle</h3>
                                                  <input type="hidden" name="total_price_payment" class="total_price_payment">
                                                  <input type="hidden" name="stripe_plan"  value="{{$plan->stripe_plan}}">
                                                  <input type="hidden" name="stripe_plan_name"  value="{{$plan->name}}">
                                                  <input type="hidden" name="plan_id"  value="{{$plan->id}}">
                                                  <label class="form-check-label" for="plan_duration_monthly"><input  type="radio" name="plan_duration" id="plan_duration_monthly" value="{{$plan->name}}" checked  /> {{$plan->name}}</label>
                                                  <label class="form-check-label" for="plan_duration_annually"><input  type="radio" value="annually"  /> Annually</label>
                                                  <span>Save {{$plan->discount}}%</span>
                                                    @if($country =='India')
                                                        <p class="plan_price_monthly" data-currency="INR" data-price ="{{$plan->monthly_price_inr}}"> Monthly payments of ₹{{number_format($plan->monthly_price_inr)}} - 12 Month Subscription</p>
                                                        <input type="hidden" name="currency" value="INR">
                                                    @else
                                                        <p class="plan_price_monthly" data-currency="USD" data-price ="{{$plan->monthly_price_usd}}"> Monthly payments of ${{number_format($plan->monthly_price_usd)}} - 12 Month Subscription</p>
                                                        <input type="hidden" name="currency" value="USD">
                                                    @endif
                                              </div>
                                          </div>
                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 my-2">
                                            <div class="input-wrapper">
                                              <b> Card Number</b>
                                              <div id="card-element" style=" font-size: 13px; color: #555; outline: none; border: 1px solid #bbb; padding: 10px 15px; border-radius: 5px; position: relative;width: 100%; height: 40px; background: #fff;">
                                               
                                               </div>
                                            </div>
                                          </div>
                                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 my-2">
                                            <div class="input-wrapper">
                                              <b>Billing Address 1</b>
                                              <input type="text" name="address" placeholder="Billing Address" />
                                            </div>
                                          </div>
                                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 my-2">
                                            <div class="input-wrapper">
                                              <b>Billing Address 2 (Optical)</b>
                                              <input type="text" name="address2" placeholder="Billing Address" />
                                            </div>
                                          </div>
                                          
                                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 my-2">
                                            <div class="input-wrapper">
                                              <b>Country</b>
                                                <select id="country" class="country" name="country_id"  require>
                                                  <option value=" ">Select</option>
                                                  @foreach($countries as $key=>$coun)
                                                   <option value="{{$coun->id}}" >{{$coun->name}}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                          </div>
                                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 my-2">
                                            <div class="input-wrapper">
                                              <b>State/Province</b>
                                               <select class="state" name="state_id"  require>
                                                  <option value=" ">Select</option> 
                                                </select>
                                            </div>
                                          </div>
                                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 my-2">
                                            <div class="input-wrapper">
                                              <b>City</b>
                                                <select id="city" name="city_id" require>
                                                    <option value=" ">Select</option> 
                                                </select>
                                            </div>
                                          </div>
                                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 my-2">
                                            <div class="input-wrapper">
                                              <b>Zip Code</b>
                                                 <input type="text" name="zip" placeholder="Enter Zip Code" />
                                            </div>
                                          </div>
                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 my-2">
                                            <div class="input-wrapper">
                                              <button class="btn btn-primary w100" type="submit">Complete Payment</button>
                                            </div>
                                          </div>
                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 my-2">
                                            <span class="signup-text text-center mt-0">By Completing payment, I agree to the <a href="">Terms of Service</a></span>
                                          </div>
                                        </div>
                                    </div>
                                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="payment-right">
                                      <h4><b>Supply Me Registered</b> - Supplier Tier Badge</h4>
                                      <ul>
                                        @foreach(explode(',',$plan->permission) as $permission)
                                            <li>
                                              <b><img src="{{asset('Admin/assets/dist/images/check.svg')}}" /> {{$permission}} 
                                            </li>
                                        @endforeach
                                      </ul>
                                         <hr>
                                      <div>
                                        <h5>Description : </h5>
                                        <p class="my-2">{{$plan->description}}</p>
                                      </div>
                                      <div class="payment-show">
                                        <h5>Supply Me Registered
                                          <span>Monthly Plan</span>
                                        </h5>
                                        @if($country =='India')
                                            <p>₹{{number_format($plan->monthly_price_inr)}} <span>/Month</span></p> 
                                        @else
                                            <p>${{number_format($plan->monthly_price_usd)}} <span>/Month</span></p>
                                        @endif
                                      </div>
                                      <div class="payment-show grand_div">
                                        <h5>Grand Total</h5>
                                        <p class="total_grand">  </p>
                                      </div>
                                      <div class="payment-show discount_div">
                                        <h5>Discount</h5>
                                        <p class="total_discount">  </p>
                                      </div>
                                      <div class="payment-show">
                                        <h5>Total</h5>
                                        <p class="total_price">  </p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </section>
    </section>
</section>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var stripe = Stripe('pk_test_rOJxxJTz0hSYflspC70rWHMy');
    var elements = stripe.elements();
    
    var card = elements.create('card');
    card.mount('#card-element');
    
    var form = document.getElementById('payment-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Display error message using SweetAlert if token creation fails
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: result.error.message // Display Stripe error message
                });
            } else {
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', result.token.id);
                form.appendChild(hiddenInput);
    
                // Display success message using SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Payment successful!'
                }).then(function() {
                    // After displaying success, submit the form
                    form.submit();
                });
            }
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js" ></script>
<script>
     $(document).ready(function() {
         $('.discount_div').hide();
         $('.grand_div').hide();
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
         
        function updatePrice(price) {
            var total_price = numberWithCommas(price);
            var currency = $('.plan_price_monthly').data('currency');
             if(currency == 'INR'){
                  $('.total_price').text('₹'+total_price);
                  $('.total_price_payment').val(price);
                  
             }
             else{
                 $('.total_price').text('$'+total_price);
                 $('.total_price_payment').val(price);
             }
        }
    
        var initialPrice = $('.plan_price_monthly').data('price'); 
        updatePrice(initialPrice);
    
         $('#plan_duration_annually').on('click', function(e) {
            var initialPrice = $('.plan_price_monthly').data('price');
            
            var priceAnnually = initialPrice * 12;
            var discount = "{{$plan['discount']}}";
            if(discount){
               $('.discount_div').show();
               $('.grand_div').show();
               $('.total_discount').text(discount + '%');
               
               var currency = $('.plan_price_monthly').data('currency');
               if(currency == 'INR'){
                 $('.total_grand').text('₹'+  numberWithCommas(priceAnnually));
               }
               else{
                   $('.total_grand').text('$'+  numberWithCommas(priceAnnually));
               }
               var discount_price =  priceAnnually *discount/100;
               var total = priceAnnually -discount_price;
            }
            updatePrice(total);
        });
        
        $('#plan_duration_monthly').on('click', function(e) {
            $('.discount_div').hide();
            $('.grand_div').hide();
           var initialPrice = $('.plan_price_monthly').data('price'); 
            updatePrice(initialPrice);
        });
    });
    
    
        $(document).on('change','#country', function() {
            var country =  $("#country").val();
            var url ="{{Route('auth.SearchState')}}";
              $.ajax({
                  url: url, 
                  method:"GET",
                  data:{'country':country},
                  success: function(result){
                      $(".state").html(result);
                  }
              });
        })
        $(document).on('change','.state', function() {
            var state =  $(".state").val();
            var url ="{{Route('auth.SearchCity')}}";
              $.ajax({
                  url: url, 
                  method:"GET",
                  data:{'state':state},
                  success: function(result){    
                      $("#city").html(result);
                  }
              });
        })
</script>
@endsection
