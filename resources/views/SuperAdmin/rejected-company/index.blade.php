@extends('SuperAdmin.layout.app')
@section('superadmincontent')
<style>
    div#example3_filter {
        margin-left: 325px;
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
                    <h2 class="main-content-title tx-24 mg-b-5">Rejected Company</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Company</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rejected Company List </li>
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
                                            <th>Website</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Contact Number</th>   
                                            <th>Action</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($claimreject as $clmreject)
                                        <tr>
                                            <td> {{ $loop->iteration }}</td>
                                            <td>{{ $clmreject ? Str::limit($clmreject->company_name, 10) : '' }}</td>
                                            <td>{{ Str::limit($clmreject->website, 10) }}</td>
                                            <td>{{ Str::limit($clmreject->address, 10) }}</td>
                                            <td>{{ Str::limit($clmreject->city->name, 10) }}</td>
                                            <td>{{ Str::limit($clmreject->state->name, 10) }}</td>
                                            <!-- <td>{{$clmreject->county}}</td> -->
                                            <td>{{ $clmreject ? $clmreject->phone_number : '' }}</td>
                                            <td style="color:red;">{{$clmreject->company_approve_status}}</td>
                                            <td>
                                            <div class="row">
                                                <div class="col-sm-3 mt-2"> <a  href="{{Route('reject.company.edit',$clmreject->id)}}" type="button"><i style="font-size:18px;" class="fa fa-eye" aria-hidden="true"></i></a>
                                                </div>
                                                <div class="col-sm-3">
                                                    <form action="{{ route('reject.company.delete', $clmreject->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this ?')">
                                                        @csrf
                                                        <button type="submit" value="submit" class="ti ti-trash btn text-danger"></button>
                                                    </form>
                                                </div>
                                            </div>
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

@endsection