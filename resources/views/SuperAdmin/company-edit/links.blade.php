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
        <form class="py-4" method="POST" action="{{ route('company.update.links') }}" enctype="multipart/form-data">
            <div class="container">
                @csrf
                <input type="hidden" name="company_id" value="{{ $company->id }}" />
                <div class="row gap-3 gap-xl-0">
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Website</label>
                            <input class="form-control" type="text" placeholder="Website" name="website" value="{{ old('website', $companyProfile->website) }}" />
                            @error('website')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>LinkedIn</label>
                            <input class="form-control" type="text" placeholder="LinkedIn" name="linkedIn" value="{{ old('linkedIn', $companyProfile->linkedIn) }}" />
                            @error('linkedIn')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Facebook</label>
                            <input class="form-control" type="text" placeholder="Facebook" name="facebook" value="{{ old('facebook', $companyProfile->facebook) }}" />
                            @error('facebook')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Instagram</label>
                            <input class="form-control" type="text" placeholder="Instagram" name="instagram" value="{{ old('instagram', $companyProfile->instagram) }}" />
                            @error('instagram')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Twitter</label>
                            <input class="form-control" type="text" placeholder="Twitter" name="twitter" value="{{ old('twitter', $companyProfile->twitter) }}" />
                            @error('twitter')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                        <div class="form-group">
                            <label>Youtube</label>
                            <input class="form-control" type="text" placeholder="Youtube" name="youtube" value="{{ old('youtube', $companyProfile->youtube) }}" />
                            @error('youtube')
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