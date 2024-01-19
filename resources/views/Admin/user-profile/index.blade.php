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

</style>
<section id="page" class="quote">
    <section class="wrapper w-100 d-flex">
        <section id="main" class="d-flex flex-column">
            <!-- navbar -->
            <div class="main-content px-md-4 px-2 py-4 mess-overflow" style="margin-top:57px">
                <!-- Welcome -->
                <div class="d-block flex-wrap gap-3 welcomeBox">
                    <div class="title pb-4 d-flex flex-column w-100 gap-2">
                        <h2 class=" position-relative">User Profile</h2>
                    </div>
                    <div class="saved-suppliers saved-suppliers-page user-profile-page">
                        <div class="row">
                            <div class="col-8 col-md-8 col-xl-8 mb-3 mb-md-0">
                                <form
                                    action="{{ route('update.user.profile', $userProfile->id) }}"  method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6 col-md-6 col-xl-6 mb-3 mb-md-0">
                                            <div class="form-input">
                                                <label>First Name</label>
                                                <input type="text" name="firstname"
                                                    value="{{ $userProfile->firstname }}" />
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-6 col-xl-6 mb-3 mb-md-0">
                                            <div class="form-input">
                                                <label>Last Name</label>
                                                <input type="text" name="lastname"
                                                    value="{{ $userProfile->lastname }}" />
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-6 col-xl-6 mb-3 mb-md-0">
                                            <div class="form-input">
                                                <label>Job Function</label>
                                                <select class="form-control" name="Jobrole_id">
                                                    @foreach($jobroles as $jobrole)
                                                    <option class="form-control" {{$jobrole->id == Auth::user()->Jobrole_id   ? 'selected'  : ' '}} value="{{$jobrole->id}}">{{$jobrole->role_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6 col-xl-6 mb-3 mb-md-0">
                                            <div class="form-input">
                                                <label> Email</label>
                                                <input type="text" name="company_email"
                                                    value="{{ !empty($userProfile->email) ? $userProfile->email : ' ' }}" readonly  />
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6 col-xl-6 mb-3 mb-md-0">
                                            <div class="form-input">
                                                <label>Mobile Phone</label>
                                                <input type="text" name="phone_number"
                                                    value="{{ !empty($userProfile->phone_number) ? $userProfile->phone_number : ' ' }}" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8 text-start">
                                            <button class="btn btn-primary px-4" type="submit">Update</button>
                                            <button class="btn btn-outline-secondary px-4 me-2">Cancel</button>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-4 col-md-4 col-xl-4 mb-3 mb-md-0">
                                <div class="user-profileR bg-light">
                                <label>Profile Photo</label>
                                    <img src="{{ URL::asset($userProfile->img_path) }}" class="mb-2">
                                  <div class="browse-btn">
                                      <label>Add Photo</label>
                                      <input type="file" name="img_path" accept="image/png, image/jpeg, image/jpg"/>
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
        <!-- back button -->

    </section>
</section>

@endsection
