@extends('dashboard.layouts.app')

@section('title', __('website::dashboard.website_information') . ' - ' . __('website::dashboard.edit_information'))

@section('subheader')
    @include('dashboard.layouts.partials.sub_header', [
        'module_name' => __('website::dashboard.edit_information'),
        'short_description' => __('website::dashboard.enter_the_website_information_details'),
        'breadcrumbs' => [],
    ]);
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ __('website::dashboard.edit_information') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ URL::previous() }}" class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}</a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">
                <div id="kt_website_information_translation_name_repeater">
                    <div class="form-group row">
                        <div data-repeater-list="translations" class="col-lg-10">
                            @foreach ($website_information->translations as $translation)
                                <div data-repeater-item class="form-group row align-items-top">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label text-right">{{ __('website::dashboard.language') }}:</label>
                                            <div class="col-lg-8">
                                                <x-dashboard.form.inputs.language-select :selectedOption="$translation->language_id" />
                                                <span
                                                    class="form-text text-muted">{{ __('website::dashboard.the_language_of_the_website_name') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label text-right">{{ __('website::dashboard.name') }}:</label>
                                            <div class="col-lg-8">
                                                <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                    :name="'name'" :placeholder="__('website::dashboard.website_name')" :value="$translation->name" :isRequired="true"
                                                    :requiredMessage="__('website::dashboard.name_is_required')" :maxlength="100" :maxlengthMessage="__(
                                                        'website::dashboard.number_of_characters_must_less_than_or_equal_100',
                                                    )" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 my-7">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label text-right">{{ __('website::dashboard.address') }}:</label>
                                            <div class="col-lg-8">
                                                <x-dashboard.form.inputs.text-area :id="''" :class="'form-control'"
                                                    :name="'address'" :placeholder="__('website::dashboard.address')" :value="$translation->address"
                                                    :isRequired="true" :requiredMessage="__('website::dashboard.address_is_required')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="offset-md-2 col-md-4">
                                        <a href="javascript:;" data-repeater-delete=""
                                            class="btn btn-sm font-weight-bolder btn-light-danger">
                                            <i class="la la-trash-o"></i>{{ __('website::dashboard.delete') }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-9 col-form-label text-right"></label>
                        <div class="col-lg-2">
                            <a href="javascript:;" data-repeater-create=""
                                class="btn btn-sm font-weight-bolder btn-light-primary">
                                <i class="la la-plus"></i>{{ __('website::dashboard.add') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <!-- Main Logo -->
                    <label
                        class="col-xl-2 col-lg-2 col-form-label text-left">{{ __('website::dashboard.main_logo') }}</label>
                    <div class="col-lg-2 col-xl-2">
                        <div class="image-input image-input-empty image-input-outline"
                            style="background-image: url('{{ $website_information->main_logo_url ?? global_asset('metronic/assets/media/users/blank.png') }}')"
                            id="main_logo">
                            <div class="image-input-wrapper"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title=""
                                data-original-title="{{ __('website::dashboard.change_image') }}">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="main_logo" accept=".png, .jpg, .jpeg, .svg" />
                                <input type="hidden" name="main_logo_remove" />
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
                    <!-- End Main Logo -->
                    <label
                        class="col-xl-2 col-lg-2 col-form-label text-left">{{ __('website::dashboard.footer_logo') }}</label>
                    <div class="col-lg-2 col-xl-2">
                        <div class="image-input image-input-empty image-input-outline"
                            style="background-image: url('{{ $website_information->footer_logo_url ?? global_asset('metronic/assets/media/users/blank.png') }}')"
                            id="footer_logo">
                            <div class="image-input-wrapper"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title=""
                                data-original-title="{{ __('website::dashboard.change_image') }}">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="footer_logo" accept=".png, .jpg, .jpeg, .svg" />
                                <input type="hidden" name="footer_logo_remove" />
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
                <!-- Pixel Code -->
                <div class="form-group row">
                    <!-- Facebook Pixel Code -->
                    <label
                        class="col-xl-2 col-lg-2 col-form-label text-left">{{ __('website::dashboard.facebook_pixel_code') }}</label>
                    <div class="col-3 col-xl-3 col-lg-3">
                        <x-dashboard.form.inputs.text-area :id="''" :class="'form-control'" :name="'facebook_pixel_code'"
                            :placeholder="__('website::dashboard.facebook_pixel_code')" :value="$website_information->facebook_pixel_code" />
                    </div>
                    <!-- End Facebook Pixel Code -->
                    <!-- Google Analytics Code -->
                    <label
                        class="col-xl-2 col-lg-2 col-form-label text-left">{{ __('website::dashboard.google_analytics_code') }}</label>
                    <div class="col-3 col-xl-3 col-lg-3">
                        <x-dashboard.form.inputs.text-area :id="''" :class="'form-control'" :name="'google_analytics_code'"
                            :placeholder="__('website::dashboard.google_analytics_code')" :value="$website_information->google_analytics_code" />
                    </div>
                    <!-- End Google Analytics Code -->
                </div>
                <!-- End Pixel Code -->
                <div class="form-group row">
                    <!-- Google Map Link -->
                    <label
                        class="col-xl-2 col-lg-2 col-form-label text-left">{{ __('website::dashboard.google_map_link') }}</label>
                    <div class="col-3 col-xl-3 col-lg-3">
                        <x-dashboard.form.inputs.text-area :id="''" :class="'form-control'" :name="'address_google_map_link'"
                            :isRequired="true" :requiredMessage="__('website::dashboard.google_map_link_is_required')" :placeholder="__('website::dashboard.google_map_link')" :value="$website_information->address_google_map_link" />
                    </div>
                    <!-- End Google Map Link -->
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('website::dashboard.save') }}</button>
                        <a href="{{ URL::previous() }}"
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
    @include('website::information.scripts')
    <!--end::Custom JS-->
@endpush
