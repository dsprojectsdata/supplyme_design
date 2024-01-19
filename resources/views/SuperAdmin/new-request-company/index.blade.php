@extends('SuperAdmin.layout.app')
@section('superadmincontent')
<!-- message close -->
@if(session('success'))
    <div class="alert alert-success mg-b-0" role="alert">
        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong> {{ session('success') }} </strong>
    </div>
@endif
<div class="col-md-12">
@if(session()->has('danger'))
    <div class="alert alert-danger mg-b-0" role="alert">
        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong> {{ session()->get('danger') }} </strong>
    </div>

@endif
</div>

<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
            <!-- Row -->
            <!-- ================= page header open ================= -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">New Company Request</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Company</a></li>
                        <li class="breadcrumb-item active" aria-current="page">New Company</li>
                    </ol>
                </div>
            </div>

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="table table-striped table-bordered text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>Company Name</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Owner</th>
                                            <th>Contact Number</th> 
                                            <th>Com. Reg. Date</th>
                                            <th>Status</th>
                                            <th> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($newrequest as $key=>$nrequest)
                                        <tr>
                                            <td>{{$key+1 }}</td>
                                            <td>{{ $nrequest->company_name ? Str::limit($nrequest->company_name, 10) : '' }}</td>
                                            <td>{{ optional($nrequest->City)->name ? Str::limit($nrequest->City->name, 10) : '' }}</td>
                                            <td>{{ optional($nrequest->State)->name ? Str::limit($nrequest->State->name, 10) : '' }}</td>
                                            <td>{{ optional($nrequest->user)->firstname ? Str::limit($nrequest->user->firstname, 10) : '' }}</td>
                                            <td>{{ $nrequest->phone_number ?? '' }}</td>
                                            <td>{{ $nrequest->created_at ? $nrequest->created_at->format('Y-m-d') : '' }}</td>
                                            @if($nrequest->company_approve_status === 'accepted')       
                                            <td style="color:green">{{ ucfirst($nrequest->company_approve_status) }}</td>
                                            @elseif($nrequest->company_approve_status == 'new')
                                            <td style="color:#228B22">{{ ucfirst($nrequest->company_approve_status) }}</td>
                                            @elseif($nrequest->company_approve_status == 'pending')
                                            <td style="color:blue">{{ ucfirst($nrequest->company_approve_status) }}</td>
                                            @elseif($nrequest->company_approve_status == 'rejected')
                                            <td style="color:red">{{ ucfirst($nrequest->company_approve_status) }}</td> 
                                            @endif
                                            <td>
                                                <a  href="{{Route('new.request.edit',$nrequest->id)}}"  type="button"><i style="font-size:18px;" class="fa fa-eye" aria-hidden="true"></i></a>
                                                <form  action="{{ route('new.request.delete', $nrequest->id) }}" method="POST" onsubmit="return confirm('Company Delete')"  style="display: inline-block;">
                                                         @csrf
                                                       <button type="submit" value="submit"  style="font-size:18px;" class="ti ti-trash btn text-danger"></button>
                                                </form>
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
<!--delete model open  -->
<div class="modal" id="modaldemo1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <form action="" method="POST"
                id="jobsRoleDeleteForm">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title">Message</h6><button aria-label="Close" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <h6>Job Role</h6>
                    <p>Job Role Type data will be Delete forevere if you click delete button </p>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary " id="jobsRoleDelete" type="submit">delete</button>
                    <button class="btn ripple btn-secondary" id="cancle" data-bs-dismiss="modal"
                        type="button">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--delete model close -->

@endsection

<script>
    function confirmDelete() {
        console.log('save data');
        $('#jobsRoleDelete').on('click', function () {
            console.log('save data');
            document.getElementById('jobsRoleDeleteForm').submit();
        })
        $('#cancle').on('click', function () {

        })
    }
</script>
<style>
    div#example3_filter {
    margin-left: 325px;
}
</style>
