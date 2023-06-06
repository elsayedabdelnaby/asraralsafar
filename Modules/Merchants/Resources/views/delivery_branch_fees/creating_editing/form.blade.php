@extends('dashboard.layouts.app')

@if(isset($merchant_branch_delivery_fees))
    @section('title', __('merchants::dashboard.merchants_management') . ' - ' . __('merchants::dashboard.edit_merchant_branch_delivery_fees'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.edit_merchant_branch_delivery_fees'),
            'short_description' => __('merchants::dashboard.enter_merchant_delivery_fees_details_and_submit'),
        ]);
    @endsection
@else
    @section('title', __('merchants::dashboard.merchants_management') . ' - ' . __('merchants::dashboard.new_delivery_branch_fees'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.new_delivery_branch_fees'),
            'short_description' => __('merchants::dashboard.enter_merchant_delivery_fees_details_and_submit'),
        ]);
    @endsection
@endif
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($merchant_branch_delivery_fees) ? __('merchants::dashboard.edit_merchant_branch_delivery_fees') :  __('merchants::dashboard.new_delivery_branch_fees')  }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.merchants.branch-fees.index',['merchant_id'=>$merchant->id,'branch_id'=>$merchantBranch->id]) }}"
                   class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}
                </a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">
                <div class="row">
                    {{--start Fee--}}
                    <div class="col-md-4">
                        <div class="row align-items-center">
                            <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.merchant_fee') }}
                                : </label>
                            <div class="col-md-7">
                                <x-dashboard.form.inputs.number
                                    :id="'merchant_fees'"
                                    :class="'form-control'"
                                    :name="'merchant_fees'"
                                    :isDecimal="true"
                                    :isRequired="false"
                                    :requiredMessage="__('merchants::dashboard.merchant_fee')"
                                    :integerValidationMessage="__('merchants::dashboard.merchant_fee_must_be_integer')"
                                    :placeholder="__('merchants::dashboard.merchant_fee')"
                                    :value="old('merchant_fees',isset($merchant_branch_delivery_fees) ? $merchant_branch_delivery_fees->fees : '')"
                                />
                            </div>
                        </div>
                    </div>
                    {{--End Fee--}}

                </div>
                <div class="row mt-15">
                    {{--merchant_fee_from from--}}
                    <div class="col-md-4">
                        <div class="row align-items-center">
                            <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.merchant_fee_from') }}
                                : </label>
                            <div class="col-md-7">
                                <x-dashboard.form.inputs.number
                                    :id="'merchant_fees_from'"
                                    :class="'form-control'"
                                    :name="'merchant_fees_from'"
                                    :isDecimal="true"
                                    :isRequired="false"
                                    :requiredMessage="__('merchants::dashboard.merchant_fee_from')"
                                    :integerValidationMessage="__('merchants::dashboard.merchant_fee_from_must_be_integer')"
                                    :placeholder="__('merchants::dashboard.merchant_fee_from')"
                                    :value="old('merchant_fees_from',isset($merchant_branch_delivery_fees) ? $merchant_branch_delivery_fees->from : '')"
                                />
                            </div>
                        </div>
                    </div>
                    {{--End merchant_fee_from--}}

                    {{--Start to--}}
                    <div class="col-md-4">
                        <div class="row align-items-center">
                            <label class="col-md-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.merchant_fee_to') }}
                                : </label>
                            <div class="col-md-7">
                                <x-dashboard.form.inputs.number
                                    :id="'merchant_fees_to'"
                                    :class="'form-control'"
                                    :name="'merchant_fees_to'"
                                    :isDecimal="true"
                                    :isRequired="false"
                                    :requiredMessage="__('merchants::dashboard.merchant_fee_to')"
                                    :integerValidationMessage="__('merchants::dashboard.merchant_fee_to_must_be_integer')"
                                    :placeholder="__('merchants::dashboard.merchant_fee_to')"
                                    :value="old('merchant_fees_to',isset($merchant_branch_delivery_fees) ? $merchant_branch_delivery_fees->to : '')"
                                />
                            </div>
                        </div>
                    </div>
                    {{--End to--}}
                </div>

            </div>

            <div class="card-footer">
                <div class="float-right mb-3">
                    <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">
                        {{ __('locations::dashboard.save') }}
                    </button>
                    <a
                        href="{{ route('dashboard.merchants.branch-fees.index',['merchant_id'=>$merchant->id,'branch_id'=>$merchantBranch->id])}}"
                        class="btn font-weight-bold btn-secondary">
                        {{ __('locations::dashboard.cancel') }}
                    </a>
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
@endpush
