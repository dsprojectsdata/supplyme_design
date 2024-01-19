@extends('SuperAdmin.layout.app')
@section('superadmincontent')
<div class="main-content pt-0">
				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Company List</h2>
							</div>
						</div>
						<!-- End Page Header -->
						<!-- Row -->
						<div class="row row-sm">
							<div class="col-lg-12">
								<div class="card custom-card">
									<div class="card-body">
										<div class="table-responsive">
											<table id="example3" class="table table-striped table-bordered text-nowrap" >
												<thead>
													<tr>
														<th>S.no</th>
														<th>Company Name</th>
														<th>User</th>
														<th>Company Type</th>
														<th>Address</th>
														<th>Phone Number</th>
														<th>Claimed Status</th>
														<th>Approved Status</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
                                                    @foreach($companys as $company)
                                                        <tr>
                                                            <td>{{$company->id}}</td>
                                                            <td>{{$company->Company_name}}</td>
                                                            <td>{{$company->user_id ? $company->user->FirstName : ' ' }}</td>
                                                            <td>{{$company->company_type}}</td>
                                                            <td>{{$company->address}}</td>
                                                            <td>{{$company->Phone_number}}</td>

                                                            <td>
																@if($company->claimed_status == 0)
																<label class="switch">
																	<a class="btn btn-danger" onclick="claimed_status(this,{{$company->id}})" type="button">Unclaimed</a>
																</label>
																@else
																<label class="switch">
																	<a class="btn btn-success" onclick="claimed_status(this,{{$company->id}})" type="button">Claimed</a>
																</label>
																@endif
															</td>
															<td>
																@if($company->Approved_Status == 0)
																<label class="switch">
																	<a class="btn btn-danger" onclick="Approved_Status(this,{{$company->id}})" type="button">Pending</a>
																</label>
																@else
																<label class="switch">
																	<a class="btn btn-success" onclick="Approved_Status(this,{{$company->id}})" type="button">Approved</a>
																</label>
																@endif
                                                            </td>
															<td>
																@if($company->status == 0)
																<label class="switch">
																	<a class="btn btn-danger" onclick="status(this,{{$company->id}})" type="button">Disabled</a>
																</label>
																@else
																<label class="switch">
																	<a class="btn btn-success" onclick="status(this,{{$company->id}})" type="button">Enabled</a>
																</label>
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