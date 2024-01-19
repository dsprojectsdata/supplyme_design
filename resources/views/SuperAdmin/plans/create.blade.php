@extends('SuperAdmin.layout.app')
@section('superadmincontent')
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
</style>
<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
            <!-- Row -->
            <!-- ================= page header open ================= -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Payment Plan</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payment plan</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('paymant.plans.index') }}" class="text-white"> <i
                                    class="fe fe-arrow-left me-2"></i> Back 
                            </a>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <form action="{{Route('paymant.plans.store')}}" method="post" enctype="multipart/form-data" id="myForm" data-parsley-validate="">
                               @csrf
                                <div class="row row-sm">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="mg-b-10">Name<span class="tx-danger">*</span></p>
                                            <input type="text" class="form-control text-dark" name="name"  placeholder="Enter Plan Name" required="">
                                        </div>
                                        <div class="form-group">
                                            <p class="mg-b-10">Monthly Price USD<span class="tx-danger">*</span></p>
                                            <input type="text" class="form-control text-dark" name="monthly_price_usd" id="monthly_price_usd"  placeholder="Enter Monthly Price USD" required="">
                                        </div>
                                        <div class="form-group">
                                            <p class="mg-b-10">Number OF User<span class="tx-danger">*</span></p>
                                            <input type="text" class="form-control text-dark" name="number_of_user" placeholder="Enter Number OF User" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="mg-b-10">Monthly Price INR<span class="tx-danger">*</span></p>
                                            <input type="text" class="form-control text-dark" id="monthly_price_inr"  name="monthly_price_inr"placeholder="Enter Monthly Price INR" required="">
                                        </div>
                                        <div class="form-group">
                                            <p class="mg-b-10">Discount<span class="tx-danger">*</span></p>
                                            <input type="text" class="form-control text-dark" name="discount" placeholder="Enter Discount" required="">
                                        </div>
                                        <div class="form-group">
                                            <p class="mg-b-10">Number OF RFQ<span class="tx-danger">*</span></p>
                                            <input type="text" class="form-control text-dark" name="number_of_rfq" placeholder="Enter Number OF RFQ" required="">
                                        </div>
                                        <div class="form-group">
                                            <p class="mg-b-10">Stripe Plan Key <span class="tx-danger">*</span></p>
                                            <input type="text" class="form-control text-dark" name="stripe_plan" placeholder="prod_******" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-xl-12 mb-3 ">
                                    <label>Permission</label>
                                    <div class="row" style=" margin-top: 20px;">
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" name="permission[]" value="RFQ Events" id="flexCheckDefault">
                                                          <label class="form-check-label" for="flexCheckDefault">
                                                               RFQ Events
                                                          </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" name="permission[]"  value="Supplier Group" id="flexCheckChecked1" >
                                                          <label class="form-check-label" for="flexCheckChecked1">
                                                               Supplier Group
                                                          </label>
                                                        </div>
                                                    </div>   
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" name="permission[]"  value="Messages" id="flexCheckChecked110" >
                                                          <label class="form-check-label" for="flexCheckChecked110">
                                                              Messages
                                                          </label>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" name="permission[]" value="Newfeed" id="flexCheckChecked2" >
                                                          <label class="form-check-label" for="flexCheckChecked2">
                                                              Newfeed
                                                          </label>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" name="permission[]" value="User" id="flexCheckChecked3" >
                                                          <label class="form-check-label" for="flexCheckChecked3">
                                                              User
                                                          </label>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox"  name="permission[]" value="Collaborators" id="flexCheckChecked4" >
                                                          <label class="form-check-label" for="flexCheckChecked4">
                                                               Collaborators
                                                          </label>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" name="permission[]" value="Company" id="flexCheckChecked5" >
                                                          <label class="form-check-label" for="flexCheckChecked5">
                                                               Company
                                                          </label>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" name="permission[]" value="Role" id="flexCheckChecked7" >
                                                          <label class="form-check-label" for="flexCheckChecked7">
                                                              Role
                                                          </label>
                                                        </div>
                                                    </div> 
                                               </div>        
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <p class="mg-b-10">Description<span class="tx-danger">*</span></p>
                                        <textarea id="description" name="description" class="form-control"  rows="4" cols="50" required=""></textarea>
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary"> Submit </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>
@endsection


