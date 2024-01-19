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

    .addded-team {
        background: #f4f4f4;
        border: 1px solid #ddd;
        padding: 12px;
        border-radius: 8px;
        position: relative;
        display: flex;
        justify-content: start;
        align-items: start;
        align-content: start;
    }

    .companyLocation-link{
        max-width: 30px
    }
    .companyLocation-image{
        max-width: 40px
    }
</style>
<div class="row">
    <div class="col-md-12 bg-white">
        @include('SuperAdmin.company-edit.layouts.index')
    </div>
    <div class="col-md-12">
        <form class="py-4" method="POST" action="{{ route('company.update.location') }}" enctype="multipart/form-data">
            <div class="container">
                @csrf
                <input type="hidden" name="company_id" value="{{ $company->id }}" />
                <div class="accordion-item border mb-3 ">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed d-flex gap-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Reg.Address Office Address
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                            <div class="row gap-3 gap-xl-0">
                                <div class="col-12 clone-row">
                                    <div class="row">
                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control" name="reg_office_address[]"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="form-group">
                                                <label>Country</label>

                                                <select class="form-control country" name="company_location_country_id[]" onchange="getState(this.value,0,'0')">
                                                    <option>Select</option>
                                                    @foreach($countries as $key=>$country)
                                                    <option value="{{$country->id}}">{{$country->emoji}}{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select id="state_0" class="form-control state" name="company_location_state_id[]" onchange="getCity(this.value,0,'0')">
                                                    <option selected>Select</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <select id="city_0" class="form-control" name="company_city_id[]">
                                                    <option selected>Select</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="form-group">
                                                <label>Zipcode</label>
                                                <input class="form-control" type="text" name="company_zipcode[]" />

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                                <div class="form-group">
                                    <span class="btn btn-primary btn-xs add-select">+ Add Another Address</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">

                                    <!-- reg address view open -->
                                    @foreach($companyRegAddress as $regAddress)
                                    <div class="addded-team mt-1 company_location" data-companyLocation_container-id="{{ $regAddress->id }}">
                                        <a href="{{route('company_location.delete', $regAddress->id)}}" class="close-icon companyLocation-link" data-id="{{ $regAddress->id }}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>

                                        <span class="companyLocation-image"><img src="{{ asset('Admin/assets/dist/images/location-icon.svg') }}"></span>
                                        <div class="addded-iner">
                                            <h4 id="member-name"> Address {{$regAddress->address}}</h4>
                                            <label class="addded-text">
                                                <b>Country Name - <em id="member-position">{{$regAddress->company_location_country}}</em></b>
                                                <b>State Name - <em id="member-position">{{$regAddress->company_location_state}}</em></b>
                                                <b>City Name - <em id="member-position">{{$regAddress->company_location_city}}</em></b>
                                                <b>Zip Code - <em id="member-position">{{$regAddress->zipcode}}</em></b>
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- reg address view close -->
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Primary Contact Information -->

                <div class="accordion-item border mb-3 ">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed d-flex gap-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Primary Contact Information
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                            <div class="row gap-3 gap-xl-0">
                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                    <div class="form-group ">
                                        <label>Purpose</label>
                                        <select class="form-control" name="purpose">
                                            <option value="">Select Purpose</option>
                                            <option value="sales" @if ($companyProfile->purpose === 'sales') selected @endif>Sales</option>
                                            <option value="hr" @if ($companyProfile->purpose === 'hr') selected @endif>HR</option>
                                            <option value="general" @if ($companyProfile->purpose === 'general') selected @endif>General</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{$companyProfile->useful_information_name}}">
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                    <div class="form-group">

                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="email" name="useful_information_email" value="{{$companyProfile->useful_information_email}}">
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                    <div class="form-group d-flex align-items-end">
                                        <label for="Contact Number">Contact Number</label>
                                        <select name="phonecode" id="" class="form-control" style="width: 15%;">
                                            @foreach($countries as $countrie)
                                            <option value="{{$countrie->phonecode}}"> {{$countrie->phonecode}} - {{$countrie->iso2}} </option>
                                            @endforeach
                                        </select>
                                        <input type="text" class="form-control" placeholder="Enter Phone Number" name="contact_number" value="{{$companyProfile->contact_number}}" style="width: 85%;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mailing Address -->
                <div class="accordion-item border mb-3 ">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed d-flex gap-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            Mailing Address
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                            <div class="row gap-3 gap-xl-0">
                                <div class="row gap-3 gap-xl-0" id="">

                                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                        <div class="form-group ">
                                            <label>Is Mailing Address different from Reg. Office Address</label>
                                            <div class="radio-custme">
                                                <div class="radio-custme-in">
                                                    <input class="different-mailing" type="radio" value="yes" id="different-mailing-1" name="different_mailing" @if($companyProfile->usfl_info_address) checked @endif>
                                                    <label for="different-mailing-1">Yes</label>
                                                </div>
                                                <div class="radio-custme-in">
                                                    <input class="different-mailing" type="radio" value="no" id="different-mailing-2" name="different_mailing" @if(!$companyProfile->usfl_info_address) checked @endif>
                                                    <label for="different-mailing-2">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mailing-address-section" @if(!$companyProfile->usfl_info_address) style="display: none;" @endif>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control" name="mailing_address">{{$companyProfile->usfl_info_address}}</textarea>

                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="form-group">

                                                <label>Country</label>
                                                <select name="mailing_country_id" class="form-control" onchange="getState(this.value,0,'mailing')">>
                                                    <option>Select</option>
                                                    @foreach($countries as $countrie)
                                                    <option value="{{$countrie->id}}" @if($countrie->id==$companyProfile->usfl_info_country_id) selected @endif> {{$countrie->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <select id="state_mailing" class="form-control" name="mailing_state_id" onchange="getCity(this.value,0,'mailing')">>
                                                    <option selected>Select</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="form-group">
                                                <label for="state">City</label>
                                                <select id="city_mailing" class="form-control" name="mailing_city_id">
                                                    <option selected>Select</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                            <div class="form-group">
                                                <label for="state">Zipcode</label>
                                                <input class="form-control" type="text" placeholder="zip code" name="mailing_zipcode" value="{{$companyProfile->usfl_info_zipcode}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Geographical Presence open -->

                <div class="accordion-item border mb-3 ">
                    <h2 class="accordion-header" id="flush-headingFour">
                        <button class="accordion-button collapsed d-flex gap-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                            Geographical Presence
                        </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                            <div class="row gap-3 gap-xl-0">
                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                    <div class="form-group ">
                                        <label>Country Name</label>
                                        <select class="form-control" name="geo_country_name" id="">
                                            @foreach($countries as $key=>$country)
                                            <option value="{{$country->id}}" @if($companyProfile->company_location_country_id == $country->id) selected @endif>{{$country->emoji}}{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location -->

                <div class="accordion-item border mb-3 ">
                    <h2 class="accordion-header" id="flush-headingFive">
                        <button class="accordion-button collapsed d-flex gap-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                            Location
                        </button>
                    </h2>
                    <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                            <div class="row gap-3 gap-xl-0">
                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                    <div class="form-group ">
                                        <label>Country Name</label>
                                        <select class="form-control" name="geo_country_name" id="location_country" onchange="getState(this.value,0,'location')">
                                            @foreach($countries as $key=>$country)
                                            <option value="{{$country->id}} @if($companyProfile->company_location_country_id == $country->id) selected @endif">{{$country->emoji}}{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                    <div class="form-group ">
                                        <label>State</label>
                                        <select id="state_location" class="form-control" name="location_state_id" onchange="getCity(this.value,0,'location')">
                                            <option selected>Select</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                    <div class="form-group ">
                                        <label>City</label>
                                        <select id="city_location" class="form-control" name="location_city_id">
                                            <option selected>Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

<script>
    function getState(country_id, state_id, state_section) {
        var data = {
            country_id: country_id,
            _token: "{{ csrf_token() }}",
        };
        let state = $('#state_' + state_section);
        state.html('');
        state.append($('<option>', {
            value: '',
            text: 'Select State',
        }));

        if (country_id) {
            $.ajax({
                url: "{{ route('company.getState') }}",
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(data) {
                    $.each(data, function(key, state) {
                        $('#state_' + state_section).append($('<option>', {
                            value: state.id,
                            text: state.name,
                        }));
                    });
                }
            });
        }
    }

    function getCity(state_id, city_id, city_section) {
        var data = {
            state_id: state_id,
            _token: "{{ csrf_token() }}",
        };
        let city = $('#city_' + city_section);
        city.html('');
        city.append($('<option>', {
            value: '',
            text: 'Select City',
        }));

        if (state_id) {
            $.ajax({
                url: "{{ route('company.getCity') }}",
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(data) {
                    $.each(data, function(key, city) {
                        $('#city_' + city_section).append($('<option>', {
                            value: city.id,
                            text: city.name,
                        }));
                    });
                }
            });
        }
    }

    $(document).ready(function() {
        $(document).on('change', '.different-mailing', function() {
            if ($(this).val() == "yes") {
                $('.mailing-address-section').show();
            } else {
                $('.mailing-address-section').hide();
            }
        });

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        $('.btn-del-select').hide();
        var addressCount = 1;
        $(document).on('click', '.add-select', function() {
            $('.clone-row').append(`
                <div class="row add-another-address-${addressCount}">
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" name="reg_office_address[]"></textarea>
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Country</label>

                            <select class="form-control country" name="company_location_country_id[]" onchange="getState(this.value,0,'${addressCount}')">
                                <option>Select</option>
                                @foreach($countries as $key=>$country)
                                <option value="{{$country->id}}">{{$country->emoji}}{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>State</label>
                            <select id="state_${addressCount}" class="form-control state" name="company_location_state_id[]" onchange="getCity(this.value,0,'${addressCount}')">
                                <option selected>Select</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label for="city">City</label>
                            <select id="city_${addressCount}" class="form-control" name="company_city_id[]">
                                <option selected>Select</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Zipcode</label>
                            <input class="form-control" type="text" name="company_zipcode[]" />

                        </div>
                    </div>

                    <div class="col-12 col-xl-6 text-end mb-2" style="margin-top:29px;">
                        <span class="btn btn-danger btn-xs pull-right btn-del-select" data-id=${addressCount}>Remove</span>
                    </div>
                </div>`);
            addressCount++;
        });
        $(document).on('click', '.btn-del-select', function() {
            var dataId = $(this).data("id");
            $('.add-another-address-' + dataId).remove();
        })
    });
</script>

@endpush