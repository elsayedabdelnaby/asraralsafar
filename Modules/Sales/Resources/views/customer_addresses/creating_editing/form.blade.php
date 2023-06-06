@extends('dashboard.layouts.app')
@section('head-css')
    <style>
        #map {
            width: 100%;
            height: 500px;
        }
    </style>
@endsection
@if (isset($customer_address))
    @section('title', __('sales::dashboard.customer_addresses_management') . ' - ' . __('sales::dashboard.edit_address'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('sales::dashboard.edit_address'),
            'short_description' => __('sales::dashboard.enter_address_details_and_submit'),
        ]);
    @endsection
@else
    @section('title', __('sales::dashboard.customer_addresses_management') . ' - ' . __('sales::dashboard.new_address'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('sales::dashboard.new_address'),
            'short_description' => __('sales::dashboard.enter_address_details_and_submit'),
        ]);
    @endsection
@endif
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    @if (isset($customer_address))
                        {{ __('sales::dashboard.edit_address') }}
                    @else
                        {{ __('sales::dashboard.new_address') }}
                    @endif
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.sales.customer-addresses.index', ['customer_id' => $customer_id]) }}"
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

                <!-- Start Of City Location -->
                <div class="row mb-6">
                    <!-- Start Countries -->
                    <div class="col-md-4">
                        <div class="row align-items-center">
                            <label class="col-md-4 col-form-label font-weight-bold">{{ __('sales::dashboard.countries') }}
                                :</label>
                            <div class="col-md-8">
                                <x-dashboard.form.inputs.select
                                    :id="'country_id'"
                                    :name="'country_id'"
                                    :options="$countries"
                                    :isMultiple="false"
                                    :isRequired="true"
                                    :requiredMessage="__('sales::dashboard.country_is_required')"
                                    :defaultOptionName="__('sales::dashboard.select_country')"
                                    :selectedOption="old('country_id', '')"
                                />
                            </div>
                        </div>
                    </div>
                    <!-- End Countries -->
                    <!-- Start State -->
                    <div class="offset-md-1 col-md-4">
                        <div class="row align-items-center">
                            <label class="col-md-4 col-form-label font-weight-bold">{{ __('sales::dashboard.state') }}
                                :</label>
                            <div class="col-md-8">
                                <select required data-parsley-required-message="{{__('sales::dashboard.state_is_required')}}" class="form-control select2" name="state_id" id="state_id"></select>
                            </div>
                        </div>
                    </div>
                    <!-- End State -->
                    <!-- Start City -->
                    <div class="col-md-4 mt-15">
                        <div class="row align-items-center">
                            <label class="col-md-4 col-form-label font-weight-bold">{{ __('sales::dashboard.city') }}
                                :</label>
                            <div class="col-md-8">
                                <select required data-parsley-required-message="{{__('sales::dashboard.city_is_required')}}" class="form-control select2" name="city_id" id="city_id"></select>
                            </div>
                        </div>
                    </div>
                    <!-- End Countries -->
                </div>
                <!-- End Of City Location -->


                <div class="form-group row mt-15">
                    <!--Start  phone_number -->
                    <div class="col-md-4">
                        <div class="row">
                            <label class="col-md-4 col-form-label font-weight-bold">{{ __('sales::dashboard.phone_number') }}: </label>
                            <div class="col-md-8">
                                <x-dashboard.form.inputs.text
                                    :id="'phone_number'" :class="'form-control'" :name="'phone_number'"
                                    :placeholder="__('sales::dashboard.phone_number')"
                                    :value="old('phone_number', $customer_address->phone_number ?? '')"
                                    :isRequired="true"
                                    :requiredMessage="__('sales::dashboard.phone_number_is_required')"
                                    data-parsley-pattern="/^(\+?\d{1,9}|\d{1,10})$/"
                                    data-parsley-pattern-message="{{ __('sales::dashboard.must_be_in_phone_format') }}"
                                    :maxlength="10"
                                    :maxlengthMessage="__('sales::dashboard.number_of_characters_must_less_than_or_equal_10',)"
                                />
                            </div>
                        </div>
                    </div>
                    <!-- END Country Code -->

                    <!--Start  address -->
                    <div class="col-md-4">
                        <div class="row">
                            <label class="col-md-3 col-form-label font-weight-bold">{{ __('sales::dashboard.address') }}
                                : </label>
                            <div class="col-md-9">
                                <x-dashboard.form.inputs.text
                                    :id="'address'" :class="'form-control'" :name="'address'"
                                    :placeholder="__('sales::dashboard.address')"
                                    :value="old('address', $customer_address->address ?? '')"
                                    :isRequired="true"
                                    :requiredMessage="__('sales::dashboard.address_is_required')"
                                    data-parsley-pattern-message="{{ __('sales::dashboard.must_be_in_address') }}"
                                    :maxlength="10"
                                    :maxlengthMessage="__('sales::dashboard.number_of_characters_must_less_than_or_equal_10',)"
                                />
                            </div>
                        </div>
                    </div>
                    <!-- END address -->


                </div>

                <div class="form-group row mt-15">
                    <!--Start  build_no -->
                    <div class="col-md-3">
                        <div class="row">
                            <label class="col-md-4 col-form-label font-weight-bold">{{ __('sales::dashboard.build_no') }}
                                : </label>
                            <div class="col-md-8">
                                <x-dashboard.form.inputs.text
                                    :id="'build_no'" :class="'form-control'" :name="'build_no'"
                                    :placeholder="__('sales::dashboard.build_no')"
                                    :value="old('build_no', $customer_address->build_no ?? '')"
                                    :isRequired="true"
                                    :requiredMessage="__('sales::dashboard.build_no_is_required')"
                                    data-parsley-pattern-message="{{ __('sales::dashboard.must_be_build_no') }}"
                                    :maxlength="10"
                                    :maxlengthMessage="__('sales::dashboard.number_of_characters_must_less_than_or_equal_10',)"
                                />
                            </div>
                        </div>
                    </div>
                    <!-- END build_no -->

                    <!--Start  floor_no -->
                    <div class="col-md-3">
                        <div class="row">
                            <label class="col-md-4 col-form-label font-weight-bold">{{ __('sales::dashboard.floor_no') }}
                                : </label>
                            <div class="col-md-8">
                                <x-dashboard.form.inputs.text
                                    :id="'floor_no'" :class="'form-control'" :name="'floor_no'"
                                    :placeholder="__('sales::dashboard.floor_no')"
                                    :value="old('floor_no', $customer_address->floor_no ?? '')"
                                    :isRequired="true"
                                    :requiredMessage="__('sales::dashboard.floor_no_is_required')"
                                    data-parsley-pattern-message="{{ __('sales::dashboard.must_be_floor_no') }}"
                                    :maxlength="10"
                                    :maxlengthMessage="__('sales::dashboard.number_of_characters_must_less_than_or_equal_10',)"
                                />
                            </div>
                        </div>
                    </div>
                    <!-- END floor_no -->


                    <!--Start  apartment_no -->
                    <div class="col-md-3">
                        <div class="row">
                            <label class="col-md-4 col-form-label font-weight-bold">{{ __('sales::dashboard.apartment_no') }}
                                : </label>
                            <div class="col-md-8">
                                <x-dashboard.form.inputs.text
                                    :id="'apartment_no'" :class="'form-control'" :name="'apartment_no'"
                                    :placeholder="__('sales::dashboard.build_no')"
                                    :value="old('apartment_no', $customer_address->apartment_no ?? '')"
                                    :isRequired="true"
                                    :requiredMessage="__('sales::dashboard.apartment_no_is_required')"
                                    data-parsley-pattern-message="{{ __('sales::dashboard.must_be_apartment_no') }}"
                                    :maxlength="10"
                                    :maxlengthMessage="__('sales::dashboard.number_of_characters_must_less_than_or_equal_10',)"
                                />
                            </div>
                        </div>
                    </div>
                    <!-- END apartment_no -->

                </div>

                <!-- is_default -->
                @if(isset($customer_address) && $customer_address->is_default == 0)
                    <div class="row mt-15">
                        <div class="col-md-3">
                            <div class="row align-items-center">
                                <label class="col-md-4 col-form-label font-weight-bold">{{ __('sales::dashboard.is_default') }}
                                    :</label>
                                <div class="col-md-6">
                                    <x-dashboard.form.inputs.success-switch
                                        class="mx-2"
                                        :id="'is_default'"
                                        :name="'is_default'"
                                        :is_disable="'true'"
                                        :isChecked="old('is_default', $customer_address->is_default ?? '')"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!--END is_default -->

                <!--Start OF Locations Customer-->
                <div class="row mt-15">
                    <!-- Start Latitude -->
                    <div class="col-md-4">
                        <div class="row">
                            <label class="col-md-4 col-form-label font-weight-bold">{{ __('sales::dashboard.latitude') }}
                                :</label>
                            <div class="col-md-8">
                                <x-dashboard.form.inputs.text
                                    :id="'latitude'"
                                    :class="'form-control'"
                                    :name="'latitude'"
                                    :placeholder="__('sales::dashboard.latitude')"
                                    :readonly="true" :isRequired="true"
                                    :value="old('branch_latitude', $customer_address->latitude ?? '')"
                                    :requiredMessage="__('sales::dashboard.latitude_is_required')"
                                    :maxlength="50" :maxlengthMessage="__('sales::dashboard.number_of_characters_must_less_than_or_equal_50')"/>
                            </div>
                        </div>
                    </div>
                    <!-- End Latitude -->
                    <!-- Start longitude -->
                    <div class="offset-md-1 col-md-4">
                        <div class="row">
                            <label class="col-md-4 col-form-label font-weight-bold">{{ __('sales::dashboard.longitude') }}
                                :</label>
                            <div class="col-md-8">
                                <x-dashboard.form.inputs.text
                                    :id="'longitude'"
                                    :class="'form-control'"
                                    :name="'longitude'"
                                    :placeholder="__('sales::dashboard.longitude')"
                                    :value="old('longitude', $customer_address->longitude ?? '')" :isRequired="true"
                                    :readonly="true" :requiredMessage="__('sales::dashboard.longitude_is_required')"
                                    :maxlength="50"
                                    :maxlengthMessage="__('sales::dashboard.number_of_characters_must_less_than_or_equal_50')"/>
                            </div>
                        </div>
                    </div>
                    <!-- End longitude -->
                </div>
                <!--End Of Locations Customer-->

                <div class="row mt-12">
                    <div id="map">

                    </div>
                </div>


            </div>
            <div class="card-footer">
                <div class="float-right mb-3">
                    <button type="submit" class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">
                        {{ __('sales::dashboard.save') }}
                    </button>
                    <a href="{{ route('dashboard.sales.customer-addresses.index', ['customer_id' => $customer_id]) }}"
                       class="btn font-weight-bold btn-secondary">
                        {{ __('sales::dashboard.cancel') }}
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
    <!-- Form state.city.filter.js -->
    <script src="{{ global_asset('js/state.city.filter.js') }}"></script>
    <!--end::state.city.filter.js-->
    <!-- Form JS -->
    <script src="{{ global_asset('js/form.js') }}"></script>
    <!--end::Form JS-->
    <!--Start::Google Map JS-->
    <script src="https://maps.googleapis.com/maps/api/js?libraries=&v=weekly"></script>
    {{--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8YjQ00gET3EIeYOuEbiIbl6VMQTbE8bw"></script> --}}
    <!--End::Google Map JS-->
    <!-- Custom JS -->
    @include('sales::customer_addresses.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
