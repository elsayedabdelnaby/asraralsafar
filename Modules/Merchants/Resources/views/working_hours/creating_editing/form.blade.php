@extends('dashboard.layouts.app')

@if(isset($merchant_working_hours))
    @section('title', __('merchants::dashboard.merchants_management') . ' - ' . __('merchants::dashboard.edit_merchant_working_hours'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.edit_merchant_working_hours'),
            'short_description' => __('merchants::dashboard.enter_merchant_working_hours_details_and_submit'),
        ]);
    @endsection
@else
    @section('title', __('merchants::dashboard.merchants_management') . ' - ' . __('merchants::dashboard.new_working_hours'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.new_merchant_working_hours'),
            'short_description' => __('merchants::dashboard.enter_merchant_working_hours_details_and_submit'),
        ]);
    @endsection
@endif
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($merchant_working_hours) ? __('merchants::dashboard.edit_merchant_working_hours') :  __('merchants::dashboard.new_merchant_working_hours')  }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.merchants.working-hours.index',['merchant_id'=>$merchant->id]) }}"
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
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.day') }}
                                : </label>
                            <div class="col-md-7">
                                <x-dashboard.form.inputs.select_week_day
                                    :id="'day'"  :name="'day'"
                                    :isRequired="true"
                                    :requiredMessage="__('merchants::dashboard.day_is_required')"
                                    :placeholder="__('merchants::dashboard.day_is_required')"
                                    :selectedOption="old('day', $merchant_working_hours->day ?? '')"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.from') }}: </label>
                            <div class="col-md-7">
                                <x-dashboard.form.inputs.time
                                    :id="'from'"
                                    :class="'form-control'"
                                    :name="'from'"
                                    :isRequired="true"
                                    :requiredMessage="__('merchants::dashboard.from_time_is_required')"
                                    :placeholder="__('merchants::dashboard.from_time_is_required')"
                                    :value="old('from',isset($merchant_working_hours) ? \Carbon\Carbon::createFromFormat('H:i:s',$merchant_working_hours->from)->format('h:i') : '')"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.to') }}: </label>
                            <div class="col-md-7">
                                <x-dashboard.form.inputs.time
                                    :id="'to'"
                                    :class="'form-control'"
                                    :name="'to'"
                                    :isRequired="true"
                                    :requiredMessage="__('merchants::dashboard.to_time_is_required')"
                                    :placeholder="__('merchants::dashboard.to_time_is_required')"
                                    :value="old('to',isset($merchant_working_hours) ? \Carbon\Carbon::createFromFormat('H:i:s',$merchant_working_hours->to)->format('h:i') : '')"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <div class="row">
                            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.is_active') }}: </label>
                            <div class="col-md-4">
                                <x-dashboard.form.inputs.success-switch
                                    class="mx-2"
                                    :id="'is_active'"
                                    :name="'is_active'"
                                    :isChecked="old('is_active', $merchant_working_hours->is_active ?? '')"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="float-right mb-3">
                    <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">
                        {{ __('locations::dashboard.save') }}
                    </button>
                    <a
                        href="{{ route('dashboard.merchants.working-hours.index',['merchant_id'=>$merchant->id])}}"
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
    <!-- Custom JS -->
    @include('merchants::working_hours.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
