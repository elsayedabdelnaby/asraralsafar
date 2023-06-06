@extends('dashboard.layouts.app')

@if (isset($customer))
    @section('title', __('sales::dashboard.customers_management') . ' - ' . __('sales::dashboard.edit_customer'))

    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('sales::dashboard.edit_customer'),
            'short_description' => __('sales::dashboard.enter_the_customer_details'),
            'breadcrumbs' => [],
        ]);
    @endsection
@else
    @section('title', __('sales::dashboard.customers_management') . ' - ' . __('sales::dashboard.create_customer'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('sales::dashboard.new_customer'),
            'short_description' => __('sales::dashboard.enter_customer_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@endif

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($customer) ? __('sales::dashboard.edit_customer') : __('sales::dashboard.new_customer') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.sales.customers.index') }}"
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
                            <label class="col-4 col-form-label font-weight-bold">{{ __('sales::dashboard.name') }}</label>
                            <div class="col-8">
                                <x-dashboard.form.inputs.text :id="'name'" :class="'form-control'" :name="'name'"
                                    :placeholder="__('sales::dashboard.name')" :value="old('name', $customer->name ?? '')" :isRequired="true" :requiredMessage="__('sales::dashboard.name_is_required')"
                                    :maxlength="255" :maxlengthMessage="__('sales::dashboard.number_of_characters_must_less_than_or_equal_255')" />
                            </div>
                        </div>
                    </div>
                    <!-- End customer Name -->
                    <!-- Email -->
                    <div class="offset-md-1 col-4">
                        <div class="row">
                            <label class="col-4 col-form-label font-weight-bold">{{ __('sales::dashboard.email') }}</label>
                            <div class="col-8">
                                <x-dashboard.form.inputs.email :id="'email'" :class="'form-control'" :name="'email'"
                                    :emailValidationMessage="__('sales::dashboard.email_must_be_in_email_format')" :isRequired="true" :requiredMessage="__('sales::dashboard.email_is_required')" :placeholder="__('sales::dashboard.email')"
                                    :value="old('email', $customer->email ?? '')" />
                            </div>
                        </div>
                    </div>
                    <!-- End Email -->
                </div>
                @if ($method == 'POST')
                    <div class="form-group row">
                        <!-- Password -->
                        <div class="col-4">
                            <div class="row">
                                <label for="item"
                                    class="col-4 col-form-label font-weight-bold">{{ __('sales::dashboard.password') }}:</label>
                                <div class="col-8">
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control password-input"
                                            value="" required id="password" />
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
                                <label for="confirm-password"
                                    class="col-4 col-form-label font-weight-bold">{{ __('sales::dashboard.confirm_password') }}:</label>
                                <div class="col-8">
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" id="confirm_password"
                                            class="form-control password-input" value="" required
                                            data-parsley-equalto="#password"
                                            data-parsley-equalto-message="Password and Confirm Password should match" />
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
                <div class="form-group row">
                    <div class="col-4">
                        <div class="row">
                            <label for="phone_number"
                                class="col-4 col-form-label font-weight-bold">{{ __('sales::dashboard.phone_number') }}:</label>
                            <div class="col-8">
                                <x-dashboard.form.inputs.phone :id="'phone_number'" :class="'form-control'" :name="'phone_number'"
                                    :isRequired="true" :requiredMessage="__('sales::dashboard.phone_is_required')" :placeholder="__('sales::dashboard.phone')" :value="old('phone_number', $customer->phone_number ?? '')"
                                    :phoneValidationMessage="__('sales::dashboard.phone_must_be_in_phone_number_formate')" />
                            </div>
                        </div>
                    </div>
                    <div class="col-4 offset-md-1">
                        <div class="row">
                            <label
                                class="col-xl-4 col-lg-4 col-form-label text-left">{{ __('sales::dashboard.image_profile') }}:</label>
                            <div class="col-lg-8 col-xl-8">
                                <div class="image-input image-input-empty image-input-outline"
                                    style="background-image: url('{{ $customer->image_profile_url ?? global_asset('metronic/assets/media/customers/blank.png') }}')"
                                    id="image_profile">
                                    <div class="image-input-wrapper"></div>
                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="{{ __('sales::dashboard.change_image') }}">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="image_profile" accept=".png, .jpg, .jpeg, .svg" />
                                        <input type="hidden" name="image_profile_remove" />
                                    </label>

                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="cancel" data-toggle="tooltip"
                                        title="{{ __('sales::dashboard.cancel_image') }}">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>

                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="remove" data-toggle="tooltip"
                                        title="{{ __('sales::dashboard.remove_image') }}">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label class="col-1 col-form-label font-weight-bold">{{ __('sales::dashboard.is_active') }}:</label>
                    <div class="col-1">
                        <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'" :name="'is_active'"
                            :isChecked="old('is_active', $customer->is_active ?? '')" />
                    </div>
                    {{-- <label
                        class="offset-md-1 col-1 col-form-label font-weight-bold">{{ __('sales::dashboard.phone_verified') }}:</label>
                    <div class="col-1">
                        <x-dashboard.form.inputs.success-switch class="mx-2" :id="'phone_verified'" :name="'phone_verified'"
                            :isChecked="old('phone_verified', $customer->phone_verified_at ?? '')" />
                    </div> --}}
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('sales::dashboard.save') }}</button>
                        <a href="{{ route('dashboard.sales.customers.index') }}"
                            class="btn font-weight-bold btn-secondary">{{ __('sales::dashboard.cancel') }}</a>
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
