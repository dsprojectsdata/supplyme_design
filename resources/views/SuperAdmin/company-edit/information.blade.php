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
        <form class="py-4" method="POST" action="{{ route('company.update.information') }}" enctype="multipart/form-data">
            <div class="container">
                @csrf
                <input type="hidden" name="company_id" value="{{ $company->id }}" />

                <div class="accordion-item border mb-3">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed d-flex gap-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                            Company Financial
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                            <div class="row gap-3 gap-xl-0">
                                <div class="row gap-3 gap-xl-0" id="body-addAnotherAddress">

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="form-group">
                                            <label>Year</label>
                                            <select class="form-select" aria-label="Default select example" name="currency_year">
                                                <option value="">Select</option>
                                                @for($i = date('Y'); $i > 1800; $i--)
                                                <option value="{{$i}}" @if ($companyProfile->currency_year??'' == $i) selected @endif>{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="form-group">
                                            <label>Currency type</label>
                                            <select class="form-select" aria-label="Default select example" name="currency_type">
                                                <option value="">Select</option>
                                                @foreach ($currencies as $currency)
                                                <option value="{{ $currency->id }}" {{ old('currency_type', $companyProfile->currency_type??'') == $currency->id ? 'selected' : '' }}>
                                                    {{ $currency->currency }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('currency_type')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="form-group">
                                            <label>Annual Revenue</label>
                                            <select class="form-select" aria-label="Default select example" name="annual_revenue">
                                                <option value="">Select</option>
                                                @foreach ($annual_revenues as $annual_revenue)
                                                <option value="{{ $annual_revenue->id }}" {{ old('annual_revenue', $companyProfile->annual_revenue??'') == $annual_revenue->id ? 'selected' : '' }}>
                                                    {{ $annual_revenue->annual_revenue }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('annual_revenue')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="form-group">
                                            <label>Link to Annual Report</label>
                                            <input class="form-control" type="text" placeholder="Link to Annual Report" name="link_to_annual_report" value="{{ old('link_to_annual_report', $companyProfile->link_to_annual_report??'') }}" />
                                            @error('link_to_annual_report')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="form-group">
                                            <label for="link_to_annual_report2">Link to Annual Report File</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="link_to_annual_report2" name="link_to_annual_report2">
                                                    <label class="custom-file-label form-control" for="link_to_annual_report2" data-browse="">Choose file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <button class="browse btn btn-primary px-4" type="button" onclick="document.getElementById('link_to_annual_report2').click()">Browse</button>
                                                </div>
                                            </div>
                                            @error('link_to_annual_report2')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            @if (!empty($companyProfile->link_to_annual_report2))
                                            <div class="mt-1">
                                                <img src="{{ asset($companyProfile->link_to_annual_report2 ?? '') }}" class="img-fluid" width="100">
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    });
</script>
@endpush