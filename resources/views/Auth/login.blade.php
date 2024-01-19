@extends('Auth.layout')
@section('content')
<div class="login">
  <div class="login-page">
    <div class="login-logo"><a href=""><img src="{{asset('Admin/assets/dist/images/login-logo.png')}}"></a></div>
    <h3>Welcome</h3>
      <p>Log in with either your Supply Me or Thomas account to continue.</p>
      @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-top-border alert-dismissible fade show my-4" role="alert">
            <i class="mdi mdi-check-all me-3 align-middle text-danger"></i><strong>Error</strong> - {{$message}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    <form action="{{Route('auth.login')}}" enctype="multipart/form-data" method="POST" class="my-4">
      @csrf
      <div class="input-wrapper">
        <input type="text" id="user" name="email" required>
        <label for="user">Email Address</label>
      </div>
      <div class="input-wrapper">
        <input type="password" id="password" name="password" required>
        <label for="password">Password</label>
      </div>
      <div class="input-group">
        <button>Continue</button>
      </div>
         <span class="signup-text">Don't have an account? <a href="{{Route('auth.ClaimProfileCompany')}}"> Sign up</a></span>
    </form>
  </div>
</div>
@endsection