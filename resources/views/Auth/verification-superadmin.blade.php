@extends('Auth.layout')
@section('content')
    <div class="login claim-list">
      <div class="login-page">
        <div class="login-logo"><a href="{{Route('auth.claim_your_company')}}"><img src="{{asset('Admin/assets/dist/images/login-logo.png')}}"></a></div>
      
           <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <p>
                        Thank you for registering with us. We received your application. Our team will review your application and notify via email shortly.
                    </p>
                </div>
                <a href="{{Route('auth.claim_your_company')}}" class="text-center">Go to website</a>
           </div>
      </div>
    </div>
    @endsection