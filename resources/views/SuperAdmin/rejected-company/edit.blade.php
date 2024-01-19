@extends('SuperAdmin.layout.app')
@section('superadmincontent')


<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
            <!-- Row -->
            <!-- ================= page header open ================= -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Rejected Company Edit</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Rejected Company</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rejected Company Edit</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('rejected.company.index') }}" class="text-white"> <i
                                    class="fe fe-arrow-left me-2"></i> Back 
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
                        <table class="table">
                                <tr>
                                    <th>Company Name : </th>
                                    <td> {{$resource->company_name}} </td>
                            
                                    <th>website : </th>
                                    <td>{{$resource->website}}</td>
                               
                                    <th>Address : </th>
                                    <td>{{$resource->address}}</td>
                                </tr>
                                <tr>
                                    <th>County : </th>
                                    <td>{{$resource->Countrie->name}}</td>

                                    <th>State : </th>
                                    <td>{{$resource->state->name}}</td>
                              
                                    <th>City : </th>
                                    <td>{{$resource->city->name}}</td>
                                   
                                </tr>
                                <tr>
                                    <th>Company Type : </th>
                                    <td>{{$resource->company_type}}</td>

                                    <th>Company Category : </th>
                                    <td>{{$resource->company_category}}</td>
                               
                                    <th>Company Email : </th>
                                    <td>{{$resource->company_email}}</td>
                                </tr>
                                <tr>
                                    <th>Phone Number : </th>
                                    <td>{{$resource->phone_number}}</td>

                                    <th>Contact Number : </th>
                                    <td>{{$resource->contact_number}}</td>
                               
                                    <th>Company Registration Date : </th>
                                    <td> {{ \Carbon\Carbon::parse($resource->created_at)->format('d/m/Y g:i:s A')}} </td>
                                </tr>

                                <!-- action open -->
                                <tr>
                                    <th></th>
                                    <td></td>
                                    <th></th>
                                    <td></td>
                                    <th>Action</th>
                                    <td>
                                        <form action="{{ route('reject.company.update', $resource->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="company_approve_status" value="0">
                                                <select name="company_approve_status" class="form-control select select2">
                                                    <option> -- Select -- </option>
                                                    <option value="new"> New</option>
                                                    <option value="pending"> Pending</option>
                                                    <option value="accepted"> Accepted</option>
                                                    <option value="rejected"> Rejected</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary my-2 btn-icon-text"> Update </button>
                                            </form>
                                    </td>
                                </tr>
                                <!-- action close -->
                        </table>
                        
                        </div>
                    </div>
                </div>
                


                <!-- user details open 1.1  -->


               

                
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                        <h6 class="main-content-label mb-1"> <i class="fa fa-user" aria-hidden="true"></i> User Details</h6>
                            <div class="row">
                                @if($userD)
                                  <table class="table">
                             
                                <tr>
                                    <th>User Name : </th>
                                    <td>{{$userD ? ($userD->firstname .' '. $userD->lastname) : ' ' }} </td>
                                    <th>website : </th>
                                    <td>{{$userD->website}}</td>
                                    <th>Address : </th>
                                    <td>{{$userD->address}}</td>
                                </tr>
                                
                                <tr>
                              <th>Address line 1 : </th>
                              <td>{{$userD->address_line_1}}</td>
                         
                              <th>Joblevel : </th>
                              <td>{{$userD->joblevel}}</td>
                          
                              <th>City : </th>
                              <td>{{$resource->city->name}}</td>
                          </tr>
                          <tr>
                              <th>State : </th>
                              <td> {{$resource->state->name}}</td>
                              
                              <th>Country : </th>
                              <td>{{$userD->countrie}}</td>
                              
                              <th>About Us : </th>
                              <td>{{$userD->about_us}}</td>
                          </tr>
                            <tr>
                                <th>Primary Use : </th>
                                <td>{{$userD->primary_use}}</td>
                                <th>User Type : </th>
                                <td>{{$userD->usertype}}</td>
                                <th>Company Registration Date : </th>
                                <td> {{ \Carbon\Carbon::parse($userD->created_at)->format('d/m/Y g:i:s A')}} </td>
                            </tr>
                                
                                </table>
                                @endif
                                <table>
                                 @if($userD)   
                                <tr>
                                    @foreach($userDocuments as $img)
                                        @if($userD->id == $img->user_id) 
                                            <div class="col-3">
                                                <div class="row"> 
                                                    <div class="col-sm-12">
                                                            <img src="{{ asset($img->document_path) }}"
                                                            style="width:170px; height:100px; margin-left:10px;" class="mb-2 shadow">
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
                                @endif
                                </table>
                                <!-- for document display close -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- user details close 1.1 -->
                
            </div>
        </div>
        <!-- End Row -->
    </div>
</div>
</div>

@endsection
