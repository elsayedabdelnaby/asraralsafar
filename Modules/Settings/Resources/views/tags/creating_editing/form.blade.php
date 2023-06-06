@extends('dashboard.layouts.app')

@if (isset($tag))
    @section('title', __('settings::dashboard.settings') . ' - ' . __('settings::dashboard.edit_tag'))

    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('settings::dashboard.edit_tag'),
            'short_description' => __('settings::dashboard.enter_tag_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@else
    @section('title', __('settings::dashboard.settings') . ' - ' . __('settings::dashboard.create_tag'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('settings::dashboard.new_tag'),
            'short_description' => __('settings::dashboard.enter_tag_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@endif

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($tag) ? __('settings::dashboard.edit_tag') : __('settings::dashboard.new_tag') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.settings.tags.index') }}"
                    class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}</a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">
                <div id="kt_tag_translation_repeater">
                    <div class="form-group row">
                        <div data-repeater-list="translations" class="col-lg-12">
                            @forelse (old('translations', $tag->translations ?? []) as $translation)
                                <div data-repeater-item class="form-group row align-items-top">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label">{{ __('settings::dashboard.language') }}:</label>
                                            <div class="col-lg-8">
                                                @if (is_array($translation))
                                                    <x-dashboard.form.inputs.language-select :selectedOption="$translation['language_id']" />
                                                @else
                                                    <x-dashboard.form.inputs.language-select :selectedOption="$translation->language_id" />
                                                @endif
                                                <span
                                                    class="form-text text-muted">{{ __('settings::dashboard.the_language_of_the_tag_name') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label">{{ __('settings::dashboard.name') }}:</label>
                                            <div class="col-lg-8">
                                                @if (is_array($translation))
                                                    <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                        :name="'name'" :placeholder="__('settings::dashboard.name')" :value="$translation['name']"
                                                        :isRequired="true" :requiredMessage="__('settings::dashboard.name_is_required')" :maxlength="100"
                                                        :maxlengthMessage="__(
                                                            'settings::dashboard.number_of_characters_must_less_than_or_equal_100',
                                                        )" />
                                                @else
                                                    <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                        :name="'name'" :placeholder="__('settings::dashboard.name')" :value="$translation->name"
                                                        :isRequired="true" :requiredMessage="__('settings::dashboard.name_is_required')" :maxlength="100"
                                                        :maxlengthMessage="__(
                                                            'settings::dashboard.number_of_characters_must_less_than_or_equal_100',
                                                        )" />
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="javascript:;" data-repeater-delete=""
                                            class="btn btn-sm font-weight-bolder btn-light-danger">
                                            <i class="la la-trash-o"></i>{{ __('settings::dashboard.delete') }}
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div data-repeater-item class="form-group row align-items-top">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label">{{ __('settings::dashboard.language') }}:</label>
                                            <div class="col-lg-8">
                                                <x-dashboard.form.inputs.language-select :selectedOption="''" />
                                                <span
                                                    class="form-text text-muted">{{ __('settings::dashboard.the_language_of_the_tag_name') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label">{{ __('settings::dashboard.name') }}:</label>
                                            <div class="col-lg-8">
                                                <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                    :name="'name'" :placeholder="__('settings::dashboard.name')" :value="''"
                                                    :isRequired="true" :requiredMessage="__('settings::dashboard.name_is_required')" :maxlength="100"
                                                    :maxlengthMessage="__(
                                                        'settings::dashboard.number_of_characters_must_less_than_or_equal_50',
                                                    )" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="javascript:;" data-repeater-delete=""
                                            class="btn btn-sm font-weight-bolder btn-light-danger">
                                            <i class="la la-trash-o"></i>{{ __('settings::dashboard.delete') }}
                                        </a>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-7 col-form-label text-right"></label>
                        <div class="col-lg-2">
                            <a href="javascript:;" data-repeater-create=""
                                class="btn btn-sm font-weight-bolder btn-light-primary">
                                <i class="la la-plus"></i>{{ __('settings::dashboard.add') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 col-form-label font-weight-bold">{{ __('settings::dashboard.is_active') }}</label>
                    <div class="col-1">
                        <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'" :name="'is_active'"
                            :isChecked="old('is_active', $tag->is_active ?? '')" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('settings::dashboard.save') }}</button>
                        <a href="{{ route('dashboard.settings.tags.index') }}"
                            class="btn font-weight-bold btn-secondary">{{ __('settings::dashboard.cancel') }}</a>
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
    @include('settings::tags.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
