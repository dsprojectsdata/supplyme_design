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
@push('custom-style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
@endpush
<div class="row">
    <div class="col-md-12 bg-white">
        @include('SuperAdmin.company-edit.layouts.index')
    </div>
    <div class="col-md-12">
        <form class="py-4" method="POST" action="{{ route('company.update.profile') }}" enctype="multipart/form-data">
            <div class="container">
                @csrf
                <input type="hidden" name="company_id" value="{{ $company->id }}" />
                <div class="row gap-3 gap-xl-0">
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input class="form-control" type="text" placeholder="Brands Name" name="company_name" value="{{ old('company_name', $company->company_name ?? 'not found') }}" />
                            @error('company_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label for="company_logo">Company Logo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="company_logo" name="company_logo">
                                    <label class="custom-file-label form-control" for="company_logo" data-browse="">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="browse btn btn-primary px-4" type="button" onclick="document.getElementById('company_logo').click()">Browse</button>
                                </div>
                            </div>
                            @error('company_logo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <!-- company logo open -->
                            @if (!empty($companyProfile->company_logo))
                            <div class="mt-1">
                                <img src="{{ asset($companyProfile->company_logo ?? '') }}" class="img-fluid" width="100">
                            </div>
                            @endif
                            <!-- company logo close -->
                        </div>
                    </div>

                    <!-- Company Type -->
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label for="type_of_comapny">Type of Company</label>
                            <div class="input-group">
                                <select class="js-select2 w-100" aria-label="Default select example" id="type_of_comapny" name="type_of_company[]" multiple>
                                    <option value="">Select</option>
                                    @foreach($companyTypes as $typCmpny)
                                    <option data-typeofcompany_id="{{$typCmpny->id}}" value="{{$typCmpny->id}}" @if (in_array($typCmpny->id, explode(",", $companyProfile->type_of_company ?? ''))) selected @endif> {{$typCmpny->type_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Close company Type -->

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label for="certificate">Certification</label>
                            <div class="input-group">
                                <select class="js-select2 w-100" aria-label="Default select example" id="certificate" name="certificate[]" multiple>
                                    <option value="">Select</option>
                                    @foreach ($certifications as $certificate)
                                    <option value="{{$certificate->id}}" @if (in_array($certificate->id, explode(",", $companyProfile->certificate??''))) selected @endif>{{$certificate->certification}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-select" id="category_id" name="company_category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories as $key => $category)
                                <option value="{{ $category->id }}" {{ old('company_category_id' ,$companyProfile->company_category_id??'') == $category->id ? 'selected' :''}}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('company_category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Sub Category</label>
                            <select class="form-select" id="sub_category_id" name="company_sub_category_id">
                            </select>
                            @error('company_sub_category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Industry</label>
                            <select class="form-select" name="industry">
                                <option value="">Select Industry</option>
                                @foreach ($industries as $industry)
                                <option value="{{ $industry->id }}" {{ old('industry' , $companyProfile->industry??'') == $industry->id ? 'selected':'' }}>
                                    {{ $industry->industry }}
                                </option>
                                @endforeach
                            </select>
                            @error('industry')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Brands Logo</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="brand_logo" name="brand_logo[]">
                                        <label class="custom-file-label form-control" for="brand_logo" data-browse="">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="browse btn btn-primary px-4" type="button" onclick="document.getElementById('brand_logo').click()">Browse</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Brand Website</label>
                            <input class="form-control" type="text" class="mt-1" placeholder="Brand Website" name="brand_website[]" />
                        </div>
                    </div> -->
                    <div class="col-12 clone-row">
                        <div class="row">
                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="form-group">
                                    <label>Brand Name</label>
                                    <input class="form-control" type="text" placeholder="Brands Name" name="brand_name[]" />
                                    @error('brand_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="form-group">
                                    <label>Brands Logo</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="brand_logo" name="brand_logo[]">
                                                <label class="custom-file-label form-control" for="brand_logo" data-browse="">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <button class="browse btn btn-primary px-4" type="button" onclick="document.getElementById('brand_logo').click()">Browse</button>
                                            </div>
                                        </div>
                                    </div>
                                    @error('brand_logo.*')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-11 col-xl-5 mb-0 mb-xl-4">
                                <div class="form-group">
                                    <label>Brand Website</label>
                                    <input class="form-control" type="text" class="mt-1" placeholder="Brand Website" name="brand_website[]" />
                                    @error('brand_website.*')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-1 col-md-1" style="margin-top:29px;">
                                <span class="btn btn-danger btn-xs pull-right btn-del-select">Remove</span>
                            </div>

                        </div>

                        <!-- <div class="row"> -->
                        <!-- </div> -->
                    </div>
                    <div class="col-12 text-end">
                        <span class="btn btn-primary btn-xs add-select">Add More</span>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            @foreach ($companyBrandLogos as $brand)
                            <div class="col-3">
                                <div class="addded-team card">
                                    <!-- <a href="{{ route('brnad.logo.delete', $brand->id) }}" class="close-icon companyBrandlgo-link" data-id="{{ $brand->id }}">
                                <img src="{{ asset('Admin/assets/dist/images/trash-icon1.svg') }}">
                            </a> -->
                                    <img src="{{ asset($brand->brand_logo??'') }}" class="card-img-top" width="100">
                                    <h5 class="card-title">{{ $brand->brand_name ??'' }}</h5>
                                    <div class="card-body">
                                        <label class="card-text">
                                            <label>Brand name - <em id="member-position">{{ $brand->brand_website??'' }}</em></label>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!---- close add type ---->
                <div class="row gap-3 gap-xl-0" id="accordion-body-Exchange">
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Started In</label>
                            <input class="form-control" type="date" name="started_in" value="{{ old('started_in', $companyProfile->started_in ?? '') }}" />
                            @error('started_in')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Number of Employee</label>
                            <select class="form-select" name="number_of_employee" id="">
                                <option value="default">Select Number Of employee</option>
                                @foreach ($numberOfEmployees as $numberOfEmployee)
                                <option value="{{ $numberOfEmployee->id }}" {{ old('number_of_employee', $companyProfile->number_of_employee ?? '') == $numberOfEmployee->id ? 'selected' :''}}>
                                    {{ $numberOfEmployee->number_of_employee }}
                                </option>
                                @endforeach
                            </select>
                            @error('number_of_employee')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label> About Company </label>
                            <textarea class="form-control" name="about_company">{{ old('about_company' ,$companyProfile->about_company??'') }}</textarea>
                            @error('about_company')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        (function($) {
            "use strict";

            $(".js-select2").select2({
                closeOnSelect: false,
                placeholder: "Click to select an option",
                allowHtml: true,
                allowClear: true,
                tags: true // ÑÐ¾Ð·Ð´Ð°ÐµÑ‚ Ð½Ð¾Ð²Ñ‹Ðµ Ð¾Ð¿Ñ†Ð¸Ð¸ Ð½Ð° Ð»ÐµÑ‚Ñƒ
            });

            $('.icons_select2').select2({
                width: "100%",
                templateSelection: function(icon) {
                    return iformat(icon, parameter1, parameter2);
                },
                templateResult: function(icon) {
                    return iformat(icon, parameter1, parameter2);
                },
                allowHtml: true,
                placeholder: "Click to select an option",
                dropdownParent: $('.select-icon'), // Ð¾Ð±Ð°Ð²Ð¸Ð»Ð¸ ÐºÐ»Ð°ÑÑ
                allowClear: true,
                multiple: false
            });

            function iformat(icon, parameter1, parameter2) {
                var originalOption = icon.element;
                var originalOptionBadge = $(originalOption).data('badge');
                // You can use parameter1 and parameter2 here as needed
                return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '<span class="badge">' + originalOptionBadge + '</span></span>');
            }
        })(jQuery);
        populateSubcategories($('#category_id').val(), "{{ old('company_sub_category_id' ,$companyProfile->company_sub_category_id??'') }}");

        $('#category_id').on('change', function() {
            var selectedCategoryId = $(this).val();
            populateSubcategories(selectedCategoryId);
        });

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

    function populateSubcategories(selectedCategoryId, subCategoryId = '') {
        var data = {
            categoryId: selectedCategoryId,
            _token: "{{ csrf_token() }}",
        };
        $('#sub_category_id').html('');
        $('#sub_category_id').append($('<option>', {
            value: '',
            text: 'Select Sub Category',
        }));
        if (selectedCategoryId) {
            $.ajax({
                url: "{{ route('company.sub-category') }}",
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(data) {
                    $.each(data, function(key, subcategory) {
                        $('#sub_category_id').append($('<option>', {
                            value: subcategory.id,
                            text: subcategory.name,
                            selected: subcategory.id == subCategoryId
                        }));
                    });
                }
            });
        }
    }
</script>
@endpush