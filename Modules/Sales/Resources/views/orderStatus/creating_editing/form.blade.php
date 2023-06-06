@extends('dashboard.layouts.app')

@if (isset($order_status))
    @section('title', __('sales::dashboard.order_status_management') . ' - ' . __('sales::dashboard.edit_order_status'))

    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('sales::dashboard.edit_customer'),
            'short_description' => __('sales::dashboard.enter_the_order_status_details'),
            'breadcrumbs' => [],
        ]);
    @endsection
@else
    @section('title', __('sales::dashboard.order_status_management') . ' - ' . __('sales::dashboard.create_order_status'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('sales::dashboard.create_order_status'),
            'short_description' => __('sales::dashboard.enter_the_order_status_details'),
            'breadcrumbs' => [],
        ]);
    @endsection
@endif

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($order_status) ? __('sales::dashboard.edit_order_status') : __('sales::dashboard.create_order_status') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.sales.order-status.index') }}"
                    class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}</a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">

                <div id="kt_repeater">
                    <!-- Translations -->
                    <div class="form-group">
                        <div data-repeater-list="translations">
                            @forelse (old('translations', isset($order_status->translations) ? collect($order_status->translations)->toArray() : []) as $translation)
                                @include('sales::orderStatus.creating_editing.translations', $translation)
                            @empty
                                @include('sales::orderStatus.creating_editing.translations', [])
                            @endforelse
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-md-10 col-md-2">
                            <a href="javascript:;" data-repeater-create=""
                               class="btn btn-sm font-weight-bolder btn-light-primary">
                                <i class="la la-plus"></i>{{ __('settings::dashboard.add') }}
                            </a>
                        </div>
                    </div>
                    <!-- END Translations -->
                </div>
                <div class="form-group row">
                        <!-- Price -->
                        <div class="col-md-4">
                            <div class="row">
                                <label class="col-md-3 col-form-label font-weight-bold">{{ __('sales::dashboard.color') }}: </label>
                                <div class="col-md-9">
                                     <x-dashboard.form.inputs.color
                                         :id="'color'"
                                         :class="'form-control'"
                                         :name="'color'"
                                         :isRequired="true"
                                         :requiredMessage="__('sales::dashboard.color_is_required')"
                                         :placeholder="__('sales::dashboard.color_is_required')"
                                         :value="old('color',$order_status->color ?? '',
                                    )" />
                                </div>
                            </div>
                        </div>
                        <!-- END Price -->
                    </div>
                <div class="form-group row align-items-center">
                    <label class="col-1 col-form-label font-weight-bold">{{ __('sales::dashboard.is_active') }}:</label>
                    <div class="col-1">
                            <x-dashboard.form.inputs.success-switch
                                class="mx-2"
                                :id="'is_active'"
                                :name="'is_active'"
                                :isChecked="old('is_active', $order_status->is_active ?? '')"/>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('sales::dashboard.save') }}</button>
                        <a href="{{ route('dashboard.sales.customers.index') }}"
                            class="btn font-weight-bold btn-secondary">{{ __('sales::dashboard.cancel') }}
                        </a>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>
@endsection

@push('javascript')
    <!-- Form Parsley Validation -->
    <script src="{{ global_asset('metronic/assets/plugins/parsley/parsley.min.js') }}"></script>
    <!--end::Form Parsley Validation-->
    <!-- Form JS -->
    <script src="{{ global_asset('js/form.js') }}"></script>
    <!--end::Form JS-->
    <!-- Custom JS -->
    @include('sales::customers.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
