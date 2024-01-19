@extends('SuperAdmin.layout.app')
@section('superadmincontent')

@if(count($errors) > 0 )
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <ul class="p-0 m-0" style="list-style: none;">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif


<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
            <!-- Row -->
            <!-- ================= page header open ================= -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Bid Sheet</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Bid Sheet </li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">

                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('bidsheet.index') }}" class="text-white"> <i
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
							<form action="{{route('bidsheet.store')}}" method="POST" enctype="multipart/form-data" class="needs-validation was-validated">
								@csrf
								<div class="form-group">
                                                <label for="name">Title Name</label>
                                                <input type="text" class="form-control" name="name" required="">
                                            </div>
								<div class="form-group">
                                                <label for="bidsheet_img">Bid Sheet File Name</label>
                                                <input type="file" class="form-control" name="bidsheet_img" required="">
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


