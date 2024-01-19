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
                    <h2 class="main-content-title tx-24 mg-b-5">Cover Letter</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Cover Letter </li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">

                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('cover-letter.index') }}" class="text-white"> <i
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

							<form action="{{route('cover-letter.store')}}" method="POST" enctype="multipart/form-data" class="needs-validation was-validated">
								@csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label> Title </label>
                                        <input type="text" name="title" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label> Description </label>
                                        <textarea class="form-control ckheight" id="description" placeholder="Enter the Description" name="description" ></textarea>
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

<style>
    .ck.ck-editor__editable {
        height: 350px; 
    }
</style>

<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>



<script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        
        .catch( error => {
            console.error( error );
            
        } );
        


</script>





@endsection


