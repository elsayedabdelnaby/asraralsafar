@extends('dashboard.layouts.app')

@if (isset($language))
    @section('title', __('dashboard.languages') . ' - ' . __('dashboard.edit_language'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('dashboard.edit_language'),
            'short_description' => __('dashboard.enter_language_details_and_submit'),
        ]);
    @endsection
@else
    @section('title', __('dashboard.languages') . ' - ' . __('dashboard.new_language'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('dashboard.new_language'),
            'short_description' => __('dashboard.enter_language_details_and_submit'),
        ]);
    @endsection
@endif

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    @if (isset($language))
                        {{ __('dashboard.edit_language') }}
                    @else
                        {{ __('dashboard.new_language') }}
                    @endif
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.languages.index') }}"
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
                <div class="form-group row mt-4">
                    <!-- Name -->
                    <div class="col-md-5">
                        <div class="row">
                            <label
                                class="col-md-2 col-form-label font-weight-bold ">{{ __('dashboard.name') }}
                            </label>
                            <div class="col-md-8">
                                <x-dashboard.form.inputs.text :id="'name'" :class="'form-control'" :name="'name'"
                                                              :placeholder="__('dashboard.name')"
                                                              :value="old('name', $language->name ?? '')"
                                                              :isRequired="true"
                                                              :requiredMessage="__('dashboard.name_is_required')"
                                                              :maxlength="10" :maxlengthMessage="__(
                                        'languages::dashboard.number_of_characters_must_less_than_or_equal_10',
                                    )"/>
                            </div>
                        </div>
                    </div>
                    <!--END Name -->
                    <div class="col-md-1"></div>
                    <!-- Code -->
                    <div class="col-md-5">
                        <div class="row">
                            <label class="col-md-2 col-form-label font-weight-bold ">{{ __('dashboard.code') }}
                            </label>
                            <div class="col-md-8">
                                <x-dashboard.form.inputs.text :id="'code'" :class="'form-control'" :name="'code'"
                                                              :placeholder="__('dashboard.code')"
                                                              :value="old('code', $language->code ?? '')"
                                                              :isRequired="true"
                                                              :requiredMessage="__('dashboard.code_is_required')"
                                                              :maxlength="3"
                                                              :maxlengthMessage="__(
                                        'languages::dashboard.number_of_characters_must_less_than_or_equal_3',
                                    )"/>
                            </div>
                        </div>
                    </div>
                    <!--END Code -->
                </div>
                <div class="form-group row">
                    <div class="col-md-5">
                        <div class="row">
                            <label
                                class="col-md-2 col-form-label font-weight-bold">{{ __('dashboard.direction') }}
                            </label>
                            <div class="col-md-8">
                                <x-dashboard.form.inputs.enum-select :id="'direction'"
                                                                     :name="'direction'"
                                                                     :options="$directions"
                                                                     :isRequired="true"
                                                                     :requiredMessage="__('dashboard.direction_is_required')"
                                                                     :isMultiple="false"
                                                                     :defaultOptionName="__('dashboard.select_direction')"
                                                                     :selectedOption="old('direction', $language['direction'] ?? null)"/>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>

                    <div class="col-md-6">
                        <div class="row">
                            <label
                                class="col-md-2 col-form-label font-weight-bold">{{ __('dashboard.is_active') }}
                            </label>
                            <div class="col-md-6">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'"
                                                                        :name="'is_active'"
                                                                        :isChecked="old('is_active', $language->is_active ?? '')"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="row">
                            <label
                                class="col-md-2 col-form-label font-weight-bold">{{ __('dashboard.icon') }}
                            </label>
                            <div class="col-md-8">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right mb-3">
                    <button type="submit" class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">
                        {{ __('dashboard.save') }}
                    </button>
                    <a href="{{ route('dashboard.languages.index') }}"
                       class="btn font-weight-bold btn-secondary">
                        {{ __('dashboard.cancel') }}
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
