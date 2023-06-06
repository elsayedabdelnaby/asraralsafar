@extends('dashboard.layouts.app')

@if (isset($subcategory))
    @section('title', __('settings::dashboard.settings') . ' - ' . __('settings::dashboard.edit_subcategory'))

    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('settings::dashboard.edit_subcategory'),
            'short_description' => __('settings::dashboard.enter_subcategory_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@else
    @section('title', __('settings::dashboard.settings') . ' - ' . __('settings::dashboard.create_subcategory'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('settings::dashboard.new_subcategory'),
            'short_description' => __('settings::dashboard.enter_subcategory_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@endif

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($subcategory) ? __('settings::dashboard.edit_subcategory') : __('settings::dashboard.new_subcategory') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.settings.subcategories.index', ['category_id' => $category_id]) }}"
                    class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}</a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">
                <div id="kt_subcategory_translation_repeater">
                    <div data-repeater-list="translations">
                        @forelse (old('translations', $subcategory->translations ?? []) as $translation)
                            <div data-repeater-item class="row mb-7">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <label
                                            class="col-lg-1 col-form-label text-center">{{ __('settings::dashboard.language') }}:</label>
                                        <div class="col-lg-3">
                                            @if (is_array($translation))
                                                <x-dashboard.form.inputs.language-select :selectedOption="$translation['language_id']" />
                                            @else
                                                <x-dashboard.form.inputs.language-select :selectedOption="$translation->language_id" />
                                            @endif
                                            <span
                                                class="form-text text-muted">{{ __('settings::dashboard.the_language_of_the_category_details') }}</span>
                                        </div>

                                        <label
                                            class="col-lg-2 col-form-label text-right">{{ __('settings::dashboard.name') }}:</label>
                                        <div class="col-lg-3">
                                            @if (is_array($translation))
                                                <x-dashboard.form.inputs.text :id="''" :class="'form-control name-input'"
                                                    :name="'name'" :placeholder="__('settings::dashboard.name')" :value="$translation['name']" :isRequired="true"
                                                    :requiredMessage="__('settings::dashboard.name_is_required')" :maxlength="255" :maxlengthMessage="__(
                                                        'settings::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                    )" />
                                            @else
                                                <x-dashboard.form.inputs.text :id="''" :class="'form-control name-input'"
                                                    :name="'name'" :placeholder="__('settings::dashboard.name')" :value="$translation->name"
                                                    :isRequired="true" :requiredMessage="__('settings::dashboard.name_is_required')" :maxlength="255"
                                                    :maxlengthMessage="__(
                                                        'settings::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                    )" />
                                            @endif

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label
                                            class="col-lg-1 col-form-label text-center">{{ __('settings::dashboard.slug') }}:</label>
                                        <div class="col-lg-3">
                                            @if (is_array($translation))
                                                <x-dashboard.form.inputs.text :id="''" :class="'form-control slug-input'"
                                                    :name="'slug'" :placeholder="__('settings::dashboard.slug')" :value="$translation['slug']"
                                                    :isRequired="true" :requiredMessage="__('settings::dashboard.slug_is_required')" :maxlength="255"
                                                    :maxlengthMessage="__(
                                                        'settings::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                    )" />
                                            @else
                                                <x-dashboard.form.inputs.text :id="''" :class="'form-control slug-input'"
                                                    :name="'slug'" :placeholder="__('settings::dashboard.slug')" :value="$translation->slug"
                                                    :isRequired="true" :requiredMessage="__('settings::dashboard.slug_is_required')" :maxlength="255"
                                                    :maxlengthMessage="__(
                                                        'settings::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                    )" />
                                            @endif
                                        </div>
                                        <label
                                            class="col-lg-2 col-form-label text-right">{{ __('settings::dashboard.description') }}:</label>
                                        <div class="col-lg-5">
                                            @if (is_array($translation))
                                                <x-dashboard.form.inputs.text-area :id="''" :class="'form-control rtf'"
                                                    :name="'description'" :placeholder="__('settings::dashboard.description')" :value="$translation['description']" />
                                            @else
                                                <x-dashboard.form.inputs.text-area :id="''" :class="'form-control rtf'"
                                                    :name="'description'" :placeholder="__('settings::dashboard.description')" :value="$translation->description" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label
                                            class="col-lg-1 col-form-label text-center">{{ __('settings::dashboard.meta_title') }}:</label>
                                        <div class="col-lg-3">
                                            @if (is_array($translation))
                                                <x-dashboard.form.inputs.meta-title :id="''" :class="'form-control'"
                                                    :value="$translation['meta_title']" />
                                            @else
                                                <x-dashboard.form.inputs.meta-title :id="''" :class="'form-control'"
                                                    :value="$translation->meta_title" />
                                            @endif
                                        </div>
                                        <label
                                            class="col-lg-2 col-form-label text-right">{{ __('settings::dashboard.meta_description') }}:</label>
                                        <div class="col-lg-5">
                                            @if (is_array($translation))
                                                <x-dashboard.form.inputs.meta-description :id="''"
                                                    :class="'form-control'" :value="$translation['meta_description']" />
                                            @else
                                                <x-dashboard.form.inputs.meta-description :id="''"
                                                    :class="'form-control'" :value="$translation->meta_description" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-10"></div>
                                        <div class="col-2">
                                            <a href="javascript:;" data-repeater-delete=""
                                                class="btn btn-sm font-weight-bolder btn-light-danger">
                                                <i class="la la-trash-o"></i>{{ __('settings::dashboard.delete') }}
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
                                            class="col-lg-1 col-form-label text-center">{{ __('settings::dashboard.language') }}:</label>
                                        <div class="col-lg-3">
                                            <x-dashboard.form.inputs.language-select :selectedOption="''" />
                                            <span
                                                class="form-text text-muted">{{ __('settings::dashboard.the_language_of_the_category_details') }}</span>
                                        </div>

                                        <label
                                            class="col-lg-2 col-form-label text-right">{{ __('settings::dashboard.name') }}:</label>
                                        <div class="col-lg-3">
                                            <x-dashboard.form.inputs.text :id="''" :class="'form-control name-input'"
                                                :name="'name'" :placeholder="__('settings::dashboard.name')" :value="''" :isRequired="true"
                                                :requiredMessage="__('settings::dashboard.name_is_required')" :maxlength="255" :maxlengthMessage="__(
                                                    'settings::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                )" />

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label
                                            class="col-lg-1 col-form-label text-center">{{ __('settings::dashboard.slug') }}:</label>
                                        <div class="col-lg-3">
                                            <x-dashboard.form.inputs.text :id="''" :class="'form-control slug-input'"
                                                :name="'slug'" :placeholder="__('settings::dashboard.slug')" :value="''" :isRequired="true"
                                                :requiredMessage="__('settings::dashboard.slug_is_required')" :maxlength="255" :maxlengthMessage="__(
                                                    'settings::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                )" />
                                        </div>
                                        <label
                                            class="col-lg-2 col-form-label text-right">{{ __('settings::dashboard.description') }}:</label>
                                        <div class="col-lg-5">
                                            <x-dashboard.form.inputs.text-area :id="''" :class="'form-control rtf'"
                                                :name="'description'" :placeholder="__('settings::dashboard.description')" :value="''" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label
                                            class="col-lg-1 col-form-label text-center">{{ __('settings::dashboard.meta_title') }}:</label>
                                        <div class="col-lg-3">
                                            <x-dashboard.form.inputs.meta-title :id="''" :class="'form-control'"
                                                :value="''" />
                                        </div>
                                        <label
                                            class="col-lg-2 col-form-label text-right">{{ __('settings::dashboard.meta_description') }}:</label>
                                        <div class="col-lg-5">
                                            <x-dashboard.form.inputs.meta-description :id="''" :class="'form-control'"
                                                :value="''" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-10"></div>
                                        <div class="col-2">
                                            <a href="javascript:;" data-repeater-delete=""
                                                class="btn btn-sm font-weight-bolder btn-light-danger">
                                                <i class="la la-trash-o"></i>{{ __('settings::dashboard.delete') }}
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
                                <i class="la la-plus"></i>{{ __('settings::dashboard.add') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-4">
                        <div class="row mb-3">
                            <label
                                class="col-7 col-form-label font-weight-bold">{{ __('settings::dashboard.is_active_in_website') }}</label>
                            <div class="col-1">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active_in_website'" :name="'is_active_in_website'"
                                    :isChecked="old('is_active_in_website', $subcategory->is_active_in_website ?? '')" data-invisible-row-id="display_order_in_website_row" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label
                                class="col-7 col-form-label font-weight-bold">{{ __('settings::dashboard.is_active_in_mobile') }}</label>
                            <div class="col-1">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active_in_mobile'" :name="'is_active_in_mobile'"
                                    :isChecked="old('is_active_in_mobile', $subcategory->is_active_in_mobile ?? '')" data-invisible-row-id="display_order_in_mobile_row" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label
                                class="col-7 col-form-label font-weight-bold">{{ __('settings::dashboard.is_display_home_page_of_website') }}</label>
                            <div class="col-1">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_display_home_page_of_website'" :name="'is_display_home_page_of_website'"
                                    :isChecked="old(
                                        'is_display_home_page_of_website',
                                        $subcategory->is_display_home_page_of_website ?? '',
                                    )" data-invisible-row-id="display_order_in_home_page_website_row" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label
                                class="col-7 col-form-label font-weight-bold">{{ __('settings::dashboard.is_display_home_page_of_mobile') }}</label>
                            <div class="col-1">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_display_home_page_of_mobile'"
                                    :name="'is_display_home_page_of_mobile'" :isChecked="old(
                                        'is_display_home_page_of_mobile',
                                        $subcategory->is_display_home_page_of_mobile ?? '',
                                    )"
                                    data-invisible-row-id="display_order_in_home_page_mobile_row" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label
                                class="col-7 col-form-label font-weight-bold">{{ __('settings::dashboard.is_display_in_fav_category_of_webite') }}</label>
                            <div class="col-1">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_display_in_fav_category_of_webite'"
                                    :name="'is_display_in_fav_category_of_webite'" :isChecked="old(
                                        'is_display_in_fav_category_of_webite',
                                        $subcategory->is_display_in_fav_category_of_webite ?? '',
                                    )" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label
                                class="col-7 col-form-label font-weight-bold">{{ __('settings::dashboard.is_display_in_fav_category_of_mobile') }}</label>
                            <div class="col-1">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_display_in_fav_category_of_mobile'"
                                    :name="'is_display_in_fav_category_of_mobile'" :isChecked="old(
                                        'is_display_in_fav_category_of_mobile',
                                        $subcategory->is_display_in_fav_category_of_mobile ?? '',
                                    )" />
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row mb-3 @if (!old('is_active_in_website', $subcategory->is_active_in_website ?? null)) invisible @endif"
                            id="display_order_in_website_row">
                            <label
                                class="col-4 col-form-label font-weight-bold">{{ __('settings::dashboard.display_order_in_website') }}</label>
                            <div class="col-4">
                                <x-dashboard.form.inputs.number :id="'display_order_in_website'" :class="'form-control'" :name="'display_order_in_website'"
                                    :integerValidationMessage="__('settings::dashboard.display_order_must_be_integer')" :placeholder="__('settings::dashboard.display_order_in_website')" :value="old(
                                        'display_order_in_website',
                                        $subcategory->display_order_in_website ?? '',
                                    )" />
                            </div>
                        </div>
                        <div class="row mb-3 @if (!old('is_active_in_mobile', $subcategory->is_active_in_mobile ?? null)) invisible @endif"
                            id="display_order_in_mobile_row">
                            <label
                                class="col-4 col-form-label font-weight-bold">{{ __('settings::dashboard.display_order_in_mobile') }}</label>
                            <div class="col-4">
                                <x-dashboard.form.inputs.number :id="'display_order_in_mobile'" :class="'form-control'" :name="'display_order_in_mobile'"
                                    :integerValidationMessage="__('settings::dashboard.display_order_must_be_integer')" :placeholder="__('settings::dashboard.display_order_in_mobile')" :value="old('display_order', $subcategory->display_order_in_mobile ?? '')" />
                            </div>
                        </div>
                        <div class="row mb-3 @if (!old('is_display_home_page_of_website', $subcategory->is_display_home_page_of_website ?? null)) invisible @endif"
                            id="display_order_in_home_page_website_row">
                            <label
                                class="col-4 col-form-label font-weight-bold">{{ __('settings::dashboard.display_order_in_home_page_of_website') }}</label>
                            <div class="col-4">
                                <x-dashboard.form.inputs.number :id="'display_order_in_home_page_of_website'" :class="'form-control'" :name="'display_order_in_home_page_of_website'"
                                    :integerValidationMessage="__('settings::dashboard.display_order_must_be_integer')" :placeholder="__('settings::dashboard.display_order_in_home_page_of_website')" :value="old(
                                        'display_order',
                                        $subcategory->display_order_in_home_page_of_website ?? '',
                                    )" />
                            </div>
                        </div>
                        <div class="row mb-3 @if (!old('is_display_home_page_of_mobile', $subcategory->is_display_home_page_of_mobile ?? null)) invisible @endif"
                            id="display_order_in_home_page_mobile_row">
                            <label
                                class="col-4 col-form-label font-weight-bold">{{ __('settings::dashboard.display_order_in_home_page_of_mobile') }}</label>
                            <div class="col-4">
                                <x-dashboard.form.inputs.number :id="'display_order_in_home_page_of_mobile'" :class="'form-control'" :name="'display_order_in_home_page_of_mobile'"
                                    :integerValidationMessage="__('settings::dashboard.display_order_must_be_integer')" :placeholder="__('settings::dashboard.display_order_in_home_page_of_mobile')" :value="old(
                                        'display_order',
                                        $subcategory->display_order_in_home_page_of_mobile ?? '',
                                    )" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <!-- Main Logo -->
                    <div class="col-4">
                        <div class="row">
                            <label
                                class="col-xl-4 col-lg-4 col-form-label text-left">{{ __('settings::dashboard.image') }}</label>
                            <div class="col-lg-8 col-xl-8">
                                <div class="image-input image-input-empty image-input-outline"
                                    style="background-image: url('{{ $subcategory->image_url ?? global_asset('metronic/assets/media/users/blank.png') }}')"
                                    id="image">
                                    <div class="image-input-wrapper"></div>
                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="{{ __('settings::dashboard.change_image') }}">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="image" accept=".png, .jpg, .jpeg, .svg" />
                                        <input type="hidden" name="image_remove" />
                                    </label>

                                    <span
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="cancel" data-toggle="tooltip"
                                        title="{{ __('settings::dashboard.cancel_image') }}">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>

                                    <span
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="remove" data-toggle="tooltip"
                                        title="{{ __('settings::dashboard.remove_image') }}">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--END Main Logo -->
                    <!-- Mobile Icon -->
                    <div class="col-4">
                        <div class="row">
                            <label
                                class="col-xl-4 col-lg-4 col-form-label text-left">{{ __('settings::dashboard.mobile_image') }}</label>
                            <div class="col-lg-8 col-xl-8">
                                <div class="image-input image-input-empty image-input-outline"
                                    style="background-image: url('{{ $subcategory->mobile_image_url ?? global_asset('metronic/assets/media/users/blank.png') }}')"
                                    id="mobile_image">
                                    <div class="image-input-wrapper"></div>
                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="{{ __('settings::dashboard.change_image') }}">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="mobile_image" required
                                            accept=".png, .jpg, .jpeg, .svg" />
                                        <input type="hidden" name="image_remove" />
                                    </label>

                                    <span
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="cancel" data-toggle="tooltip"
                                        title="{{ __('settings::dashboard.cancel_image') }}">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>

                                    <span
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="remove" data-toggle="tooltip"
                                        title="{{ __('settings::dashboard.remove_image') }}">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Main Logo -->
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('settings::dashboard.save') }}</button>
                        <a href="{{ route('dashboard.settings.categories.index') }}"
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
    @include('settings::subcategories.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
