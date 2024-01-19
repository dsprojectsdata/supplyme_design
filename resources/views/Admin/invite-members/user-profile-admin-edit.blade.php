@extends('Admin.layout.app')
@section('admincontent')

<link rel="stylesheet" href="{{asset('Admin/assets/dist/css/style.css')}}">

<style>
    .user-profileR {
	background: #efefef;
	padding: 15px;
	display: inline-block;
	width: 90%;
	height: 550px;
	border-radius: 10px;
	float: right;
}
</style>
<section id="page" class="quote">
    <section class="wrapper w-100 d-flex">
  
      <section id="main" class="d-flex flex-column">
        <!-- navbar -->
      
        <div class="main-content px-md-4 px-2 py-4 mess-overflow" style="margin-top:57px">
          <!-- Welcome -->
        
          <div class="d-block flex-wrap gap-3 welcomeBox"> 
            <div class="title pb-4 d-flex flex-column w-100 gap-2">
              <h2 class=" position-relative">Admin / User Profile</h2>
            </div>
            <div class="saved-suppliers saved-suppliers-page user-profile-page">
             
              <div class="row">
              <div class="col-8 col-md-8 col-xl-8 mb-3 mb-md-0">
                <form action="{{route('invites-members.admin.update', $userProfile->id)}}" method="POST" enctype="multipart/form-data">

                @csrf
                <div class="row">
                  <div class="col-6 col-md-6 col-xl-6 mb-3 mb-md-0">
                      <div class="form-input browse-photo">
                        <label>Profile Photo</label>
                        <div class="browse-btn">
                          <label>Add Photo</label>
                          <input type="file" name="img_path" />
                        </div>
                      </div>
                  </div>
                  <div class="col-6 col-md-6 col-xl-6 mb-3 mb-md-0">
                    <div class="form-input">
                      <label>First Name</label>
                      <input type="text" name="firstname" value="{{$userProfile->firstname}}"/>
                    </div>
                  </div>
  
                  <div class="col-6 col-md-6 col-xl-6 mb-3 mb-md-0">
                    <div class="form-input">
                      <label>Last Name</label>
                      <input type="text" name="lastname" value="{{$userProfile->lastname}}" />
                    </div>
                  </div>
  
                  <div class="col-6 col-md-6 col-xl-6 mb-3 mb-md-0">
                    <div class="form-input">
                      <label>Job Function</label>
                      <select class="form-control">
                        <option class="form-control">Select</option>  
                        
                      </select>
                    </div>
                  </div>
               
                  <div class="col-6 col-md-6 col-xl-6 mb-3 mb-md-0">
                    <div class="form-input">
                      <label>Company Name</label>

                      <input type="text" name="company_name" value="{{ !empty($userCompany->company_name) ? $userCompany->company_name : 'not values' }}"/>
                    </div>
                  </div>
  
                  <div class="col-6 col-md-6 col-xl-6 mb-3 mb-md-0">
                    <div class="form-input">
                      <label>Business Email</label>
                      <input type="text" name="company_email" value="{{!empty($userCompany->company_email) ? $userCompany->company_email : 'not value' }}" />
                    </div>
                  </div>
                  <div class="col-6 col-md-6 col-xl-6 mb-3 mb-md-0">
                    <div class="form-input">
                      <label>Company Website</label>
                      <input type="text" name="website" value="{{!empty($userCompany->website) ? $userCompany->website : 'not value'}}"/>
                    </div>
                  </div>
  
                  <div class="col-6 col-md-6 col-xl-6 mb-3 mb-md-0">
                    <div class="row">
                      <div class="col-7 col-md-7 col-xl-7">
                        <div class="form-input">
                          <label>Country</label>
                          
                        </div>
                      </div>
                      <div class="col-5 col-md-5 col-xl-5">
                        <div class="form-input">
                          <label>Zip Code</label>
                          <input type="text" placeholder="Zip Code" name="zipcode" value="{{!empty($userCompany->zipcode) ? $userCompany->zipcode : 'not values'}}"/>
                        </div>
                      </div>
                      
                    </div>
                  </div>
  
                  <div class="col-6 col-md-6 col-xl-6 mb-3 mb-md-0">
                    <div class="form-input">
                      <label>Mobile Phone</label>
                      <input type="text" name="phone_number" value="{{!empty($userCompany->phone_number) ? $userCompany->phone_number : 'not value'}}" /> 
                    </div>
                  </div>
  
  
                  <div class="col-12 col-md-8 text-start">
                    
                    <button class="btn btn-primary px-4" type="submit">Update</button>
                    <button class="btn btn-outline-secondary px-4 me-2">Cancel</button>
                  </div>
  
                  
                </div>
                </form>
              </div>
              
              <div class="col-4 col-md-4 col-xl-4 mb-3 mb-md-0">
            
                  <div class="user-profileR bg-light">
                    
                  <img src=" {{ URL::asset($userProfile->img_path) }}"
                                           >
                                           </div>
              </div>
             
            </div>
            </div>
          </div>
        </div>
        </div>
        </div>
        </div>
      </section>
      <!-- back button -->
      
    </section>
  </section>









@endsection
