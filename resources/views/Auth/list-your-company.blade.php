@extends('Auth.layout')
@section('content')
<style>
  .select2-container--default .select2-selection--single {
    font-size: 13px;
    color: #555;
    outline: none;
    border: 1px solid #bbb;
    padding: 4px 14px;
    border-radius: 5px;
    position: relative;
    width: 100%;
    height: 40px !important; 
    background: #fff;
}

    #successMessage {
        color: green;
        display: none;
        opacity: 0; /* Set initial opacity to 0 */
        transition: opacity 2s; /* Apply a 2-second transition to opacity property */
    }

    span.tag.label.label-info {
    color: black;
    background-color: #5bc0de;
    margin-right: 2px;
    color: white;
    / display: inline; /
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

/* tags open */
.tag {
  display: inline-block;
  color: white;
  background-color:#547FF1;
  border: 1px solid #95a5a6;
  padding: 2px 8px;
  margin: 1px 2px;
  border-radius: 7px;
  white-space: nowrap;
  cursor:default;
}

.tag:hover {
  color: #FAFAFA;
  border: 1px solid #263238;
  background-color: #263238;
}

.tag.over {
  border: 1px dashed #000;
}

.tag.delete {
  background-color: #547FF1;
  border: 1px solid #547FF1;
}

.tag .remove {
  display: none;
  font-size: 12px;
  margin-left: 6px;
  margin-right: -2px;
  cursor: pointer;
}

.tag.delete .remove {
  display: inline;
}

[draggable] {
  -moz-user-select: none;
  -webkit-user-select: none;
  user-select: none;
}




input {
  max-width: 100%;
  width: 500px;
  padding: 6px 10px;
  max-width: 100%;
  font-size: 15px;
  background-color: #fff;
  border: 1px solid #95a5a6;
  border-radius: 4px;
  margin-bottom: 10px
}
/* tags close */
.form-control.is-invalid, .was-validated .form-control:invalid {
    border-color: #9f9091 !important;
    background-image: url() !important;
}

label#Company_name-error {
    position: relative;
    top: -5px;
    color: red;
    /* right: 8px; */
}
label#company_type-error {
    position: relative;
    top: 25px;
    color: red;
    /* right: 8px; */
}
label#company_email-error {
    position: relative;
    top: -5px;
    color: red;
}
label#address-error {
    position: relative;
    top: -5px;
    /* right: 20px; */
    color: red;
}
label#country-error {
    position: absolute;
    top: 86px;
    color: red;
}
label#state-error {
    position: absolute;
    top: 88px;
    color: red;
}
label#P_zipcode-error{
    position: relative;
 top: -5px;
    color: red;
}
label#mobileNumber-error{
    position: relative;
    top: -5px;
    color: red;
}

#validation-message {
    margin-top: -12px !important;
    margin-right: 80px !important;
}
</style>
    <div class="login claim-list">
      <div class="login-page">
        <div class="login-logo"><a href=""><img src="{{asset('Admin/assets/dist/images/login-logo.png')}}"></a></div>
        <h3>List Your Company</h3>
        <p>Get found on Supply me for free</p>
        <form action="{{Route('auth.company_add')}}" enctype="multipart/form-data" method="POST" id="supply-me-form">
           @csrf
           @php
                use Illuminate\Support\Facades\Session; // Make sure to import the Session facade
                $usr = 'new company';
                Session::put('newcompany',$usr); // Replace 'newcompany' with the key you want and $newcompany with the value you want to store
            @endphp
           <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>Company Name <span style=" color: red;"> *</span> </b>
                <input type="text" name="Company_name" placeholder="Company Name" class="form-control " required>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>Company Type <span style=" color: red;"> *</span></b>
                <select name="company_type"  required >
                      <option value="" disabled selected>Select Company Type</option>
                      @foreach($companytypes as $companytype)
                        <option value="{{$companytype->type_name}}">{{$companytype->type_name}}</option>
                      @endforeach
                </select>
              </div>
            </div>
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>Company Email<span style=" color: red;"> *</span></b>
                <input type="email" name="company_email" placeholder="Company Email" class="form-control " required >
                <p id="validation-message"></p>
                   @error('company_email')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
              </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>Address Line 1 <span style=" color: red;"> *</span></b>
               <input name="address" placeholder="Enter Address" class="form-control " required></input>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>Address Line 2</b>
                <input name="address2" placeholder="Enter Address" class="form-control " ></input>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>Country Name <span style=" color: red;"> *</span></b>
                <select class="js-example-basic-single position" name="country_id" id="country" required>
                    <option value="" disabled selected>Select </option>
                  @foreach($countries as $countrie)
                    <option value="{{$countrie->id}}" data-country-code="{{$countrie->phonecode}}">{{$countrie->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>State Name <span style=" color: red;"> *</span></b>
                <select class="js-example-basic-single position" name="state_id" id="state" required>

                </select>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>City Name <span style=" color: red;"> *</span></b>
                 <select class="js-example-basic-single position" name="city_id" id="city" >
                  
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>Zip Code <span style=" color: red;"> *</span></b>
                <input type="text" name="P_zipcode" placeholder="Zip Code"  class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)" required>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>Country Code<span style=" color: red;"> *</span></b>
                   <select class="js-example-basic-single position" name="country_code" id="country_code">
                        <option>Select </option>
                      @foreach($countries as $countrie)
                        <option value="{{$countrie->id}}">+ {{$countrie->phonecode}}</option>
                      @endforeach
                    </select>
              </div>
            </div>
             <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                  <div class="input-wrapper">
                    <b>Phone Number <span style=" color: red;"> *</span></b>
                    <input type="text" name="Phone_number" placeholder="Phone Number"  id="mobileNumber"   class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15)" required>
                    <span id="validationResult"></span>   
                    <p id="warningMessage" style="color: red; display: none;">Mobile number must have 10 digits</p>
                    <p id="successMessage" style="color: green; display: none;">Mobile number is complete!</p>
    
                    @error('Phone_number')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                  </div>
            </div>

            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>Website </b>
                <input type="text" name="Website"  placeholder="Website" class="form-control " >
              </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="input-wrapper">
                <b>Product & Service Categories <span style=" color: red;"> *</span></b> <br>
                <span id="form">
                <input id="tagArray" name="company_category[]" type="hidden" />
                <input id="transientTagField"  type="text" pattern="^([a-zA-Z0-9\.\-+]{2,20},?)+$" title="Min: 2 Chars and only [a-z,+,-,.]" placeholder="e.g. Valves, Pumps, Cleaning Security etc."/>
                <div id="tagContainer" class="inline"></div>  

                  </span>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="input-wrapper search-input">
              <button class="btn btn-primary w100">Continue</button>
            </div>
          </div>
           </div>
            <span class="signup-text text-center mt-0">Already listed on Supply me?  <a href="{{route('auth.claim_your_company')}}">Claim Your Company</a></span>
        </form>
      </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" ></script>
<script>
 $(document).on('change','#country', function() {
        var country =  $("#country").val();
         var selectedCountryCode = $("#country option:selected").data("country-code");
            $("#country_code").empty(); 
            $("#country_code").append($("<option></option>")
                .attr("value", selectedCountryCode)
                .text(selectedCountryCode));
        console.log('country',country);
        var url ="{{Route('auth.SearchState')}}";
          $.ajax({
              url: url, 
              method:"GET",
              data:{'country':country},
              success: function(result){
                  console.log(result);
                  $("#state").html(result);
              }
          });
     })

  $(document).on('change','#state', function() {
    var state =  $("#state").val();
    var url ="{{Route('auth.SearchCity')}}";
      $.ajax({
          url: url, 
          method:"GET",
          data:{'state':state},
          success: function(result){
              $("#city").html(result);
          }
      });
  })
</script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(".position").select2({
  allowClear:true,
  placeholder: 'Select'
});
</script>

<!-- email id validation open -->
<script>
   function validateEmail(email) {
      const validationMessage = document.getElementById("validation-message");
      const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    
      if (emailRegex.test(email)) {
        validationMessage.textContent = "  ";
        validationMessage.style.color = "green";
        validationMessage.style.opacity = '1'; 
    
        // Fade out after 2 seconds
        setTimeout(() => {
          validationMessage.style.opacity = '0';
        }, 2000);
      } else {
        validationMessage.textContent = "Invalid email address";
        validationMessage.style.color = "red";
      }
    }

  </script>
<!-- email id validation close -->


<script>
        function validateMobileNumber() {
            const mobileNumberInput = document.getElementById('mobileNumber');
            const warningMessage = document.getElementById('warningMessage');
            const successMessage = document.getElementById('successMessage');
            const mobileNumber = mobileNumberInput.value;

            // Remove all non-digit characters from the input
            const cleanedNumber = mobileNumber.replace(/\D/g, '');

            if (cleanedNumber.length < 10 || cleanedNumber.length > 12) {
                // If the cleaned number has less than 10 digits, show the warning message and hide success message
                warningMessage.style.display = 'block';
                successMessage.style.display = 'none';
                successMessage.style.opacity = '0'; // Reset opacity when hiding
                mobileNumberInput.removeAttribute('maxlength');
            } else if (cleanedNumber.length === 10) {
                // If the cleaned number has 10 digits, show the success message and hide warning message
                warningMessage.style.display = 'none';
                successMessage.style.display = 'block';
                successMessage.style.opacity = '1'; // Trigger the fade-in effect
                setTimeout(() => {
                    successMessage.style.opacity = '0'; // Fade out after 2 seconds
                }, 2000);
                mobileNumberInput.setAttribute('maxlength', '10');
            }
        }
    </script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js" ></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" />

<script>
  $(document).ready(function(){
      $('#tags_input').tagsInput();
  });
</script>


<!-- tags down open -->
<script>
    /*
    Basic form
*/
var disableSubmit = false

document.getElementById("form").addEventListener("submit", function(e) {
  if (disableSubmit) {
    e.preventDefault()
    disableSubmit = false
    return false
  }

  // rest of send stuff

});

/*
  Tag script
*/
$(document).ready(function () {
            'use-strict';

            var $toView = $('#tagContainer');
            var $toServer = $('#tagArray');
            var $transientTagField = $('#transientTagField');
            var $validate = $('#validate');
            var dragSrcEl = null;
            var tags = [];

            function input(ignoreComma) {
                if (!/^([a-zA-Z0-9\.\-+]{2,20},?)+$/g.test($transientTagField.val())) {
                    disableSubmit = true;
                    if (typeof $transientTagField[0].willValidate !== 'undefined') $validate.click();
                    else alert('Min: 2 Chars and [a-z,+,-] (and update your goddamn browser)');
                    return;
                }

                if ($transientTagField.val().indexOf(',') !== -1 || ignoreComma) {
                    if ($transientTagField.val().slice(-1) === ',') $transientTagField.val($transientTagField.val().slice(0, -1));

                    var newTags = $transientTagField.val().split(',');
                    for (var i = 0; i < newTags.length; i++) {
                        if (tags.indexOf(newTags[i]) === -1) tags.push(newTags[i]);
                    }

                    $transientTagField.val('');
                    render();
                }
            }

            $transientTagField.on('input', function () {
                input.call(this, false);
            });

            $transientTagField.on('keypress', function (e) {
                if (e.keyCode === 13) {
                    e.preventDefault();
                    input.call(this, true);
                }
            });

            function render() {
                $toView.empty(); // Clear the container
                for (var i = 0; i < tags.length; i++) {
                    appendNewTag(tags[i]);
                }
                $toServer.val(tags.join(','));
            }

            function toggleRemoveTag() {
                if (!$(this).hasClass('delete')) $(this).addClass('delete');
                else $(this).removeClass('delete');
            }

            function removeTag() {
                var tagValue = $(this).parent().contents().eq(0).text();
                tags.splice(tags.indexOf(tagValue), 1);
                render();
            }

            // Drag and drop
            function handleDragStart(e) {
                $(this).css('opacity', '0.4');
                dragSrcEl = this;

                e.originalEvent.dataTransfer.effectAllowed = 'move';
            }

            function handleDragEnter(e) {
                $(this).addClass('over');
            }

            function handleDragLeave(e) {
                $(this).removeClass('over');
            }

            function handleDragEnd(e) {
                $(this).css('opacity', '1');
            }

            function handleDragOver(e) {
                if (e.preventDefault) e.preventDefault();
                e.originalEvent.dataTransfer.dropEffect = 'move';
            }

            function handleDrop(e) {
                if (e.stopPropagation) e.stopPropagation();

                if (dragSrcEl !== this) {
                    var indexTwo = tags.indexOf($(this).contents().eq(0).text());
                    tags[tags.indexOf($(dragSrcEl).contents().eq(0).text())] = $(this).contents().eq(0).text();
                    tags[indexTwo] = $(dragSrcEl).contents().eq(0).text();
                    render();
                }

                $(this).removeClass('over');
            }

            function appendNewTag(name) {
                var $para = $('<span>', {
                    'class': 'tag delete',
                    'draggable': true,
                    'text': name
                });

                var $remove = $('<span>', {
                    'class': 'remove',
                    'text': '✖'
                });

                $remove.on('click', removeTag);
                $para.append($remove);

                $para.on('click', toggleRemoveTag)
                    .on('dragstart', handleDragStart)
                    .on('dragenter', handleDragEnter)
                    .on('dragleave', handleDragLeave)
                    .on('dragover', handleDragOver)
                    .on('dragend', handleDragEnd)
                    .on('drop', handleDrop);

                $toView.append($para);
            }

            // Init
            if ($toServer.val() && $toServer.val().length > 0) {
                var newTags = $toServer.val().split(',');
                for (var i = 0; i < newTags.length; i++) {
                    if (tags.indexOf(newTags[i]) === -1) tags.push(newTags[i]);
                }
                render();
            }
        });
</script>
<!-- tags down close -->







@endsection