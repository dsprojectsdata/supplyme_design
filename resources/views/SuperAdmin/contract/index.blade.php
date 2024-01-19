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
                    <h2 class="main-content-title tx-24 mg-b-5">Contract</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contract</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">

                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('contract.create') }}" class="text-white"> <i
                                    class="fe fe-plus me-2"></i> Add Contract
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
                                            <th>Title Name</th>
                                            <th>File Download</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($contarct as $contarcts)
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                               <td>{{$contarcts->file_name }} </td>
                                             <td>
                                                    <a href="{{ asset($contarcts->contract_img) }}" target="__blank" >
                                                    <i class="text-primary fa fa-download fa-2x text-center"></i></a>
                                            </td>
                                                <td>
                                                <div class="d-flex">
                                                    <span class="mr-2 mt-2">

                                              <a href="{{route('contract.edit', $contarcts->id)}}" class="ti ti-pencil"> </a> </span>

                                                   <span>   <form action="{{ route('contract.delete', $contarcts->id) }}" method="POST" 
                                                        onsubmit="return confirm('Are you sure you want to delete this model?')">
                                                        @csrf
                                                        <button type="submit" class="ti ti-trash btn"></button> 
                                                    </form>
                                                    </span>
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


