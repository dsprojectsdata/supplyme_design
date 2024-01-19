@extends('SuperAdmin.layout.app')
@section('superadmincontent')
@include('SuperAdmin.company-edit.layouts.index')

<div class="container">
    <div class="row">
        <div class="col-12 col-md-7 col-xl-9 ">
            <div class="d-flex flex-column pb-4">
                <h2 class="pb-2">Company Profile</h2>
                <p>A short description about the Product Details required.</p>
            </div>

            <form method="POST" action="{{ route('company.update.profile') }}">
                @csrf
                <input type="hidden" name="company_id" value="{{ $company->id }}" />
                <div class="row gap-3 gap-xl-0">
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="input-wrapper">
                            <b>Company Name</b>
                            <input type="text" placeholder="Brands Name" name="company_name" value="{{ $company->company_name ?? 'not found' }}" />
                            @error('company_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="input-wrapper">
                            <b>Company Logo</b>
                            <div class="form-group" x-data="{ fileName: '' }">
                                <div class="input-group">
                                    <input type="file" x-ref="file" @change="fileName = $refs.file.files[0].name" name="company_logo" class="d-none">
                                    <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileName">
                                    <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                                </div>
                                <!-- company logo open -->
                                @if (!empty($companyProfile))
                                <div class="mt-1">
                                    <a href="{{ route('company.logo.delete', $companyProfile->id) }}">
                                        <img src="{{ asset('Admin/assets/dist/images/trash-icon1.svg') }}">
                                    </a>
                                    <span><img src="{{ asset($companyProfile->company_logo) }}"></span>
                                </div>
                                @endif
                                <!-- company logo close -->
                            </div>
                        </div>
                    </div>

                    <!-- Company Type -->
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="input-wrapper">
                            <b>Type of Company</b>
                            <select aria-label="Default select example" name="type_of_company">
                                <option value="">Select</option>
                                @foreach ($companyTypes as $companyType)
                                <option value="{{ $companyType->id }}" {{ $companyProfile->type_of_company == $companyType->id ? 'selected' : '' }}">
                                    {{ $companyType->type_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Close company Type -->

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="input-wrapper">
                            <b>Certification</b>
                            <select aria-label="Default select example" name="certificate">
                                <option value="">Select</option>
                                @foreach ($certifications as $certificate)
                                <option value="{{ $certificate->id }}" @if ($companyProfile->certificate === $certificate->id) selected @endif>
                                    {{ $certificate->certification }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="input-wrapper">
                            <b>Category</b>
                            <select id="category_id" name="company_category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories as $key => $category)
                                <option value="{{ $category->id }}" {{ $companyProfile->company_category_id == $category->id ? 'selected' : ' ' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="input-wrapper">
                            <b>Sub Category</b>
                            <select id="sub_category_id" name="company_subcategory_id">
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="input-wrapper">
                            <b>Industry</b>
                            <select name="industry">
                                <option value="">Select Industry</option>
                                @foreach ($industries as $industry)
                                <option value="{{ $industry->id }}" @if ($companyProfile->industry === $industry->id) selected @endif>
                                    {{ $industry->industry }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="input-wrapper">
                            <b>Brand Name</b>
                            <input type="text" placeholder="Brands Name" name="brand_name" value="{{ $companyProfile->brand_name }}" />
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="input-wrapper">
                            <b>Brands Logo</b>
                            <div class="form-group mt-1" x-data="{ 'fileName' }">
                                <div class="input-group">
                                    <input type="file" x-ref="file" @change="fileName = ." name="brand_logo[]" class="d-none" value="">
                                    <input type="text" class="form-control form-control-lg" x-model="fileName">
                                    <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="input-wrapper">
                            <b>Brand Website</b>
                            <input type="text" class="mt-1" placeholder="Brand Website" name="brand_website[]" />
                        </div>
                    </div>

                    @foreach ($companyBrandLogos as $brand)
                    <div class="row mt-1">
                        <div class="addded-team">
                            <a href="{{ route('brnad.logo.delete', $brand->id) }}" class="close-icon companyBrandlgo-link" data-id="{{ $brand->id }}">
                                <img src="{{ asset('Admin/assets/dist/images/trash-icon1.svg') }}">
                            </a>
                            <span><img src="{{ asset($brand->brand_logo) }}"></span>
                            <div class="addded-iner">
                                <h2 id="member-name">{{ $brand->brand_website }}</h2>
                                <label class="addded-text">
                                    <b>Brand name - <em id="member-position">{{ $brand->brand_website }}</em></b>
                                </label>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <!---- close add type ---->


                <!-- <div class="col-12 col-xl-6 mb-0 mb-xl-3 mt-1">
                                <div class="input-wrapper">
                                    <a class="btn btn-outline-primary add-icon" id="add-brandName"> + Add Brand Name</a>
                                    <a class="delete-brandName btn btn-outline-danger text-dark"> - Remove Brand Name</a>
                                </div>
                            </div> -->

                <div class="row gap-3 gap-xl-0" id="accordion-body-Exchange">
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="input-wrapper">
                            <b>Started In</b>
                            <input type="date" name="started_in" value="{{ $companyProfile->started_in }}" />
                        </div>
                    </div>
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="input-wrapper">
                            <b>Number of Employee</b>
                            <select name="number_of_employee" id="">
                                <option value="default">Select Number Of employee</option>
                                @foreach ($numberOfEmployees as $numberOfEmployee)
                                <option value="{{ $numberOfEmployee->id }}" @if ($companyProfile->number_of_employee === $numberOfEmployee->id) selected @endif>
                                    {{ $numberOfEmployee->number_of_employee }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                        <div class="input-wrapper">
                            <b> About Company </b>
                            <textarea name="about_company">{{ $companyProfile->about_company }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex py-3 border bg-white justify-content-between position-fixed bottom-0 w-100 px-5" style="border-color:#B4B6BD;">
                    <div class="col-12 col-md-4 ">
                        <button class="btn px-4 text-white" id="formid" value="submit" type="submit" style="background: #D39D36;">Save
                            as Draft</button>
                    </div>
            </form>
            {{-- <div class="row"> --}}
            <div class="col-12 col-md-8 text-center">
                <button class="btn btn-outline-secondary px-4 me-2" id="prev"><i class="bi bi-chevron-left"></i>
                    Previous</button>
                <button class="btn btn-primary px-4" id="next">Next <i class="bi bi-chevron-right"></i></button>
            </div>
            {{-- </div> --}}
        </div>
    </div>
</div>
@endsection




<div class="accordion-item border mb-3">
    <h2 class="accordion-header" id="flush-headingOne">
        <button class="accordion-button collapsed d-flex gap-3" style="background:#EAEFF0;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
            Reg.Address Office Address
        </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">

            <div class="row gap-3 gap-xl-0">
                <div class="row gap-3 gap-xl-0" id="body-addAnotherAddress">
                    <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                        <div class="form-group">
                            <b>Address</b>
                            <textarea class="form-control" name="reg_office_address[]"></textarea>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <b>State</b>
                            <select class="form-select" id="state_1" class="state" name="company_location_state_id[]" data-state_id="1">
                                <option selected>Select</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <b>City</b>
                            <select class="form-select" id="city_1" name="company_city_id[]">
                                <option selected>Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <b>ZIP Code</b>
                            <input class="form-control" type="text" name="company_zipcode[]" />
                        </div>
                    </div>

                </div>
                <div class="col-12 col-xl-12 mb-0 mb-xl-3 mt-1">
                    <a class="btn btn-outline-primary add-icon" id="addAnotherAddress"> + Add Another Address </a>
                    <a class="deleteAnotherAddress btn btn-outline-danger text-dark"> - Remove Another Address</a>
                </div>
            </div>


        </div>
    </div>
</div>

@push('custom-scripts')
<script>
    $(document).ready(function() {
        populateSubcategories($('#category_id').val(), "{{ $companyProfile->company_sub_category_id }}");

        $('#category_id').on('change', function() {
            var selectedCategoryId = $(this).val();
            populateSubcategories(selectedCategoryId);
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