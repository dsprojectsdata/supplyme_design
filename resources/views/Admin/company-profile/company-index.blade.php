@extends('Admin.layout.app')
@section('admincontent')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" />
<style>
    span.tag.label.label-info {
        color: black;
        background-color: #5bc0de;
        margin-right: 2px;
        color: white;
        display: inline;
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


    .searchResults {
        background-color: #fff;
        border: 1px solid #dfe6ec;
        box-shadow: 0 0.125rem 0.375rem rgb(0 0 0 / 10%);
        z-index: 10;
    }

    .searchResults__list {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .cyc-searchResultsCTA {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        box-shadow: 0 -0.25rem 0.25rem rgb(0 0 0 / 5%);
        border-top: 1px solid #dfe6ec;
        border-bottom: 1px solid #dfe6ec;
    }

    .searchResults__list {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .cyc-searchResultsItem {
        align-items: center;
        background-color: #fff;
        display: flex;
        flex-wrap: nowrap;
        list-style-type: none;
        padding: 0.75rem;
        position: relative;
    }

    .cyc-searchResultsItem__logo {
        border-radius: 50%;
        height: 100%;
        margin-right: 0.5rem;
        max-height: 3.125rem;
        max-width: 3.125rem;
        width: 100%;
    }

    .cyc-searchResultsItem__titleWrapper {
        flex-grow: 1;
    }

    .cyc-searchResultsItem__title {
        margin-top: 0;
        margin-bottom: 0;
    }

    .cyc-searchResultsItem__subTitle {
        color: #616668;
        margin-top: 0;
        margin-bottom: 0;
    }

    .btn-sm {
        padding: 0.5rem;
        font-size: .875rem;
        line-height: 1;
        border-radius: 0.2rem;
    }

    .cyc-searchResultsItem__claimed {
        color: #a4acb3;
    }

    .icon {
        display: inline-block;
        width: 1em;
        height: 1em;
        vertical-align: -0.125em;
        fill: currentColor;
    }

    .cyc-searchResultsCTA {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        box-shadow: 0 -0.25rem 0.25rem rgb(0 0 0 / 5%);
        border-top: 1px solid #dfe6ec;
        border-bottom: 1px solid #dfe6ec;
    }

    .login-page {
        max-width: 450px;
        width: 95%;
        background: #fff;
        padding: 50px;
        border-radius: 10px;
        max-height: calc(100vh - 50px);
    }

    #mainbrand {
        width: 400px;
        height: 50px;

        display: flex;
    }

    #mainbrand div {

        flex: 1;
    }

    .company-offering-radios .form-check .form-check-input{
        height: 20px;
        width: 20px;
        padding: 0;
        margin-right: 4px
    }

    .company-offering-radios .form-check label{
        line-height: 28px;
        font-size: 14px;
    }
</style>
@push('custom-style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
@endpush
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="main-content px-md-4 px-2 py-4" style="margin-top:57px">
    <!-- Welcome -->
    <div class="d-block flex-wrap gap-3 welcomeBox">
        <div class="title pb-4 d-flex flex-column w-100 gap-2">
            <h2 class=" position-relative"> Your company Profile
                <!-- <span> <a href="{{route('company.profile')}}" class="btn btn-primary">view company profile</a> </span>   </h2> -->
                <div class="d-md-flex justify-content-between">
                    <p class="pb-2">Complete all necessary steps to your Company Profile </p>
                </div>
        </div>
        <form action="{{route('company.profile.create')}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 col-md-5 col-xl-3 mb-3 mb-md-0">
                    <div class="border bg-white compnay-tabs-ul" style="border-color:#B4B6BD;">
                        <ul class="d-flex flex-column nav nav-tabs listing nav-RFQ" id="nav-tabs" role="tablist">
                            <li><a id="nav-Company-profile-tab" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-Company-profile" type="button" role="tab" aria-controls="nav-Company-profile" aria-selected="true" href="#" class=" nav-link active py-3 px-4 d-block position-relative"><span class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">1
                                    </span>Company profile</a></li>

                            <li><a id="nav-company-location-tab" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-company-location" type="button" role="tab" aria-controls="nav-company-location" aria-selected="false" href="#" class="nav-link py-3 px-4 d-block position-relative"><span class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">2</span>
                                    Company Location</a>
                            </li>

                            <li><a id="nav-add-Organisational-tab" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-add" type="button" role="tab" aria-controls="nav-add" aria-selected="false" href="#" class="nav-link py-3 px-4 d-block position-relative"><span class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">3</span>
                                    Organisational Structure</a>
                            </li>

                            <li><a id="nav-Product-tab" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-Product" type="button" role="tab" aria-controls="nav-Product" aria-selected="false" href="#" class="nav-link py-3 px-4 d-block position-relative"><span class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">4</span>
                                    Product and Sevices</a>
                            </li>

                            <li><a id="nav-customer-tab" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-customer" type="button" role="tab" aria-controls="nav-customer" aria-selected="false" href="#" class="nav-link py-3 px-4 d-block position-relative"><span class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">5</span>
                                    Customers</a>
                            </li>

                            <li><a id="nav-useful-information-tab" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-useful-information" type="button" role="tab" aria-controls="nav-useful-information" aria-selected="false" href="#" class="nav-link py-3 px-4 d-block position-relative"><span class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">6</span>
                                    Useful Information</a>
                            </li>

                            <li><a id="nav-useful-links-tab" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-useful-links" type="button" role="tab" aria-controls="nav-useful-links" aria-selected="false" href="#" class="nav-link py-3 px-4 d-block position-relative"><span class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">7</span>
                                    Useful Links</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-md-7 col-xl-9 ">
                    <div class="border bg-white p-3 px-sm-4 py-sm-4 tab-content" id="nav-tabContent" style="border-color:#B4B6BD;">

                        <div class="tab-pane fade show active" id="nav-Company-profile" role="tabpanel" aria-labelledby="nav-Company-profile-tab">
                            <div class="d-flex flex-column pb-4">
                                <h2 class="pb-2">Company Profile</h2>
                            </div>
                            <div class="accordion accordion-flush">
                                <div class="row gap-3 gap-xl-0">
                                    <div class="row gap-3 gap-xl-0">

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b>Company Name</b>
                                                <input type="text" placeholder="Brands Name" name="new_company_name" value="{{ !empty($company->company_name) ? $company->company_name : 'not found' }}" />
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b>Company Logo</b>

                                                <div class="form-group" x-data="fileUploadComponent('company_logo','company-logo-preview')">
                                                    <div class="input-group">
                                                        <input type="file" x-ref="file" @change="displayImage" name="company_logo" class="d-none">
                                                        <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileName">
                                                        <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                                                    </div>
                                                    <div class="addded-team company-logo-preview company_lgo mt-1" style="display: none;">
                                                        <span>
                                                            <img x-bind:src="imagePreview" alt="Selected Image" onerror="img_onError(this)">
                                                        </span>
                                                        <div>
                                                            <strong>FileName:</strong><small x-text="fileName"></small>
                                                        </div>
                                                    </div>
                                                    <!-- company logo open -->
                                                    @if(!empty($ompanyProfile))
                                                    <div class="addded-team company_lgo company_logo mt-1" data-companylogoContainer-id="{{ $ompanyProfile->id }}">
                                                        <a href="{{route('company.logo.delete',$ompanyProfile->id)}}" class="close-icon companylgo-link" data-id="{{ $ompanyProfile->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                                        <span>
                                                            <img src="{{ asset($ompanyProfile->company_logo ??'') }}" onerror="img_onError(this)">
                                                        </span>
                                                        <div>
                                                            <strong>FileName:</strong><small>{{ pathinfo($ompanyProfile->company_logo, PATHINFO_BASENAME) }}</small>
                                                            <br>
                                                            <a href="{{ asset($ompanyProfile->company_logo) }}" download>Download</a>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <!-- company logo close -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b>Type of Company</b>
                                                <select aria-label="Default select example" name="type_of_company">
                                                    <option value="">Select</option>
                                                    @foreach($typesOfCompany as $typCmpny)
                                                    <option {{$typCmpny->type_name == $company->company_type ? 'selected' : '' }} data-typeofcompany_id="{{$typCmpny->id}}" value="{{$typCmpny->type_name}}" > {{$typCmpny->type_name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b>Company Offering</b>
                                                <div class="company-offering-radios">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="company_offering" @if(($ompanyProfile->type_of_offering ?? '' ) =='product') checked @endif value="product" id="co_product">
                                                        <label class="form-check-label" for="co_product">Product</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="company_offering" @if(($ompanyProfile->type_of_offering ?? '' ) =='service') checked @endif value="service" id="co_service">
                                                        <label class="form-check-label" for="co_service">Service</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="company_offering" @if(($ompanyProfile->type_of_offering ?? '' ) =='product_and_service') checked @endif value="product_and_service" id="co_product_and_service">
                                                        <label class="form-check-label" for="co_product_and_service">Product and Service</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b>Certification</b>
                                                <select class="js-select2" aria-label="Default select example" name="certificate[]" multiple>
                                                    <option value="">Select</option>
                                                    @foreach($companyCertification as $certification)
                                                    <option value="{{$certification->id}}" @if (in_array($certification->id, explode(",", $ompanyProfile->certificate ?? ''))) selected @endif>{{$certification->certification}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b>Industry</b>
                                                <select aria-label="Default select example" name="industry">
                                                    <option selected>Select</option>
                                                    @foreach($companyIndustry as $industry)
                                                    <option value="{{$industry->id}}" @if (($ompanyProfile->industry ?? '') == $industry->id) selected @endif>{{$industry->industry}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="row gap-3 gap-xl-0 mt-2" id="accordion-body-Exchange">
                                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                <div class="input-wrapper">
                                                    <b>Started In</b>
                                                    <input type="date" placeholder="Started In" name="started_in" value="{{$ompanyProfile->started_in??''}}"  max="{{ date('Y-m-d') }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                <div class="input-wrapper">
                                                    <b>Number of Employee</b>
                                                    <input type="number" placeholder="Number Of employee" name="number_of_employee" value="{{$ompanyProfile->number_of_employee??''}}" id="employeeInput12"  max="1000000" />
                                                </div>
                                            </div>

                                            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                <div class="input-wrapper">
                                                    <b> About Company </b>
                                                    <textarea name="about_company" value="{{$ompanyProfile->about_company??''}}">{{$ompanyProfile->about_company??''}}</textarea>
                                                </div>
                                            </div>
                                            <!-- input text -->
                                        </div>
                                        <!-- close -->
                                        
                                        <div class="col-12"  >
                                            <div id="accordion-body-companyProfile" >
                                                <div class="row" style="border: 1px #c7d7d9 solid; padding: 22px;">
                                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                        <div class="input-wrapper">
                                                            <b>Brand Name</b>
                                                            <input type="text" placeholder="Brands Name" name="brand_name[]" />
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                        <div class="input-wrapper">
                                                            <b>Brands Logo</b>
                                                            <div class="form-group  mt-1" x-data="fileUploadComponent('null','brand-logo-preview')">
                                                                <div class="input-group">
                                                                    <input type="file" x-ref="file" @change="displayImage" name="brand_logo[]" class="d-none">
                                                                    <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileName">
                                                                    <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                                                                </div>
                                                                 <div class="addded-team brand-logo-preview mt-1" style="display: none;">
                                                                    <span>
                                                                        <img x-bind:src="imagePreview" alt="Selected Image" onerror="img_onError(this)">
                                                                    </span>
                                                                    <div>
                                                                        <strong>FileName:</strong><small x-text="fileName"></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                        <div class="input-wrapper">
                                                            <b>Brand Website</b>
                                                            <input type="text" class="mt-1" placeholder="Brand Website" name="brand_website[]" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                         <div class="input-wrapper">
                                                            <a class="btn btn-outline-primary add-icon" type id="add-brandName" style=" position: relative; right: -65px; top: 35px;"> + Add Brand Name</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            @foreach($brandWebsitesLogo as $brand)
                                            <div class="row mt-1">
                                                <div class="addded-team company_brand_lgo" data-brandContainer-id="{{ $brand->id }}">
                                                    <a href="{{route('brnad.logo.delete',$brand->id)}}" class="close-icon companyBrandlgo-link" data-id="{{ $brand->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}" onerror="img_onError(this)"></a>
                                                    <span><img src="{{ asset($brand->brand_logo) }}" onerror="img_onError(this)"></span>
                                                    <div class="addded-iner">
                                                        <h2 id="member-name">{{$brand->brand_name}}</h2>
                                                        <label class="addded-text">
                                                            <b>Website  - <em id="member-position">{{$brand->brand_website}}</em></b>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div> 
                                        <div class="clearfix"></div>
                                        
                                        <div class="row my-4">
                                            <button class="btn btn-primary col-sm-4" type="submit" style="position: relative;left: 77%;width: 19%;">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ############### Company Location ########################-->
                        <div class="tab-pane fade" id="nav-company-location" role="tabpanel" aria-labelledby="nav-company-location-tab">
                            <div class="d-flex flex-column pb-3">
                                <h2 class="pb-2">2. Company Location </h2>
                                <p>A short description about the Product Details required.</p>
                            </div>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item border mb-3">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed d-flex gap-3" style="background:#EAEFF0;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Reg.Address 
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">

                                            <div class="row gap-3 gap-xl-0">
                                                <div class="row gap-3 gap-xl-0" id="body-addAnotherAddress"  style=" border: 1px #cbd9d9 solid; padding: 7px;  margin: 0px;">
                                                    <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                        <div class="input-wrapper">
                                                            <b>Address</b>
                                                            <textarea name="reg_office_address[]"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                        <div class="input-wrapper">
                                                            <b>Country</b>
                                                            <select id="country" class="country_1" name="company_location_country_id[]" data-country_id="1">
                                                                <option>Select</option>
                                                                @foreach($countries as $key=>$country)
                                                                <option value="{{$country->id}}">{{$country->name}} ({{$country->emoji}})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                        <div class="input-wrapper">
                                                            <b>State</b>
                                                            <select id="state_1" class="state" name="company_location_state_id[]" data-state_id="1">
                                                                <option selected>Select</option>
                                                            </select>

                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                        <div class="input-wrapper">
                                                            <b>City</b>
                                                            <select id="city_1" name="company_city_id[]">
                                                                <option selected>Select</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                        <div class="input-wrapper">
                                                            <b>ZIP Code</b>
                                                            <input type="number" name="company_zipcode[]" />
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">

                                                    <div class="col-12 col-xl-12 mb-0 mb-xl-3 mt-1">
                                                        <a class="btn btn-outline-primary add-icon" id="addAnotherAddress"> + Add Another Address </a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">

                                                        <!-- reg address view open -->
                                                        @foreach($companyRegAddress as $regAddress)
                                                        <div class="addded-team mt-1 company_location" data-companyLocation_container-id="{{ $regAddress->id }}">
                                                            <a href="{{route('company_location.delete', $regAddress->id)}}" class="close-icon companyLocation-link" data-id="{{ $regAddress->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>

                                                            <span><img src="{{ asset('Admin/assets/dist/images/location-icon.svg') }}" onerror="img_onError(this)"></span>
                                                            <div class="addded-iner">
                                                                <h2 id="member-name"> Address {{$regAddress->address}}</h2>
                                                                <label class="addded-text">
                                                                    <b>Country Name - <em id="member-position">{{$regAddress->company_location_country}}</em></b>
                                                                    <b>State Name - <em id="member-position">{{$regAddress->company_location_state}}</em></b>
                                                                    <b>City Name - <em id="member-position">{{$regAddress->company_location_city}}</em></b>
                                                                    <b>Zip Code - <em id="member-position">{{$regAddress->zipcode}}</em></b>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <!-- reg address view close -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Primary Contact Information -->
                                <div class="accordion-item border mb-3">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" style="background:#EAEFF0;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Primary Contact Information
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row gap-3 gap-xl-0">
                                                <div class="col-12">
                                                    <div class="row gap-3 gap-xl-0" id="LocationAfterBody"  style=" border: 1px #c3d5d5 solid;padding: 11px;">
                                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                            <div class="input-wrapper">
                                                                <b>Select your designation</b>
                                                                <select name="purpose[]">
                                                                    @foreach($Jobrole as $Job)
                                                                        <option value="">Select your designation</option>
                                                                        <option value="{{$Job->role_name}}">{{$Job->role_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                            <div class="input-wrapper">
                                                                <b>Name</b>
                                                                <input type="text" placeholder="Name" name="primary_name[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                            <div class="input-wrapper">
                                                                <b>Email</b>
                                                                <input type="email" placeholder="email" name="primary_email[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                            <div class="input-wrapper">
                                                                <b>Contact Number</b>
                                                                    <input type="number" id="phone-country-number" name="contact_number[]"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3 mt-3">
                                                    <a class="btn btn-outline-primary add-icon" id="addAnotherPrimaryInfo"> + Add Another Address </a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-12">
                                                        <!-- reg address view open -->
                                                        @foreach($companyPrimaryContacts as $companyPrimaryContact)
                                                            @if($companyPrimaryContact)
                                                                <div class="addded-team mt-1 company_location" >
                                                                    <a href="{{route('customer.company_primary.delete', $companyPrimaryContact->id)}}" class="close-icon companyLocation-link" data-id="{{ $companyPrimaryContact->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                                                    <span><img src="{{ asset('Admin/assets/dist/images/location-icon.svg') }}" onerror="img_onError(this)"></span>
                                                                    <div class="addded-iner">
                                                                        <h2 id="member-name">  {{$companyPrimaryContact->name}}</h2>
                                                                        <label class="addded-text">
                                                                            <b>Email - <em id="member-position">{{$companyPrimaryContact->email}}</em></b>
                                                                            <b>Contact No - <em id="member-position">{{$companyPrimaryContact->contact_no}}</em></b>
                                                                            <b>Designation - <em id="member-position">{{$companyPrimaryContact->designation}}</em></b>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endif    
                                                        @endforeach
                                                    </div>
                                                    <!-- reg address view close -->
                                                </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item border mb-3">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" style="background:#EAEFF0;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Mailing Address
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>Is Mailing Address different from Reg. Office Address</b>
                                                        <div class="radio-custme">
                                                            <div class="radio-custme-in">
                                                                <input class="different-mailing" type="radio" value="yes" id="different-mailing-1" name="different_mailing" @if($ompanyProfile->usfl_info_address ?? 0) checked @endif>
                                                                <label for="different-mailing-1">Yes</label>
                                                            </div>
                                                            <div class="radio-custme-in">
                                                                <input class="different-mailing" type="radio" value="no" id="different-mailing-2" name="different_mailing" @if(!($ompanyProfile->usfl_info_address ?? 0)) checked @endif>
                                                                <label for="different-mailing-2">No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mailing-address-section" @if(!($ompanyProfile->usfl_info_address ?? 0)) style="display: none;" @endif>
                                                    <div class="col-12">
                                                        <div class="row">

                                                            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                                <div class="input-wrapper">
                                                                    <b>Address</b>
                                                                    <textarea name="mailing_address">{{$ompanyProfile->usfl_info_address??''}}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                                <div class="input-wrapper">
                                                                    <b>Country</b>
                                                                    <select id="country" class="country_10" name="mailing_country_id" data-country_id="10">
                                                                        <option>Select</option>
                                                                        @foreach($countries as $countrie)
                                                                        <option value="{{$countrie->id}}" class="form-control" @if($countrie->id== ($ompanyProfile->usfl_info_country_id ?? '')) selected @endif> {{$countrie->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                                <div class="input-wrapper">
                                                                    <b>State</b>
                                                                    <select id="state_10" class="state" name="mailing_state_id" data-state_id="10">
                                                                        <option selected>Select</option>
                                                                    </select>

                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                                <div class="input-wrapper">
                                                                    <b>City</b>
                                                                    <select id="city_10" name="mailing_city_id">
                                                                        <option selected>Select</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                                <div class="input-wrapper">
                                                                    <b>ZIP Code</b>
                                                                    <input type="number" placeholder="zip code" name="mailing_zipcode" value="{{$ompanyProfile->usfl_info_zipcode ?? ''}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Geographical Presence open -->
                                <div class="accordion-item border mb-3">
                                    <h2 class="accordion-header" id="heading10">
                                        <button class="accordion-button collapsed" style="background:#EAEFF0;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwoten" aria-expanded="false" aria-controls="collapseTwoten">
                                            Geographical Presence
                                        </button>
                                    </h2>
                                    <div id="collapseTwoten" class="accordion-collapse collapse" aria-labelledby="heading10" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row" id="LocationAfterBody">
                                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>Country Name</b>
                                                        <select name="country_id" id="">
                                                            @foreach($countries as $key=>$country)
                                                            <option value="{{$country->id}}" @if(($ompanyProfile->country_id ?? 0) == $country->id) selected @endif>{{$country->name}} ({{$country->emoji}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Geographical Presence close -->


                            </div>
                            <div class="row my-4">
                                <button class="btn btn-primary col-sm-4" type="submit" style="position: relative;left: 77%;width: 19%;">Save</button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-add" role="tabpanel" aria-labelledby="nav-add-tab">
                            <div class="d-flex flex-column pb-4">
                                <h2 class="pb-2">Organisational Structure</h2>
                            </div>
                            <div class="row organisational_structure" style="border: 1px #cdd8db solid; padding: 4px; margin: 0px; ">
                                <div class="row">
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Profile / Positions</b>
                                            <select aria-label="Default select example" name="profile_positions">
                                                <option selected>Select</option>

                                                @foreach($companyProfilePositions as $profile_position)
                                                @if(!empty($ompanyProfile))
                                                <option value="{{$profile_position->id}}" @if ($ompanyProfile->profile_positions == $profile_position->id) selected @endif>{{$profile_position->profile_position}}</option>
                                                @else
                                                <option value="{{$profile_position->id}}">{{$profile_position->profile_position}}</option>
                                                @endif
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Name</b>
                                            <input type="text" placeholder="Enter Name" name="organisational_structre_name" value="{{$ompanyProfile->organisational_structre_name ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Email</b>
                                            <input type="email" placeholder="Enter Name" name="organisational_structre_email" value="{{$ompanyProfile->organisational_structre_email ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Images</b>
                                            <div class="form-group" x-data="fileUploadComponent('organisationalstructreBody','organisational-logo-preview')">
                                                <div class="input-group">
                                                    <input type="file" x-ref="file" @change="displayImage" name="Organisational_image" class="d-none">
                                                    <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileName">
                                                    <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                                                </div>
                                                <div class="addded-team mt-1 organisational-logo-preview" style="display: none;">
                                                    <span>
                                                        <img x-bind:src="imagePreview" alt="Selected Image" onerror="img_onError(this)">
                                                    </span>
                                                    <div>
                                                        <strong>FileName:</strong><small x-text="fileName"></small>
                                                    </div>

                                                </div>
                                                <!-- company logo open -->
                                                @if(!empty($ompanyProfile))
                                                <div class="addded-team mt-1 organisationalstructreBody" data-organisational-container-id="{{ $ompanyProfile->id }}">
                                                    <a href="{{route('organisational_structre.delete', $ompanyProfile->id)}}" class="close-icon organisational-link" data-id="{{ $ompanyProfile->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                                    <span><img src="{{ asset($ompanyProfile->Organisational_image) }}" onerror="img_onError(this)"></span>
                                                    <div>
                                                        <strong>FileName:</strong><small>{{ pathinfo($ompanyProfile->Organisational_image, PATHINFO_BASENAME) }}</small>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="addded-team mt-1 organisationalstructreBody" data-organisational-container-id="">
                                                    <a href="" class="close-icon organisational-link" data-id=""><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}" onerror="img_onError(this)"></a>
                                                    <span><img src=""></span>
                                                </div>
                                                @endif
                                                <!-- company logo close -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="row">-->
                            <!--    <div class="col-12 col-xl-12 mb-0 mb-xl-3 mt-1">-->
                            <!--        <a class="btn btn-outline-primary add-icon" id="addorganisational"> + Add Organisational Structure </a>-->
                            <!--    </div>-->
                            <!--</div>-->
                             <div class="row my-4">
                                <button class="btn btn-primary col-sm-4" type="submit" style="position: relative;left: 77%;width: 19%;">Save</button>
                            </div>
                            
                        </div>
                        <div class="tab-pane fade" id="nav-Product" role="tabpanel" aria-labelledby="nav-Product-tab">
                            <div class="d-flex flex-column pb-4">
                                <h2 class="pb-2">Product and Service</h2>

                            </div>
                            <!--Product and Service  open -->

                            <div class="row gap-3 gap-xl-0" >
                                <div class="row" id="body-addProdcutAndService">
                                    <div class="col-6 col-xl-6 mb-0 mb-xl-3 mt-3 ">
                                        <div class="input-wrapper">
                                            <b>Add Product Catalog</b>
                                            <div class="form-group" x-data="fileUploadComponent('product_catalog','add_product_catalog-logo-preview')">
                                                <div class="input-group">
                                                    <input type="file" x-ref="file" @change="displayImage" name="add_product_catalog" class="d-none">
                                                    <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileName">
                                                    <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                                                </div>
                                                <div class="addded-team mt-1 add_product_catalog-logo-preview" style="display: none;">
                                                    <span>
                                                        <img x-bind:src="imagePreview" alt="Selected Image" onerror="img_onError(this)">
                                                    </span>
                                                    <div>
                                                         <strong>FileName:</strong><small x-text="fileName"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- prodcut and service add_product_catalog open -->
                                        @if (!empty($ompanyProfile) && $ompanyProfile->add_product_catalog)
                                            <div class="addded-team mt-1 productCatlog-address product_catalog" data-product-Container-id="{{ $ompanyProfile->id }}">
                                                <a href="{{ route('product_catelog.delete', $ompanyProfile->id) }}" class="close-icon delete-product-link" data-id="{{ $ompanyProfile->id }}">
                                                    <img src="{{ asset('Admin/assets/dist/images/trash-icon1.svg') }}" onerror="img_onError(this)">
                                                </a>
                                                <span>
                                                    <img src="{{ asset($ompanyProfile->add_product_catalog) }}" onerror="img_onError(this)">
                                                    <a style=" position: absolute;" href="{{ asset($ompanyProfile->add_product_catalog) }}" download>Download</a>
                                                    <br>
                                                </span>
                                            </div>
                                        @endif
                                        <!-- prodcut and service add_product_catalog close -->
                                    </div>
                                    <div class="col-6 col-xl-6 mb-0 mb-xl-3 mt-3">
                                        <div class="input-wrapper">
                                            <b>Add Company Brochure</b>
                                            <div class="form-group" x-data="fileUploadComponent('add_company_brochure','add_company_brochure-logo-preview')">
                                                <div class="input-group">
                                                    <input type="file" x-ref="file" @change="displayImage" name="add_company_brochure" class="d-none">
                                                    <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileName">
                                                    <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                                                </div>
                                                <div class="add_company_brochure-logo-preview" >
                                                </div>
                                                <div class="addded-team mt-1 add_company_brochure-logo-preview" style="display: none;">
                                                    <span>
                                                        <img x-bind:src="imagePreview" alt="Selected Image" onerror="img_onError(this)">
                                                    </span>
                                                    <div>
                                                         <strong>FileName:</strong><small x-text="fileName"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- prodcut and service add_company_brochure open -->
                                        @if (!empty($ompanyProfile) && $ompanyProfile->add_company_brochure)
                                        <div class="addded-team mt-1 productCatlog-address add_company_brochure" data-product-Container-id="{{ $ompanyProfile->id }}">
                                            <a href="{{route('company.brochure.delete', $ompanyProfile->id)}}" class="close-icon delete-product-link" data-id="{{ $ompanyProfile->id }}">
                                                <img src="{{ asset('Admin/assets/dist/images/trash-icon1.svg') }}">
                                            </a>
                                            <span>
                                                <img src="{{ asset($ompanyProfile->add_company_brochure) }}" onerror="img_onError(this)">
                                               <a style=" position: absolute;" href="{{ asset($ompanyProfile->add_company_brochure) }}" download>Download</a>
                                                <br>
                                                
                                            </span>
                                        </div>
                                        @endif
                                        <!-- prodcut and service add_company_brochure close -->
                                        
                                    </div>
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3 my-4">
                                        <div class="input-wrapper">
                                            <b>Type of Offering</b>
                                            <div class="radio-custme">
                                                <div class="radio-custme-in">
                                                    <input data-id=1 class="product-export" type="radio" id="Product" value="product" name="type_of_offering[]">
                                                    <label for="Product">Product</label>
                                                </div>
                                                <div class="radio-custme-in">
                                                    <input data-id=1 class="product-export" type="radio" value="service" id="Service" name="type_of_offering[]" checked>
                                                    <label for="Service">Service</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3 my-4">
                                        <div class="input-wrapper">
                                            <b>Category</b>
                                            <select id="productcategory" name="product_category[]" data-productcategory_id="0">
                                                <option value="">Category</option>
                                                @foreach($category as $key=>$cat)
                                                <option value="{{$cat->id}}" data-cat_id="{{$cat->id}}">{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Sub Category</b>
                                            <select id="productSubcategory_0" name="product_sub_category[]">
                                                <option value="">Sub-Category</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Product Name</b>
                                            <input type="text" name="product_name[]">
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3 product-annual-1" style="display: none;">
                                        <div class="input-wrapper">
                                            <b>Annual Capacity</b>
                                            <input type="text" placeholder="Annual Capacity" name="product_annual[]">
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Currently Exported</b>
                                            <div class="radio-custme">
                                                <div class="radio-custme-in">
                                                    <input data-id=1 class="product-export" type="radio" id="test1" value="yes" name="product_currently_export[]">
                                                    <label for="test1">Yes</label>
                                                </div>
                                                <div class="radio-custme-in">
                                                    <input data-id=1 class="product-export" type="radio" value="no" id="test2" name="product_currently_export[]" checked>
                                                    <label for="test2">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3 data-product-country-1" style="display: none;">
                                        <div class="input-wrapper">
                                            <b>Countries</b>
                                            <select id="country" class="country_4" name="product_country[]" data-country_id="4">
                                                <option>Select</option>
                                                @foreach($countries as $key=>$country)
                                                <option value="{{$country->id}}">{{$country->name}} ({{$country->emoji}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Product Description</b>
                                            <textarea name="product_description[]"></textarea>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="input-wrapper">
                                            <b>Add Product Images (Up to 10)</b>
                                            <div class="form-group" x-data="imageUploader()">
                                                <div class="row">
                                                    <template x-for="(fileInput, index) in fileInputs" :key="index">
                                                        <div class="input-group mb-2 col-12 col-xl-6 mb-0 mb-xl-3">
                                                            <input type="file" x-ref="fileInput" name="product_images-0[]" class="d-none">
                                                            <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileInput.fileName">
                                                            <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.fileInput.click()">Browse</button>
                                                            <button class="remove btn btn-danger" type="button" x-on:click.prevent="removeImage(index)">Remove</button>
                                                        </div>
                                                    </template>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 text-end">
                                                        <button class="add-more btn btn-success" type="button" x-on:click.prevent="addImage" x-bind:disabled="fileInputs.length >= 10">Add More Image</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                        <h2></h2>
                                    </div>
                                </div> <!---- productAndService close ---->
                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                    <a class="btn btn-outline-primary add-icon" id="addProdcutAndService"> + Add Product / Service </a>
                                    <!-- <a class="deleteproductandService btn btn-outline-danger text-dark"> - Remove Add Anoth Product / Service</a> -->
                                </div>
                                <div class="col-12">
                                    <!-- reg address view open -->
                                    @foreach($companyProductService as $prodServs)

                                    <div class="addded-team products-address mt-1" data-container-id="{{ $prodServs->id }}">
                                        <a href="{{route('product.delete', $prodServs->id)}}" class="close-icon delete-link" data-id="{{ $prodServs->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>

                                        <span><img src="{{ asset('Admin/assets/dist/images/location-icon.svg') }}" onerror="img_onError(this)"></span>
                                        <div class="addded-iner">
                                            <h2 id="member-name">{{ucfirst($prodServs->type_of_offering)}}</h2>

                                            <label class="addded-text">
                                                <b>Category - <em id="member-position">{{$prodServs->categories->name ?? ""}}</em></b>
                                                <b>SubCategory - <em id="member-position">{{$prodServs->subcategories->name ?? ""}}</em></b>
                                                @if($prodServs->type_of_offering=='product')
                                                <b>Product Name - <em id="member-position">{{$prodServs->product_name}}</em></b>
                                                <b>Product Annual - <em id="member-position">{{$prodServs->product_annual}}</em></b>
                                                @else
                                                <b>Service Name - <em id="member-position">{{$prodServs->product_name}}</em></b>
                                                @endif
                                            </label>

                                            <label class="addded-text">

                                                <b>Currently Export - <em id="member-position">{{$prodServs->product_currently_export}}</em></b>
                                                @if($prodServs->product_currently_export=='yes')
                                                <b>Country - <em id="member-position">{{$prodServs->countries->name}}</em></b>
                                                @endif
                                                <b>Description - <em id="member-position">{{$prodServs->product_description}}</em></b>

                                            </label>
                                            <div class="my-2">
                                                @if($prodServs->product_images)
                                                @foreach(explode(",",$prodServs->product_images) as $image)
                                                <img class="img-fluid mx-2" width="50" src="{{asset($image)}}" alt="product image" onerror="img_onError(this)" />
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- reg address view close -->
                                    <div class="row my-4">
                                        <button class="btn btn-primary col-sm-4" type="submit" style="position: relative;left: 77%;width: 19%;">Save</button>
                                    </div>
                                
                            </div>

                            <!-- Product and Service  clsoe -->
                        </div>
                        

                        <!-- ######################## customer and client open ##########################################-->
                        <div class="tab-pane fade" id="nav-customer" role="tabpanel" aria-labelledby="nav-customer-tab">

                            <div class="d-flex flex-column pb-4">
                                <h2 class="pb-2">Customers/Client</h2>
                            </div>

                            <div class="row" id="accordionCustomerAndClient" style=" border: 1px #b9cdcb solid; padding: 10px;">
                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                    <div class="input-wrapper">
                                        <b>Company Name</b>
                                        <input type="text" class="mt-1" name="client_company_name[]" value="">
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                    <div class="input-wrapper">
                                        <b>Product or Service</b>
                                        <input type="text" class="mt-1" name="client_product_or_service[]" value="">
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                    <div class="input-wrapper">
                                        <b>Website Link</b>
                                        <input type="url" class="mt-1" name="client_website_link[]" value="">
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                    <div class="input-wrapper">
                                        <b>Review Link</b>
                                        <input type="url" class="mt-1" name="client_review_link[]" value="">
                                    </div>
                                </div>

                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                    <div class="input-wrapper">
                                        <b>Compnay Logo</b>

                                        <div class="form-group" x-data="{ fileName: '' }">
                                            <div class="input-group">
                                                <input type="file" x-ref="file" @change="fileName = $refs.file.files[0].name" name="client_company_logo[]" class="d-none">
                                                <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileName">
                                                <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-xl-6 mb-0 mb-xl-3 mt-1">
                                    <a class="btn btn-outline-primary add-icon" id="addCustomerAndCient"> + Add Another customer </a>
                                    <!-- <a class="delCustomerAndCient btn btn-outline-danger text-dark"> - Remove Another Location</a> -->
                                </div>
                            </div>


                            <!-- content show of customer client open -->
                            @foreach($companyCustomerClient as $csclient)
                            <div class="row mt-1 customerClient-address" data-customer-client-container-id="{{ $csclient->id }}">
                                <div class="addded-team">
                                    <a href="{{route('customer.client.delete', $csclient->id)}}" class="close-icon client-link" data-id="{{ $csclient->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                    <span><img src="{{ asset($csclient->client_company_logo) }}" onerror="img_onError(this)"></span>
                                    <div class="addded-iner">
                                        <h2 id="member-name"> Company {{$csclient->client_company_name}}</h2>
                                        <label class="addded-text">
                                            <b>Review - <em id="client_review_link">{{$csclient->client_review_link}}</em></b>

                                            <b>Website - <em id="client_website_link">{{$csclient->client_website_link}}</em></b>
                                            <b>Product - <em id="client_product_or_service">{{$csclient->client_product_or_service}}</em></b>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            <div class="row my-4">
                                <button class="btn btn-primary col-sm-4" type="submit" style="position: relative;left: 77%;width: 19%;">Save</button>
                            </div>
                            

                        </div> <!--- close accordian  -->

                        <!-- ######################## customer and client close ##########################################-->
                        <div class="tab-pane fade" id="nav-useful-information" role="tabpanel" aria-labelledby="nav-useful-information-tab">
                            <div class="d-flex flex-column pb-4">
                                <h2 class="pb-2">Useful Information </h2>
                            </div>
                            <div>

                                <!-- financial open -->
                                <div class="accordion-item border mb-2">
                                    <h2 class="accordion-header" id="headingFive">
                                        <button class="accordion-button collapsed" style="background:#EAEFF0;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            Company Financial
                                        </button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        <div class="accordion-body company-tabs">

                                            <div class="row gap-3 gap-xl-0">
                                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>Year</b>
                                                        <select name="currency_year">
                                                            <option value=" ">Select Year</option>
                                                            @for($i = date('Y'); $i > 1800; $i--)
                                                            <option value="{{$i}}" @if ($ompanyProfile->currency_year??'' == $i) selected @endif>{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>Currency type</b>
                                                        <select name="currency_type">
                                                            <option selected>Select</option>

                                                            @foreach($companyCurrency as $currency)
                                                            <option value="{{$currency->id}}" @if (($ompanyProfile->currency_type ?? '') == $currency->id) selected @endif>{{$currency->name}} {{$currency->code}} ({{$currency->symbol}})</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>Annual Revenue</b>
                                                        <input type="text" placeholder="Annual Revenue" name="annual_revenue" value="{{$ompanyProfile->annual_revenue ?? ''}}">
                                                    </div>
                                                </div>

                                                <!-- <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>Link to Annual Report</b>
                                                        <input type="text" placeholder="Link to Annual Report" name="link_to_annual_report" value="{{$ompanyProfile->link_to_annual_report??''}}">
                                                    </div>
                                                </div> -->

                                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>Attach Annual Report</b>
                                                        <div class="form-group" x-data="{ fileName: '' }">
                                                            <div class="input-group">
                                                                <input type="file" x-ref="file" @change="fileName = $refs.file.files[0].name" name="link_to_annual_report2" class="d-none">
                                                                <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileName">
                                                                <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                                                            </div>

                                                            <!-- company financial open -->
                                                            @if(!empty($ompanyProfile) && $ompanyProfile->link_to_annual_report2)
                                                            <div class="addded-team mt-1 financial-address" data-financial-Container-id="{{ $ompanyProfile->id }}">
                                                                <a href="{{ route('company.financialimage.delete', $ompanyProfile->id) }}" class="close-icon delete-financial-link" data-id="{{ $ompanyProfile->id }}">
                                                                    <img src="{{ asset('Admin/assets/dist/images/trash-icon1.svg') }}">
                                                                </a>
                                                                <span>
                                                                    <a href="{{ asset($ompanyProfile->link_to_annual_report2) }}" download>Download</a>
                                                                </span>
                                                            </div>
                                                            @endif

                                                            <!-- company financial close -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- financial close -->
                            </div>
                             <div class="row my-4">
                                <button class="btn btn-primary col-sm-4" type="submit" style="position: relative;left: 77%;width: 19%;">Save</button>
                            </div>

                        </div>


                        <div class="tab-pane fade" id="nav-useful-links" role="tabpanel" aria-labelledby="nav-useful-links-tab">


                            <div class="d-flex flex-column pb-4">
                                <h2 class="pb-2">Useful Links</h2>
                            </div>


                            <!-- useful link open -->
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="row">
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Website</b>
                                            <input type="url" placeholder="Website" name="website" value="{{$ompanyProfile->website ?? ''}}">
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>LinkedIn</b>
                                            <input type="url" placeholder="LinkedIn" name="linkedIn" value="{{$ompanyProfile->linkedIn ?? ''}}">
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Facebook</b>
                                            <input type="url" placeholder="Facebook" name="facebook" value="{{$ompanyProfile->facebook ?? ''}}">
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Instagram</b>
                                            <input type="url" placeholder="Instagram" name="instagram" value="{{$ompanyProfile->instagram ?? ''}}">
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Twitter</b>
                                            <input type="url" placeholder="Twitter" name="twitter" value="{{$ompanyProfile->twitter ?? ''}}">
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Youtube</b>
                                            <input type="url" placeholder="Youtube" name="youtube" value="{{$ompanyProfile->youtube ?? ''}}">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- useful link close -->

                            <div class="row my-4">
                                <button class="btn btn-primary col-sm-4" type="submit" style="position: relative;left: 77%;width: 19%;">Save</button>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
    </div>
</div>
</div>

</form>



<!-- Modal -->
<div class="modal fade" id="add-brand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="saved-suppliers">
                    <h4>Your Saved Suppliers </h4>
                    <div class="row">
                        <div class="col-12 col-md-5 col-xl-3 mb-3 mb-md-0">
                            <div class="border bg-white compnay-tabs-ul" style="border-color:#B4B6BD;">
                                <ul class="d-flex flex-column nav nav-tabs listing" id="nav-tabs" role="tablist">
                                    <li>
                                        <a id="supplier-tab" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#supplier-tab-one" type="button" role="tab" aria-controls="nav-Company-profile" aria-selected="true" href="#" class=" nav-link active py-3 px-4 d-block position-relative">
                                            <span class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">1</span>
                                            <h2>Supplier List 1(USA)<b>8 Companies</b></h2>
                                        </a>
                                    </li>

                                    <li><a id="supplier-west" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#supplier-west-two" type="button" role="tab" aria-controls="supplier-west-tab" aria-selected="false" href="#" class="nav-link py-3 px-4 d-block position-relative"><span class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">6</span>
                                            <h2>West Coast Suppliers (USA)<b>14 Companies</b></h2>
                                        </a>
                                    </li>

                                    <li><a id="eur-west" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#eur-west-three" type="button" role="tab" aria-controls="eur-west-tab" aria-selected="false" href="#" class="nav-link py-3 px-4 d-block position-relative"><span class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">6</span>
                                            <h2>West Coast Suppliers (USA)<b>14 Companies</b></h2>
                                        </a>
                                    </li>


                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-md-7 col-xl-9 ">
                            <div class="border bg-white p-3 px-sm-4 py-sm-4 tab-content" id="nav-tabContent" style="border-color:#B4B6BD;">
                                <div class="tab-pane fade show active" id="supplier-tab-one" role="tabpanel" aria-labelledby="supplier-tab">
                                    <div class="d-flex flex-column pb-4">
                                        <h2 class="pb-2">Supplier List 1(USA)</h2>
                                        <p>Created : 14 Sep 2021</p>
                                    </div>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <form>
                                            <div class="row gap-3 gap-xl-0 ">

                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                    <div class="saved-com">
                                                        <h3>8 Saved Companies</h3>
                                                        <div class="saved-com-r">
                                                            <div class="saved-com-serach">
                                                                <img src="{{ asset('Admin/assets/dist/images/search-icon.svg') }}" onerror="img_onError(this)">
                                                                <input type="text" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                    <div class="addded-team add-slip">
                                                        <input type="checkbox" />
                                                        <span><img src="{{ asset('Admin/assets/dist/images/table-iconOne.png') }}" alt="icon" class="w-auto img-fluid" onerror="img_onError(this)"></span>
                                                        <div class="addded-iner">
                                                            <h2>ATG Group</h2>
                                                            <label class="addded-text">
                                                                <b>Distributor</b>
                                                                <b><em><img src="{{ asset('Admin/assets/dist/images/television-icon.svg') }}" onerror="img_onError(this)">
                                                                        Detroit, MI 53226 </em><em><img src="assets/dist/images/user-icon.svg"> 150
                                                                        - 200</em><em><img src="assets/dist/images/report-icon.svg">
                                                                        24</em></b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                    <div class="addded-team add-slip">
                                                        <input type="checkbox" />
                                                        <span><img src="{{ asset('Admin/assets/dist/images/table-large-iconTwo.png') }}" alt="icon" class="w-auto img-fluid"></span>
                                                        <div class="addded-iner">
                                                            <h2>TLC Pvt Ltd</h2>
                                                            <label class="addded-text">
                                                                <b>Display Manufacturers</b>
                                                                <b><em><img src="{{ asset('Admin/assets/dist/images/television-icon.svg') }}">
                                                                        Detroit, MI 53226 </em><em><img src="assets/dist/images/user-icon.svg"> 150
                                                                        - 200</em><em><img src="assets/dist/images/report-icon.svg">
                                                                        24</em></b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                    <div class="addded-team add-slip">
                                                        <input type="checkbox" />
                                                        <span><img src="{{ asset('Admin/assets/dist/images/table-iconOne.png') }}" alt="icon" class="w-auto img-fluid"></span>
                                                        <div class="addded-iner">
                                                            <h2>ATG Group</h2>
                                                            <label class="addded-text">
                                                                <b>Distributor</b>
                                                                <b><em><img src="{{ asset('Admin/assets/dist/images/television-icon.svg') }}">
                                                                        Detroit, MI 53226 </em><em><img src="assets/dist/images/user-icon.svg"> 150
                                                                        - 200</em><em><img src="assets/dist/images/report-icon.svg">
                                                                        24</em></b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                    <div class="addded-team add-slip">
                                                        <input type="checkbox" />
                                                        <span><img src="{{ asset('Admin/assets/dist/images/table-large-iconTwo.png') }}" alt="icon" class="w-auto img-fluid"></span>
                                                        <div class="addded-iner">
                                                            <h2>TLC Pvt Ltd</h2>
                                                            <label class="addded-text">
                                                                <b>Display Manufacturers</b>
                                                                <b><em><img src="{{ asset('Admin/assets/dist/images/television-icon.svg') }}">
                                                                        Detroit, MI 53226 </em><em><img src="assets/dist/images/user-icon.svg"> 150
                                                                        - 200</em><em><img src="assets/dist/images/report-icon.svg">
                                                                        24</em></b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </form>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="supplier-west-two" role="tabpanel" aria-labelledby="supplier-west-tab">
                                    <div class="d-flex flex-column pb-4">
                                        <h2 class="pb-2">West Coast Suppliers (USA)</h2>
                                        <p>14 Companies</p>
                                    </div>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <form>
                                            <div class="row gap-3 gap-xl-0 ">

                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                    <div class="saved-com">
                                                        <h3>8 Saved Companies</h3>
                                                        <div class="saved-com-r">
                                                            <div class="saved-com-serach">
                                                                <img src="{{ asset('Admin/assets/dist/images/search-icon.svg') }}">
                                                                <input type="text" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                    <div class="addded-team add-slip">
                                                        <input type="checkbox" />
                                                        <span><img src="{{ asset('Admin/assets/dist/images/table-iconOne.png') }}" alt="icon" class="w-auto img-fluid"></span>
                                                        <div class="addded-iner">
                                                            <h2>ATG Group</h2>
                                                            <label class="addded-text">
                                                                <b>Distributor</b>
                                                                <b><em><img src="{{ asset('Admin/assets/dist/images/television-icon.svg') }}">
                                                                        Detroit, MI 53226 </em><em><img src="assets/dist/images/user-icon.svg"> 150
                                                                        - 200</em><em><img src="assets/dist/images/report-icon.svg">
                                                                        24</em></b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                    <div class="addded-team add-slip">
                                                        <input type="checkbox" />
                                                        <span><img src="{{ asset('Admin/assets/dist/images/table-large-iconTwo.png') }}" alt="icon" class="w-auto img-fluid"></span>
                                                        <div class="addded-iner">
                                                            <h2>TLC Pvt Ltd</h2>
                                                            <label class="addded-text">
                                                                <b>Display Manufacturers</b>
                                                                <b><em><img src="{{ asset('Admin/assets/dist/images/television-icon.svg') }}">
                                                                        Detroit, MI 53226 </em><em><img src="assets/dist/images/user-icon.svg"> 150
                                                                        - 200</em><em><img src="assets/dist/images/report-icon.svg">
                                                                        24</em></b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                    <div class="addded-team add-slip">
                                                        <input type="checkbox" />
                                                        <span><img src="{{ asset('Admin/assets/dist/images/table-iconOne.png') }}" alt="icon" class="w-auto img-fluid"></span>
                                                        <div class="addded-iner">
                                                            <h2>ATG Group</h2>
                                                            <label class="addded-text">
                                                                <b>Distributor</b>
                                                                <b><em><img src="{{ asset('Admin/assets/dist/images/television-icon.svg') }}">
                                                                        Detroit, MI 53226 </em><em><img src="assets/dist/images/user-icon.svg"> 150
                                                                        - 200</em><em><img src="assets/dist/images/report-icon.svg">
                                                                        24</em></b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                    <div class="addded-team add-slip">
                                                        <input type="checkbox" />
                                                        <span><img src="{{ asset('Admin/assets/dist/images/table-large-iconTwo.png') }}" alt="icon" class="w-auto img-fluid"></span>
                                                        <div class="addded-iner">
                                                            <h2>TLC Pvt Ltd</h2>
                                                            <label class="addded-text">
                                                                <b>Display Manufacturers</b>
                                                                <b><em><img src="{{ asset('Admin/assets/dist/images/television-icon.svg') }}">
                                                                        Detroit, MI 53226 </em><em><img src="assets/dist/images/user-icon.svg"> 150
                                                                        - 200</em><em><img src="assets/dist/images/report-icon.svg">
                                                                        24</em></b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </form>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="eur-west-three" role="tabpanel" aria-labelledby="eur-west-tab">
                                    <div class="d-flex flex-column pb-4">
                                        <h2 class="pb-2">Suppliers - Europe</h2>
                                        <p>3 Companies</p>
                                    </div>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <form>
                                            <div class="row gap-3 gap-xl-0 ">

                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                    <div class="saved-com">
                                                        <h3>8 Saved Companies</h3>
                                                        <div class="saved-com-r">
                                                            <div class="saved-com-serach">
                                                                <img src="{{ asset('Admin/assets/dist/images/search-icon.svg') }}">
                                                                <input type="text" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                    <div class="addded-team add-slip">
                                                        <input type="checkbox" />
                                                        <span><img src="{{ asset('Admin/assets/dist/images/table-iconOne.png') }}" alt="icon" class="w-auto img-fluid"></span>
                                                        <div class="addded-iner">
                                                            <h2>ATG Group</h2>
                                                            <label class="addded-text">
                                                                <b>Distributor</b>
                                                                <b><em><img src="{{ asset('Admin/assets/dist/images/television-icon.svg') }}">
                                                                        Detroit, MI 53226 </em><em><img src="assets/dist/images/user-icon.svg"> 150
                                                                        - 200</em><em><img src="assets/dist/images/report-icon.svg">
                                                                        24</em></b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                    <div class="addded-team add-slip">
                                                        <input type="checkbox" />
                                                        <span><img src="{{ asset('Admin/assets/dist/images/table-large-iconTwo.png') }}" alt="icon" class="w-auto img-fluid"></span>
                                                        <div class="addded-iner">
                                                            <h2>TLC Pvt Ltd</h2>
                                                            <label class="addded-text">
                                                                <b>Display Manufacturers</b>
                                                                <b><em><img src="{{ asset('Admin/assets/dist/images/television-icon.svg') }}">
                                                                        Detroit, MI 53226 </em><em><img src="assets/dist/images/user-icon.svg"> 150
                                                                        - 200</em><em><img src="assets/dist/images/report-icon.svg">
                                                                        24</em></b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                    <div class="addded-team add-slip">
                                                        <input type="checkbox" />
                                                        <span><img src="{{ asset('Admin/assets/dist/images/table-iconOne.png') }}" alt="icon" class="w-auto img-fluid"></span>
                                                        <div class="addded-iner">
                                                            <h2>ATG Group</h2>
                                                            <label class="addded-text">
                                                                <b>Distributor</b>
                                                                <b><em><img src="{{ asset('Admin/assets/dist/images/television-icon.svg') }}">
                                                                        Detroit, MI 53226 </em><em><img src="assets/dist/images/user-icon.svg"> 150
                                                                        - 200</em><em><img src="assets/dist/images/report-icon.svg">
                                                                        24</em></b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                    <div class="addded-team add-slip">
                                                        <input type="checkbox" />
                                                        <span><img src="{{ asset('Admin/assets/dist/images/table-large-iconTwo.png') }}" alt="icon" class="w-auto img-fluid"></span>
                                                        <div class="addded-iner">
                                                            <h2>TLC Pvt Ltd</h2>
                                                            <label class="addded-text">
                                                                <b>Display Manufacturers</b>
                                                                <b><em><img src="{{ asset('Admin/assets/dist/images/television-icon.svg') }}">
                                                                        Detroit, MI 53226 </em><em><img src="assets/dist/images/user-icon.svg"> 150
                                                                        - 200</em><em><img src="assets/dist/images/report-icon.svg">
                                                                        24</em></b>
                                                            </label>
                                                        </div>
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

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script src="{{ asset('Admin/assets/dist/js/company-profile.js') }}"></script>
<script src="{{ asset('Admin/assets/dist/js/delete-company-profile.js') }}"></script>
<script>
    function img_onError(_this) {
        _this.src = "{{asset('storage/dummy-image.jpg')}}";
    }

    function fileUploadComponent(section_class = '', preview_section = '') {
        if (section_class == '' || preview_section == '') {
            return {
                fileName: ''
            }
            $(`.${section_class}`).show();
        }
        return {
            fileName: '',
            imagePreview: '',
            inputName: '',
            placeholder: '',
            buttonLabel: 'Browse',

            displayImage() {
                const fileInput = this.$refs.file;
                const selectedFile = fileInput.files[0];

                if (selectedFile) {
                    this.fileName = selectedFile.name;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        $(`.${section_class}`).hide();
                        $(`.${preview_section}`).show();
                        this.imagePreview = e.target.result;
                    };
                    reader.readAsDataURL(selectedFile);
                } else {
                    $(`.${section_class}`).show();
                    $(`.${preview_section}`).hide();
                    this.fileName = '';
                    this.imagePreview = '';
                }
            },
        };
    }

</script>
<script>
    const getsubcategorydata = (category_id = null, sub_category_id = null, data_id = null) => {

        if (data_id == null || data_id == '') {
            return
        }
        if (category_id == null) {
            return
        }
        if (sub_category_id == null) {
            return
        }
        var category = category_id;
        var url = "{{ Route('company.getsubcategory') }}";
        $.ajax({
            url: url,
            method: "GET",
            data: {
                'category': category_id,
                'sub_category': sub_category_id,

            },
            success: function(result) {

                $("#subcategory_" + data_id).html(result.subcategory.html);
            }
        });

    }

    $(document).ready(function() {
        var category_id = "{{$ompanyProfile->company_category_id??''}}";
        var sub_category_id = "{{$ompanyProfile->company_sub_category_id??''}}";

        getsubcategorydata(category_id, sub_category_id, data_id = "1")
    });

    const getStateCitydata = (country_id = null, state_id = null, city_id = null, data_id = null) => {
        if (data_id == null || data_id == '') {
            return
        }
        if (country_id == null || state_id == null || city_id == null) {
            return
        }
        var country = country_id;

        var url = "{{Route('auth.getStateCity')}}";
        $.ajax({
            url: url,
            method: "GET",
            data: {
                'country': country,
                state_id: state_id,
                city_id: city_id
            },
            success: function(result) {
                if (result.status) {
                    if (result.state.status) {
                        $("#state_" + data_id).html(result.state.html);
                    }
                    if (result.city.status) {
                        $("#city_" + data_id).html(result.city.html);
                    }
                }
            }
        });
    }

    $(document).ready(function() {
        var country_id = "{{$ompanyProfile->usfl_info_country_id ?? null}}";
        var state_id = "{{$ompanyProfile->usfl_info_state_id ?? null}}";
        var city_id = "{{$ompanyProfile->usfl_info_city_id ?? null}}";
        getStateCitydata(country_id, state_id, city_id, data_id = "10");

        getStateCitydata("{{$ompanyProfile->company_location_country_id ?? null}}", "{{$ompanyProfile->company_location_state_id ?? null}}", "{{$ompanyProfile->company_location_city_id ?? null}}", data_id = "4");

        // product and service open
        $(document).on('change', '#productcategory', function() {
            var productcategory_id = $(this).data('productcategory_id');
            var category = $(this).val();

            console.log('cotegory id ' + category);
            var url = "{{ Route('company.SelectSubCategory') }}";
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    'category': category
                },
                success: function(result) {
                    $("#productSubcategory_" + productcategory_id).html(result);
                }
            });
        })
        // product and service close
        $(document).on('change', '#location_country', function() {
            var country = $("#location_country").val();
            var country_id = $(this).data('country_id');

            console.log('country id bydefault is  ' + country_id);
            console.log('on drop down country' + country);
            var url = "{{Route('auth.SearchState')}}";
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    'country': country
                },
                success: function(result) {
                    console.log(result);
                    $("#state_" + country_id).html(result);
                }
            });
        })

        $(document).on('change', '#country', function() {
            var country = $("#country").val();
            var country_id = $(this).data('country_id');
            console.log('country id bydefault is  ' + country_id);
            console.log('on drop down country' + country);
            var url = "{{Route('auth.SearchState')}}";
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    'country': country
                },
                success: function(result) {
                    console.log(result);
                    $("#state_" + country_id).html(result);
                }
            });
        })
        $(document).on('change', '.state', function() {
            var state_id = $(this).data('state_id');
            console.log('state id is comig' + state_id);
            var state = $("#state_" + state_id).val();
            console.log('state id ' + state);
            var url = "{{ Route('auth.SearchCity') }}";
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    'state': state
                },
                success: function(result) {
                    $("#city_" + state_id).html(result);
                }
            });
        })

        $(document).on('click', '#coverimg', function() {
            var coverimg_id = $(this).data('cover_id');
            console.log(coverimg_id);
            var url = "{{ Route('admin.SelectCoverImg') }}";
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    'coverimg_id': coverimg_id
                },
                success: function(result) {
                    console.log(result);
                    var html = result;
                    var div = document.createElement("div");
                    div.innerHTML = html;
                    var text = div.textContent || div.innerText || "";
                    console.log(text)
                    $("#cover_letter").html(text);
                }
            });
        })
        $(document).on('keyup', '#searchautocomplete', function() {
            var searchautocomplete = $("#searchautocomplete").val();
            var url = "{{ Route('admin.SelectCompanys') }}";
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    'searchautocomplete': searchautocomplete
                },
                success: function(result) {
                    if (searchautocomplete == ' ') {
                        $(".searchResults").html();
                    } else {
                        $(".searchResults").html(result);
                    }
                }
            });
        })

        // ======================================= company profile open ==============================================
        $(".delete-brandName").hide();
        console.log('delete brand close');
        //when the Add Field button is clicked

        (function($) {
            "use strict";

            $(".js-select2").select2({
                closeOnSelect: false,
                placeholder: "Click to select an option",
                allowHtml: true,
                allowClear: true,
                tags: true // ÑÐ¾Ð·Ð´Ð°ÐµÑ‚ Ð½Ð¾Ð²Ñ‹Ðµ Ð¾Ð¿Ñ†Ð¸Ð¸ Ð½Ð° Ð»ÐµÑ‚Ñƒ
            });

            $('.icons_select2').select2({
                width: "100%",
                templateSelection: function(icon) {
                    return iformat(icon, parameter1, parameter2);
                },
                templateResult: function(icon) {
                    return iformat(icon, parameter1, parameter2);
                },
                allowHtml: true,
                placeholder: "Click to select an option",
                dropdownParent: $('.select-icon'), // Ð¾Ð±Ð°Ð²Ð¸Ð»Ð¸ ÐºÐ»Ð°ÑÑ
                allowClear: true,
                multiple: false
            });

            function iformat(icon, parameter1, parameter2) {
                var originalOption = icon.element;
                var originalOptionBadge = $(originalOption).data('badge');
                // You can use parameter1 and parameter2 here as needed
                return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '<span class="badge">' + originalOptionBadge + '</span></span>');
            }
        })(jQuery);



        var companycategory_id = 2;
        console.log('on change caompany category values' + companycategory_id);
        $("#add-brandName").click(function(e) {
            $(".delete-brandName").fadeIn("1500");
            //Append a new row of code to the "#items" div
            $("#accordion-body-companyProfile").append(`<div class="row gap-3 gap-xl-0  my-2" style="border: 1px #c7d7d9 solid; padding: 22px;" id="accordion-body-companyProfile-remo-${companycategory_id}">
            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                <div class="input-wrapper">
                    <b>Brand Name</b>
                    <input type="text" placeholder="Brands Name" name="brand_name[]" />
                </div>
            </div>
            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                <div class="input-wrapper">
                    <b>Brands Logo</b>
                    <div class="form-group mt-1" x-data="fileUploadComponent('null','brand-logo-preview-${companycategory_id}')">
                        <div class="input-group">
                            <input type="file" x-ref="file" @change="displayImage" name="brand_logo[]" class="d-none">
                            <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileName">
                            <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                        </div>
                        <div class="addded-team brand-logo-preview-${companycategory_id} mt-1" style="display: none;">
                            <span>
                                <img x-bind:src="imagePreview" alt="Selected Image" onerror="img_onError(this)">
                            </span>
                            <div>
                                <strong>FileName:</strong><small x-text="fileName"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                <div class="input-wrapper">
                    <b>Brand Website</b>
                    <input type="text" placeholder="Brand Website" name="brand_website[]" />
                </div>
            </div>
            <div class="col-12 col-xl-6 mb-xl-3 mt-4 text-end">
                <a class="delete-brandName btn btn-outline-danger text-dark" data-id="${companycategory_id}" style="position: relative;right: 90px;"> - Remove Brand</a>
            </div>
      </div>`);
            companycategory_id++;
        });


        $("body").on("click", ".delete-brandName", function(e) {
            let delete_id = $(this).data('id');
            $("#accordion-body-companyProfile-remo-" + delete_id).remove();
        });



        $(document).on('change', '#companycategory', function() {
            var companycategory_id = $(this).data('companycategory_id');
            console.log(companycategory_id);

            var category = $(".companycategory_" + companycategory_id).val();


            var url = "{{ Route('company.SelectSubCategory') }}";
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    'category': category
                },
                success: function(result) {
                    $("#subcategory_" + companycategory_id).html(result);
                }
            });
        })


        // ======================================= company profile close ==============================================




        // ##############################  customer and client open ###############################################
        $(".delCustomerAndCient").hide();
        console.log('delete brand close');
        //when the Add Field button is clicked

        var customer_client_id = 2;

        $("#addCustomerAndCient").click(function(e) {
            $(".delCustomerAndCient").fadeIn("1500");
            //Append a new row of code to the "#items" div
            $("#accordionCustomerAndClient").after(`<div class="row my-2" id="accordionCustomerAndClient-remo-${customer_client_id}" style=" border: 1px #b9cdcb solid; padding: 10px;">

                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                    <div class="input-wrapper">
                        <b>Company Name</b>
                        <input type="text" placeholder="Company Name" name="client_company_name[]">
                    </div>
                </div>

                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                    <div class="input-wrapper">
                        <b>Product or Service</b>
                        <input type="text" placeholder="Product or Service" name="client_product_or_service[]">
                    </div>
                </div>

                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                    <div class="input-wrapper">
                        <b>Website Link</b>
                        <input type="text" placeholder="Website Link" name="client_website_link[]">
                    </div>
                </div>

                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                    <div class="input-wrapper">
                        <b>Review Link</b>
                        <input type="text" placeholder="Review Link" name="client_review_link[]">
                    </div>
                </div>

                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                    <div class="input-wrapper">
                        <b>Compnay Logo</b>
                        <div class="form-group" x-data="{ fileName: '' }">
                            <div class="input-group">
                                <input type="file" x-ref="file" @change="fileName = $refs.file.files[0].name" name="client_company_logo[]" class="d-none">
                                <input type="text" class="form-control form-control-lg"  placeholder="Your Files" x-model="fileName">
                                <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-end">
                    <a class="delCustomerAndCient btn btn-outline-danger text-dark" data-id=${customer_client_id}> - Remove</a>
                </div>
            </div>`);
            customer_client_id++;
        });




        $("body").on("click", ".delCustomerAndCient", function(e) {
            let data_id = $(this).data('id');
            $("#accordionCustomerAndClient-remo-" + data_id).remove();
        });
        // ##############################  customer and client close ###############################################




        // ======================================= Company Location reg office addresss open ==================================





        // nth code open
        $(".deleteAnotherAddress").hide();
        //when the Add Field button is clicked
        var country_id = 2;
        $("#addAnotherAddress").click(function(e) {
            $(".deleteAnotherAddress").fadeIn("1500");
            //Append a new row of code to the "#items" div
            $("#body-addAnotherAddress").after(`<div class="row gap-3 gap-xl-0 my-2" id="body-addAnotherAddress-remo-${country_id}" style=" border: 1px #cbd9d9 solid; padding: 7px;  margin: 0px;">
            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                    <div class="input-wrapper">
                        <b>Address1</b>
                        <textarea name="reg_office_address[]"></textarea>
                    </div>
                </div>
                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                <div class="input-wrapper">
                    <b>Country</b>
                    <select id="country" class="country_${country_id}" name="company_location_country_id[]" data-country_id="${country_id}">
                    <option >Select</option>
                    @foreach($countries as $key=>$country)
                        <option value="{{$country->id}}">{{$country->name}} ({{$country->emoji}})</option>
                    @endforeach
                    </select>
                </div>
                </div>
                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                <div class="input-wrapper">
                    <b>State</b>
                    <select id="state_${country_id}" name="company_location_state_id[]" data-state_id="${country_id}">
                        <option selected>Select</option>
                    </select>
                </div>
                </div>
                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                <div class="input-wrapper">
                    <b>City</b>
                    <select id="city_${country_id}" name="company_city_id[]">
                        <option selected>Select</option>
                    </select>
                </div>
                </div>
                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                <div class="input-wrapper">
                    <b>Zip Code</b>
                    <input type="number" name="company_zipcode[]" placeholder="">
                </div>
                </div>
                <div class="col-12 col-xl-12 mb-0 mb-xl-3 mt-1 text-end">
                    <a class="deleteAnotherAddress btn btn-outline-danger text-dark" data-id=${country_id}> - Remove Another Address</a>
                </div>
            </div>`);
            country_id++;
        });
        $("body").on("click", ".deleteAnotherAddress", function(e) {
            let data_id = $(this).data('id');
            $("#body-addAnotherAddress-remo-" + data_id).remove();
        });

        var primary_info = 2;
        $("#addAnotherPrimaryInfo").click(function(e) {
            $(".deleteAnotherPrimaryInfo").fadeIn("1500");
            //Append a new row of code to the "#items" div
            $("#LocationAfterBody").after(`<div class="row gap-3 gap-xl-0 my-2" id="LocationAfterBody-${primary_info}"  style=" border: 1px #c3d5d5 solid;padding: 11px;">
                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                    <div class="input-wrapper">
                        <b>Select your designation</b>
                        <select name="purpose[]">
                            @foreach($Jobrole as $Job)
                                <option value="">Select your designation</option>
                                <option value="{{$Job->role_name}}">{{$Job->role_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                    <div class="input-wrapper">
                        <b>Name</b>
                        <input type="text" placeholder="Name" name="primary_name[]">
                    </div>
                </div>
                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                    <div class="input-wrapper">
                        <b>Email</b>
                        <input type="email" placeholder="email" name="primary_email[]">
                    </div>
                </div>
                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                    <div class="input-wrapper">
                        <b>Contact Number</b>
                            <input type="number" id="phone-country-${primary_info}-number" name="contact_number[]"/>
                    </div>
                </div>
                <div class="col-12 col-xl-12 mb-0 mb-xl-3 mt-1 text-end">
                    <a class="deleteAnotherPrimaryInfo btn btn-outline-danger text-dark" data-id=${primary_info}> - Remove Info</a>
                </div>
            </div>`);
            primary_info++;
        });
        $("body").on("click", ".deleteAnotherPrimaryInfo", function(e) {
            let data_id = $(this).data('id');
            $("#LocationAfterBody-" + data_id).remove();
        });
    })
    $(document).on('change', '.different-mailing', function() {
        if ($(this).val() == "yes") {
            $('.mailing-address-section').show();
        } else {
            $('.mailing-address-section').hide();
        }
    });


    $(document).on('change', '#country', function() {
        var country_id = $(this).data('country_id');
        console.log('country_id', country_id);
        $(document).on('change', '.country_' + country_id, function() {
            var country = $(".country_" + country_id).val();
            var url = "{{Route('auth.SearchState')}}";
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    'country': country
                },
                success: function(result) {
                    console.log(result);
                    $("#state_" + country_id).html(result);
                }
            });

            $(document).on('change', '#state_' + country_id, function() {
                var state_id = $(this).data('state_id');
                var state = $("#state_" + state_id).val();
                console.log('state_id', state_id);
                console.log('state', state);
                var url = "{{Route('auth.SearchCity')}}";
                $.ajax({
                    url: url,
                    method: "GET",
                    data: {
                        'state': state
                    },
                    success: function(result) {
                        $("#city_" + state_id).html(result);
                    }
                });
            })
        })
    })
    var phoneCodeDropdown=false;
    updateContactNumberLength()

    $("body").on('change','.phone-country',function() {
        let id = $(this).attr('id');
        phoneCodeDropdown=true;
        updateContactNumberLength(id);
    });

    $("body").on('mousedown','.phone-country',function() {
        phoneCodeDropdown=true;
        let id = $(this).attr('id');
        $(`#${id} option`).each(function() {
            $(this).html(`${$(this).data('country-name')}`);
        });
    });

    $(document).mouseup(function(e){
        var dropdown = $('.phone-country');
        if (!dropdown.is(e.target) && dropdown.has(e.target).length === 0 && phoneCodeDropdown) {
            updateContactNumberLength()
            phoneCodeDropdown=false;
        }
    })

    function updateContactNumberLength(id='phone-country') {
        if(id){
            var selectedCountry = $(`#${id} option:selected`);
            var digitCount = selectedCountry.data('digits');
            var phoneCode = selectedCountry.data('phone-code');

            $(`#${id}-number`).attr('maxlength', digitCount);
            $(`#${id}-number`).attr('minlength', digitCount);
            selectedCountry.html(`+${phoneCode}`);
        }

    }
    // ======================================= Company Location reg office addresss close =================================


    // ##################### product and service open 5 ######################################


    $(".deleteproductandService").hide();
    //when the Add Field button is clicked
    var country_id = 5;
    let productServiceCount = 1;
    $("#addProdcutAndService").click(function(e) {
        $(".deleteproductandService").fadeIn("1500");
        //Append a new row of code to the "#items" div
        $("#body-addProdcutAndService").after(`<div class="row gap-3 gap-xl-0" id="body-addProdcutAndService-remo-${productServiceCount}">
        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
            <div class="input-wrapper">
                <b>Type of Offering</b>
                <select name="type_of_offering[]" class="type-of-offering" data-id=${productServiceCount}>
                    <option value="">Select</option>
                    <option value="product">Product</option>
                    <option value="service">Service</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
            <div class="input-wrapper">
                <b>Category</b>
                <select id="productcategory" data-productcategory_id="${productServiceCount}" name="product_category[]">
                    <option>Category</option>
                    @foreach($category as $key=>$cat)
                    <option value="{{$cat->id}}" data-cat_id="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
            <div class="input-wrapper">
                <b>Sub Category</b>
                <select id="productSubcategory_${productServiceCount}" name="product_sub_category[]">
                        <option>Sub-Category</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
            <div class="input-wrapper">
                <b>Product Name</b>
                <input type="text" name="product_name[]">
            </div>
        </div>

        <div class="col-12 col-xl-6 mb-0 mb-xl-3 product-annual-${productServiceCount}" style="display: none;">
            <div class="input-wrapper">
                <b>Annual Capacity</b>
                <input type="text" placeholder="Annual Capacity" name="product_annual[]">
            </div>
        </div>

        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
            <div class="input-wrapper">
                <b>Currently Exported</b>
                <div class="radio-custme">
                    <div class="radio-custme-in">
                        <input class="product-export" data-id=${country_id} type="radio" value="yes" id="test1-${productServiceCount}" name="product_currently_export[${productServiceCount}]">
                        <label for="test1-${productServiceCount}">Yes</label>
                    </div>
                    <div class="radio-custme-in">
                        <input class="product-export" data-id=${country_id} type="radio" value="no" id="test2-${productServiceCount}" name="product_currently_export[${productServiceCount}]" checked>
                        <label for="test2-${productServiceCount}">No</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 mb-0 mb-xl-3 data-product-country-${country_id}" style="display: none;">
            <div class="input-wrapper">
                <b>Countries</b>
                <select id="country" class="country_4" name="product_country[]" data-country_id="4">
                    <option>Select</option>
                    @foreach($countries as $key=>$country)
                    <option value="{{$country->id}}">{{$country->name}} ({{$country->emoji}})</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-xl-12 mb-0 mb-xl-3">
            <div class="input-wrapper">
                <b>Product Description</b>
                <textarea name="product_description[]"></textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="input-wrapper">
                <b>Add Product Images (Up to 10)</b>
                <div class="form-group" x-data="imageUploader()">
                    <div class="row">
                        <template x-for="(fileInput, index) in fileInputs" :key="index">
                            <div class="input-group mb-2 col-12 col-xl-6 mb-0 mb-xl-3">
                                <input type="file" x-ref="fileInput" name="product_images-${productServiceCount}[]" class="d-none">
                                <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileInput.fileName">
                                <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.fileInput.click()">Browse</button>
                                <button class="remove btn btn-danger" type="button" x-on:click.prevent="removeImage(index)">Remove</button>
                            </div>
                        </template>
                    </div>
                    <div class="row">
                        <div class="col-12 text-end">
                            <button class="add-more btn btn-success mb-3" type="button" x-on:click.prevent="addImage" x-bind:disabled="fileInputs.length >= 10">Add More Image</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 text-end mb-3">
           <a class="deleteproductandService btn btn-outline-danger text-dark" data-id=${productServiceCount}> - Remove Product / Service</a>
        </div>
      </div>
      `);
        country_id++;
        productServiceCount++;
    });
    $("body").on("click", ".deleteproductandService", function(e) {
        let data_id = $(this).data('id');
        $("#body-addProdcutAndService-remo-" + data_id).remove();
    });
    $(document).on('change', '.product-export', function() {
        let data_id = $(this).data('id');
        console.log(data_id, $(this), "++++++", $(this).val());
        if ($(this).val() == "yes") {
            $('.data-product-country-' + data_id).show();
        } else {
            $('.data-product-country-' + data_id).hide();
        }
    });

    $(document).on('change', '.type-of-offering', function() {
        var dataId = $(this).data("id");
        if ($(this).val() === "product") {
            $(".product-annual-" + dataId).show();
        } else {
            $(".product-annual-" + dataId).hide();
        }
    });

    function imageUploader() {
        return {
            fileInputs: [],

            addImage() {
                if (this.fileInputs.length < 10) {
                    this.fileInputs.push({
                        fileName: ''
                    });
                } else {
                    alert('You have reached the maximum limit of 10 images.');
                }
            },

            removeImage(index) {
                this.fileInputs.splice(index, 1);
            }
        };
    }





    $(document).on('change', '#country', function() {
        var country_id = $(this).data('country_id');
        console.log('country_id', country_id);
        $(document).on('change', '.country_' + country_id, function() {
            var country = $(".country_" + country_id).val();
            var url = "{{Route('auth.SearchState')}}";
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    'country': country
                },
                success: function(result) {
                    console.log(result);
                    $("#state_" + country_id).html(result);
                }
            });

            $(document).on('change', '#state_' + country_id, function() {
                var state_id = $(this).data('state_id');
                var state = $("#state_" + state_id).val();
                console.log('state_id', state_id);
                console.log('state', state);
                var url = "{{Route('auth.SearchCity')}}";
                $.ajax({
                    url: url,
                    method: "GET",
                    data: {
                        'state': state
                    },
                    success: function(result) {
                        $("#city_" + state_id).html(result);
                    }
                });
            })
        })
    })
    // ======================================= product and service close =================================
    
        var customer_client_id = 2;
        $("#organisational_structure").click(function(e) {
            $(".organisational_structure").fadeIn("1500");
            //Append a new row of code to the "#items" div
            $("#organisational_structure").after(`<div class="row">
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Profile / Positions</b>
                                            <select aria-label="Default select example" name="profile_positions">
                                                <option selected>Select</option>

                                                @foreach($companyProfilePositions as $profile_position)
                                                @if(!empty($ompanyProfile))
                                                <option value="{{$profile_position->id}}" @if ($ompanyProfile->profile_positions == $profile_position->id) selected @endif>{{$profile_position->profile_position}}</option>
                                                @else
                                                <option value="{{$profile_position->id}}">{{$profile_position->profile_position}}</option>
                                                @endif
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Name</b>
                                            <input type="text" placeholder="Enter Name" name="organisational_structre_name" value="{{$ompanyProfile->organisational_structre_name ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Email</b>
                                            <input type="email" placeholder="Enter Name" name="organisational_structre_email" value="{{$ompanyProfile->organisational_structre_email ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Images</b>
                                            <div class="form-group" x-data="fileUploadComponent('organisationalstructreBody','organisational-logo-preview')">
                                                <div class="input-group">
                                                    <input type="file" x-ref="file" @change="displayImage" name="Organisational_image" class="d-none">
                                                    <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileName">
                                                    <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                                                </div>
                                                <div class="addded-team mt-1 organisational-logo-preview" style="display: none;">
                                                    <span>
                                                        <img x-bind:src="imagePreview" alt="Selected Image" onerror="img_onError(this)">
                                                    </span>
                                                    <div>
                                                        <strong>FileName:</strong><small x-text="fileName"></small>
                                                    </div>

                                                </div>
                                                @if(!empty($ompanyProfile))
                                                <div class="addded-team mt-1 organisationalstructreBody" data-organisational-container-id="{{ $ompanyProfile->id }}">
                                                    <a href="{{route('organisational_structre.delete', $ompanyProfile->id)}}" class="close-icon organisational-link" data-id="{{ $ompanyProfile->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                                    <span><img src="{{ asset($ompanyProfile->Organisational_image) }}" onerror="img_onError(this)"></span>
                                                    <div>
                                                        <strong>FileName:</strong><small>{{ pathinfo($ompanyProfile->Organisational_image, PATHINFO_BASENAME) }}</small>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="addded-team mt-1 organisationalstructreBody" data-organisational-container-id="">
                                                    <a href="" class="close-icon organisational-link" data-id=""><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}" onerror="img_onError(this)"></a>
                                                    <span><img src=""></span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>`);
            customer_client_id++;
        });




        $("body").on("click", ".delCustomerAndCient", function(e) {
            let data_id = $(this).data('id');
            $("#accordionCustomerAndClient-remo-" + data_id).remove();
        });
</script>
<script>
  // Get the input element
  var employeeInput = document.getElementById('employeeInput12');

  // Event listener to check input value
  employeeInput.addEventListener('input', function() {
    // Parse input value to ensure it's a number
    var inputValue = parseInt(employeeInput.value);

    // Check if the entered value exceeds the maximum
    if (inputValue > 1000000) {
      // Set the input value to the maximum if it exceeds
      employeeInput.value = 1000000;
    }
  });
</script>
@endsection

@push('custom-script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
@endpush
