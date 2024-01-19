@extends('Auth.layout')
@section('content')
  <div class="login">
    <div class="login-page">
      <div class="login-logo"><a href=""><img src="{{asset('Admin/assets/dist/images/login-logo.png')}}"></a></div>
      <h3>Email Verification</h3>
      @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-top-border alert-dismissible fade show my-4" role="alert">
            <i class="mdi mdi-check-all me-3 align-middle text-danger"></i><strong>Error</strong> - {{$message}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <p>Before you get started, let's verify your email. Check your email for a message with your code.</p>
      <form action="{{Route('auth.checkotp')}}" enctype="multipart/form-data" method="POST">
           @csrf
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="input-wrapper search-input">
              <span class="text-success w100">Code has been send.</span>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="input-wrapper">
              <b>Enter Code</b>
              <input type="text" name="otp" placeholder="Enter Code" required>
            </div>
          </div>
          <span class="signup-text text-center mt-0 mb-20"><a href="login.html">Resend Code</a></span>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="input-wrapper search-input">
              <button class="btn btn-primary w100">Continue</button>
            </div>
          </div>

        </div>

        
      </form>
    </div>
  </div>
  @endsection