@extends('dashboard.layouts.app')

@section('title', __('usersmanagement::dashboard.users_management') . ' - ' .
    __('usersmanagement::dashboard.view_profile'))

@section('head-css')

@endsection

@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ __('usersmanagement::dashboard.profile_details') }}
                </h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <span class="text-dark-50 font-weight-bold"
                        id="kt_subheader_total">{{ $profile->name . ' ' . __('usersmanagement::dashboard.details') }}</span>
                </div>
                <!--end::Search Form-->
            </div>
            <!--end::Details-->
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">{{ $profile->name }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.users-management.profiles.index') }}"
                    class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}</a>
            </div>
        </div>
        <div class="card-body">
            <div id="kt_profile_translation_name_repeater">
                <div class="form-group row">
                    <div data-repeater-list="translations" class="col-lg-10">
                        @foreach ($profile->translations as $translation)
                            <div data-repeater-item class="form-group row align-items-center">
                                <div class="col-md-4">
                                    <div class="row">
                                        <label
                                            class="col-lg-4 col-form-label text-right">{{ __('usersmanagement::dashboard.langauge') }}:</label>
                                        <div class="col-lg-8">
                                            <span>{{ $translation->language->name }}</span>
                                            <span
                                                class="form-text text-muted">{{ __('usersmanagement::dashboard.the_language_of_the_profile_name') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row align-items-center">
                                        <label
                                            class="col-lg-4 col-form-label text-right">{{ __('usersmanagement::dashboard.name') }}:</label>
                                        <div class="col-lg-8">
                                            {{ $translation->name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group row align-items-center px-7">
                <label class="col-1 col-form-label font-weight-bold">{{ __('dashboard.is_active') }}</label>
                <div class="col-1">
                    <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'" :name="'is_active'" :isChecked="$profile->is_active"
                        :isDisabled="true" />
                </div>
            </div>
            <div class="separator separator-dashed mb-2"></div>
            @foreach ($modules as $module)
                <div class="form-group row">
                    <label
                        class="col-3 col-form-label font-size-h4">{{ __('usersmanagement::permissions.' . $module->name) }}</label>
                    @foreach ($module->models as $model)
                        <div class="row px-9">
                            <label
                                class="col-2 col-form-label">{{ __('usersmanagement::permissions.' . $model->name) }}</label>
                            <div class="col-10 col-form-label">
                                <div class="row">
                                    @foreach (getSystemPermissions()->where('model_id', $model->id) as $permission)
                                        <div class="col-2">
                                            <label
                                                class="mx-2">{{ __('usersmanagement::permissions.' . $permission->name) }}</label>
                                        </div>
                                        <div class="col-2">
                                            <x-dashboard.form.inputs.success-switch class="mx-2" :id="$permission->name"
                                                :name="'permissions[' . $permission->id . ']'" :isChecked="in_array($permission->id, $profile_permissions)" :isDisabled="true" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="separator separator-dashed mb-2"></div>
            @endforeach
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-10"></div>
                <div class="col-2">
                    <a href="{{ route('dashboard.users-management.profiles.index') }}"
                        class="btn font-weight-bold btn-secondary">{{ __('usersmanagement::dashboard.back') }}</a>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('javascript')
    <!-- Select Js -->
    <script src="{{ global_asset('metronic/assets/js/pages/crud/forms/widgets/select2.js') }}" type="text/javascript"></script>
    <!--end::Select Js -->
    <!-- Form Parsley Validation -->
    <script src="{{ global_asset('metronic/assets/plugins/parsley/parsley.min.js') }}"></script>
    <!--end::Form Parsley Validation-->
    <!-- Form JS -->
    <script src="{{ global_asset('js/form.js') }}"></script>
    <!--end::Form JS-->
    @include('usersmanagement::profiles.creating.scripts');
@endpush
