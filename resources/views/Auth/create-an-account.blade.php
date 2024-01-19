@extends('Auth.layout')
@section('content')
<style>
    #successMessage {
        color: green;
        display: none;
        opacity: 0; /* Set initial opacity to 0 */
        transition: opacity 2s; /* Apply a 2-second transition to opacity property */
    }
    #password_rules ul li {
        /*font-size: 12px;
        font-weight: normal;*/
        color: #000000;
    }
    #password_rules ul li.complete {
        color: #5DB406;
    }
    span.togglePassword {
        color: gray;
        font-size: 12px;
        cursor: pointer;
    }

    .validation-message {
        color: red;
    }
    
    .valid-message {
        color: green;
    }

    #asBuyerRadioBtn,#asSupplierRadioBtn {
        height: 13px;
        width: 28px;
    }
    
    
</style>
    <div class="login claim-list">
      <div class="login-page">
        <div class="login-logo"><a href=""><img src="{{asset('Admin/assets/dist/images/login-logo.png')}}"></a></div>
        <h3>Create an Account</h3>
        @if ($message = Session::get('error'))
          <div class="alert alert-danger alert-top-border alert-dismissible fade show my-4" role="alert">
              <i class="mdi mdi-check-all me-3 align-middle text-danger"></i><strong>Error</strong> - {{$message}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <p>Join the Supply Me network, the leading on-demand manufacturing platform which connects the customer with suppliers to provide professional services and profitable work along every step in the supply chain.</p>
       
        <form action="{{Route('auth.sign_in')}}" enctype="multipart/form-data" method="POST"  class="my-4" id="passwordform">
           @csrf
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="input-wrapper">
                        <b>First Name <span style=" color: red;"> *</span></b>
                        <input type="text" name="FirstName"  placeholder="First Name" required="required">
                        <input type="hidden" name="company_id"  value="{{$companyids ?? ' '}}" >
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <div class="input-wrapper">
                    <b>Last Name <span style=" color: red;"> *</span></b>
                    <input type="text" name="LastName"  placeholder="Last Name" required>
                  </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <div class="input-wrapper">
                    <b>Primary Email <span style=" color: red;"> *</span></b>
                        <input type="text" name="email"  value="" placeholder="Enter Email" required onkeyup="validateEmail(this.value)">
                        <p id="validation-message" style="margin-right: 83px;"></p>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <div class="input-wrapper">
                    <b>Mobile No. <span style=" color: red;"> *</span></b>
                        <input type="number" name="phone_number"  value="" placeholder="Enter phone number" required onkeyup="validateEmail(this.value)">
                        <p id="validation-message"></p>
                  </div>
                </div>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>How will you primarily use our network? <span style=" color: red;"> *</span></b>
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4">
                        <input type="radio" id="asBuyerRadioBtn" name="Primary_Use_our_network_for" value="As buyer" required> <b id="buyerSpan"> As Buyer</b>
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4">
                        <input type="radio" id="asSupplierRadioBtn" name="Primary_Use_our_network_for" value="As supplier" required> <b id="supplierSpan"> As Supplier</b>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>Job Role <span style=" color: red;"> *</span></b>
                <select name="JobRole" required>
                  <option value="" disabled selected >Select Job Role</option>
                  @foreach($jobroles as $jobrole)
                  <option value="{{$jobrole->id}}">{{$jobrole->role_name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>Password</b>
                <input type="password" name="password"  placeholder="Entry Password ." required  id="pass" >
              </div>
              <div id="password_rules">
                    <h4>Passwords must meet these requirements:</h4>
                    <ul>
                        <li class="password_length">At least 8 characters</li>
                        <li class="password_uppercase">At least 1 uppercase letter</li>
                        <li class="password_number">at least one number</li>
                    </ul><br>
              </div>
            </div> -->

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>Enter Password. <span style=" color: red;"> *</span></b>
                <input type="password" name="password"  placeholder="Entry Password ." required  id="password" >
              </div>
              <div id="password_rules" style="font-size: 13px;">
                    <span> <b></b>Your password must : </b></span><br>
                    <span class="validation-message" id="uppercase-info">Include a uppercase letter</span> <br>
                    <span class="validation-message" id="lowercase-info">Include a lowercase letter</span><br>
                    <span class="validation-message" id="number-info">Include a number</span> <br>
                    <span class="validation-message" id="special-info">Include a special character</span> <br>
                    <span class="validation-message" id="length-info">Be at Least 8 character</span> <br>
                  <br>
              </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="input-checkbox">
              
              <label><input type="checkbox" required > I agree to Supply me <a href=""> Terms and Conditions</a> and <a href="">Privacy Policy</a>.</label>
              <label><input type="checkbox" > I would like to receive Supply promotional offers.</label>
            </div>
          </div>
          
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="input-wrapper search-input">
              <button class="btn btn-primary w100 " type="submit">Create Account</button>
            </div>
          </div>

         

           </div>
        </form>
      </div>
    </div>

    
     <!-- email id validation open -->
<script>
    function validateEmail(email) {
      const validationMessage = document.getElementById("validation-message");
      const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

      if (emailRegex.test(email)) {
        validationMessage.textContent = " ";
        validationMessage.style.color = "green";
        validationMessage.style.opacity = '1'; // Trigger the fade-in effect
                setTimeout(() => {
                  validationMessage.style.opacity = '0'; // Fade out after 2 seconds
                }, 2000);

      } else {
        validationMessage.textContent = "Invalid email address";
        validationMessage.style.color = "red";
      }
    }
  </script>
<!-- email id validation close -->

    
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" ></script>
  
    <script src="script.js"></script>

<script>
$(document).ready(function () {
    const passwordInput = $("#password");
    const uppercaseInfo = $("#uppercase-info");
    const lowercaseInfo = $("#lowercase-info");
    const numberInfo = $("#number-info");
    const specialInfo = $("#special-info");
    const lengthInfo = $("#length-info");
    const passwordForm = $("#passwordform");

    passwordInput.on("keyup", function () {
        validatePassword();
    });

    passwordForm.on("submit", function (event) {
        if (!validatePassword()) {
            event.preventDefault();
        }
    });

    function validatePassword() {
        const password = passwordInput.val();
        const hasUppercase = /[A-Z]/.test(password);
        const hasLowercase = /[a-z]/.test(password);
        const hasNumber = /\d/.test(password);
        const hasSpecialCharacter = /[^A-Za-z0-9]/.test(password);
        const hasMinimumLength = password.length >= 8;

        updateValidationInfo(uppercaseInfo, hasUppercase);
        updateValidationInfo(lowercaseInfo, hasLowercase);
        updateValidationInfo(numberInfo, hasNumber);
        updateValidationInfo(specialInfo, hasSpecialCharacter);
        updateValidationInfo(lengthInfo, hasMinimumLength);

        return hasUppercase && hasLowercase && hasNumber && hasSpecialCharacter && hasMinimumLength;
    }

    function updateValidationInfo(element, isValid) {
        if (isValid) {
            element.addClass("valid-message").removeClass("validation-message");
        } else {
            element.addClass("validation-message").removeClass("valid-message");
        }
    }
});
</script>
@endsection