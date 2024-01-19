@extends('Auth.layout')
@section('content')
<div class="login">
  <!-- message close -->




  <div class="login-page">
    <div class="login-logo"><a href=""><img src="{{asset('Admin/assets/dist/images/login-logo.png')}}"></a></div>
    <h3>Welcome</h3>

    @if(session('success'))
    <div class="alert alert-success mg-b-0" role="alert">

            <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong> {{ session('success') }} </strong>
        </div>
    @endif

      <p>Log in with either your Supply Me or Thomas account to continue.</p>
      @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-top-border alert-dismissible fade show my-4" role="alert">
            <i class="mdi mdi-check-all me-3 align-middle text-danger"></i><strong>Error</strong> - {{$message}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

    <form action="{{Route('auth.login')}}" enctype="multipart/form-data" method="POST">
      @csrf
      <div class="input-wrapper">


      @php
    $email = session('email');
    @endphp

    @if ($email)
        <input type="text" id="user" name="email" required value="{{ $email }}">
        <label for="user">Email Address</label>
      </div>

      @endif
      <div class="input-wrapper">
        <input type="password" id="password" name="password" required>
        <label for="password">Password</label>
      </div>
      <div class="input-group">
        <button>Continue</button>
      </div>
         <span class="signup-text">Don't have an account? <a href="{{Route('auth.create_an_account')}}"> Sign up</a></span>
    </form>
  </div>
</div>
@endsection