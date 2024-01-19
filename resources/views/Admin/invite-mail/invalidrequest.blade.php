@extends('Auth.layout')
@section('content')
    <div class="login claim-list">
      <div class="login-page">
        <div class="login-logo"><a href=""><img src="{{asset('Admin/assets/dist/images/login-logo.png')}}"></a></div>
        <h3 style="color:red;"> Invalid Request</h3>
        @if ($message = Session::get('error'))
          <div class="alert alert-danger alert-top-border alert-dismissible fade show my-4" role="alert">
              <i class="mdi mdi-check-all me-3 align-middle text-danger"></i><strong>Error</strong> - {{$message}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <p>Join the Supply Me network, the leading on-demand manufacturing platform which connects the customer with suppliers to provide professional services and profitable work along every step in the supply chain.</p>
        <form action="{{Route('auth.sign_in.invite-member')}}" enctype="multipart/form-data" method="POST" >
           @csrf
           <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>First Name</b>
                <input type="text" name="FirstName"  placeholder="First Name" required="required" disabled>
                
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>Last Name</b>
                <input type="text" name="LastName"  placeholder="Last Name" disabled>
              </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>Email</b>
                <input type="text" name="email" placeholder="Enter email"  value="" disabled>
              </div>
            </div>

            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>Password</b>
                <input type="password" name="password"  placeholder="password" required="required">
              </div>
            
            

            
            

            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="input-wrapper search-input">
              <button class="btn btn-primary w100" disabled> Disabled</button>
            </div>
          </div>

          

           </div>
        </form>
      </div>
    </div>
    @endsection