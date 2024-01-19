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
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
<div class="row">
    <div class="col-md-12 bg-white">
        @include('SuperAdmin.company-edit.layouts.index')
    </div>
    <div class="col-md-12">
        <form class="py-4" method="POST" action="{{ route('company.update.products') }}" enctype="multipart/form-data">
            <div class="container">
                @csrf
                <input type="hidden" name="company_id" value="{{ $company->id }}" />


                <div class="row gap-3 gap-xl-0">
                    <div class="col-12 clone-row">
                        <div class="row">
                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="form-group">
                                    <label>Type of Offering</label>
                                    <select class="form-select type-of-offering" data-id=1 aria-label="Default select example" name="type_of_offering[]">
                                        <option value="">Select</option>
                                        <option value="product">Product</option>
                                        <option value="service">Service</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="form-group">
                                    <label>Product category</label>
                                    <select class="form-select product_category" aria-label="Default select example" name="product_category[]">
                                        <option value="">Select</option>
                                        @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">
                                            {{ $cat->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('product_category')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="form-group">
                                    <label>Product Sub Category</label>
                                    <select class="form-select product_sub_category" aria-label="Default select example" name="product_sub_category[]">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input class="form-control" type="text" placeholder="Product Name" name="product_name[]" />
                                    @error('product_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-xl-6 mb-0 mb-xl-3 product-annual-1" style="display: none;">
                                <div class="form-group">
                                    <label>Annual Capacity</label>
                                    <input class="form-control" type="text" placeholder="Annual Capacity" name="product_annual[]" />
                                    @error('product_annual')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                    <b>Currently Exported</b>
                                    <div class="radio-custme">
                                        <div class="radio-custme-in">
                                            <input data-id=1 class="product-export" id="test1" type="radio" value="yes" name="product_currently_export[]">
                                            <label for="test1">Yes</label>
                                        </div>
                                        <div class="radio-custme-in">
                                            <input data-id=1 class="product-export" id="test2" type="radio" value="no" name="product_currently_export[]" checked>
                                            <label for="test2">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-xl-6 mb-0 mb-xl-3 data-product-country-1" style="display: none;">
                                <div class="input-wrapper">
                                    <b>Countries</b>
                                    <select id="country" class="form-select" name="product_country[]">
                                        <option>Select</option>
                                        @foreach($countries as $key=>$country)
                                        <option value="{{$country->id}}">{{$country->emoji}}{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                <div class="form-group">
                                    <label> Product Description </label>
                                    <textarea class="form-control" name="product_description[]"></textarea>
                                    @error('product_description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-wrapper">
                                    <b>Add Product Images (Up to 10)</b>
                                    <div class="form-group" x-data="imageUploader()">
                                        <div class="row">
                                            <template x-for="(fileInput, index) in fileInputs" :key="index">
                                                <div class="input-group mb-2 col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <input type="file" x-ref="fileInput" name="product_images-0[]" class="d-none">
                                                    <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileInput.fileName">
                                                    <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.fileInput.click()">Browse</button>
                                                    <button class="remove btn btn-danger" type="button" x-on:click.prevent="removeImage(index)">Remove</button>
                                                </div>
                                            </template>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-end">
                                                <button class="add-more btn btn-success mb-3" type="button" x-on:click.prevent="addImage" x-bind:disabled="fileInputs.length >= 10">Add More Image</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <span class="btn btn-primary btn-xs add-select">Add More</span>
                    </div>
                </div>

                @foreach($companyProductService as $prodServs)
                <div class="addded-team products-address mt-1" data-container-id="{{ $prodServs->id }}">
                    <!-- <a href="{{route('product.delete', $prodServs->id)}}" class="close-icon delete-link" data-id="{{ $prodServs->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a> -->

                    <span><img src="{{ asset('Admin/assets/dist/images/location-icon.svg') }}" class="img-fluid" width="80"></span>
                    <div class="addded-iner">
                        <h2 id="member-name"> Address {{$prodServs->type_of_offering}}</h2>
                        <label class="addded-text">
                            <b>Category - <em id="member-position">{{$prodServs->categories->name ?? ''}}</em></b>
                            <b>SubCategory - <em id="member-position">{{$prodServs->subcategories->name ?? ''}}</em></b>
                            <b>Product Name - <em id="member-position">{{$prodServs->product_name ?? ''}}</em></b>
                            <b>Product Annual - <em id="member-position">{{$prodServs->product_annual ?? ''}}</em></b>
                        </label>
                        <label class="addded-text">
                            <b>Currently Export - <em id="member-position">{{$prodServs->product_currently_export ?? ''}}</em></b>
                            <b>Country - <em id="member-position">{{$prodServs->countries->name ?? ''}}</em></b>
                            <b>Description - <em id="member-position">{{$prodServs->product_description ?? ''}}</em></b>
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="action-buttons d-none d-md-flex py-3 border bg-white justify-content-between position-fixed bottom-0 w-100 px-5" style="border-color:#B4B6BD;">
                <div class="col-12 col-md-4 ">
                    <button class="btn px-4 text-white" id="formid" value="submit" type="submit" style="background: #D39D36;">Save as Draft</button>
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

        // Event delegation for category selection
        $(document).on('change', '.product_category', function() {
            var selectedCategoryId = $(this).val();
            var data = {
                categoryId: selectedCategoryId,
                _token: "{{ csrf_token() }}",
            };

            var subCat = $(this).closest('.clone-row').find('.product_sub_category');
            subCat.html('');
            subCat.append($('<option>', {
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
                            subCat.append($('<option>', {
                                value: subcategory.id,
                                text: subcategory.name,
                            }));
                        });
                    }
                });
            }
        });

        $('.btn-del-select').hide();
        var productServiceCount = 2;
        $(document).on('click', '.add-select', function() {
            $(".clone-row").append(`<div class="row product-service-${productServiceCount}">
                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="form-group">
                                    <label>Type of Offering</label>
                                    <select class="form-select type-of-offering" data-id=${productServiceCount} aria-label="Default select example" name="type_of_offering[]">
                                        <option value="">Select</option>
                                        <option value="product">Product</option>
                                        <option value="service">Service</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="form-group">
                                    <label>Product category</label>
                                    <select class="form-select product_category" aria-label="Default select example" name="product_category[]">
                                        <option value="">Select</option>
                                        @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">
                                            {{ $cat->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('product_category')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="form-group">
                                    <label>Product Sub Category</label>
                                    <select class="form-select product_sub_category" aria-label="Default select example" name="product_sub_category[]">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input class="form-control" type="text" placeholder="Product Name" name="product_name[]" />
                                    @error('product_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-xl-6 mb-0 mb-xl-3 product-annual-${productServiceCount}" style="display: none;">
                                <div class="form-group">
                                    <label>Annual Capacity</label>
                                    <input class="form-control" type="text" placeholder="Annual Capacity" name="product_annual[]" />
                                    @error('product_annual')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                    <b>Currently Exported</b>
                                    <div class="radio-custme">
                                        <div class="radio-custme-in">
                                            <input data-id=${productServiceCount} class="product-export" type="radio" id="test1-${productServiceCount}" value="yes" name="product_currently_export[${productServiceCount}]">
                                            <label for="test1-${productServiceCount}">Yes</label>
                                        </div>
                                        <div class="radio-custme-in">
                                            <input data-id=${productServiceCount} class="product-export" type="radio" id="test2-${productServiceCount}" value="no" name="product_currently_export[${productServiceCount}]" checked>
                                            <label for="test2-${productServiceCount}">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-xl-6 mb-0 mb-xl-3 data-product-country-${productServiceCount}" style="display: none;">
                                <div class="input-wrapper">
                                    <b>Countries</b>
                                    <select id="country" class="form-select" name="product_country[]">
                                        <option>Select</option>
                                        @foreach($countries as $key=>$country)
                                        <option value="{{$country->id}}">{{$country->emoji}}{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                <div class="form-group">
                                    <label> Product Description </label>
                                    <textarea class="form-control" name="product_description[]"></textarea>
                                    @error('product_description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-wrapper">
                                    <b>Add Product Images (Up to 10)</b>
                                    <div class="form-group" x-data="imageUploader()">
                                        <div class="row">
                                            <template x-for="(fileInput, index) in fileInputs" :key="index">
                                                <div class="input-group mb-2 col-12 col-xl-6 mb-0 mb-xl-3">
                                                    <input type="file" x-ref="fileInput" name="product_images-${productServiceCount}[]" class="d-none">
                                                    <input type="text" class="form-control form-control-lg" placeholder="Your Files" x-model="fileInput.fileName">
                                                    <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.fileInput.click()">Browse</button>
                                                    <button class="remove btn btn-danger" type="button" x-on:click.prevent="removeImage(index)">Remove</button>
                                                </div>
                                            </template>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-end">
                                                <button class="add-more btn btn-success mb-3" type="button" x-on:click.prevent="addImage" x-bind:disabled="fileInputs.length >= 10">Add More Image</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-0 mb-xl-3 text-end" style="margin-top:29px;">
                                <span class="btn btn-danger btn-xs pull-right btn-del-select" data-id=${productServiceCount}>Remove</span>
                            </div>
                        </div>`);
            productServiceCount++;
        });

        $(document).on('change', '.product-export', function() {
            let data_id = $(this).data('id');
            if ($(this).val() == "yes") {
                $('.data-product-country-' + data_id).show();
            } else {
                $('.data-product-country-' + data_id).hide();
            }
        });

        $(document).on('change', '.type-of-offering', function() {
            var dataId = $(this).data("id");
            if ($(this).val() === "product") {
                $(".product-annual-" + dataId).show();
            } else {
                $(".product-annual-" + dataId).hide();
            }
        });

        $(document).on('click', '.btn-del-select', function() {
            var dataId = $(this).data("id");
            $('.product-service-' + dataId).remove();
        })

    });

    function imageUploader() {
        return {
            fileInputs: [],

            addImage() {
                if (this.fileInputs.length < 10) {
                    this.fileInputs.push({
                        fileName: ''
                    });
                } else {
                    alert('You have reached the maximum limit of 10 images.');
                }
            },

            removeImage(index) {
                this.fileInputs.splice(index, 1);
            }
        };
    }
</script>
@endpush