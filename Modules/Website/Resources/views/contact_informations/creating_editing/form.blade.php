@extends('dashboard.layouts.app')

@if (isset($contact_information))
    @section('title', __('website::dashboard.website') . ' - ' . __('website::dashboard.edit_contact_information'))

    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('website::dashboard.edit_contact_information'),
            'short_description' => __('website::dashboard.enter_contact_information_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@else
    @section('title', __('website::dashboard.website') . ' - ' . __('website::dashboard.create_contact_information'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('website::dashboard.new_contact_information'),
            'short_description' => __('website::dashboard.enter_contact_information_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@endif

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($contact_information) ? __('website::dashboard.edit_contact_information') : __('website::dashboard.new_contact_information') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.website.contact-informations.index') }}"
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
                    <label class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.type') }}</label>
                    <div class="col-2">
                        <x-dashboard.form.inputs.enum-select :id="'type'" :name="'type'" :isRequired="true"
                            :options="$types" :requiredMessage="__('website::dashboard.type_is_required')" :defaultOptionName="__('website::dashboard.select_type')" :selectedOption="old('type', $contact_information->type ?? '')" />
                        <span
                            class="form-text text-muted">{{ __('website::dashboard.select_the_type_of_contact_information') }}</span>
                    </div>
                    <div class="col-1"></div>
                    <label class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.value') }}</label>
                    <div class="col-3">
                        @if ((old('type') != null && old('type') != 'phone') || isset($contact_information->type) != 'phone')
                            <x-dashboard.form.inputs.email :id="'value'" :class="'form-control'" :name="'value'" :emailValidationMessage="__('website::dashboard.value_must_be_in_email_format')"
                                :isRequired="true" :requiredMessage="__('website::dashboard.email_is_required')" :placeholder="__('website::dashboard.email')" :value="old('value', $contact_information->value ?? '')" />
                        @else
                            <x-dashboard.form.inputs.phone :id="'value'" :class="'form-control'" :name="'value'" :isRequired="true"
                                :requiredMessage="__('website::dashboard.phone_is_required')" :placeholder="__('website::dashboard.phone')" :value="old('value', $contact_information->value ?? '')" :phoneValidationMessage="__('website::dashboard.phone_must_be_in_phone_number_formate')" />
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.is_active') }}</label>
                    <div class="col-1">
                        <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'" :name="'is_active'"
                            :isChecked="old('is_active', $contact_information->is_active ?? '')" />
                    </div>
                    <div class="col-1"></div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('website::dashboard.save') }}</button>
                        <a href="{{ route('dashboard.website.contact-informations.index') }}"
                            class="btn font-weight-bold btn-secondary">{{ __('website::dashboard.cancel') }}</a>
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
    @include('website::contact_informations.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
