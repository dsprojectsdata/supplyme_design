@extends('SuperAdmin.layout.app')
@section('superadmincontent')

<style>
    .dataTables_wrapper .dataTables_filter {
        margin-left: 323px;
        /* border: 1px solid #e8e8f7; */
        border: 0px solid #e8e8f7;
    }
</style>
<!-- message open -->
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
                    <h2 class="main-content-title tx-24 mg-b-5">Certification</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Certification</li>
                    </ol>
                </div>
            </div>

            <div class="row row-sm">
                <div class="col-12 col-lg-6">
                    <div class="card custom-card">
                        <div class="card-header">
                            @if ($single_info->slug)
                            <h5>Edit Certification</h5>
                            @else
                            <h5>Add Certification</h5>
                            @endif
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('company.certificateSave', $single_info->slug) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label">Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ old('name', $single_info->certification) }}">
                                        @error('name')
                                        <div class="form-valid-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary ">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @if (!empty($all_info))
                <div class="col-lg-6 col-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="table table-striped table-bordered text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>Certificate</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($all_info as $single)
                                        <tr>
                                            <td>{{ $loop->iteration }} </td>
                                            <td>{{ $single->certification }} </td>
                                            <td>
                                                <a href="{{ route('company.getStoreCertificate', $single->slug) }}" class="ti ti-pencil"></a>
                                                <a href="" onclick="confirmDelete('{{$single->id}}')" data-bs-target="#modaldemo1" data-bs-toggle="modal" class="ti ti-trash"></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>


<!--delete model open  -->
<div class="modal" id="modaldemo1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <form action="#" method="POST" id="deleteForm" data-action="{{ route('company.certificateDelete', ':slug') }}">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title">Message</h6><button aria-label="Close" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <h6>Certification</h6>
                    <p>Certification data will be Delete forever if you click delete button </p>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary " id="savedelete" type="submit">delete</button>
                    <button class="btn ripple btn-secondary" id="cancle" data-bs-dismiss="modal" type="button">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--delete model close -->

@endsection

<script>
    function confirmDelete(slug) {
        var deleteForm = document.getElementById('deleteForm');
        var actionUrl = deleteForm.getAttribute('data-action');
        actionUrl = actionUrl.replace(':slug', slug);
        deleteForm.setAttribute('action', actionUrl);

        // $('#modaldemo1').modal('show');
    }
</script>