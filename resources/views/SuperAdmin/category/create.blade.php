@extends('SuperAdmin.layout.app')
@section('superadmincontent')


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
                        <li class="breadcrumb-item active" aria-current="page">Add Category </li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">

                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('category.index') }}" class="text-white"> <i
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
							<form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data" class="needs-validation was-validated">
								@csrf
                                 <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Category Name</label>
                                        <input type="text" class="form-control" name="name" required="">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Select</label>

                                        <select name="parent_id"  class="form-control" required="">
                                            <option  class="form-control"> -- Select --</option>
                                            <option value="0" class="form-control">Parent</option>
                                            @foreach($category as $cat)
                                            <option value="{{ $cat->id }}"  class="form-control">{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="name">Type Of Category</label>
                                        <select name="category_type" class="form-control">
                                            <option value="default" class="form-control">-- Select Type Of Category --</option>
                                            <option value="product" class="form-control">Product</option>
                                            <option value="services" class="form-control">Service</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" class="form-control">Active</option>
                                            <option value="0" class="form-control">In Active</option>
                                        </select>
                                    </div>
                                    </div>
                                 </div>
								    
								    
								   
                                            
									<button type="submit" class="btn btn-primary" vlaue="submit" >Submit</button>

							</form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>



@endsection


