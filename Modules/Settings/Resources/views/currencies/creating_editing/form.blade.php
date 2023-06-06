@extends('dashboard.layouts.app')

@if (isset($currency))
    @section('title', __('settings::dashboard.settings') . ' - ' . __('settings::dashboard.edit_currency'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('settings::dashboard.edit_currency'),
            'short_description' => __('settings::dashboard.enter_currency_details_and_submit'),
        ]);
    @endsection
@else
    @section('title', __('settings::dashboard.settings') . ' - ' . __('settings::dashboard.new_currency'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('settings::dashboard.new_currency'),
            'short_description' => __('settings::dashboard.enter_currency_details_and_submit'),
        ]);
    @endsection
@endif



@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    @if (isset($currency))
                        {{ __('settings::dashboard.edit_currency') }}
                    @else
                        {{ __('settings::dashboard.new_currency') }}
                    @endif
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.settings.currencies.index') }}"
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
                <!-- Translation -->
                <div id="kt_currency_translation_repeater">
                    <div>
                        <div data-repeater-list="translations">
                            @forelse (old('translations', isset($currency->translations) ? collect($currency->translations)->toArray() : []) as $translation)
                                @include('settings::currencies.creating_editing.translation', $translation)
                            @empty
                                @include('settings::currencies.creating_editing.translation', [])
                            @endforelse
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10"></div>
                        <div class="col-md-2">
                            <a href="javascript:;" data-repeater-create=""
                                class="btn btn-sm font-weight-bolder btn-light-primary">
                                <i class="la la-plus"></i>{{ __('settings::dashboard.add') }}
                            </a>
                        </div>
                    </div>
                </div>
                <!--END Translation -->

                <div class="form-group row mt-4">
                    <!-- ISO Code -->
                    <div class="col-md-4">
                        <div class="row">
                            <label
                                class="col-md-3 col-form-label font-weight-bold ">{{ __('settings::dashboard.iso_code') }}
                                : </label>
                            <div class="col-md-8">
                                <x-dashboard.form.inputs.text :id="'iso_code'" :class="'form-control'" :name="'iso_code'"
                                    :placeholder="__('settings::dashboard.iso_code')" :value="old('iso_code', $currency->iso_code ?? '')" :isRequired="true" :requiredMessage="__('settings::dashboard.iso_code_is_required')"
                                    :maxlength="10" :maxlengthMessage="__(
                                        'settings::dashboard.number_of_characters_must_less_than_or_equal_10',
                                    )" />
                            </div>
                        </div>
                    </div>
                    <!--END ISO Code -->
                    <div class="col-md-1"></div>
                    <!-- Symbol -->
                    <div class="col-md-4">
                        <div class="row">
                            <label class="col-md-3 col-form-label font-weight-bold ">{{ __('settings::dashboard.symbol') }}:
                            </label>
                            <div class="col-md-8">
                                <x-dashboard.form.inputs.text :id="'symbol'" :class="'form-control'" :name="'symbol'"
                                    :placeholder="__('settings::dashboard.symbol')" :value="old('symbol', $currency->symbol ?? '')" :requiredMessage="__('settings::dashboard.symbol_is_required')" :maxlength="10"
                                    :maxlengthMessage="__(
                                        'settings::dashboard.number_of_characters_must_less_than_or_equal_10',
                                    )" />
                            </div>
                        </div>
                    </div>
                    <!--END Symbol -->
                </div>
                <div class="form-group row">
                    <!-- HTML Entity -->
                    <div class="col-md-4">
                        <div class="row">
                            <label
                                class="col-md-3 col-form-label font-weight-bold ">{{ __('settings::dashboard.html_entity') }}
                                : </label>
                            <div class="col-md-8">
                                <x-dashboard.form.inputs.text :id="'html_entity'" :class="'form-control'" :name="'html_entity'"
                                    :placeholder="__('settings::dashboard.html_entity')" :value="old('html_entity', $currency->html_entity ?? '')" :requiredMessage="__('settings::dashboard.html_entity_is_required')" :maxlength="10"
                                    :maxlengthMessage="__(
                                        'settings::dashboard.number_of_characters_must_less_than_or_equal_50',
                                    )" />
                            </div>
                        </div>
                    </div>
                    <!--END HTML Entity -->
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <div class="row">
                            <label
                                class="col-md-6 col-form-label font-weight-bold ">{{ __('settings::dashboard.symbol_first') }}
                                : </label>
                            <div class="col-md-6">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_symbol_first'" :name="'is_symbol_first'"
                                    :isChecked="old('is_symbol_first', $currency->is_symbol_first ?? '')" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <div class="row">
                            <label
                                class="col-md-3 col-form-label font-weight-bold">{{ __('settings::dashboard.is_active') }}
                                : </label>
                            <div class="col-md-6">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'" :name="'is_active'"
                                    :isChecked="old('is_active', $currency->is_active ?? '')" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <div class="row">
                            <label class="col-md-3 col-form-label font-weight-bold">{{ __('settings::dashboard.is_main') }}
                                : </label>
                            <div class="col-md-6">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_main'" :name="'is_main'"
                                    :isChecked="old('is_main', $currency->is_main ?? '')" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="float-right mb-3">
                    <button type="submit" class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">
                        {{ __('settings::dashboard.save') }}
                    </button>
                    <a href="{{ route('dashboard.settings.currencies.index') }}"
                        class="btn font-weight-bold btn-secondary">
                        {{ __('settings::dashboard.cancel') }}
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
    @include('settings::currencies.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
