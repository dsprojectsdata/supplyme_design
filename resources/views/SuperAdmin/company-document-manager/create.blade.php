@extends('SuperAdmin.layout.app')
@section('superadmincontent')
<style>
    span.tag.label.label-info {
    color: black;
    background-color: #5bc0de;
    margin-right: 2px;
    color: white;
    display: inline;
    padding: 0.2em 0.6em 0.3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25em;  
}
</style>
<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
            <!-- Row -->
            <!-- ================= page header open ================= -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Company Document</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Company Document </li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">

                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('comapny.document.manager') }}" class="text-white"> <i
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
							<form action="{{route('store.comapny.document')}}" method="POST" enctype="multipart/form-data" class="needs-validation was-validated">
                                @csrf
                                    <div class="form-group">
                                        <b>Country Name</b>
                                        <select class="js-example-basic-single position_country form-control" name="country_id" id="country">
                                            <option>Select Country Name</option>
                                        @foreach($countries as $countrie)
                                            <option value="{{$countrie->id}}" class="form-control">{{$countrie->emoji}} {{$countrie->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="role_name">Document Name</label>
                                        <input type="text" class="form-control" name="document_name" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" name="description" class="form-control"  rows="4" cols="50" required=""></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-wrapper">
                                          <label for="document_type">Document Type</label>
                                           <input type="text" name="document_type[]" class="input-wrapper" id="tags-input" data-role="tagsinput" placeholder="Enter .pdf etc__">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="document_required">Document Required / Not required</label>
                                            <div class="col-sm-3">
                                            </div>
                                            <div class="col-sm-2">
                                                <input class="form-check-input" type="radio" name="document_required" value="No Required" id="flexRadioDefault2" checked>
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Not required
                                                </label>
                                            </div>    
                                            <div class="col-sm-2">
                                                <input class="form-check-input" type="radio" name="document_required" value="Required" id="flexRadioDefault1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Required
                                                </label>    
                                            </div>
                                            <div class="col-sm-5">
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


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(".position_country").select2({
  allowClear:true,
  placeholder: 'Select'
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" ></script> 
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js" ></script>
<script>
    $('#tags-input').tagsinput({
    confirmKeys: [13, 44, 188], // Customize the keys to add tags (optional)
    trimValue: true, // Trim the tags' values (optional)
    // Add other options if needed
    });
</script>
@endsection


