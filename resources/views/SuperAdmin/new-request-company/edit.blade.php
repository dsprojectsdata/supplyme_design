@extends('SuperAdmin.layout.app')
@section('superadmincontent')

<style>

table {
    table-layout:auto;
}
td {overflow:hidden; white-space:nowrap}
</style>
<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
            <!-- Row -->
            <!-- ================= page header open ================= -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">New Request Company</h2>
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">New Request Companies </a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$company->company_approve_status}}</li>
                    </ol>
                  
                       
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">

                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('new.request.index') }}" class="text-white"> <i
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
                        <h6 class="main-content-label mb-1">Company Details</h6>
                            <!-- company open -->
                                    @if($company)
                                        <table class="table dtr-details" width="100%">
                                            <tbody>
                                                <tr>
                                                    <th>Company Name :</th>
                                                    <td>{{ $company ? $company->company_name : ' '}}</td>
                                                    <th>Owner Name :</th>
                                                    <td>{{ $company->user_id ? $company->user->firstname : ' ' }} {{ $company->user_id ? $company->user->lastname : ' ' }} </td>
                                                </tr>
                                                <tr>
                                                </tr>
                                                <tr>
                                                    <th>Company Type :</th>
                                                    <td>{{ $company->company_type == 'Select Company Type' ? '' : $company->company_type }}</td>
                                                    <th>Phone Number :</th>
                                                    <td>+{{ $company ? $company->country_code : ' ' }}{{ $company ? $company->phone_number : ' ' }}</td>
                                                    
                                                </tr>
                                                <tr>
                                                    <th>Company Address :</th>
                                                    <td>{{ $company ? $company->address : ' '}}</td>
                                                    <th>City :</th>
                                                    <td>{{ $company ? ($company->City ? $company->City->name : ' ') : ' ' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>State :</th>
                                                    <td>{{ $company ? $company->State->name : ' ' }}</td>
                                                    <th>Country :</th>
                                                    <td>{{ $company ? $company->Countrie->name : ' ' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Zipcode :</th>
                                                    <td>{{ $company ? $company->zipcode : ' ' }}</td>
                                                    <th>Company Email :</th>
                                                    <td>{{ $company ? $company->company_email : ' ' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Product & Services :</th>
                                                    <td>{{ $company ? str_replace(',', ', ', $company->company_category) : ' ' }}</td>
                                                    <th>Company Registration Date :</th>
                                                    <td>{{ $company ? $company->created_at->format('Y-m-d') : ' ' }}</td>
                                                </tr>
                                                <tr>
                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                        @else
                                        <div class="text-center">
                                            <img style="max-width: 250px" src="{{ asset('storage/no-data.jpg') }}" alt="no-data" onerror="img_onError(this)">
                                        </div>
                                        @endif
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
                                        <td> {{$company ? ($company->user ? $company->user->phone_number : ' ') : ' ' }} </td>
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
            
                 <!-- second close  -->
                <!-- Third card open -->
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <h6 class="main-content-label mb-1">Documents</h6>
                            @if($image)
                            <div class="row">
                                @foreach($image as $img)
                                    <div class="col-2">
                                        <div class="row"> 
                                            <a href="{{ asset($img->document_path) }}" target="__blank">
                                                <div class="col-sm-12" style="text-transform:capitalize;"> &nbsp;&nbsp;&nbsp; {{$img->documnet_name}}
                                                    <i class="fa fa-cloud-download text-success"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center">
                                <img style="max-width: 250px" src="{{ asset('storage/no-data.jpg') }}" alt="no-data" onerror="img_onError(this)">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Third card close -->

                <!-- fourth card open -->
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <h6 class="main-content-label mb-1">Action</h6>
                            <div class="row">
                                <div class="col-6">
                                    <!-- test open -->
                                    {{---<div class="row row-xs align-items-center mg-b-20">
										<div class="col-md-4">
											<label class="mg-b-0">Enable :</label>
										</div>
										<div class="col-md-8 mg-t-5 mg-md-t-0">
                                        @if($company->approved_status == 1)
                                            <label class="custom-switch">
                                                <input type="checkbox" name="custom-switch-checkbox" onclick="claimed_status(this,{{$company->id}})" class="custom-switch-input" >
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                            @else
                                            <label class="custom-switch">
                                                <input type="checkbox" name="custom-switch-checkbox" onclick="claimed_status(this,{{$company->id}})" class="custom-switch-input" checked >
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                            @endif
										</div>
									</div>---}}
                                    <!-- test close -->
                                </div> 
                                <div class="col-6"></div>
                                <div class="col-6">
                                    <form action="{{ route('new.request.accept.reject', $company->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="company_approve_status" id="accepted" checked value="accepted" <?php echo ($company->company_approve_status === 'accepted') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="accepted">Accepted</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="company_approve_status" id="pending" value="pending" <?php echo ($company->company_approve_status === 'pending') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="pending">Pending</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="company_approve_status" id="rejected" value="rejected" <?php echo ($company->company_approve_status === 'rejected') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="rejected">Rejected</label>
                                        </div>
                                        <br>
                                        <button type="submit" value="submit" class="btn btn-primary my-2 btn-icon-text">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fourth card close -->
            </div>

        </div>
    </div>
</div>



<script type="text/javascript">
	
function claimed_status(thiss,id){
    if(thiss.innerHTML=='Claimed')
    {
        var claimed_status='Desabled';
    }
    else
    {
        var claimed_status='Enabled'; 
    }
   var ok= confirm( "Are you sure,change this to " + claimed_status);
   if(ok==true)
   {
    url = "{{ url('superadmin/claimed_status') }}/"+id
    $.get( url, function() {
        location.reload();
    });
}
}
</script>
@endsection
