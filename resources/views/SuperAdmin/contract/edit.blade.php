@extends('SuperAdmin.layout.app')
@section('superadmincontent')
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
                        <li class="breadcrumb-item active" aria-current="page">Contract Edit</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('contract.index') }}" class="text-white"> <i
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
							<form action="{{route('contract.update',$contractdit->id)}}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
                                    <label for="contract_img">Title Name</label>
                                    <input type="text" class="form-control" name="file_name" required="" value="{{ $contractdit->file_name }}">
                                </div>
								<div class="form-group">
                                                <label for="company">Contract Updload File</label>
                                                <input type="file" class="form-control" name="contract_img" value="{{ $contractdit->contract_img }}">
                                       

                                            <iframe src="{{ URL::asset($contractdit->contract_img) }}"
                                            style="width:170px; height:100px; margin-left:10px;" scrolling="no"> </iframe>

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


