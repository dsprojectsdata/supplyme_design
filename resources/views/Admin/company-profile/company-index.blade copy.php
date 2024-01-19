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
</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="main-content px-md-4 px-2 py-4" style="margin-top:57px">
    <!-- Welcome -->
    <div class="d-block flex-wrap gap-3 welcomeBox">
        <div class="title pb-4 d-flex flex-column w-100 gap-2">
            <h2 class=" position-relative"> Your company Profile
                <!-- <span> <a href="{{route('company.profile')}}" class="btn btn-primary">view company profile</a> </span>   </h2> -->
                <div class="d-md-flex justify-content-between">
                    <p class="pb-2">Complete all necessary steps to your Company Profile </p>
                    <span class="badge border border-success text-success " style="background: #19875414;">Avg.completion
                        time ~ 15mins</span>
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
                                    Organisational Structre</a>
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
                                <p>A short description about the Product Details required.</p>
                            </div>
                            <div class="accordion accordion-flush">

                                <div class="row gap-3 gap-xl-0">
                                    <div class="row gap-3 gap-xl-0 " id="accordion-body-companyProfile">

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b>Company Name</b>
                                                <input type="text" placeholder="Brands Name" name="new_company_name" value="{{ !empty($company->company_name) ? $company->company_name : 'not found' }}" />
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b>Company Logo</b>

                                                <div class="form-group" x-data="{ fileName: '' }">
                                                    <div class="input-group">
                                                        <input type="file" x-ref="file" @change="fileName = $refs.file.files[0].name" name="company_logo" class="d-none">
                                                        <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileName">
                                                        <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                                                    </div>
                                                    <!-- company logo open -->
                                                    @if(!empty($ompanyProfile))
                                                    <div class="addded-team company_lgo  mt-1" data-companylogoContainer-id="{{ $ompanyProfile->id }}">
                                                        <a href="{{route('company.logo.delete',$ompanyProfile->id)}}" class="close-icon companylgo-link" data-id="{{ $ompanyProfile->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                                        <span><img src="{{ asset($ompanyProfile->company_logo) }}"></span>
                                                    </div>
                                                    @else

                                                    @endif
                                                    <!-- company logo close -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b>Type of Company</b>
                                                <select aria-label="Default select example" name="type_of_company">
                                                    <option value="" selected>Select</option>

                                                    @foreach($typesOfCompany as $typCmpny)
                                                    @if(!empty($ompanyProfile))
                                                    <option @if ($ompanyProfile->type_of_company == $typCmpny->id ) selected @endif  data-typeofcompany_id="{{$typCmpny->id}}" value="{{$typCmpny->id}}"> {{$typCmpny->type_name}} </option>
                                                    @else

                                                    <option data-typeofcompany_id="{{$typCmpny->id}}" value="{{$typCmpny->id}}"> {{$typCmpny->type_name}} </option>

                                                    @endif



                                                    @endforeach
                                                </select>



                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b>Certification</b>
                                                <select aria-label="Default select example" name="certificate">
                                                    <option selected>Select</option>
                                                    @foreach($companyCertification as $certification)
                                                    @if(!empty($ompanyProfile))
                                                    <option value="{{$certification->id}}" @if ($ompanyProfile->certificate == $certification->id) selected @endif>{{$certification->certification}}</option>
                                                    @else
                                                    <option value="{{$certification->id}}">{{$certification->certification}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b>Category</b>



                                                <select id="companycategory" class="companycategory_1" name="company_category_id" data-companycategory_id="1">
                                                    <option value="">Select Category</option>
                                                    @foreach($category as $key=>$cat)
                                                    @if(!empty($ompanyProfile))
                                                    <option {{$ompanyProfile->company_category_id == $cat->id ? 'selected' : ' ' }} value="{{ $cat->id }}"> {{ $cat->name }} </option>

                                                    @else
                                                    <option value="{{ $cat->id }}"> {{ $cat->name }} </option>
                                                    @endif
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b>Sub Category </b>
                                                <select id="subcategory_1" name="company_subcategory_id" data-subcategory_id="1">
                                                  <option value="">Sub-Category</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b>Industry</b>
                                                <select aria-label="Default select example" name="industry">
                                                    <option selected>Select</option>
                                                    @foreach($companyIndustry as $industry)
                                                    @if(!empty($ompanyProfile))
                                                    <option value="{{$industry->id}}" @if ($ompanyProfile->industry == $industry->id) selected @endif>{{$industry->industry}}</option>
                                                    @else
                                                    <option value="{{$industry->id}}">{{$industry->industry}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b>Brand Name</b>
                                                @if(!empty($ompanyProfile))
                                                <input type="text" placeholder="Brands Name" name="brand_name" value="{{$ompanyProfile->brand_name}}" />

                                                @else
                                                <input type="text" placeholder="Brands Name" name="brand_name" />
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b>Brands Logo</b>

                                                <div class="form-group mt-1" x-data="{'fileName'}">
                                                    <div class="input-group">
                                                        <input type="file" x-ref="file" @change="fileName = ." name="brand_logo[]" class="d-none" value="">
                                                        <input type="text" class="form-control form-control-lg" x-model="fileName">
                                                        <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
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

                                        @foreach($brandWebsitesLogo as $website)



                                        <div class="row mt-1">

                                            <div class="addded-team company_brand_lgo" data-brandContainer-id="{{ $website->id }}">
                                                <a href="{{route('brnad.logo.delete',$website->id)}}" class="close-icon companyBrandlgo-link" data-id="{{ $website->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                                <span><img src="{{ asset($website->brand_logo) }}"></span>
                                                <div class="addded-iner">
                                                    <h2 id="member-name">{{$website->brand_website}}</h2>
                                                    <label class="addded-text">
                                                        <b>Brand name - <em id="member-position">{{$website->brand_website}}</em></b>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>



                                        @endforeach

                                    </div> <!---- close add type ---->
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3 mt-1">


                                        <div class="input-wrapper">
                                            <a class="btn btn-outline-primary add-icon" id="add-brandName"> + Add Brand Name</a>
                                            <a class="delete-brandName btn btn-outline-danger text-dark"> - Remove Brand Name</a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="row gap-3 gap-xl-0" id="accordion-body-Exchange">
                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b>Started In</b>
                                                @if(!empty($ompanyProfile))
                                                <input type="Date" placeholder="Brand Website" name="started_in" value="{{$ompanyProfile->started_in}}" />
                                                @else
                                                <input type="Date" placeholder="Brand Website" name="started_in" />
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b>Number of Employee</b>
                                                <select name="number_of_employee" id="">
                                                    @if(!empty($ompanyProfile))
                                                    <option value="default">Select Number Of employee</option>
                                                    <option value="1-10" @if ($ompanyProfile->number_of_employee === '1-10') selected @endif>1-10</option>
                                                    <option value="11-50" @if ($ompanyProfile->number_of_employee === '11-50') selected @endif>11-50</option>
                                                    <option value="51-100" @if ($ompanyProfile->number_of_employee === '51-100') selected @endif>51-100</option>
                                                    <option value="101-150" @if ($ompanyProfile->number_of_employee === '101-150') selected @endif>101-150</option>
                                                    <option value="151-250" @if ($ompanyProfile->number_of_employee === '151-250') selected @endif>151-250</option>

                                                    @else
                                                    <option value="default">Select Number Of employee</option>
                                                    <option value="1-10">1-10</option>
                                                    <option value="11-50">11-50</option>
                                                    <option value="51-100">51-100</option>
                                                    <option value="101-150">101-150</option>
                                                    <option value="151-250">151-250</option>
                                                    @endif
                                                </select>


                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                            <div class="input-wrapper">
                                                <b> About Company </b>
                                                @if(!empty($ompanyProfile))
                                                <textarea name="about_company" value="{{$ompanyProfile->about_company}}">{{$ompanyProfile->about_company}}</textarea>

                                                @else
                                                <textarea name="about_company"></textarea>
                                                @endif
                                            </div>
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
                                            Reg.Address Office Address
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">

                                            <div class="row gap-3 gap-xl-0">
                                                <div class="row gap-3 gap-xl-0" id="body-addAnotherAddress">
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
                                                                <option value="{{$country->id}}">{{$country->emoji}}{{$country->name}}</option>
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
                                                            <input type="text" name="company_zipcode[]" />
                                                        </div>
                                                    </div>

                                                    <!-- reg address view open -->
                                                    @foreach($companyRegAddress as $regAddress)






                                                    <div class="addded-team mt-1 company_location" data-companyLocation_container-id="{{ $regAddress->id }}">
                                                        <a href="{{route('company_location.delete', $regAddress->id)}}" class="close-icon companyLocation-link" data-id="{{ $regAddress->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>

                                                        <span><img src="{{ asset('Admin/assets/dist/images/location-icon.svg') }}"></span>
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

                                                    <!-- reg address view close -->

                                                </div>
                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3 mt-1">
                                                    <a class="btn btn-outline-primary add-icon" id="addAnotherAddress"> + Add Another Address </a>
                                                    <a class="deleteAnotherAddress btn btn-outline-danger text-dark"> - Remove Another Address</a>
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
                                            <div class="row" id="LocationAfterBody">
                                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>Purpose</b>
                                                        <select name="purpose">
                                                            @if(!empty($ompanyProfile))
                                                            <option value="Sales" @if ($ompanyProfile->purpose === 'Sales') selected @endif>Sales</option>
                                                            <option value="HR" @if ($ompanyProfile->purpose === 'HR') selected @endif>HR</option>
                                                            <option value="General" @if ($ompanyProfile->purpose === 'General') selected @endif>General</option>
                                                            @else
                                                            <option value="Sales">Sales</option>
                                                            <option value="HR">HR</option>
                                                            <option value="General">General</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>Name</b>
                                                        @if(!empty($ompanyProfile))
                                                        <input type="text" placeholder="Name" name="name" value="{{$ompanyProfile->useful_information_name}}">
                                                        @else
                                                        <input type="text" placeholder="Name" name="name">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>Email</b>
                                                        @if(!empty($ompanyProfile))
                                                        <input type="email" placeholder="email" name="useful_information_email" value="{{$ompanyProfile->useful_information_email}}">

                                                        @else
                                                        <input type="email" placeholder="email" name="useful_information_email">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>Contact Number</b>
                                                        <div class="country-code">
                                                            <select name="phonecode" id="">
                                                                @foreach($countries as $countrie)
                                                                <option value="{{$countrie->phonecode}}"> {{$countrie->phonecode}} -{{$countrie->name}} </option>
                                                                @endforeach
                                                            </select>
                                                            @if(!empty($ompanyProfile))
                                                            <input type="text" name="contact_number" value="{{$ompanyProfile->contact_number}}" />

                                                            @else
                                                            <input type="text" name="contact_number" />
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
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
                                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>Address</b>
                                                        @if(!empty($ompanyProfile))
                                                        <textarea name="mailing_address">{{$ompanyProfile->usfl_info_address}}</textarea>

                                                        @else
                                                        <textarea name="mailing_address"></textarea>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>Country</b>
                                                        <select id="country" class="country_10" name="mailing_country_id" data-country_id="10">
                                                            <option>Select</option>
                                                            @foreach($countries as $countrie)
                                                            <option value="{{$countrie->id}}" class="form-control" @if($countrie->id==$ompanyProfile->usfl_info_country_id) selected @endif> {{$countrie->name}}</option>
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
                                                        @if(!empty($ompanyProfile))
                                                        <input type="text" placeholder="zip code" name="mailing_zipcode" value="{{$ompanyProfile->usfl_info_zipcode}}">

                                                        @else
                                                        <input type="text" placeholder="zip code" name="mailing_zipcode">

                                                        @endif
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
                                                        <b>Contry Name</b>
                                                        <select name="geo_country_name" id="">
                                                            @foreach($countries as $key=>$country)
                                                            <option value="{{$country->id}}">{{$country->emoji}}{{$country->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Geographical Presence close -->

                                <!-- Location open -->
                                <div class="accordion-item border mb-3">
                                    <h2 class="accordion-header" id="heading10">
                                        <button class="accordion-button collapsed" style="background:#EAEFF0;" type="button" data-bs-toggle="collapse" data-bs-target="#collapselocationtab" aria-expanded="false" aria-controls="collapselocationtab">
                                            Location
                                        </button>
                                    </h2>
                                    <div id="collapselocationtab" class="accordion-collapse collapse" aria-labelledby="heading10" data-bs-parent="#accordionLocationExample">
                                        <div class="accordion-body">
                                            <div class="row" id="Location">
                                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>Contry Name</b>
                                                        <select name="geo_country_name" id="location_country" data-country_id="4">
                                                            @foreach($countries as $key=>$country)
                                                            <option value="{{$country->id}} @if($ompanyProfile->company_location_country_id == $country->id) selected @endif">{{$country->emoji}}{{$country->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>State</b>
                                                        <select id="state_4" class="state" name="location_state_id" data-state_id="4">

                                                            <option selected>Select</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>City</b>
                                                        <select id="city_4" name="location_city_id">
                                                            <option selected>Select</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Location close -->

                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-add" role="tabpanel" aria-labelledby="nav-add-tab">
                            <div class="d-flex flex-column pb-4">
                                <h2 class="pb-2">Organisational Structre</h2>
                                <p>Pick an off the shelf bid sheet to get started or download and customise your own bid
                                    sheet</p>
                            </div>


                            <div class="row">
                                <!-- test open-->
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
                                            @if(!empty($ompanyProfile))
                                            <input type="text" placeholder="Enter Name" name="organisational_structre_name" value="{{$ompanyProfile->organisational_structre_name}}">
                                            @else
                                            <input type="text" placeholder="Enter Name" name="organisational_structre_name">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Email</b>
                                            @if(!empty($ompanyProfile))
                                            <input type="text" placeholder="Enter Name" name="organisational_structre_email" value="{{$ompanyProfile->organisational_structre_email}}">

                                            @else
                                            <input type="text" placeholder="Enter Name" name="organisational_structre_email">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Images</b>
                                            <div class="form-group" x-data="{ fileName: '' }">
                                                <div class="input-group">
                                                    <input type="file" x-ref="file" @change="fileName = $refs.file.files[0].name" name="Organisational_image" class="d-none">
                                                    <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileName">
                                                    <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                                                </div>


                                                <!-- company logo open -->
                                                @if(!empty($ompanyProfile))
                                                <div class="addded-team mt-1 organisationalstructreBody" data-organisational-container-id="{{ $ompanyProfile->id }}">
                                                    <a href="{{route('organisational_structre.delete', $ompanyProfile->id)}}" class="close-icon organisational-link" data-id="{{ $ompanyProfile->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                                    <span><img src="{{ asset($ompanyProfile->Organisational_image) }}"></span>
                                                </div>
                                                @else
                                                <div class="addded-team mt-1 organisationalstructreBody" data-organisational-container-id="">
                                                    <a href="" class="close-icon organisational-link" data-id=""><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                                    <span><img src=""></span>
                                                </div>
                                                @endif
                                                <!-- company logo close -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- test close -->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-Product" role="tabpanel" aria-labelledby="nav-Product-tab">
                            <div class="d-flex flex-column pb-4">
                                <h2 class="pb-2">Product and Service</h2>

                            </div>
                            <!--Product and Service  open -->

                            <div class="row gap-3 gap-xl-0">
                                <div class="row" id="body-addProdcutAndService">
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Type of Offering</b>
                                            <select name="type_of_offering[]">
                                                <option selected>Select</option>
                                                @foreach ($companyTypes as $companyType)
                                                <option value="{{ $companyType->id }}" {{$ompanyProfile->type_of_offering ?? '' == $companyType->id ? 'selected' : '' }}>
                                                    {{ $companyType->type_of_offering ?? '' }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
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
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
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
                                                    <input type="radio" id="test1" value="Apple" name="product_currently_export[]" checked="">
                                                    <label for="test1">Apple</label>
                                                </div>
                                                <div class="radio-custme-in">
                                                    <input type="radio" value="Peach" id="test2" name="product_currently_export[]">
                                                    <label for="test2">Peach</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Countries</b>
                                            <select id="country" class="country_4" name="product_country[]" data-country_id="4">
                                                <option>Select</option>
                                                @foreach($countries as $key=>$country)
                                                <option value="{{$country->id}}">{{$country->emoji}}{{$country->name}}</option>
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

                                    <!-- <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                        <div class="row gap-3 gap-md-0">
                                            @foreach($ndas as $nda)
                                            <div class="col-12 col-md-6 col-lg-3 nda-cont">
                                                <figure><iframe src="{{asset($nda->nda_file_name)}}"  id="nda-irame" class="img-fluid mx-auto w-100" alt="page"></iframe> </figure>
                                                <figcaption class="text-center py-3" style="font-size:16px; font-weight:600; color:#000;">{{$nda->nda_file_title}} <a href="{{asset($nda->nda_file_name)}}" download><i class="fa fa-download" aria-hidden="true"></i></a>
                                            </figcaption>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div> -->


                                    <!-- reg address view open -->
                                    @foreach($companyProductService as $prodServs)

                                    <div class="addded-team products-address mt-1" data-container-id="{{ $prodServs->id }}">
                                        <a href="{{route('product.delete', $prodServs->id)}}" class="close-icon delete-link" data-id="{{ $prodServs->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>

                                        <span><img src="{{ asset('Admin/assets/dist/images/location-icon.svg') }}"></span>
                                        <div class="addded-iner">
                                            <h2 id="member-name"> Address {{$prodServs->typeofoffering->type_of_offering}}</h2>

                                            <label class="addded-text">
                                                <b>Category - <em id="member-position">{{$prodServs->categories->name}}</em></b>
                                                <b>SubCategory - <em id="member-position">{{$prodServs->subcategories->name}}</em></b>
                                                <b>Product Name - <em id="member-position">{{$prodServs->product_name}}</em></b>
                                                <b>Product Annual - <em id="member-position">{{$prodServs->product_annual}}</em></b>
                                            </label>
                                            
                                            <label class="addded-text">

                                                <b>Currently Export - <em id="member-position">{{$prodServs->product_currently_export}}</em></b>
                                                <b>Country - <em id="member-position">{{$prodServs->countries->name}}</em></b>
                                                <b>Description - <em id="member-position">{{$prodServs->product_description}}</em></b>

                                            </label>
                                        </div>
                                    </div>
                                    @endforeach

                                    <!-- reg address view close -->

                                    <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                        <h2></h2>
                                    </div>
                                </div> <!---- productAndService close ---->
                                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                    <a class="btn btn-outline-primary add-icon" id="addProdcutAndService"> +Add Anoth Product / Service </a>
                                    <a class="deleteproductandService btn btn-outline-danger text-dark"> - Remove Add Anoth Product / Service</a>
                                </div>

                                <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                    <div class="input-wrapper">
                                        <b>Add Product Catalog</b>
                                        <div class="form-group" x-data="{ fileName: '' }">
                                            <div class="input-group">
                                                <input type="file" x-ref="file" @change="fileName = $refs.file.files[0].name" name="add_product_catalog" class="d-none">
                                                <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileName">
                                                <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- prodcut and service add_product_catalog open -->
                                    @if(!empty($ompanyProfile))
                                    <div class="addded-team mt-1 productCatlog-address" data-product-Container-id="{{ $ompanyProfile->id }}">
                                        <a href="{{route('product_catelog.delete', $ompanyProfile->id)}}" class="close-icon delete-product-link" data-id="{{ $ompanyProfile->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                        <span><img src="{{ asset($ompanyProfile->add_product_catalog) }}"></span>
                                    </div>
                                    @else

                                    @endif
                                    <!-- prodcut and service add_product_catalog close -->
                                </div>


                                <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                    <div class="input-wrapper">
                                        <b>Add Company Brochure</b>
                                        <div class="form-group" x-data="{ fileName: '' }">
                                            <div class="input-group">
                                                <input type="file" x-ref="file" @change="fileName = $refs.file.files[0].name" name="add_company_brochure" class="d-none">
                                                <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileName">
                                                <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- prodcut and service add_company_brochure open -->
                                    @if(!empty($ompanyProfile))

                                    <div class="addded-team mt-1 companyBrochure-address" data-cmpBrochure-Container-id="{{ $ompanyProfile->id }}">
                                        <a href="{{route('company.brochure.delete', $ompanyProfile->id)}}" class="close-icon delete-brochure-link" data-id="{{ $ompanyProfile->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                        <span><img src="{{ asset($ompanyProfile->add_company_brochure) }}"></span>
                                    </div>

                                    @else

                                    @endif
                                    <!-- prodcut and service add_company_brochure close -->
                                </div>
                            </div>

                            <!-- Product and Service  clsoe -->
                        </div>

                        <!-- ######################## customer and client open ##########################################-->
                        <div class="tab-pane fade" id="nav-customer" role="tabpanel" aria-labelledby="nav-customer-tab">

                            <div class="d-flex flex-column pb-4">
                                <h2 class="pb-2">Customers/Client</h2>
                                <p>Pick an off the shelf bid sheet to get started or download and customise your own bid
                                    sheet</p>
                            </div>

                            <div class="row" id="accordionCustomerAndClient">
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
                                        <input type="text" class="mt-1" name="client_website_link[]" value="">
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                    <div class="input-wrapper">
                                        <b>Review Link</b>
                                        <input type="text" class="mt-1" name="client_review_link[]" value="">
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



                                <!-- content show of customer client open -->
                                @foreach($companyCustomerClient as $csclient)
                                <div class="row mt-1 customerClient-address" data-customer-client-container-id="{{ $csclient->id }}">
                                    <div class="addded-team">
                                        <a href="{{route('customer.client.delete', $csclient->id)}}" class="close-icon client-link" data-id="{{ $csclient->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                        <span><img src="{{ asset($csclient->client_company_logo) }}"></span>
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
                                <!-- content show of customer client close -->

                            </div> <!--- close accordian  -->

                            <div class="col-12 col-xl-6 mb-0 mb-xl-3 mt-1">
                                <a class="btn btn-outline-primary add-icon" id="addCustomerAndCient"> + Add Another customer </a>
                                <a class="delCustomerAndCient btn btn-outline-danger text-dark"> - Remove Another Location</a>
                            </div>
                        </div>

                        <!-- ######################## customer and client close ##########################################-->
                        <div class="tab-pane fade" id="nav-useful-information" role="tabpanel" aria-labelledby="nav-useful-information-tab">
                            <div class="d-flex flex-column pb-4">
                                <h2 class="pb-2">Useful Information </h2>
                            </div>
                            <div>
                                <!-- Useful Information open -->
                                <!-- <div class="accordion-item border mb-2">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" style="background:#EAEFF0;"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            Primary old Contact Information
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body company-tabs">
                                            <form>
                                                <div class="row gap-3 gap-xl-0">
                                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                        <div class="input-wrapper">
                                                            <b>Purpose</b>
                                                            <select name="name">
                                                                <option value="Sales">Sales</option>
                                                                <option value="HR">HR</option>
                                                                <option value="General">General</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                        <div class="input-wrapper">
                                                            <b>Name</b>
                                                            <input type="text" name="name"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                        <div class="input-wrapper">
                                                            <b>Email ID</b>
                                                            <input type="text" name="email"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                        <div class="input-wrapper">
                                                            <b>Contact Number</b>
                                                            <div class="country-code">
                                                                <input type="text" placeholder="+91"/>
                                                                <input type="text" placeholder="789548589" name="contact_number"/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                        <h2>Mailing Address </h2>
                                                    </div>

                                                    <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                                        <div class="input-wrapper">
                                                            <b>Address</b>
                                                            <textarea name="address"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                        <div class="input-wrapper">
                                                            <b>Country</b>
                                                            <select id="country" class="country_5"  name="country_id" data-country_id="5">
                                                                    <option >Select</option>
                                                                    @foreach($countries as $key=>$country)
                                                                    <option value="{{$country->id}}" >{{$country->emoji}}{{$country->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                        <div class="input-wrapper">
                                                            <b>State</b>
                                                            <select class="state" name="state_id" id="state_5" data-state-id="5">
                                                            <option selected>Select</option>
                                                        </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                        <div class="input-wrapper">
                                                            <b>City</b>
                                                            <select id="city_2" name="city_id">
                                                                    <option selected>Select</option> 
                                                                </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                        <div class="input-wrapper">
                                                            <b>ZIP Code</b>
                                                            <input type="text" name="zipcode"/>
                                                        </div>
                                                    </div>
                                                </div>
                                         
                                        </div>
                                    </div>
                                </div> -->
                                <!-- Useful Information close -->

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
                                                        <b>Currency type</b>
                                                        <select name="currency_type">
                                                            <option selected>Select</option>

                                                            @foreach($companyCurrency as $currency)
                                                            @if(!empty($ompanyProfile))
                                                            <option value="{{$currency->id}}" @if ($ompanyProfile->currency_type == $currency->id) selected @endif>{{$currency->currency}}</option>
                                                            @else
                                                            <option value="{{$currency->id}}">{{$currency->currency}}</option>
                                                            @endif
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>Annual Revenue</b>
                                                        <select name="annual_revenue">                                                            
                                                            <option selected>Select</option>
                                                            @foreach($companyAnnualRevenues as $annual_revenue)
                                                            @if(!empty($ompanyProfile))
                                                            <option value="{{$annual_revenue->id}}" @if ($ompanyProfile->annual_revenue == $annual_revenue->id) selected @endif>{{$annual_revenue->annual_revenue}}</option>
                                                            @else
                                                            <option value="{{$annual_revenue->id}}">{{$annual_revenue->annual_revenue}}</option>
                                                            @endif
                                                            @endforeach
                                                          
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>Link to Annual Report</b>
                                                        @if(!empty($ompanyProfile))
                                                        <input type="text" placeholder="Link to Annual Report" name="link_to_annual_report" value="{{$ompanyProfile->link_to_annual_report}}">
                                                        @else
                                                        <input type="text" placeholder="Link to Annual Report" name="link_to_annual_report" value="">
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <div class="input-wrapper">
                                                        <b>Link to Annual Report</b>
                                                        <div class="form-group" x-data="{ fileName: '' }">
                                                            <div class="input-group">
                                                                <input type="file" x-ref="file" @change="fileName = $refs.file.files[0].name" name="link_to_annual_report2" class="d-none">
                                                                <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileName">
                                                                <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                                                            </div>

                                                            <!-- company financial open -->
                                                            @if(!empty($ompanyProfile))
                                                            <div class="addded-team mt-1 financial-address" data-financial-Container-id="{{ $ompanyProfile->id }}">
                                                                <a href="{{route('company.financialimage.delete', $ompanyProfile->id)}}" class="close-icon delete-financial-link" data-id="{{ $ompanyProfile->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                                                <span><img src="{{ asset($ompanyProfile->link_to_annual_report2) }}"></span>
                                                            </div>
                                                            @else

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

                        </div>


                        <div class="tab-pane fade" id="nav-useful-links" role="tabpanel" aria-labelledby="nav-useful-links-tab">


                            <div class="d-flex flex-column pb-4">
                                <h2 class="pb-2">Useful Links</h2>
                                <p>Pick an off the shelf bid sheet to get started or download and customise your own bid
                                    sheet</p>
                            </div>




                            <!-- useful link open -->
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="row">
                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Website</b>
                                            @if(!empty($ompanyProfile))
                                            <input type="text" placeholder="Website" name="website" value="{{$ompanyProfile->website}}">
                                            @else
                                            <input type="text" placeholder="Website" name="website">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>LinkedIn</b>
                                            @if(!empty($ompanyProfile))
                                            <input type="text" placeholder="LinkedIn" name="linkedIn" value="{{$ompanyProfile->linkedIn}}">
                                            @else
                                            <input type="text" placeholder="LinkedIn" name="linkedIn" value="">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Facebook</b>
                                            @if(!empty($ompanyProfile))
                                            <input type="text" placeholder="Facebook" name="facebook" value="{{$ompanyProfile->facebook}}">
                                            @else
                                            <input type="text" placeholder="Facebook" name="facebook" value="">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Instagram</b>
                                            @if(!empty($ompanyProfile))

                                            <input type="text" placeholder="Instagram" name="instagram" value="{{$ompanyProfile->instagram}}">

                                            @else
                                            <input type="text" placeholder="Instagram" name="instagram" value="">

                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Twitter</b>
                                            @if(!empty($ompanyProfile))
                                            <input type="text" placeholder="Twitter" name="twitter" value="{{$ompanyProfile->twitter}}">
                                            @else
                                            <input type="text" placeholder="Twitter" name="twitter" value="">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <b>Youtube</b>
                                            @if(!empty($ompanyProfile))
                                            <input type="text" placeholder="Youtube" name="youtube" value="{{$ompanyProfile->youtube}}">
                                            @else
                                            <input type="text" placeholder="Youtube" name="youtube" value="">
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- useful link close -->


                        </div>
                    </div>

                </div>


            </div>
    </div>
</div>
</div>


<div class="d-none d-md-flex py-3 border bg-white justify-content-between position-fixed bottom-0 w-100 px-5" style="border-color:#B4B6BD;">
    <div class="col-12 col-md-4 ">
        <button class="btn px-4 text-white" id="formid" value="submit" type="submit" style="background: #D39D36;">Save
            as Draft</button>
    </div>
    </form>
    <div class="col-12 col-md-8 text-center">
        <button class="btn btn-outline-secondary px-4 me-2" id="prev"><i class="bi bi-chevron-left"></i>
            Previous</button>
        <button class="btn btn-primary px-4" id="next">Next <i class="bi bi-chevron-right"></i></button>
    </div>
</div>



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
  const getsubcategorydata = (category_id = null,sub_category_id=null,data_id = null) => {
      
        if (data_id == null || data_id == '') {
            return
        }
        if (category_id == null) {
            return
        }
        if(sub_category_id==null)
        {
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
        var category_id = "{{$ompanyProfile->company_category_id}}";    
        var sub_category_id = "{{$ompanyProfile->company_sub_category_id}}";          

        getsubcategorydata(category_id,sub_category_id,data_id ="1")
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
        var country_id = "{{$ompanyProfile->usfl_info_country_id}}";
        var state_id = "{{$ompanyProfile->usfl_info_state_id}}";
        var city_id = "{{$ompanyProfile->usfl_info_city_id}}";
        getStateCitydata(country_id, state_id, city_id, data_id = "10");

        getStateCitydata("{{$ompanyProfile->company_location_country_id}}", "{{$ompanyProfile->company_location_state_id}}", "{{$ompanyProfile->company_location_city_id}}", data_id = "4");

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

        var companycategory_id = 2;
        console.log('on change caompany category values' + companycategory_id);
        $("#add-brandName").click(function(e) {
            $(".delete-brandName").fadeIn("1500");
            //Append a new row of code to the "#items" div
            $("#accordion-body-companyProfile").append(`<div class="row gap-3 gap-xl-0" id="accordion-body-companyProfile-remo">
        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
            <div class="input-wrapper">
                <b>Brands Logo</b>
                <div class="form-group" x-data="{ fileName: '' }">
                    <div class="input-group">
                        <input type="file" x-ref="file"
                            @change="fileName = $refs.file.files[0].name" name="brand_logo[]"
                            class="d-none">
                        <input type="text" class="form-control form-control-lg"
                            placeholder="Your Files" x-model="fileName" >
                        <button class="browse btn btn-primary px-4" type="button"
                            x-on:click.prevent="$refs.file.click()">Browse</button>
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

      </div>`);
            companycategory_id++;
        });




        $("body").on("click", ".delete-brandName", function(e) {
            $("#accordion-body-companyProfile-remo").last().remove();
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
            $("#accordionCustomerAndClient").append(`<div class="row gap-3 gap-xl-0 col-12" id="accordionCustomerAndClient-remo">
    
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
</div>`);
            customer_client_id++;
        });




        $("body").on("click", ".delCustomerAndCient", function(e) {
            $("#accordionCustomerAndClient-remo").last().remove();
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
            $("#body-addAnotherAddress").append(`<div class="row gap-3 gap-xl-0" id="body-addAnotherAddress-remo">
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
                <option value="{{$country->id}}">{{$country->emoji}}{{$country->name}}</option>
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
            <input type="text" name="company_zipcode[]" placeholder="">
          </div>
        </div>
      </div>`);
            country_id++;
        });
        $("body").on("click", ".deleteAnotherAddress", function(e) {
            $("#body-addAnotherAddress-remo").last().remove();
        });

    })



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
    // ======================================= Company Location reg office addresss close =================================


    // ##################### product and service open 5 ######################################


    $(".deleteproductandService").hide();
    //when the Add Field button is clicked
    var country_id = 5;
    let productServiceCount = 1;
    $("#addProdcutAndService").click(function(e) {
        $(".deleteproductandService").fadeIn("1500");
        //Append a new row of code to the "#items" div
        $("#body-addProdcutAndService").append(`<div class="row gap-3 gap-xl-0" id="body-addProdcutAndService-remo">
    <div class="input-wrapper">
        <b>Type of Offering</b>
        <select name="type_of_offering[]">
            <option>Product</option>
            <option>Service</option>
        </select>
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
    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
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
                    <input type="radio" value="Apple" id="test1-${productServiceCount}" name="product_currently_export[${productServiceCount}]" checked="">
                    <label for="test1-${productServiceCount}">Apple</label>
                </div>
                <div class="radio-custme-in">
                    <input type="radio" value="Peach" id="test2-${productServiceCount}" name="product_currently_export[${productServiceCount}]">
                    <label for="test2-${productServiceCount}">Peach</label>
                </div>
            </div>
        </div>
    </div>

        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
          <div class="input-wrapper">
            <b>Country</b>
            <select id="country" class="country_${country_id}" name="product_country[]" data-country_id="${country_id}">
              <option >Select</option>
              @foreach($countries as $key=>$country)
                <option value="{{$country->id}}">{{$country->emoji}}{{$country->name}}</option>
            @endforeach
            </select>
          </div>
        </div>
        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
          <div class="input-wrapper">
            <b>State</b>
            <select id="state_${country_id}" name="product_state_id[]" data-state_id="${country_id}">
                <option selected>Select</option>
            </select>
          </div>
        </div>
        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
          <div class="input-wrapper">
            <b>City</b>
            <select id="city_${country_id}" name="product_city_id[]">
                <option selected>Select</option> 
            </select>
          </div>
        </div>
        <div class="col-12 col-xl-12 mb-0 mb-xl-3">
            <div class="input-wrapper">
                <b>Product Description</b>
                <textarea name="product_description[]"></textarea>
            </div>
        </div>
      </div>`);
        country_id++;
        productServiceCount++;
    });
    $("body").on("click", ".deleteproductandService", function(e) {
        $("#body-addProdcutAndService-remo").last().remove();
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
    // ======================================= product and service close =================================
</script>
@endsection