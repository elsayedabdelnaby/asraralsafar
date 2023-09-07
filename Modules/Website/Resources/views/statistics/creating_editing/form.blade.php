@extends('dashboard.layouts.app')

@if (isset($statistic))
    @section('title', __('website::dashboard.website') . ' - ' . __('website::dashboard.edit_statistic'))

    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('website::dashboard.edit_statistic'),
            'short_description' => __('website::dashboard.enter_statistic_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@else
    @section('title', __('website::dashboard.website') . ' - ' . __('website::dashboard.create_statistic'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('website::dashboard.new_statistic'),
            'short_description' => __('website::dashboard.enter_statistic_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@endif

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($statistic) ? __('website::dashboard.edit_statistic') : __('website::dashboard.new_statistic') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.website.statistics.index') }}"
                    class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}</a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">
                <div id="kt_statistic_translation_repeater">
                    <div class="form-group row">
                        <div data-repeater-list="translations" class="col-lg-12">
                            @forelse (old('translations', $statistic->translations ?? []) as $translation)
                                <div data-repeater-item class="form-group row align-items-top">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label text-right">{{ __('website::dashboard.language') }}:</label>
                                            <div class="col-lg-8">
                                                @if (is_array($translation))
                                                    <x-dashboard.form.inputs.language-select :selectedOption="$translation['language_id']" />
                                                @else
                                                    <x-dashboard.form.inputs.language-select :selectedOption="$translation->language_id" />
                                                @endif
                                                <span
                                                    class="form-text text-muted">{{ __('website::dashboard.the_language_of_the_statistic_title_and_description') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label text-right">{{ __('website::dashboard.title') }}:</label>
                                            <div class="col-lg-8">
                                                @if (is_array($translation))
                                                    <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                        :name="'title'" :placeholder="__('website::dashboard.title')" :value="$translation['title']"
                                                        :isRequired="true" :requiredMessage="__('website::dashboard.name_is_required')" :maxlength="100"
                                                        :maxlengthMessage="__(
                                                            'website::dashboard.number_of_characters_must_less_than_or_equal_100',
                                                        )" />
                                                @else
                                                    <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                        :name="'title'" :placeholder="__('website::dashboard.title')" :value="$translation->title"
                                                        :isRequired="true" :requiredMessage="__('website::dashboard.name_is_required')" :maxlength="100"
                                                        :maxlengthMessage="__(
                                                            'website::dashboard.number_of_characters_must_less_than_or_equal_100',
                                                        )" />
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="javascript:;" data-repeater-delete=""
                                            class="btn btn-sm font-weight-bolder btn-light-danger">
                                            <i class="la la-trash-o"></i>{{ __('website::dashboard.delete') }}
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div data-repeater-item class="form-group row align-items-top">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label text-right">{{ __('website::dashboard.language') }}:</label>
                                            <div class="col-lg-8">
                                                <x-dashboard.form.inputs.language-select :selectedOption="''" />
                                                <span
                                                    class="form-text text-muted">{{ __('website::dashboard.the_language_of_the_statistic_title_and_description') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label text-right">{{ __('website::dashboard.title') }}:</label>
                                            <div class="col-lg-8">
                                                <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                    :name="'title'" :placeholder="__('website::dashboard.statistic_title')" :value="''"
                                                    :isRequired="true" :requiredMessage="__('website::dashboard.title_is_required')" :maxlength="100"
                                                    :maxlengthMessage="__(
                                                        'website::dashboard.number_of_characters_must_less_than_or_equal_100',
                                                    )" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="javascript:;" data-repeater-delete=""
                                            class="btn btn-sm font-weight-bolder btn-light-danger">
                                            <i class="la la-trash-o"></i>{{ __('website::dashboard.delete') }}
                                        </a>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-10 col-form-label text-right"></label>
                        <div class="col-lg-2">
                            <a href="javascript:;" data-repeater-create=""
                                class="btn btn-sm font-weight-bolder btn-light-primary">
                                <i class="la la-plus"></i>{{ __('website::dashboard.add') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.is_active') }}</label>
                    <div class="col-1">
                        <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'" :name="'is_active'"
                            :isChecked="old('is_active', $statistic->is_active ?? '')" />
                    </div>
                    <div class="col-1"></div>
                    <label
                        class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.display_order') }}</label>
                    <div class="col-2">
                        <x-dashboard.form.inputs.number :id="'display_order'" :class="'form-control'" :name="'display_order'"
                            :integerValidationMessage="__('website::dashboard.display_order_must_be_integer')" :placeholder="__('website::dashboard.display_order')" :value="old('display_order', $statistic->display_order ?? '')" />
                    </div>
                    <div class="col-1"></div>
                    <label class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.number') }}</label>
                    <div class="col-2">
                        <x-dashboard.form.inputs.number :id="'number'" :class="'form-control'" :name="'number'"
                            :integerValidationMessage="__('website::dashboard.number_must_be_integer')" :isRequired="true" :requiredMessage="__('website::dashboard.number_is_required')" :placeholder="__('website::dashboard.number')"
                            :value="old('number', $statistic->number ?? '')" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('website::dashboard.save') }}</button>
                        <a href="{{ route('dashboard.website.statistics.index') }}"
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
    @include('website::statistics.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
