@extends('dashboard.layouts.app')

@section('title', __('usersmanagement::dashboard.users_management') . ' - ' .
    __('usersmanagement::dashboard.create_role'))

@section('subheader')
    @include('dashboard.layouts.partials.sub_header', [
        'module_name' => __('usersmanagement::dashboard.edit_role'),
        'short_description' => __('usersmanagement::dashboard.edit_the_role_details'),
        'breadcrumbs' => [],
    ]);
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">{{ __('usersmanagement::dashboard.edit_role') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.users-management.roles.index') }}"
                    class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}</a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" enctype="multipart/form-data" method="POST"
            action="{{ route('dashboard.users-management.roles.update', ['id' => $role->id]) . '?report_to=' . $report_to }}">
            @method('put')
            @csrf
            <div class="card-body">
                <div id="kt_profile_translation_name_repeater">
                    <div class="form-group row">
                        <div data-repeater-list="translations" class="col-lg-10">
                            @if (old('translations') !== null)
                                @foreach (old('translations') as $translation)
                                    <div data-repeater-item class="form-group row align-items-top">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <label
                                                    class="col-lg-4 col-form-label text-right">{{ __('usersmanagement::dashboard.langauge') }}:</label>
                                                <div class="col-lg-8">
                                                    <x-dashboard.form.inputs.language-select :selectedOption="$translation['language_id']" />
                                                    <span
                                                        class="form-text text-muted">{{ __('usersmanagement::dashboard.the_language_of_the_role_name') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <label
                                                    class="col-lg-4 col-form-label text-right">{{ __('usersmanagement::dashboard.name') }}:</label>
                                                <div class="col-lg-8">
                                                    <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                        :name="'name'" :placeholder="__('usersmanagement::dashboard.role_name')" :value="$translation['name']"
                                                        :isRequired="true" :requiredMessage="__('usersmanagement::dashboard.name_is_required')" :maxlength="100"
                                                        :maxlengthMessage="__(
                                                            'usersmanagement::dashboard.number_of_characters_must_less_than_or_equal_100',
                                                        )" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="javascript:;" data-repeater-delete=""
                                                class="btn btn-sm font-weight-bolder btn-light-danger">
                                                <i class="la la-trash-o"></i>{{ __('usersmanagement::dashboard.delete') }}
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @foreach ($role->translations as $translation)
                                    <div data-repeater-item class="form-group row align-items-top">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <label
                                                    class="col-lg-4 col-form-label text-right">{{ __('usersmanagement::dashboard.langauge') }}:</label>
                                                <div class="col-lg-8">
                                                    <x-dashboard.form.inputs.language-select :selectedOption="$translation->language_id" />
                                                    <span
                                                        class="form-text text-muted">{{ __('usersmanagement::dashboard.the_language_of_the_role_name') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <label
                                                    class="col-lg-4 col-form-label text-right">{{ __('usersmanagement::dashboard.name') }}:</label>
                                                <div class="col-lg-8">
                                                    <x-dashboard.form.inputs.text :id="''" :class="'form-control'"
                                                        :name="'name'" :placeholder="__('usersmanagement::dashboard.role_name')" :value="$translation->name"
                                                        :isRequired="true" :requiredMessage="__('usersmanagement::dashboard.name_is_required')" :maxlength="100"
                                                        :maxlengthMessage="__(
                                                            'usersmanagement::dashboard.number_of_characters_must_less_than_or_equal_100',
                                                        )" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="javascript:;" data-repeater-delete=""
                                                class="btn btn-sm font-weight-bolder btn-light-danger">
                                                <i class="la la-trash-o"></i>{{ __('usersmanagement::dashboard.delete') }}
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-9 col-form-label text-right"></label>
                        <div class="col-lg-2">
                            <a href="javascript:;" data-repeater-create=""
                                class="btn btn-sm font-weight-bolder btn-light-primary">
                                <i class="la la-plus"></i>{{ __('usersmanagement::dashboard.add') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="separator separator-dashed mb-2"></div>

                <div class="form-group row align-items-center px-7">
                    <label class="col-1 col-form-label font-weight-bold">{{ __('dashboard.is_active') }}</label>
                    <div class="col-1">
                        <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'" :name="'is_active'"
                            :isChecked="old('is_active', $role->is_active)" />
                    </div>
                    <div class="col-3"></div>
                    <label class="col-2 col-form-label font-weight-bold">{{ __('dashboard.profiles') }}</label>
                    <div class="col-3">
                        <x-dashboard.form.inputs.select :id="'profiles'" :name="'profiles[]'" :isRequired="true" :options="$profiles"
                            :requiredMessage="__('usersmanagement::dashboard.profiles_is_required')" :isMultiple="true" :defaultOptionName="__('usersmanagement::dashboard.select_profiles')" :selectedOption="old('profiles', $role_profiles)" />
                        <span
                            class="form-text text-muted">{{ __('usersmanagement::dashboard.select_profiles_of_the_role') }}</span>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('usersmanagement::dashboard.save') }}</button>
                        <a href="{{ route('dashboard.users-management.roles.index') }}"
                            class="btn font-weight-bold btn-secondary">{{ __('usersmanagement::dashboard.cancel') }}</a>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
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
