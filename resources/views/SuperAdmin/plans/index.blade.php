@extends('SuperAdmin.layout.app')
@section('superadmincontent')

<style>
    .dataTables_wrapper .dataTables_filter {
        margin-left: 323px;
        border: 0px solid #e8e8f7;
    }
    div#example3_filter {
    margin-left: 325px;
}
</style>
<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">
            <!-- ================= page header open ================= -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Payment Plans</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('paymant.plans.create') }}" class="text-white">  Add Plans </a>
                        </button>
                    </div>
                </div>

            </div>
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
							<!-- company open -->
                            <div class="table-responsive">
                                <table id="example3" class="table table-striped table-bordered text-nowrap">
                                    <thead>
										<tr>
											<th>S.no</th>
											<th>Name</th>
											<th>Monthly Price USD</th>
											<th>Number Of User </th>
											<th>Monthly Price INR</th>
											<th>Number Of RFQ</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach($plans as $key => $plan)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $plan->name }}</td>
                                                <td>{{ $plan->monthly_price_usd }}</td>
                                                <td>{{ $plan->number_of_user }}</td>
                                                <td>{{ $plan->monthly_price_inr }}</td>
                                                <td>{{ $plan->number_of_rfq }}</td>
                                                <td class="{{$plan->status == '1' ? 'text-success' : 'text-danger'}}">{{ $plan->status == '1' ? 'Active' : 'In Active' }}</td>
                                                <td>
                                                    <a href="{{Route('paymant.plans.edit',$plan->id)}}" type="button">
                                                        <i style="font-size:18px;" class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

							<!-- company close -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>



@endsection


