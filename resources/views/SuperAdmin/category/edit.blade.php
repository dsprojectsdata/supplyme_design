@extends('SuperAdmin.layout.app')
@section('superadmincontent')

<style>
    .dataTables_wrapper .dataTables_filter {
        margin-left: 323px;
        /* border: 1px solid #e8e8f7; */
        border: 0px solid #e8e8f7;
    }

</style>
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
                        <li class="breadcrumb-item active" aria-current="page">Category Edit</li>
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

                        <form action="{{ route('update.category', $category->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                <label for="company">Category</label>
                                <input type="text" class="form-control" name="name" value="{{$category->name}}">
                            </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Select category</label>
                                            <select name="parent_id" class="form-control">
                                                <option value="">Select Parent</option>
                                                <option value="0" @if ($category->parent_id === 0) selected @endif>Parent </option>
                                                @foreach($categories as $cat)
                                                <option {{$cat->id == $category->parent_id ? 'selected' : ' '}} value="{{ $cat->id }}" >{{ $cat->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="name">Type Of Category</label>
                                    <select name="category_type" class="form-control">
                                        <option value="product" @if ($category->category_type === 'product') selected @endif>Product</option>
                                        <option value="services" @if ($category->category_type === 'services') selected @endif>Service</option>
                                      
                                    </select>
                                </div>

                                <div class="col-md-12">

                                <div class="form-group">
                                <label for="name">Status</label>
                                <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="1" @if ($category->status === 1) selected @endif>Active</option>
                                    <option value="0" @if ($category->status === 0) selected @endif>Inactive</option>
                                </select>
                            </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
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


