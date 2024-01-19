@extends('SuperAdmin.layout.app')
@section('superadmincontent')
<!-- message close -->

<style>
    .card-header {
    padding: 5px 54px 0px 36px !important;
    }
</style>

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
                    <h2 class="main-content-title tx-24 mg-b-5">Category</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">

                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('category.create') }}" class="text-white"> <i
                                    class="fe fe-plus me-2"></i> Add Category
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
                                    <ul class="list-group">
                                    @foreach($category as $catgg)
                                       <div class="card mt-3">
                                        <div class="card-header bg-light"> 
                                        <div class="card-header">{{ $catgg['name'] }}  
                                             @if($catgg['category_type'] == 'services') <span class="text-success"> services </span>
                                            @elseif ($catgg['category_type'] == 'product') <span class="text-danger">   product </span>
                                            @endif
                                            <div style="float:right">
                                               
                                            <form action="{{ route('categories.del', $catgg['id']) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?')">
                                                    @csrf
                                                    <button type="submit" class="ti ti-trash btn text-danger"> Delete</button>
                                                </form>
                                            </div>
                                            <div style="float:right; margin-top:8px;">
                                            <a href="{{ route('categories.edit', $catgg['id']) }}" class="ti ti-pencil" style="font-size:15px;"> Edit</a>
                                               
                                               
                                            </div>
                                            </div>
                                            </div>
                                        <div class="crad-body">
                                        <li class="list-group-item">
                                            
                                            @if (!empty($catgg['children']))
                                                <ul class="mt-2">
                                                    <div class="card shadow">
                                                        <div class="card-body">
                                                            <!-- subcategories open -->
                                                            @foreach($catgg['children'] as $child)
                                                            <li class="list-group-item"> {{ $child['name'] }}
                                                                <div class="row">
                                                                <div class="col-md-9"></div>
                                                                    <div class="col-md-1" style="margin-top:8px;"> 
                                                                        <a href="{{ route('categories.edit', $child['id']) }}" class="ti ti-pencil"> Edit</a>
                                                                    </div>
                                                                    <div class="col-md-2"> 
                                                                        <form action="{{ route('categories.del', $child['id']) }}" method="POST"
                                                                            onsubmit="return confirm('Are you sure you want to delete this category?')">
                                                                            @csrf
                                                                            
                                                                            <button type="submit" value="submit" class="ti ti-trash btn text-danger"> Delete</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </li> 
                                                            @endforeach
                                                            <!-- subcategories close -->
                                                        </div>
                                                    </div>  
                                                </ul>
                                            @endif
                                            
                                        </li>
                                        </div>
                                       </div>
                                    @endforeach
                                </ul>

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


