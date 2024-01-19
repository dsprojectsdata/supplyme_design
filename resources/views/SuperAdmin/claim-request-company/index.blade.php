@extends('SuperAdmin.layout.app')
@section('superadmincontent')
<style>
    div#example3_filter {
        margin-left: 325px;
    }
</style>
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
                    <h2 class="main-content-title tx-24 mg-b-5">Claim Request Company</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Company</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Claim Company</li>
                    </ol>
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
                                            <th>Company Name</th>
                                            <th>Website</th>
                                            <th>Address</th>
                                            <th>Number Of Claim Request </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                
                                    @foreach ($companiesWithCount as $key=>$item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                @foreach ($companies as $company)
                                                    @if ($company->id == $item->company_id)
                                                        {{ Str::limit($company->company_name, 10) }}
                                                        @break
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{$item ? ($item->company ?  $item->company->website : '') : ' '}}</td>
                                            <td>{{$item ? ($item->company ?  $item->company->address : '' ) : ' '}}</td>
                                            <td>{{ $item->company_count }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-3 mt-2">
                                                        <a href="{{ route('edit.claim.request', $item->company_id) }}" type="button">
                                                            <i style="font-size: 18px;" class="fa fa-eye" aria-hidden="true"></i>
                                                        </a>
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
<!--delete model open  -->
<div class="modal" id="modaldemo1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <form action="" method="POST"id="claimRequestDeleteForm">
                    @csrf
                <div class="modal-header">
                    <h6 class="modal-title">Message</h6><button aria-label="Close" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <h6>Claim Request</h6>
                    <p>Data will be Delete forevere if you click delete button </p>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary " id="claimRequestDelete" type="submit">delete</button>
                    <button class="btn ripple btn-secondary" id="cancle" data-bs-dismiss="modal"
                        type="button">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--delete model close -->

@endsection

<script>
    function confirmDelete() {
        console.log('save data');
        $('#claimRequestDelete').on('click', function () {
            console.log('save data');
            document.getElementById('claimRequestDeleteForm').submit();
        })
        $('#cancle').on('click', function () {

        })
    }
</script>
