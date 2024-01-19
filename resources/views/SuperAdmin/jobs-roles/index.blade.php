@extends('SuperAdmin.layout.app')
@section('superadmincontent')
<style>
    .dataTables_wrapper .dataTables_filter {
        margin-left: 323px;
        /* border: 1px solid #e8e8f7; */
        border: 0px solid #e8e8f7;
    }
</style>
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
                    <h2 class="main-content-title tx-24 mg-b-5">Job Role</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Job Role</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">

                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('create.jobs') }}" class="text-white"> <i
                                    class="fe fe-plus me-2"></i> Add Job Role
                            </a>
                        </button>
                    </div>
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
                                            <th>Jobs Role Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($getJobsRoles as $roles)
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                                <td>{{ $roles->role_name }} </td>
                                                <td>{{ $roles->description }} </td>
                                                <td>
                                                <a href="{{ route('edit.jobs', $roles->id) }}" class="ti ti-pencil">
                                                        </a>
                                                    <a href="#" data-bs-target="#modaldemo-{{$roles->id}}" data-bs-toggle="modal" class="ti ti-trash" ></a>
                                                </td>
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
 @foreach($getJobsRoles as $roles)
<div class="modal" id="modaldemo-{{$roles->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <form action="{{ route('delete.jobs' , $roles->id) }}" method="POST"
                id="jobsRoleDeleteForm">
                @csrf

                <div class="modal-body">
                    <h6>Job Role</h6>
                    <p>Do you want delete job role ? </p>
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
 @endforeach
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
