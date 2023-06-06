@extends('dashboard.layouts.app')

@if (isset($meta_page))
    @section('title', __('website::dashboard.website') . ' - ' . __('website::dashboard.edit_meta_page'))

    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('website::dashboard.edit_meta_page'),
            'short_description' => __('website::dashboard.enter_meta_page_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@else
    @section('title', __('website::dashboard.website') . ' - ' . __('website::dashboard.create_meta_page'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('website::dashboard.new_meta_page'),
            'short_description' => __('website::dashboard.enter_meta_page_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@endif

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($meta_page) ? __('website::dashboard.edit_meta_page') : __('website::dashboard.new_meta_page') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.website.meta-pages.index') }}"
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
                    <label
                        class="col-2 col-form-label font-weight-bold text-center">{{ __('website::dashboard.page') }}</label>
                    <div class="col-3">
                        <x-dashboard.form.inputs.enum-select :id="'page'" :name="'page'" :isRequired="true"
                            :options="$pages" :requiredMessage="__('website::dashboard.page_is_required')" :defaultOptionName="__('website::dashboard.select_page')" :selectedOption="old('page', $meta_page->page ?? '')" />
                        <span
                            class="form-text text-muted">{{ __('website::dashboard.select_the_type_of_meta_page') }}</span>
                    </div>
                </div>

                <div id="kt_meta_page_translation_repeater">
                    <div data-repeater-list="translations">
                        @forelse (old('translations', $meta_page->translations ?? []) as $translation)
                            <div data-repeater-item class="row mb-7">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <label
                                            class="col-lg-2 col-form-label text-center">{{ __('website::dashboard.language') }}:</label>
                                        <div class="col-lg-3">
                                            @if (is_array($translation))
                                                <x-dashboard.form.inputs.language-select :selectedOption="$translation['language_id']" />
                                            @else
                                                <x-dashboard.form.inputs.language-select :selectedOption="$translation->language_id" />
                                            @endif
                                            <span
                                                class="form-text text-muted">{{ __('website::dashboard.the_language_of_the_meta_page_details') }}</span>
                                        </div>
                                        <label
                                            class="col-lg-2 col-form-label text-center">{{ __('website::dashboard.meta_title') }}:</label>
                                        <div class="col-lg-3">
                                            @if (is_array($translation))
                                                <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                    :name="'title'" :placeholder="__('website::dashboard.meta_title')" :value="$translation['title']"
                                                    :isRequired="true" :requiredMessage="__('website::dashboard.meta_title_is_required')" :maxlength="65"
                                                    :maxlengthMessage="__(
                                                        'website::dashboard.number_of_characters_must_less_than_or_equal_65',
                                                    )" />
                                            @else
                                                <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                    :name="'title'" :placeholder="__('website::dashboard.meta_title')" :value="$translation->title"
                                                    :isRequired="true" :requiredMessage="__('website::dashboard.meta_title_is_required')" :maxlength="65"
                                                    :maxlengthMessage="__(
                                                        'website::dashboard.number_of_characters_must_less_than_or_equal_65',
                                                    )" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label
                                            class="col-lg-2 col-form-label text-center">{{ __('website::dashboard.meta_description') }}:</label>
                                        <div class="col-lg-3">
                                            @if (is_array($translation))
                                                <x-dashboard.form.inputs.text-area :id="''" :class="'form-control'"
                                                    :isRequired="true" :requiredMessage="__('website::dashboard.meta_description_is_required')" :name="'description'"
                                                    :placeholder="__('website::dashboard.meta_description')" :value="$translation['description']" />
                                            @else
                                                <x-dashboard.form.inputs.text-area :id="''" :class="'form-control'"
                                                    :isRequired="true" :requiredMessage="__('website::dashboard.meta_description_is_required')" :name="'description'"
                                                    :placeholder="__('website::dashboard.meta_description')" :value="$translation->description" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-10"></div>
                                        <div class="col-2">
                                            <a href="javascript:;" data-repeater-delete=""
                                                class="btn btn-sm font-weight-bolder btn-light-danger">
                                                <i class="la la-trash-o"></i>{{ __('website::dashboard.delete') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-2"></div>
                                <!--end::Separator-->
                            </div>
                        @empty
                            <div data-repeater-item class="row mb-7">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <label
                                            class="col-lg-2 col-form-label text-center">{{ __('website::dashboard.language') }}:</label>
                                        <div class="col-lg-3">
                                            <x-dashboard.form.inputs.language-select :selectedOption="''" />
                                            <span
                                                class="form-text text-muted">{{ __('website::dashboard.the_language_of_the_meta_page_details') }}</span>
                                        </div>
                                        <label
                                            class="col-lg-2 col-form-label text-center">{{ __('website::dashboard.meta_title') }}:</label>
                                        <div class="col-lg-3">
                                            <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                :name="'title'" :placeholder="__('website::dashboard.meta_title')" :value="''" :isRequired="true"
                                                :requiredMessage="__('website::dashboard.meta_title_is_required')" :maxlength="65" :maxlengthMessage="__(
                                                    'website::dashboard.number_of_characters_must_less_than_or_equal_65',
                                                )" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label
                                            class="col-lg-2 col-form-label text-center">{{ __('website::dashboard.meta_description') }}:</label>
                                        <div class="col-lg-3">
                                            <x-dashboard.form.inputs.text-area :id="''" :class="'form-control'"
                                                :isRequired="true" :requiredMessage="__('website::dashboard.meta_description_is_required')" :name="'description'" :placeholder="__('website::dashboard.meta_description')"
                                                :value="''" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-10"></div>
                                        <div class="col-2">
                                            <a href="javascript:;" data-repeater-delete=""
                                                class="btn btn-sm font-weight-bolder btn-light-danger">
                                                <i class="la la-trash-o"></i>{{ __('website::dashboard.delete') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-2"></div>
                                <!--end::Separator-->
                            </div>
                        @endforelse
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
                    <!-- End Main Logo -->
                    <label
                        class="col-xl-2 col-lg-2 col-form-label text-left">{{ __('website::dashboard.meta_image') }}</label>
                    <div class="col-lg-2 col-xl-2">
                        <div class="image-input image-input-empty image-input-outline"
                            style="background-image: url('{{ $meta_page->image_url ?? global_asset('metronic/assets/media/users/blank.png') }}')"
                            id="image">
                            <div class="image-input-wrapper"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title=""
                                data-original-title="{{ __('website::dashboard.change_image') }}">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg, .svg" />
                                <input type="hidden" name="image_remove" />
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="cancel" data-toggle="tooltip"
                                title="{{ __('website::dashboard.cancel_image') }}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="remove" data-toggle="tooltip"
                                title="{{ __('website::dashboard.remove_image') }}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('website::dashboard.save') }}</button>
                        <a href="{{ route('dashboard.website.meta-pages.index') }}"
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
    @include('website::meta_pages.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
