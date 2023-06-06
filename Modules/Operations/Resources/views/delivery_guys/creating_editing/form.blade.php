@extends('dashboard.layouts.app')

@if (isset($deliveryGuy))
    @section('title', __('operations::dashboard.delivery_guys_management') . ' - ' . __('operations::dashboard.edit_delivery_guy'))

    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('operations::dashboard.edit_delivery_guy'),
            'short_description' => __('operations::dashboard.enter_the_delivery_guy_details'),
            'breadcrumbs' => [],
        ]);
    @endsection
@else
    @section('title', __('operations::dashboard.delivery_guys_management') . ' - ' . __('operations::dashboard.create_delivery_guy'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('operations::dashboard.create_delivery_guy'),
            'short_description' => __('operations::dashboard.enter_the_delivery_guy_details'),
            'breadcrumbs' => [],
        ]);
    @endsection
@endif

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($deliveryGuy) ? __('operations::dashboard.edit_delivery_guy') : __('operations::dashboard.create_delivery_guy') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.operations.delivery-guys.index') }}"
                   class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}</a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">

                <div class="form-group row">
                    <!-- customer Name -->
                    <div class="col-4">
                        <div class="row">
                            <label class="col-4 col-form-label font-weight-bold">{{ __('operations::dashboard.name') }}</label>
                            <div class="col-8">
                                <x-dashboard.form.inputs.text
                                    :id="'name'"
                                    :class="'form-control'"
                                    :name="'name'"
                                    :placeholder="__('operations::dashboard.name')"
                                    :value="old('name', $deliveryGuy->name ?? '')"
                                    :isRequired="true"
                                    :requiredMessage="__('operations::dashboard.name_is_required')"
                                    :maxlength="255"
                                    :maxlengthMessage="__('operations::dashboard.number_of_characters_must_less_than_or_equal_255')"/>
                            </div>
                        </div>
                    </div>
                    <!-- End customer Name -->

                    <!-- Email -->
                    <div class="offset-md-1 col-4">
                        <div class="row">
                            <label class="col-4 col-form-label font-weight-bold">{{ __('operations::dashboard.email') }}</label>
                            <div class="col-8">
                                <x-dashboard.form.inputs.email
                                    :id="'email'"
                                    :class="'form-control'"
                                    :name="'email'"
                                    :emailValidationMessage="__('operations::dashboard.email_must_be_in_email_format')"
                                    :isRequired="true"
                                    :requiredMessage="__('operations::dashboard.email_is_required')"
                                    :placeholder="__('operations::dashboard.email')"
                                    :value="old('email', $deliveryGuy->email ?? '')"/>
                            </div>
                        </div>
                    </div>
                    <!-- End Email -->
                </div>

                <!-- Password-->
                @if($method == 'POST')
                    <div class="form-group row">
                        <!-- Password -->
                        <div class="col-4">
                            <div class="row">
                                <label for="item" class="col-4 col-form-label font-weight-bold">{{ __('operations::dashboard.password') }}:</label>
                                <div class="col-8">
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control password-input" value="" required id="password"/>
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary show-hide-password-btn" type="button">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Password -->
                        <!-- Confirm Password -->
                        <div class="offset-md-1 col-4">
                            <div class="row">
                                <label for="confirm-password" class="col-4 col-form-label font-weight-bold">{{ __('operations::dashboard.confirm_password') }}
                                    :</label>
                                <div class="col-8">
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" id="confirm_password"
                                               class="form-control password-input" value="" required
                                               data-parsley-equalto="#password"
                                               data-parsley-equalto-message="Password and Confirm Password should match"/>
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary show-hide-password-btn" type="button">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Confirm Password -->
                    </div>
                @endif
                <!--End  Password-->

                <!-- Phone Number -->
                <div class="form-group row">
                    <div class="col-4">
                        <div class="row">
                            <label for="phone_number" class="col-4 col-form-label font-weight-bold">{{ __('operations::dashboard.phone_number') }}
                                :</label>
                            <div class="col-8">
                                <x-dashboard.form.inputs.phone
                                    :id="'phone_number'"
                                    :class="'form-control'"
                                    :name="'phone_number'"
                                    :isRequired="true"
                                    :requiredMessage="__('operations::dashboard.phone_is_required')"
                                    :placeholder="__('operations::dashboard.phone')" :value="old('phone_number', $deliveryGuy->phone_number ?? '')"
                                    :phoneValidationMessage="__('operations::dashboard.phone_must_be_in_phone_number_format')"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="col-4 offset-md-1">
                        <div class="row">
                            <label
                                class="col-xl-4 col-lg-4 col-form-label text-left">{{ __('operations::dashboard.image_profile') }}
                                :</label>
                            <div class="col-lg-8 col-xl-8">
                                <div class="image-input image-input-empty image-input-outline"
                                     style="background-image: url('{{ $deliveryGuy->image_profile_url ?? global_asset('metronic/assets/media/customers/blank.png') }}')"
                                     id="image_profile">
                                    <div class="image-input-wrapper"></div>
                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="{{ __('operations::dashboard.change_image') }}">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="image_profile" accept=".png, .jpg, .jpeg, .svg"/>
                                        <input type="hidden" name="image_profile_remove"/>
                                    </label>

                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                          data-action="cancel" data-toggle="tooltip"
                                          title="{{ __('operations::dashboard.cancel_image') }}">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>

                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                          data-action="remove" data-toggle="tooltip"
                                          title="{{ __('operations::dashboard.remove_image') }}">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Phone Number -->

                <!-- Is Active-->
                <div class="form-group row align-items-center">
                    <label class="col-1 col-form-label font-weight-bold">{{ __('operations::dashboard.is_active') }}
                        :</label>
                    <div class="col-1">
                        <x-dashboard.form.inputs.success-switch
                            class="mx-2"
                            :id="'is_active'"
                            :name="'is_active'"
                            :isChecked="old('is_active', $deliveryGuy->is_active ?? '')"/>
                    </div>
                </div>
                <!-- End IS Active -->


                <div class="row mb-6">

                    <!-- Start Countries -->
                    <div class="col-md-4">
                        <div class="row align-items-center">
                            <label class="col-md-4 col-form-label font-weight-bold">{{ __('operations::dashboard.countries') }}
                                :</label>
                            <div class="col-md-8">
                                <x-dashboard.form.inputs.select
                                    :id="'country_id'"
                                    :name="'country_id'"
                                    :options="$countries"
                                    :isMultiple="false"
                                    :isRequired="true"
                                    :requiredMessage="__('operations::dashboard.country_is_required')"
                                    :defaultOptionName="__('operations::dashboard.select_country')"
                                    :selectedOption="old('country_id', '')"/>
                            </div>
                        </div>
                    </div>
                    <!-- End Countries -->

                    <!-- Start State -->
                    <div class="offset-1 col-md-4">
                        <div class="row align-items-center">
                            <label class="col-md-4 col-form-label font-weight-bold">{{ __('operations::dashboard.state') }}
                                :</label>
                            <div class="col-md-8">
                                <select data-parsley-required-message="{{__('operations::dashboard.state_is_required')}}" class="form-control select2" name="state_id" id="state_id" required></select>
                            </div>
                        </div>
                    </div>
                    <!-- End State -->

                    <!-- Start City -->
                    <div class="mt-10 col-md-4">
                        <div class="row align-items-center">
                            <label class="col-md-4 col-form-label font-weight-bold">{{ __('operations::dashboard.city') }}
                                :</label>
                            <div class="col-md-8">
                                <select data-parsley-required-message="{{__('operations::dashboard.city_is_required')}}" class="form-control select2" name="city_ids[]" id="city_id" multiple="multiple" required></select>
                            </div>
                        </div>
                    </div>
                    <!-- End Countries -->

                </div>



                <div class="form-group row">
                    <!-- Start Insurance Amount -->
                        <div class="col-4">
                        <div class="row">
                            <label for="insurance_amount" class="col-4 col-form-label font-weight-bold">{{ __('operations::dashboard.insurance_amount') }}
                                :</label>
                            <div class="col-8">
                                <x-dashboard.form.inputs.text
                                    :id="'insurance_amount'"
                                    :class="'form-control'"
                                    :name="'insurance_amount'"
                                    :isRequired="true"
                                    :requiredMessage="__('operations::dashboard.insurance_amount_is_required')"
                                    :placeholder="__('operations::dashboard.insurance_amount')"
                                    :value="old('insurance_amount', $deliveryGuy->deliveryGuyInfo->insurance_amount ?? '')"
                                    :phoneValidationMessage="__('operations::dashboard.insurance_amount_is_required')"
                                />
                            </div>
                        </div>
                    </div>
                    <!--End Insurance Amount -->

                    <!-- Start Allow To Exceed -->
                        <div class="col-2">
                        <div class="row">
                            <label class="col-8 col-form-label font-weight-bold">{{ __('operations::dashboard.allow_to_exceed') }}
                                :</label>
                            <div class="col-4">
                                <x-dashboard.form.inputs.success-switch
                                    class="mx-2"
                                    :id="'allow_to_exceed'"
                                    :name="'allow_to_exceed'"
                                    :isChecked="old('allow_to_exceed', $deliveryGuy->deliveryGuyInfo->allow_to_exceed ?? '')"/>
                            </div>
                        </div>
                    </div>
                    <!-- End Allow To Exceed -->

                    <!-- Start Exceed Amount -->
                        <div class="col-4">
                        <div class="row">
                            <label for="exceed_amount" class="col-4 col-form-label font-weight-bold">{{ __('operations::dashboard.exceed_amount') }}
                                :</label>
                            <div class="col-8">
                                <x-dashboard.form.inputs.text
                                    :id="'exceed_amount'"
                                    :class="'form-control'"
                                    :name="'exceed_amount'"
                                    :isRequired="false"
                                    :requiredMessage="__('operations::dashboard.exceed_amount_is_required')"
                                    :placeholder="__('operations::dashboard.exceed_amount')" :value="old('exceed_amount', $deliveryGuy->deliveryGuyInfo->exceed_amount ?? '')"
                                    :phoneValidationMessage="__('operations::dashboard.exceed_amount_is_required')"
                                />
                            </div>
                        </div>
                    </div>
                    <!--End Exceed Amount -->
                </div>


            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                                class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('operations::dashboard.save') }}</button>
                        <a href="{{ route('dashboard.operations.delivery-guys.index') }}"
                           class="btn font-weight-bold btn-secondary">{{ __('operations::dashboard.cancel') }}</a>
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
    @include('operations::delivery_guys.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
