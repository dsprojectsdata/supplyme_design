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
        <form class="py-4" method="POST" action="{{ route('company.update.structure') }}" enctype="multipart/form-data">
            <div class="container">
                @csrf
                <input type="hidden" name="company_id" value="{{ $company->id }}" />


                <div class="row gap-3 gap-xl-0">

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Profile / Positions</label>
                            <select class="form-select" aria-label="Default select example" name="profile_positions">
                                <option value="">Select</option>
                                @foreach ($profile_positions as $profile_position)
                                <option value="{{ $profile_position->id }}" {{ old('profile_positions', $companyProfile->profile_positions ?? '') == $profile_position->id ? 'selected' : '' }}>
                                    {{ $profile_position->profile_position }}
                                </option>
                                @endforeach
                            </select>
                            @error('profile_positions')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Enter Name</label>
                            <input class="form-control" type="text" placeholder="Link to Annual Report" name="organisational_structre_name" value="{{ old('organisational_structre_name', $companyProfile->organisational_structre_name ?? '') }}" />
                            @error('organisational_structre_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Enter Email</label>
                            <input class="form-control" type="text" placeholder="Link to Annual Report" name="organisational_structre_email" value="{{ old('organisational_structre_email', $companyProfile->organisational_structre_email ?? '') }}" />
                            @error('organisational_structre_email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label for="Organisational_image">Organization Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="Organisational_image" name="Organisational_image">
                                    <label class="custom-file-label form-control" for="Organisational_image" data-browse="">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="browse btn btn-primary px-4" type="button" onclick="document.getElementById('Organisational_image').click()">Browse</button>
                                </div>
                            </div>
                            @error('Organisational_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if (!empty($companyProfile->Organisational_image))
                            <div class="mt-1">
                                <img src="{{ asset($companyProfile->Organisational_image ?? '') }}" class="img-fluid" width="100">
                            </div>
                            @endif
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
<script>
    $(document).ready(function() {
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
@endpush