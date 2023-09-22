@extends('dashboard.layouts.app')

@if (isset($service))
    @section('title', __('website::dashboard.website') . ' - ' . __('website::dashboard.edit_service'))

    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('website::dashboard.edit_service'),
            'short_description' => __('website::dashboard.enter_service_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@else
    @section('title', __('website::dashboard.website') . ' - ' . __('website::dashboard.create_service'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('website::dashboard.new_service'),
            'short_description' => __('website::dashboard.enter_service_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@endif

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($service) ? __('website::dashboard.edit_service') : __('website::dashboard.new_service') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.website.services.index') }}"
                    class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}</a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">
                <div id="kt_service_translation_repeater">
                    <div class="form-group row">
                        <div data-repeater-list="translations" class="col-12">
                            @forelse (old('translations', $service->translations ?? []) as $translation)
                                <div data-repeater-item class="row align-items-top">
                                    <div class="col-3">
                                        <div class="row">
                                            <label
                                                class="col-4 col-form-label text-right">{{ __('website::dashboard.language') }}:</label>
                                            <div class="col-8">
                                                @if (is_array($translation))
                                                    <x-dashboard.form.inputs.language-select :selectedOption="$translation['language_id']" />
                                                @else
                                                    <x-dashboard.form.inputs.language-select :selectedOption="$translation->language_id" />
                                                @endif
                                                <span
                                                    class="form-text text-muted">{{ __('website::dashboard.the_language_of_the_service_details') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <label
                                                class="col-1 col-form-label text-center">{{ __('website::dashboard.title') }}:</label>
                                            <div class="col-3">
                                                @if (is_array($translation))
                                                    <x-dashboard.form.inputs.text :id="''" :class="'form-control title-input'"
                                                        :name="'title'" :placeholder="__('website::dashboard.title')" :value="$translation['title']"
                                                        :isRequired="true" :requiredMessage="__('website::dashboard.title_is_required')" :maxlength="255"
                                                        :maxlengthMessage="__(
                                                            'website::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                        )" />
                                                @else
                                                    <x-dashboard.form.inputs.text :id="''" :class="'form-control title-input'"
                                                        :name="'title'" :placeholder="__('website::dashboard.title')" :value="$translation->title"
                                                        :isRequired="true" :requiredMessage="__('website::dashboard.title_is_required')" :maxlength="255"
                                                        :maxlengthMessage="__(
                                                            'website::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                        )" />
                                                @endif

                                            </div>
                                            <label
                                                class="col-2 col-form-label text-right">{{ __('website::dashboard.slug') }}:</label>
                                            <div class="col-5">
                                                @if (is_array($translation))
                                                    <x-dashboard.form.inputs.text :id="''" :class="'form-control slug-input'"
                                                        :name="'slug'" :placeholder="__('website::dashboard.slug')" :value="$translation['slug']"
                                                        :isRequired="true" :requiredMessage="__('website::dashboard.slug_is_required')" :maxlength="255"
                                                        :maxlengthMessage="__(
                                                            'website::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                        )" />
                                                @else
                                                    <x-dashboard.form.inputs.text :id="''" :class="'form-control slug-input'"
                                                        :name="'slug'" :placeholder="__('website::dashboard.slug')" :value="$translation->slug"
                                                        :isRequired="true" :requiredMessage="__('website::dashboard.title_is_required')" :maxlength="255"
                                                        :maxlengthMessage="__(
                                                            'website::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                        )" />
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 my-6">
                                        <div class="row">
                                            <label
                                                class="col-1 col-form-label text-right">{{ __('website::dashboard.description') }}:</label>
                                            <div class="col-5">
                                                @if (is_array($translation))
                                                    <x-dashboard.form.inputs.text-area :id="''" :class="'form-control rtf'"
                                                        :name="'description'" :placeholder="__('website::dashboard.description')" :value="$translation['description']"
                                                        :isRequired="true" :requiredMessage="__('website::dashboard.description_is_required')" />
                                                @else
                                                    <x-dashboard.form.inputs.text-area :id="''" :class="'form-control rtf'"
                                                        :name="'description'" :placeholder="__('website::dashboard.description')" :value="$translation->description"
                                                        :isRequired="true" :requiredMessage="__('website::dashboard.description_is_required')" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 my6">
                                        <div class="row align-items-center">
                                            <label
                                                class="col-1 col-form-label text-center">{{ __('website::dashboard.meta_title') }}:</label>
                                            <div class="col-3">
                                                @if (is_array($translation))
                                                    <x-dashboard.form.inputs.meta-title :id="''"
                                                        :class="'form-control'" :value="$translation['meta_title']" />
                                                @else
                                                    <x-dashboard.form.inputs.meta-title :id="''"
                                                        :class="'form-control'" :value="$translation->meta_title" />
                                                @endif
                                            </div>
                                            <label
                                                class="col-2 col-form-label text-right">{{ __('website::dashboard.meta_description') }}:</label>
                                            <div class="col-5">
                                                @if (is_array($translation))
                                                    <x-dashboard.form.inputs.meta-description :id="''"
                                                        :class="'form-control'" :isRequired="true" :value="$translation['meta_description']" />
                                                @else
                                                    <x-dashboard.form.inputs.meta-description :id="''"
                                                        :class="'form-control'" :isRequired="true" :value="$translation->meta_description" />
                                                @endif
                                            </div>
                                            <div class="col-1">
                                                <a href="javascript:;" data-repeater-delete=""
                                                    class="btn btn-sm font-weight-bolder btn-light-danger">
                                                    <i class="la la-trash-o"></i>{{ __('website::dashboard.delete') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div data-repeater-item class="form-group row align-items-top">
                                    <div class="col-12">
                                        <div class="row">
                                            <label
                                                class="col-1 col-form-label text-right">{{ __('website::dashboard.language') }}:</label>
                                            <div class="col-2">
                                                <x-dashboard.form.inputs.language-select :selectedOption="''" />
                                                <span
                                                    class="form-text text-muted">{{ __('website::dashboard.the_language_of_the_service_details') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <label
                                                class="col-1 col-form-label text-center">{{ __('website::dashboard.title') }}:</label>
                                            <div class="col-3">
                                                <x-dashboard.form.inputs.text :id="''" :class="'form-control title-input'"
                                                    :name="'title'" :placeholder="__('website::dashboard.service_title')" :value="''"
                                                    :isRequired="true" :requiredMessage="__('website::dashboard.title_is_required')" :maxlength="255"
                                                    :maxlengthMessage="__(
                                                        'website::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                    )" />
                                            </div>
                                            <label
                                                class="col-1 col-form-label text-right">{{ __('website::dashboard.slug') }}:</label>
                                            <div class="col-5">
                                                <x-dashboard.form.inputs.text :id="''" :class="'form-control slug-input'"
                                                    :name="'slug'" :placeholder="__('website::dashboard.service_slug')" :value="''"
                                                    :isRequired="true" :requiredMessage="__('website::dashboard.slug_is_required')" :maxlength="255"
                                                    :maxlengthMessage="__(
                                                        'website::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                    )" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 my-6">
                                        <div class="row">
                                            <label
                                                class="col-1 col-form-label text-right">{{ __('website::dashboard.description') }}:</label>
                                            <div class="col-5">
                                                <x-dashboard.form.inputs.text-area :id="''" :class="'form-control rtf'"
                                                    :name="'description'" :placeholder="__('website::dashboard.description')" :value="''"
                                                    :isRequired="true" :requiredMessage="__('website::dashboard.description_is_required')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 my6">
                                        <div class="row align-items-center">
                                            <label
                                                class="col-1 col-form-label text-center">{{ __('website::dashboard.meta_title') }}:</label>
                                            <div class="col-3">
                                                <x-dashboard.form.inputs.meta-title :id="''" :class="'form-control'"
                                                    :value="''" />
                                            </div>
                                            <label
                                                class="col-2 col-form-label text-right">{{ __('website::dashboard.meta_description') }}:</label>
                                            <div class="col-5">
                                                <x-dashboard.form.inputs.meta-description :id="''"
                                                    :class="'form-control'" :isRequired="true" :value="''" />
                                            </div>
                                            <div class="col-1">
                                                <a href="javascript:;" data-repeater-delete=""
                                                    class="btn btn-sm font-weight-bolder btn-light-danger">
                                                    <i class="la la-trash-o"></i>{{ __('website::dashboard.delete') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-10 col-form-label text-right"></label>
                        <div class="col-2">
                            <a href="javascript:;" data-repeater-create=""
                                class="btn btn-sm font-weight-bolder btn-light-primary">
                                <i class="la la-plus"></i>{{ __('website::dashboard.add') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label
                        class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.display_order') }}</label>
                    <div class="col-2">
                        <x-dashboard.form.inputs.number :id="'display_order'" :class="'form-control'" :name="'display_order'"
                            :integerValidationMessage="__('website::dashboard.display_order_must_be_integer')" :placeholder="__('website::dashboard.display_order')" :value="old('display_order', $service->display_order ?? '')" />
                    </div>
                    <div class="col-1"></div>
                    <label class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.type') }}</label>
                    <div class="col-2">
                        <select id="type" name="type" isRequired="true" class="form-control select2" required
                            data-parsley-required-message="{{ __('website::dashboard.type_is_required') }}">
                            <option value="">{{ __('website::dashboard.select_type') }}
                            </option>
                            <option value="flight" @if (isset($service) && $service->type == 'flight') selected @endif>
                                {{ __('website::dashboard.flight') }}</option>
                            <option value="tourism" @if (isset($service) && $service->type == 'tourism') selected @endif>
                                {{ __('website::dashboard.tourism') }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.is_active') }}</label>
                    <div class="col-1">
                        <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'" :name="'is_active'"
                            :isChecked="old('is_active', $service->is_active ?? '')" />
                    </div>
                    <div class="col-1"></div>
                    <label class="col-xl-2 col-2 col-form-label text-center">{{ __('website::dashboard.image') }}</label>
                    <div class="col-2 col-xl-2">
                        <div class="image-input image-input-empty image-input-outline"
                            style="background-image: url('{{ $service->image_url ?? global_asset('metronic/assets/media/users/blank.png') }}')"
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
                        <a href="{{ route('dashboard.website.terms-conditions.index') }}"
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
    @include('website::services.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
