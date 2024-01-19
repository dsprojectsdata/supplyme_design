@extends('Admin.layout.app')
@section('admincontent')

<div class="main-content px-md-4 px-2 py-4" style="margin-top:57px">
    <div class="container-fluid">
        <h6>View All Catelog</h6>
        <div class="row">
        @foreach($catelog as $cat)
            <div class="col-md-5">
                <div class="addded-team mt-1 productCatlog-address product_catalog" data-product-Container-id="{{ $cat->id }}">
                    <a href="{{ route('product_catelog.delete', $cat->id) }}" class="close-icon delete-product-link" data-id="{{ $cat->id }}">
                        <img src="{{ asset('Admin/assets/dist/images/trash-icon1.svg') }}" onerror="img_onError(this)">
                    </a>
                    <span>
                        <img src="{{ asset($cat->add_product_catalog) }}" onerror="img_onError(this)">
                        <strong>FileName:</strong><small>{{ pathinfo($cat->add_product_catalog, PATHINFO_BASENAME) }}</small>
                        <br>
                        <a href="{{ asset($cat->add_product_catalog) }}" download>Download</a>
                    </span>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>

<style>
    .addded-team{
        height: 100px;
    }
</style>
@endsection('admincontent')