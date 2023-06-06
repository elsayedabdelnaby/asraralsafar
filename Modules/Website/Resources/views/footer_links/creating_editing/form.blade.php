@extends('dashboard.layouts.app')

@if (isset($footer_link))
    @section('title', __('website::dashboard.website') . ' - ' . __('website::dashboard.edit_footer_link'))

    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('website::dashboard.edit_footer_link'),
            'short_description' => __('website::dashboard.enter_footer_link_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@else
    @section('title', __('website::dashboard.website') . ' - ' . __('website::dashboard.create_footer_link'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('website::dashboard.new_footer_link'),
            'short_description' => __('website::dashboard.enter_footer_link_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@endif

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($footer_link) ? __('website::dashboard.edit_footer_link') : __('website::dashboard.new_footer_link') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.website.footer-links.index', ['footer_section_id' => $footer_section_id]) }}"
                    class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}</a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">
                <div id="kt_footer_link_translation_repeater">
                    <div class="form-group row">
                        <div data-repeater-list="translations" class="col-lg-12">
                            @forelse (old('translations', $footer_link->translations ?? []) as $translation)
                                <div data-repeater-item class="form-group row align-items-top">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label">{{ __('website::dashboard.language') }}:</label>
                                            <div class="col-lg-8">
                                                @if (is_array($translation))
                                                    <x-dashboard.form.inputs.language-select :selectedOption="$translation['language_id']" />
                                                @else
                                                    <x-dashboard.form.inputs.language-select :selectedOption="$translation->language_id" />
                                                @endif
                                                <span
                                                    class="form-text text-muted">{{ __('website::dashboard.the_language_of_the_footer_link_name') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label">{{ __('website::dashboard.name') }}:</label>
                                            <div class="col-lg-8">
                                                @if (is_array($translation))
                                                    <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                        :name="'name'" :placeholder="__('website::dashboard.name')" :value="$translation['name']"
                                                        :isRequired="true" :requiredMessage="__('website::dashboard.name_is_required')" :maxlength="100"
                                                        :maxlengthMessage="__(
                                                            'website::dashboard.number_of_characters_must_less_than_or_equal_100',
                                                        )" />
                                                @else
                                                    <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                        :name="'name'" :placeholder="__('website::dashboard.name')" :value="$translation->name"
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
                                                class="col-lg-4 col-form-label">{{ __('website::dashboard.language') }}:</label>
                                            <div class="col-lg-8">
                                                <x-dashboard.form.inputs.language-select :selectedOption="''" />
                                                <span
                                                    class="form-text text-muted">{{ __('website::dashboard.the_language_of_the_footer_link_name') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label">{{ __('website::dashboard.name') }}:</label>
                                            <div class="col-lg-8">
                                                <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                    :name="'name'" :placeholder="__('website::dashboard.name')" :value="''"
                                                    :isRequired="true" :requiredMessage="__('website::dashboard.name_is_required')" :maxlength="100"
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
                        <label class="col-lg-7 col-form-label text-right"></label>
                        <div class="col-lg-2">
                            <a href="javascript:;" data-repeater-create=""
                                class="btn btn-sm font-weight-bolder btn-light-primary">
                                <i class="la la-plus"></i>{{ __('website::dashboard.add') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.type') }}</label>
                    <div class="col-2">
                        <x-dashboard.form.inputs.enum-select :id="'type'" :name="'type'" :isRequired="true"
                            :options="$types" :requiredMessage="__('website::dashboard.type_is_required')" :defaultOptionName="__('website::dashboard.select_type')" :selectedOption="old('type', $footer_link->type ?? '')" />
                        <span class="form-text text-muted">{{ __('website::dashboard.select_the_type_of_link') }}</span>
                    </div>

                    <label class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.link') }}</label>
                    <div class="col-3">
                        <x-dashboard.form.inputs.url :id="'url'" :class="'form-control'" :name="'url'"
                            :isRequired="true" :requiredMessage="__('website::dashboard.url_is_required')" :placeholder="__('website::dashboard.url')" :value="old('url', $footer_link->url ?? '')"
                            :urlValidationMessage="__('website::dashboard.url_must_be_in_url_format')" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.is_active') }}</label>
                    <div class="col-1">
                        <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'" :name="'is_active'"
                            :isChecked="old('is_active', $footer_link->is_active ?? '')" />
                    </div>
                    <div class="col-1"></div>
                    <label
                        class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.display_order') }}</label>
                    <div class="col-2">
                        <x-dashboard.form.inputs.number :id="'display_order'" :class="'form-control'" :name="'display_order'"
                            :integerValidationMessage="__('website::dashboard.display_order_must_be_integer')" :placeholder="__('website::dashboard.display_order')" :value="old('display_order', $footer_link->display_order ?? '')" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('website::dashboard.save') }}</button>
                        <a href="{{ route('dashboard.website.footer-links.index', ['footer_section_id' => $footer_section_id]) }}"
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
    @include('website::footer_links.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
