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
                    <h2 class="main-content-title tx-24 mg-b-5">NDA</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">NDA</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">

                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('nda.create') }}" class="text-white"> <i
                                    class="fe fe-plus me-2"></i> Add NDA
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
                                            <th>File Name</th>
                                            <th>File</th>
                                            <th>File Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ndafile as $f => $ndafiles)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ndafiles->nda_file_title }}</td>
                                            <td>
                                                @php
                                                    $extension = pathinfo($ndafiles->nda_file_name, PATHINFO_EXTENSION);
                                                    $iconClass = isset($icons[$extension]) ? $icons[$extension] : 'fa-file-o'; 
                                                @endphp
                                                <div style="width: 170px; height: 100px; overflow: hidden;">
                                                <iframe src="{{ asset($ndafiles->nda_file_name) }}" type="application/pdf"></iframe>
                                            </div>
                                            </td>
                                            <td>
                                            <a href="{{ asset($ndafiles->nda_file_name) }}" target="__blank" >
                                            <i class="text-primary fa {{ $iconClass }} fa-2x text-center"></i></a>
                                            </td>
                                            <td>
                                            <div class="row">
                                                <div class="col-md-8"></div>
                                                <div class="col-md-1 mt-2"><a href="{{ route('nda.edit', $ndafiles->id) }}" class="ti ti-pencil"></a> </div>
                                                <div class="col-md-2">
                                                <form action="{{ route('nda.delete', $ndafiles->id) }}" method="POST" 
                                                        onsubmit="return confirm('Are you sure you want to delete this model?')">
                                                        @csrf
                                                        <button type="submit" class="ti ti-trash btn"></button> 
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


