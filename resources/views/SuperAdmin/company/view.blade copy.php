@extends('SuperAdmin.layout.app')
@section('superadmincontent')
<style>
    table {
        table-layout: auto;
    }

    td {
        overflow: hidden;
        white-space: nowrap
    }
    div#example3_filter {
        margin-left: 325px;
    }
</style>

<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
            <!-- Row -->
            <!-- ================= page header open ================= -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Company</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Companies Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Company view</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">

                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('company.index') }}" class="text-white"> <i class="fe fe-arrow-left me-2"></i> Back
                            </a>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="company-profile-basic d-flex align-items-center">
                                        <img style="max-width: 130px" src="{{ asset($company->companyprofile->company_logo??'') }}" alt="{{$company->company_name??'dummy'}}" onerror = img_onError(this)>
                                        <div class="ms-3">
                                            <h5>
                                                @if($company && $company->company_name)
                                                    <h5>{{ $company->company_name }}</h5>
                                                @endif
                                            </h5>
                                            <p class="mb-2">
                                                <!--<i class="fa fa-display me-1"></i> -->
                                                <a href="{{$company->website ??''}}" target="_blank">{{$company->website??''}}</a>
                                            </p>
                                            <div class="d-flex w-100">
                                                <p><i class="fa fa-location-dot"></i> {{$company->City->name ?? ''}} {{$company->State->name??''}} {{$company->Countrie->name??''}}, {{$company->zipcode}}</p>
                                                <p class="ms-3" title="Company followers"><i class="fa fa-users"></i> {{$followers ? $followers : ' 0'}} Followers
                                                </p>
                                                <p class="ms-3" title="Company Registration Date">
                                                    <i class="fa fa-clock-o"></i> 
                                                    {{$company->created_at->format('Y-m-d') ?? ''}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-end">
                                    <a href="{{route('company.edit.profile',[$company->id])}}" class="btn btn-outline-secondary me-auto">
                                        <i class="fa fa-pencil me-2"></i>
                                        Edit
                                    </a>
                                </div>
                            </div>
                            <!-- company close -->
                        </div>
                    </div>
                </div>
                
                                <div class="col-lg-12">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <h6 class="main-content-label mb-1">Owner Details</h6>
                                            @if($company->user)
                                            <table class="table dtr-details" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <th> First Name : </th>
                                                        <td> {{ $company->user_id ? $company->user->firstname : ' ' }} </td>
                                                        <th> Last Name : </th>
                                                        <td> {{ $company->user_id ? $company->user->lastname : ' ' }} </td>    
                                                    </tr>
                                                    <tr>
                                                        <th>Job Role : </th>
                                                        <td>
                                                            @php
                                                                $jobrole = null;
                                                                if ($company->user) {
                                                                    $jobrole = App\Models\Jobrole::where('id', $company->user->Jobrole_id)->first();
                                                                }
                                                            @endphp
                                                            {{ $jobrole->role_name ?? '' }}
                                                        </td>
                                                        <th>email  :</th>
                                                        <td>{{$company ? ($company->user ? $company->user->email : ' ') : ' ' }}</td> 
                                                    </tr>
                                                    <tr>
                                                        <th>Primary User :</th>
                                                        <td>{{$company ? ($company->user ? $company->user->primary_use : ' ') : ' ' }}</td> 
                                                        <th>Phone Number :</th>
                                                        <td>{{$company ? ($company->user ? $company->phone_number : ' ') : ' ' }}</td> 
                                                    </tr>
                                                    <tr>
                                                        <th>Company register Date :</th>
                                                        <td> {{ \Carbon\Carbon::parse($company->user ? $company->user->created_at : ' ')->format('Y-m-d')}} </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            @else
                                            <div class="text-center">
                                                <img style="max-width: 250px" src="{{ asset('storage/no-data.jpg') }}" alt="no-data" onerror="img_onError(this)">
                                            </div>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>


                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="m-0">About</p>
                                <a href="{{route('company.edit.profile',[$company->id])}}" class="btn btn-outline-secondary">
                                    <i class="fa fa-pencil me-2"></i>
                                    Edit
                                </a>
                            </div>
                            <div class="border-bottom border-secondary pt-2"></div>
                            <p class="w-75 my-3">{{$company->companyprofile->about_company??''}}</p>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <p class="text-muted font-weight-bold mb-1">COMPANY TYPE</p>
                                    <p style="font-size: 16px">
                                        {{ $company->company_type ?? ''}}
                                    </p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="text-muted font-weight-bold mb-1">PRODUCT & SERVICES</p>
                                    <p style="font-size: 16px">
                                        {{ $company ? str_replace(',', ', ', $company->company_category) : ' ' }}
                                    </p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="text-muted font-weight-bold mb-1">STARTED IN</p>
                                    <p style="font-size: 16px">{{$company->companyprofile ? $company->companyprofile->started_in_year : ''}}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="text-muted font-weight-bold mb-1">ANNUAL REVENUE</p>
                                    <p style="font-size: 16px">{{$company->companyprofile ? $company->companyprofile->annual_revenue : ''}}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="text-muted font-weight-bold mb-1">NO OF. EMPLOYEES</p>
                                    <p style="font-size: 16px">{{$company->companyprofile ? $company->companyprofile->number_of_employee : ''}}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="text-muted font-weight-bold mb-1">CEO/OWNER</p>
                                    <p style="font-size: 16px">{{$company->user ? $company->user->firstname.' '.$company->user->lastname : ' ' }}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="text-muted font-weight-bold mb-1">HEAD OFFICE ADDRESS</p>
                                    <p style="font-size: 16px">
                                        {{$company ? $company->address :''}},
                                        {{$company ? $company->address2 :''}},
                                        {{ $company->city_id ? $company->City->name : ''}},
                                        {{ $company->state_id ? $company->State->name : ''}},
                                        {{ $company->countrie_id ? $company->Countrie->name : ''}} 
                                    </p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="text-muted font-weight-bold mb-1">KEY PERSONNEL</p>
                                    <p style="font-size: 16px">
                                        {{$company->user ? $company->user->firstname.' '.$company->user->lastname : ' ' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="nav nav-tabs gap-3 position-relative" id="nav-tab" role="tablist">
                                <button class="nav-link py-3 active" id="nav-products-tab" data-bs-toggle="tab" data-bs-target="#nav-products" type="button" role="tab" aria-controls="nav-products" aria-selected="true">
                                    Products ({{$company->companyproductandservices->count()}})
                                </button>
                                <button class="nav-link py-3" id="nav-customer-tab" data-bs-toggle="tab" data-bs-target="#nav-customer" type="button" role="tab" aria-controls="nav-customer" aria-selected="false">
                                    Customers ({{$company->companyprofilecustomerandclients->count()}})
                                </button>
                                <button class="nav-link py-3" id="nav-brand-tab" data-bs-toggle="tab" data-bs-target="#nav-brand" type="button" role="tab" aria-controls="nav-brand" aria-selected="false">
                                    Brands ({{$company->companyprofilebrandlogos->count()}})
                                </button>
                                <a href="{{route('company.edit.profile',[$company->id])}}" class="btn btn-outline-secondary edit-tab-button">
                                    <i class="fa fa-pencil me-2"></i>
                                    Edit
                                </a>
                            </div>
                            <div class="tab-content welcomeBox py-4" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-products" role="tabpanel" aria-labelledby="nav-products-tab">
                                    <div class="d-flex flex-column gap-4">
                                        @if($company->companyproductandservices->count() == 0)
                                        <div class="d-flex gap-3 justify-content-center align-items-center">
                                            <img style="max-width: 250px" src="{{ asset('storage/no-data.jpg') }}" alt="no-data" onerror = img_onError(this)>
                                        </div>
                                        @endif
                                        @foreach($company->companyproductandservices as $product)
                                        <div class="d-flex gap-3 align-items-center mb-3">
                                            @php
                                            $product_images = strpos($product->product_images, ',') !== false
                                            ? explode(",", $product->product_images)
                                            : [$product->product_images] ??[]
                                            @endphp
                                            @if (!empty($product_images[0]))
                                            <img style="max-width: 150px" src="{{ asset($product_images[0]) }}" alt="{{ $product->product_name }}" onerror = img_onError(this)>
                                            @endif
                                            <div class="ms-3">
                                                <h5><strong>{{$product->product_name}}</strong></h5>
                                                @if($product->typeofoffering->slug ?? ''=='product')
                                                <div class="mb-3">
                                                    <strong>Category : </strong>{{$product->categories ? $product->categories->name : ''}}
                                                    <strong>Sub Categories : </strong>{{$product->subcategories ? $product->subcategories->name : ''}}
                                                    <strong>Annual Capacity : </strong>{{$product->product_annual ? $product->product_annual : 0}}
                                                    @if($product->product_currently_export=='yes')
                                                    <strong>Export Country : </strong>{{$product->countries->name ?? ''}}
                                                    @endif
                                                </div>
                                                @else

                                                @endif
                                                <p><strong>Description : </strong>{{$product->product_description??''}}</p>
                                                <div class="d-flex gap-3">
                                                    @foreach($product_images as $key=>$pro_image)
                                                    <img style="max-width: 80px" src="{{ asset($pro_image) }}" alt="{{$product->product_name . $key }}" onerror = img_onError(this)>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="nav-customer" role="tabpanel" aria-labelledby="nav-customer-tab">
                                    <div class="d-flex flex-column gap-4">
                                        @if($company->companyprofilecustomerandclients->count() == 0)
                                        <div class="d-flex gap-3 justify-content-center align-items-center">
                                            <img style="max-width: 250px" src="{{ asset('storage/no-data.jpg') }}" alt="no-data" onerror = img_onError(this)>
                                        </div>
                                        @endif
                                        @foreach($company->companyprofilecustomerandclients as $csclient)
                                        <div class="d-flex gap-3 align-items-center mb-3">
                                            <img style="max-width: 100px;" src="{{ asset($csclient->client_company_logo) }}" alt="{{$csclient->client_company_name}}" onerror = img_onError(this)>
                                            <div class="ms-3">
                                                <h4> <strong>Company : </strong>{{$csclient->client_company_name}}</h4>
                                                <strong>Review - </strong>{{$csclient->client_review_link}}
                                                <strong>Website - </strong>{{$csclient->client_website_link}}
                                                <strong>Product - </strong>{{$csclient->client_product_or_service}}
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="nav-brand" role="tabpanel" aria-labelledby="nav-brand-tab">
                                    <div class="d-flex flex-column gap-4">
                                        @if($company->companyprofilebrandlogos->count() == 0)
                                        <div class="d-flex gap-3 justify-content-center align-items-center">
                                            <img style="max-width: 250px" src="{{ asset('storage/no-data.jpg') }}" alt="no-data" onerror = img_onError(this)>
                                        </div>
                                        @endif
                                        @foreach($company->companyprofilebrandlogos as $brand)
                                        <div class="d-flex gap-3 align-items-center mb-3">
                                            <img style="max-width: 100px;" src="{{ asset($brand->brand_logo) }}" alt="{{$brand->brand_name}}" onerror = img_onError(this)>
                                            <div class="ms-3">
                                                <h4>{{$brand->brand_name}}</h4>
                                                <strong>Website - </strong>{{$brand->brand_website}}
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- team member -->
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <h6 class="main-content-label mb-4">Team Member Details</h6>
                            <div class="table-responsive">
                                <table id="example3" class="table table-striped table-bordered text-nowrap">
                                    <thead>
										<tr>
											<th>S.no</th>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Job Role </th>
											<th>Email</th>
											<!--<th>Phone No</th>-->
											<th>Primary User</th>
											<th>Register Date</th>
											<th>Status</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teamMembers as $key => $teamMember)
                                         @php
                                             $jobrole = App\Models\Jobrole::where('id',$teamMember->Jobrole_id)->first();
                                         @endphp
                                            <tr>
                                                <td> {{ $key+1 }} </td>
                                                <td> {{ $teamMember ? $teamMember->firstname : '' }} </td>
                                                <td> {{ $teamMember ? $teamMember->lastname : '' }} </td>
                                                <td> {{ $jobrole ? $jobrole->role_name : ' '  }} </td>
                                                <td> {{ $teamMember ? $teamMember->email : '' }}</td>
                                                <!--<td> {{ $teamMember ? $teamMember->phone_number : '' }}</td>-->
                                                <td> {{ $teamMember ? $teamMember->primary_use : '' }} </td>
                                                <td> {{ \Carbon\Carbon::parse($teamMember->user ? $teamMember->user->created_at : ' ')->format('Y-m-d')}} </td>
                                                <td>
													@if($teamMember->team_member_status == 0)
													<label class="custom-switch">
														<input type="checkbox" name="custom-switch-checkbox" onclick="statusTeamMember(this,{{$teamMember->id}})" class="custom-switch-input"> 
														<span class="custom-switch-indicator" style="background-color:red;"></span>
													</label>
													@else
													<label class="custom-switch">
														<input type="checkbox" name="custom-switch-checkbox" onclick="statusTeamMember(this,{{$teamMember->id}})" class="custom-switch-input" checked > 
														<span class="custom-switch-indicator" style="background-color:green;"></span>
													</label>
													@endif
												</td>
                                            </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- second close  -->
                <!-- Third card open -->
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <h6 class="main-content-label mb-1">Documents</h6>
                            <div class="row">
                                @if($image)
                                    @foreach($image as $img)
                                        <div class="col-2">
                                            <div class="row"> 
                                                @if($img->document_path)
                                                    <a href="{{ asset($img->document_path) }}" target="__blank">
                                                        <div class="col-sm-12" style="text-transform:capitalize;"> &nbsp;&nbsp;&nbsp; {{$img->documnet_name}}
                                                            <i class="fa fa-cloud-download text-success"></i>
                                                        </div>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                <div class="text-center">
                                    <img style="max-width: 250px" src="{{ asset('storage/no-data.jpg') }}" alt="no-data" onerror="img_onError(this)">
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Third card close -->

                <!-- fourth card open -->
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="row">
                                <h6 class="main-content-label mb-1">Action Company Claime & Un-Claime Status :</h6>

                                <td>
                                    @if ($company->claimed_status == 0)
                                    <label class="custom-switch">
                                        <input type="checkbox" name="custom-switch-checkbox" onclick='claimed_status(this,"{{ $company->id }}")' class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch">
                                        <input type="checkbox" name="custom-switch-checkbox" onclick='claimed_status(this,"{{ $company->id }}")' class="custom-switch-input" checked>
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                    @endif
                                </td>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- fourth card close -->

                <!-- fifth card open -->
                <!--<div class="col-lg-12">-->
                <!--    <div class="card custom-card">-->
                <!--        <div class="card-body">-->
                <!--            <h6 class="main-content-label mb-1">Category</h6>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!-- fifth card close -->
            </div>

        </div>
    </div>
</div>

<style>
    .nav-tabs .nav-link.active {
        color: #4682e3;
        border-bottom: 1px solid #4574dd;
    }

    .nav-tabs .nav-link {
        color: #222222;
        font-weight: 800;
        font-size: 14px;
        border: none;
    }

    .nav-tabs {
        border-bottom: 1px solid #dee2e6;
    }

    .nav-tabs .nav-link:hover,
    .nav-tabs .nav-link:focus {
        background-color: unset;
        color: #4682e3 !important;
    }

    .edit-tab-button {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translate(0, -50%)
    }
</style>

    <script type="text/javascript">
        function claimed_status(thiss, id) {
            if (thiss.innerHTML == 'Claimed') {
                var claimed_status = 'Un-Claimed';
            } else {
                var claimed_status = 'Claimed';
            }
            var ok = confirm("Are you sure,change this to " + claimed_status);
            if (ok == true) {
                url = "{{ url('superadmin/claimed_status') }}/" + id
                $.get(url, function() {
                    location.reload();
                });
            }
        }
    
        function img_onError(_this) {
            _this.src = "{{asset('storage/dummy-image.jpg')}}";
        }
    </script>
    
    <script>
        function statusTeamMember(thiss,id){
            if(thiss.innerHTML=='Enabled')
            {
                var team_member_status='Disabled';
            }
            else
            {
                var team_member_status='Enabled'; 
            }
           var ok= confirm( "Are you sure,change this to "+team_member_status);
           if(ok==true)
           {
                url = "{{ url('superadmin/team-member-status') }}/"+id
                $.get( url, function() {
                    location.reload();
                });
            }
        }
    </script> 
    
@endsection