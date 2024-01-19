@extends('SuperAdmin.layout.app')
@section('superadmincontent')
<style>
    .icon-size,
    .icon-size img {
        max-width: 20px
    }

    .action-buttons {
        z-index: 11;
    }

    .custom-file-label::after {
        padding: 0;
    }
</style>
<div class="row">
    <div class="col-md-12 bg-white">
        @include('SuperAdmin.company-edit.layouts.index')
    </div>
    <div class="col-md-12">
        <form class="py-4" method="POST" action="{{ route('company.update.customers') }}" enctype="multipart/form-data">
            <div class="container">
                @csrf
                <input type="hidden" name="company_id" value="{{ $company->id }}" />


                <div class="row gap-3 gap-xl-0">
                    <div class="col-12 clone-row">
                        <div class="row">
                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input class="form-control" type="text" placeholder="Client Name" name="client_company_name[]" />
                                    @error('client_company_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="form-group">
                                    <label>Product or Service</label>
                                    <input class="form-control" type="text" placeholder="Product or Service" name="client_product_or_service[]" />
                                    @error('client_product_or_service')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="form-group">
                                    <label>Website Link</label>
                                    <input class="form-control" type="text" placeholder="Website Link" name="client_website_link[]" />
                                    @error('client_website_link')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="form-group">
                                    <label>Review Link</label>
                                    <input class="form-control" type="text" placeholder="Review Link" name="client_review_link[]" />
                                    @error('client_review_link')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="form-group">
                                    <label for="client_company_logo">Compnay Logo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="client_company_logo" name="client_company_logo[]">
                                            <label class="custom-file-label form-control" for="client_company_logo" data-browse="">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="browse btn btn-primary px-4" type="button" onclick="document.getElementById('client_company_logo').click()">Browse</button>
                                        </div>
                                    </div>
                                    @error('client_company_logo')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-xl-6 mb-0 mb-xl-3 text-end" style="margin-top:29px;">
                                <span class="btn btn-danger btn-xs pull-right btn-del-select">Remove</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <span class="btn btn-primary btn-xs add-select">Add More</span>
                    </div>
                </div>
                @foreach($companyCustomerClient as $client)
                <div class="row mt-1 customerClient-address" data-customer-client-container-id="{{ $client->id }}">
                    <div class="addded-team">
                        <!-- <a href="{{route('customer.client.delete', $client->id)}}" class="close-icon client-link" data-id="{{ $client->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a> -->
                        <span><img src="{{ asset($client->client_company_logo) }}" class="img-fluid" width="100"></span>
                        <div class="addded-iner">
                            <h2 id="member-name"> Company {{$client->client_company_name}}</h2>
                            <label class="addded-text">
                                <b>Review - <em id="client_review_link">{{$client->client_review_link}}</em></b>
                                <b>Website - <em id="client_website_link">{{$client->client_website_link}}</em></b>
                                <b>Product - <em id="client_product_or_service">{{$client->client_product_or_service}}</em></b>
                            </label>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="action-buttons d-none d-md-flex py-3 border bg-white justify-content-between position-fixed bottom-0 w-100 px-5" style="border-color:#B4B6BD;">
                <div class="col-12 col-md-4 ">
                    <button class="btn px-4 text-white btn-primary" id="formid" value="submit" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('custom-scripts')
<script>
    $(document).ready(function() {
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        $('.btn-del-select').hide();
        $(document).on('click', '.add-select', function() {
            $(this).parent().parent().find(".clone-row").clone().insertBefore($(this).parent()).removeClass("clone-row");
            $('.btn-del-select').fadeIn();
            $(this).parent().parent().find(".btn-del-select").click(function(e) {
                var parentRow = $(this).parent().parent().parent();
                if (!parentRow.hasClass("clone-row")) {
                    parentRow.remove();
                } else {
                    // Here code for last row can't delete
                }
            });
        });
    });
</script>
@endpush