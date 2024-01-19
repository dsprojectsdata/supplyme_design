@extends('Auth.layout')
@section('content')
<div class="login">
  <div class="login-page">
  <div class="login-logo"><a href=""><img src="{{asset('Admin/assets/dist/images/login-logo.png')}}"></a></div>
    <h3>Current Claim Company</h3>
    <div class="card row" >
        <div class="card-body col-sm-12" >
            <div class="row">
                <div class="col-sm-6"> 
                <h5 class="card-subtitle mb-2 text-muted"><span style="color:green">Company Name</span> = {{$company ? $company->company_name : ' '}}</h5>
                </div> 
                <div class="col-sm-6"> 
                <h5 class="card-subtitle mb-2 text-muted"><span style="color:green"> User Name </span> = {{$company ? $company->user->firstname : ' '}}</h5>
                </div>
                <div class="col-sm-6"> 
                <h5 class="card-subtitle mb-2 text-muted"><span style="color:green">Address</span> = {{$company ? $company->address : ' '}}</h5>
                </div>
                <div class="col-sm-6"> 
                <h5 class="card-subtitle mb-2 text-muted"><span style="color:green">Company Type </span>={{$company ? $company->company_type : ' '}}</h5>
                </div>
            </div>
        </div>
    </div>
      @php
         $companyId = base64_encode($company->id);
       @endphp
    <span class="signup-text">Don't have an account? <a href="{{Route('auth.create_an_account',$companyId)}}"> Sign up</a></span>
  </div>
</div>
@endsection