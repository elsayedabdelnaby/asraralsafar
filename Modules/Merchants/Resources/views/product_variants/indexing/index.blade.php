@extends('dashboard.layouts.app')
@section('title', __('merchants::dashboard.products_management'))

@section('head-css')
    <link href="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('subheader')

    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ __('merchants::dashboard.products_variants_management') }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard.merchants.products.index',['merchant_id'=>$merchant->id,'product_id'=>$product->id]) }}" class="text-muted">{{ __('merchants::dashboard.product_variants') }}</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">{{ __('merchants::dashboard.product_variants') }}</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->

                <a href="{{ route('dashboard.merchants.products-variant.create',['merchant_id'=>$merchant->id,'product_id'=>$product->id]) }}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <i class="fas fa-plus"></i>
                    </span>{{ __('merchants::dashboard.new_product_variants') }}
                </a>

                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                <thead>
                <tr>
                    <th>{{ __('merchants::dashboard.id') }}</th>
                    <th>{{ __('merchants::dashboard.price') }}</th>
                    <th>{{ __('merchants::dashboard.status') }}</th>
                    <th>{{ __('merchants::dashboard.actions') }}</th>
                </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>

@endsection

@push('javascript')
    <script src="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    @include('merchants::product_variants.indexing.scripts');
@endpush
