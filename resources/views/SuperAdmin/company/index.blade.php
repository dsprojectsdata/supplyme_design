@extends('SuperAdmin.layout.app')
@section('superadmincontent')

<style>
    .dataTables_wrapper .dataTables_filter {
        margin-left: 323px;
        border: 0px solid #e8e8f7;
    }
    div#example3_filter {
    margin-left: 325px;
}
</style>
<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
            <!-- ================= page header open ================= -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Companies</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Companies dashboard</li>
                    </ol>
                </div>
                
            </div>
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
							<!-- company open -->

                            <div class="table-responsive">
                                <table id="example3" class="table table-striped table-bordered text-nowrap">
                                    <thead>
										<tr>
											<th>S.no</th>
											<th>Company Name</th>
											<th>Company Type</th>
											<th>Owner </th>
											<th>Address</th>
											<th>Phone Number</th>
											<th>Company Register Date</th>
											<th>Status</th>
											<th>Action</th>
											<th>View</th>
										</tr>
                                    </thead>

                                    <tbody>
                                         @foreach($companys as $key=>$company)
											<tr>
												<td>{{$key+1}}</td>
												<td>{{ Str::limit($company->company_name ? $company->company_name : '', 10) }}</td>
                                                <td>{{ Str::limit($company->company_type == 'Select Company Type' ? '' : $company->company_type, 10) }}</td>
                                                <td>{{ Str::limit($company->user ? $company->user->firstname : ' ', 10) }}</td>
                                                <td>{{ Str::limit($company->address ? $company->address : '', 10) }}</td>
												<td>{{$company->phone_number ? $company->phone_number : ''}}</td>
												<td>{{\Carbon\Carbon::parse($company->created_at)->format('d-m-Y')}}</td>
												<td>
													@if($company->enabled == 0)
													<label class="custom-switch">
														<input type="checkbox" name="custom-switch-checkbox" onclick="status(this,{{$company->id}})" class="custom-switch-input"> 
														<span class="custom-switch-indicator" style="background-color:red;"></span>
													</label>
													@else
													<label class="custom-switch">
														<input type="checkbox" name="custom-switch-checkbox" onclick="status(this,{{$company->id}})" class="custom-switch-input" checked > 
														<span class="custom-switch-indicator" style="background-color:green;"></span>
													</label>
													@endif
												</td>
												<td>
													@if($company->claimed_status == 1)
                                                       <b> <span class="ti ti-check text-success" style="font-size:16px"> Claimed  </span> </b> 
													@else
                                                      <b> <span class="ti ti-na text-danger" style="font-size:16px"> Un-Claimed  </span> </b> 
													@endif
												</td>
												<td>
													<a  href="{{Route('company.show',$company->id)}}"  type="button"><i style="font-size:18px;" class="fa fa-eye" aria-hidden="true"></i></a>
												</td>
											</tr>
										@endforeach
                                    </tbody>
                                </table>
                            </div>

							<!-- company close -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>

<script type="text/javascript">
	
function claimed_status(thiss,id){
    if(thiss.innerHTML=='Claimed')
    {
        var claimed_status='Unclaimed';
    }
    else
    {
        var claimed_status='Claimed'; 
    }
   var ok= confirm( "Are you sure,change this to "+claimed_status);
   if(ok==true)
   {
    url = "{{ url('superadmin/claimed_status') }}/"+id
    $.get( url, function() {
        location.reload();
    });
}
}


function Approved_Status(thiss,id){
    if(thiss.innerHTML=='Approved')
    {
        var claimed_status='Pending';
    }
    else
    {
        var claimed_status='Approved'; 
    }
   var ok= confirm( "Are you sure,change this to "+claimed_status);
   if(ok==true)
   {
    url = "{{ url('superadmin/Approved_Status') }}/"+id
    $.get( url, function() {
        location.reload();
    });
  }
}

function status(thiss,id){
    if(thiss.innerHTML=='Enabled')
    {
        var claimed_status='Disabled';
    }
    else
    {
        var claimed_status='Enabled'; 
    }
   var ok= confirm( "Are you sure,change this to "+claimed_status);
   if(ok==true)
   {
        url = "{{ url('superadmin/status') }}/"+id
        $.get( url, function() {
            location.reload();
        });
    }
}
</script> 

@endsection


