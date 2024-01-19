 


@extends('Auth.layout')
@section('content')
  <div class="login">
    <div class="login-page">
      <div class="login-logo"><a href=""><img src="{{asset('Admin/assets/dist/images/login-logo.png')}}"></a></div>
      <h3>Email Verification</h3>
      @php
               $userId = base64_encode($user_id);
               $companyId = base64_encode($company_id);
            @endphp 
      @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-top-border alert-dismissible fade show my-4" role="alert">
            <i class="mdi mdi-check-all me-3 align-middle text-danger"></i><strong>Error</strong> - {{$message}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      
      <p style="background-color: #a6e5a6;height: 66px;padding: 10px; color: #000000;    border-radius: 7px;font-size: 14px;">We've sent a verificaton code to your email - {{$user ?  $user->email : ' '}} </p>
     
      <form action="{{Route('mail.checkotp',['company_id'=> $companyId,'user_id'=>$userId])}}" enctype="multipart/form-data" method="POST">
           @csrf
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="input-wrapper search-input">
             <span class="text-success w100" style="font-size: 13px; text-align: center;">OTP has been send.</span>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="input-wrapper search-input">
            <div id="countdown-container" style="font-size: 13px; text-align: center;">
            <span id="countdown" class="text-danger" > <b> <h3>  30 </h3></b> </span> Seconds remaining
        </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="input-wrapper">
              <b>Enter Code</b>   
              <input type="text" name="otp" placeholder="Enter Code" required>
              <input type="hidden" name="company_id" value="{{$company_id}}">
              <input type="hidden" name="user_id" value="{{$user_id}}">
            </div>
          </div>
                   
              
          <span class="signup-text text-center mt-0 mb-20"><a href="{{Route('opt.Resendotp',['company_id'=> $companyId,'user_id'=>$userId])}}">Resend Code</a></span>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="input-wrapper search-input">
              <button class="btn btn-primary w100" id="cdesabled">Continue</button>
            </div>
          </div>

        </div>

        
      </form>
    </div>
  </div>



  <script>
    var countdown = 30; // Countdown time in seconds

        function updateCountdown() {
            var countdownElement = document.getElementById('countdown');
            countdown--;

            if (countdown <= 0) {
                 document.getElementById('countdown-container').style.display = 'none';
                 document.getElementById('otphsa').style.display = 'none';
              
            } else {
                countdownElement.textContent = countdown;
                setTimeout(updateCountdown, 1000); // Update every 1 second
                document.getElementById('cdesabled').disabled = false;
            }
        }

      updateCountdown();

  </script>
 
 


  @endsection