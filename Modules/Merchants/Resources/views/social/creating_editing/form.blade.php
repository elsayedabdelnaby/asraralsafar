@extends('dashboard.layouts.app')

@if (isset($merchant_social))
    @section('title', __('merchants::dashboard.social_management') . ' - ' . __('merchants::dashboard.edit_social'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.edit_social'),
            'short_description' => __('merchants::dashboard.enter_social_details_and_submit'),
        ]);
    @endsection
@else
    @section('title', __('merchants::dashboard.social_management') . ' - ' . __('merchants::dashboard.new_social'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.new_social'),
            'short_description' => __('merchants::dashboard.enter_social_details_and_submit'),
        ]);
    @endsection
@endif
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($merchant_social) ?  __('merchants::dashboard.edit_social') :  __('merchants::dashboard.new_social')  }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.merchants.social.index', ['merchant_id' => $merchant->id]) }}"
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

                <div class="row">
                    <div class="col-md-6 form-group">
                        <div class="row">
                            <label class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.url') }}</label>
                            <div class="col-6">
                                <x-dashboard.form.inputs.url
                                    :id="'url'"
                                    :class="'form-control'"
                                    :name="'url'"
                                    :isRequired="true"
                                    :requiredMessage="__('merchants::dashboard.url_is_required')"
                                    :placeholder="__('website::dashboard.url')"
                                    :value="old('url', $merchant_social->url ?? '')"
                                    :urlValidationMessage="__('website::dashboard.url_must_be_in_url_format')"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 form-group">
                        <div class="row">
                            <label class="col-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.display') }}</label>
                            <div class="col-7">
                                <x-dashboard.form.inputs.text
                                    :id="'display'"
                                    :class="'form-control'"
                                    :name="'display'"
                                    :isRequired="true"
                                    :requiredMessage="__('merchants::dashboard.display_is_required')"
                                    :placeholder="__('merchants::dashboard.display')"
                                    :value="old('display', $merchant_social->display ?? '')"
                                    :urlValidationMessage="__('website::dashboard.display_is_required')"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <!-- End Main Logo -->
                    <label class="col-lg-2 col-form-label text-left">{{ __('settings::dashboard.image') }}</label>
                    <div class="col-lg-2">
                        <div class="image-input image-input-empty image-input-outline"
                             style="background-image: url('{{ $merchant_social->icon_url ?? global_asset('metronic/assets/media/users/blank.png') }}')"
                             id="image">
                            <div class="image-input-wrapper"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                   data-action="change" data-toggle="tooltip" title=""
                                   data-original-title="{{ __('settings::dashboard.change_image') }}">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg, .svg"/>
                                <input type="hidden" name="image_remove"/>
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                  data-action="cancel" data-toggle="tooltip"
                                  title="{{ __('settings::dashboard.cancel_image') }}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                  data-action="remove" data-toggle="tooltip"
                                  title="{{ __('settings::dashboard.remove_image') }}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <div class="row">
                            <label
                                class="col-md-2 col-form-label font-weight-bold">{{ __('locations::dashboard.is_active') }}
                                : </label>
                            <div class="col-md-6">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'"
                                                                        :name="'is_active'" :isChecked="old('is_active', $city->is_active ?? '')" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <div class="card-footer">
        <div class="float-right mb-3">
            <button type="submit" class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">
                {{ __('locations::dashboard.save') }}
            </button>
            <a href="{{ route('dashboard.merchants.social.index', ['merchant_id' => $merchant->id])}}"
               class="btn font-weight-bold btn-secondary">
                {{ __('locations::dashboard.cancel') }}
            </a>
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
    @include('merchants::social.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
