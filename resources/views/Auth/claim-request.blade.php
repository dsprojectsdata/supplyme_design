@extends('Auth.layout')
@section('content')
    <div class="login">
      <div class="login-page">
        <div class="login-logo"><a href=""><img src="{{asset('Admin/assets/dist/images/login-logo.png')}}"></a></div>
        <h3>Sign In</h3>
        <p>Lon in with either your Supply Me account to continue.</p>
        <form  >
          <div class="row">
            <div class="col-lg-12 col-md-12 col-md-12 col-xs-12">
              <div class="input-wrapper search-input">
                <a href="{{Route('auth.sign_up')}}" class="btn btn-primary w100">Claim Your Company For Free</a>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-md-12 col-xs-12">
              <span class="signup-text text-center mt-0">New to Supply Me?  <a href="{{Route('auth.sign_up')}}"> Create Your Free Account</a></span>
            </div>
          </div>
        </form>
      </div>
    </div>
    @endsection