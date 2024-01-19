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
                    <h2 class="main-content-title tx-24 mg-b-5">Company Document Manager</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Company</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Document Manager</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">

                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('create.document.manager') }}" class="text-white"> <i
                                    class="fe fe-plus me-2"></i> Add New Record
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
                                <table id="example3" class="table table-striped table-bordered text-nowrap" data-page-length='50'>
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>Country Name</th>
                                            <th>Document Type</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($companyDocManager as $compdoc)
                                      <tr>
                                           <td>{{ $loop->iteration }} </td>
                                           <td>{{$compdoc->countrie->name}}</td>
                                           <td>{{$compdoc->document_name}}</td>
                                           <td>{{$compdoc->description}}</td>
                                            <td>
                                               <a  href="{{ route('edit.comapny.document', $compdoc->id) }}"  type="button"><i style="font-size:18px;" class="ti ti-pencil" aria-hidden="true"></i></a>
                                                <form action="{{ route('delete.comapny.document' , $compdoc->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this company document type?')">
                                                @csrf
                                            
                                                <button type="submit" class="ti ti-trash btn">Delete</button>
                                            </form>


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




<!--delete model open  -->
<!-- <div class="modal" id="modaldemo1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <form action="" method="POST" id="companyDocDeleteForm"> 
                <div class="modal-header">
                    <h6 class="modal-title">Message</h6><button aria-label="Close" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <h6>Company Document</h6>
                    <p>Company Document data will be Delete forevere if you click delete button </p>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary " id="compDocDelete" type="submit">delete</button>
                    <button class="btn ripple btn-secondary" id="cancle" data-bs-dismiss="modal"
                        type="button">Close</button>
                </div>
            </form>
        </div>
    </div>
</div> -->

<!--delete model close -->

@endsection

<script>
    function confirmDelete() {
        console.log('save data');
        $('#compDocDelete').on('click', function () {
            console.log('save data');
            document.getElementById('companyDocDeleteForm').submit();
        })
        $('#cancle').on('click', function () {

        })
    }
</script>
