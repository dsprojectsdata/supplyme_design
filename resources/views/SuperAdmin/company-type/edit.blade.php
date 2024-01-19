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
                    <h2 class="main-content-title tx-24 mg-b-5">Company Type</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Company Type Edit</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">

                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('company.companyType') }}" class="text-white"> <i
                                    class="fe fe-arrow-left me-2"></i> Back To Dashboard
                            </a>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
							<form action="{{route('update.company.type',$findCompanyType->id)}}" method="POST" enctype="multipart/form-data">
								@csrf
									<div class="form-group">
										<label for="company">Company Type</label>
										<input type="text" class="form-control" name="type_name" value="{{ $findCompanyType->type_name }}">
										
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


