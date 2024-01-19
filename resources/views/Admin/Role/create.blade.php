@extends('Admin.layout.app')
@section('admincontent')

<link rel="stylesheet" href="{{ asset('Admin/assets/dist/css/style.css') }}">
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
    .choices {
        margin-top: 9px;
    }

</style>
 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" />
<link href="{{asset('SuperAdmin/assets/libs/choices.js/public/assets/styles/choices.min.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('SuperAdmin/assets/js/pages/form-advanced.init.js')}}"></script>
<script src="{{asset('SuperAdmin/assets/libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>
<section id="page" class="quote">
    <section class="wrapper w-100 d-flex">
        <section id="main" class="d-flex flex-column">
            <!-- navbar -->
            <div class="main-content px-md-4 px-2 py-4 mess-overflow" style="margin-top:57px">
                <!-- Welcome -->
                <div class="d-block flex-wrap gap-3 welcomeBox">
                    <div class="title pb-4 d-flex flex-column w-100 gap-2">
                        <h2 class=" position-relative">Create Role User</h2>
                    </div>
                    <div class="saved-suppliers saved-suppliers-page user-profile-page">
                        <div class="row">
                            <div class="col-12 col-md-12 col-xl-12 mb-3 mb-md-0">
                                <form  action="{{Route('role.store')}}"  method="POST" enctype="multipart/form-data">
                                     @csrf
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-xl-12 mb-3 mb-md-0">
                                            <div class="form-input">
                                                <label>Role Name</label>
                                                <input type="text" name="role_name" value=" " required/>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12 col-xl-12 mb-3 ">
                                            <label>Permission</label>
                                                <div class="row" style=" margin-top: 20px;">
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" name="permission[]" value="RFQ Events" id="flexCheckDefault">
                                                          <label class="form-check-label" for="flexCheckDefault">
                                                               RFQ Events
                                                          </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" name="permission[]"  value="Supplier Group" id="flexCheckChecked1" >
                                                          <label class="form-check-label" for="flexCheckChecked1">
                                                               Supplier Group
                                                          </label>
                                                        </div>
                                                    </div>   
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" name="permission[]"  value="Messages" id="flexCheckChecked11" >
                                                          <label class="form-check-label" for="flexCheckChecked11">
                                                              Messages
                                                          </label>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" name="permission[]" value="Newfeed" id="flexCheckChecked2" >
                                                          <label class="form-check-label" for="flexCheckChecked2">
                                                              Newfeed
                                                          </label>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" name="permission[]" value="User" id="flexCheckChecked3" >
                                                          <label class="form-check-label" for="flexCheckChecked3">
                                                              User
                                                          </label>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox"  name="permission[]" value="Collaborators" id="flexCheckChecked4" >
                                                          <label class="form-check-label" for="flexCheckChecked4">
                                                               Collaborators
                                                          </label>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" name="permission[]" value="Company" id="flexCheckChecked5" >
                                                          <label class="form-check-label" for="flexCheckChecked5">
                                                               Company
                                                          </label>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" name="permission[]" value="Role" id="flexCheckChecked7" >
                                                          <label class="form-check-label" for="flexCheckChecked7">
                                                              Role
                                                          </label>
                                                        </div>
                                                    </div> 
                                               </div>        
                                        </div>
                                        <div class="col-12 col-md-8 text-start">
                                            <button class="btn btn-primary px-4" type="submit">Save</button>
                                            <a href="{{Route('role.index')}}" class="btn btn-outline-secondary px-4 me-2">Cancel</a>
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
            </div>
        </section>
    </section>
</section>

@endsection
