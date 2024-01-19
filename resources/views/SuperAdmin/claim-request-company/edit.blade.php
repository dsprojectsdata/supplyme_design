@extends('SuperAdmin.layout.app')
@section('superadmincontent')


<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
            <!-- Row -->
            <!-- ================= page header open ================= -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Claim Request</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Claim</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Claim Request Edit</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">

                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('claim.request.index') }}" class="text-white"> <i
                                    class="fe fe-arrow-left me-2"></i> Back To Dashboard
                            </a>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body"> 
                        <h6 class="main-content-label mb-1"> <i class="fa fa-building-o" aria-hidden="true"></i> Company Details </h6> <hr>
                            <table class="table dtr-details" width="100%">
                                <tbody>
                                                <tr>
                                                    <th>Company Name :</th>
                                                    <td>{{ $resource->company_name }}</td>
                                                    <th>Owner :</th>
                                                    <td>{{ $resource->user_id ? $resource->user->firstname : '' }} </td>
                                                </tr>
                                                <tr>
                                                    
                                                </tr>
                                                <tr>
                                                    <th>Company Type :</th>
                                                    <td>{{ $resource->company_type }}</td>
                                                    <th>Phone Number :</th>
                                                    <td>{{$resource->country_code}},{{ $resource->phone_number }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Company Address :</th>
                                                    <td>{{ $resource->address }} {{ $resource->address2 }}</td>
                                                      <th>Company Email :</th>
                                                    <td>{{ $resource->company_email }}</td>
                                                   
                                                </tr>
                                                <tr>
                                                    <th>State :</th>
                                                    <td>{{ $resource->State->name }}</td>
                                                    <th>Country :</th>
                                                    <td>{{ $resource->Countrie->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Zipcode :</th>
                                                    <td>{{ $resource->zipcode }}</td>
                                                    <th>Company Type :</th>
                                                    <td>{{ $resource->company_type }}</td>
                                                </tr>
                                                <tr>
                                                   
                                                    <th>Company Category :</th>
                                                    <td>{{ $resource->company_category }}</td>
                                                </tr>
                                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- user details open 1.1  -->
                @foreach($gettingUserDetails as $userD)
                 @if($userD)
                 @php
                   $Jobrole = App\Models\Jobrole::where('id',$userD->Jobrole_id)->first();
                 @endphp
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                        <h6 class="main-content-label mb-1"> <i class="fa fa-user" aria-hidden="true"></i> User Details</h6>
                            <div class="row">
                                <table class="table">
                                  <tr>
                                    <th>User Name : </th>
                                    <td>{{ $userD->firstname .' '. $userD->lastname }} </td>
                                    <th>Address : </th>
                                    <td>{{$userD ? $userD->address.' '. $userD->address_line_1 : ''}}</td>
                                </tr>
                                  <tr>
                                      <th>Joblevel : </th>
                                      <td>{{$Jobrole ? $Jobrole->role_name : ''}}</td>
                                      <th>City : </th>
                                      <td>{{$resource ? $resource->city->name : ''}}</td>
                                  </tr>
                                  <tr>
                                        <th>Company Registration Date : </th>
                                        <td> {{ \Carbon\Carbon::parse($userD ? $userD->created_at : '')->format('d/m/Y g:i:s A')}} </td>
                                    </tr>
                                  
                                </table>
                                <table>
                                    <tr>
                                         <h6 class="main-content-label mb-1">Documents</h6><br>
                                        @foreach($userDocuments as $img)
                                            @if($userD->id == $img->user_id ) 
                                                <div class="col-3">
                                                    <div class="row"> 
                                                        <div class="col-sm-12">
                                                                <a href="{{ asset($img->document_path) }}" target="__blank">
                                                        </div>
                                                        <div class="col-sm-12" style="text-transform:capitalize;"> &nbsp;&nbsp;&nbsp; {{$img->documnet_title}}
                                                            <i class="fa fa-cloud-download text-success"></i></a>
                                                        </div>
                                                    </div>
                                                </div>    
                                            @endif
                                        @endforeach
                                    </tr>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
                 @endif
                @endforeach
                <!-- user details close 1.1 -->
                <!-- company document open -->
               
                <!-- company document close -->
            </div>
        </div>
        <!-- End Row -->
    </div>
</div>
</div>

@endsection
