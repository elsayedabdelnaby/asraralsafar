@extends('dashboard.layouts.app')
@section('title', __('merchants::dashboard.products_management'))

@section('head-css')
    <link href="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('subheader')

    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ __('merchants::dashboard.products_management') }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard.merchants.products.index',['merchant_id'=>$merchant->id]) }}"
                               class="text-muted">{{ __('merchants::dashboard.products') }}</a>
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
                <h3 class="card-label">{{ __('merchants::dashboard.products') }}</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->

                <!-- Button trigger product basic modal-->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productBasicModal">
                    {{__('merchants::dashboard.import_product') }}
                </button>
                <!-- Price Update Modal-->
                <div class="modal fade" id="productBasicModal" tabindex="-1" role="dialog"
                     aria-labelledby="productBasicModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"
                                    id="productBasicModalLabel">{{__('merchants::dashboard.import_product') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i aria-hidden="true" class="ki ki-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!--begin::Price Form-->
                                <form class="form parsley-form"
                                      action="{{ route('dashboard.merchants.products.import-product', ['merchant_id'=>$merchant->id]) }}"
                                      method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>File Browser</label>
                                            <div></div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="product_simple" name="product_simple"/>
                                                <label class="custom-file-label" for="product_simple">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit"
                                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">
                                        {{ __('locations::dashboard.save') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Modal-->

                <!-- Button trigger price modal-->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productPriceModal">
                    {{__('merchants::dashboard.import_price') }}
                </button>
                <!-- Price Update Modal-->
                <div class="modal fade" id="productPriceModal" tabindex="-1" role="dialog"
                     aria-labelledby="productPriceModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"
                                    id="productPriceModalLabel">{{__('merchants::dashboard.import_price') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i aria-hidden="true" class="ki ki-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!--begin::Price Form-->
                                <form class="form parsley-form"
                                      action="{{ route('dashboard.merchants.products.import-price', ['merchant_id'=>$merchant->id]) }}"
                                      method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>File Browser</label>
                                            <div></div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="product_price" name="product_price"/>
                                                <label class="custom-file-label" for="product_price">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit"
                                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">
                                        {{ __('locations::dashboard.save') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Modal-->

                <!--begin::Button-->
                <a href="{{ route('dashboard.merchants.products.export-simple', ['merchant_id'=>$merchant->id]) }}"
                   class="btn btn-info font-weight-bolder">
                    {{ __('merchants::dashboard.export_products') }}</a>
                <!--end::Button-->

                <!--begin::Button-->
                <a href="{{ route('dashboard.merchants.products.export-variant', ['merchant_id'=>$merchant->id]) }}"
                   class="btn btn-info font-weight-bolder">
                    {{ __('merchants::dashboard.export_variants') }}</a>
                <!--end::Button-->

                <!--begin::Button-->
                <a href="{{ route('dashboard.merchants.products.create',['merchant_id'=>$merchant->id]) }}"
                   class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <i class="fas fa-plus"></i>
                    </span>{{ __('merchants::dashboard.new_products') }}
                </a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable"
                   style="margin-top: 13px !important">
                <thead>
                <tr>
                    <th>{{ __('merchants::dashboard.id') }}</th>
                    <th>{{ __('merchants::dashboard.name') }}</th>
                    <th>{{ __('merchants::dashboard.image') }}</th>
                    <th>{{ __('merchants::dashboard.type') }}</th>
                    <th>{{ __('merchants::dashboard.accept_additions') }}</th>
                    <th>{{ __('merchants::dashboard.price') }}</th>
                    <th>{{ __('merchants::dashboard.discount_price') }}</th>
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
    @include('merchants::products.indexing.scripts');
@endpush
