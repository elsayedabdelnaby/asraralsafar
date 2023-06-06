@extends('dashboard.layouts.app')

@if (isset($user))
    @section('title', __('usersmanagement::dashboard.users_management') . ' - ' .
        __('usersmanagement::dashboard.edit_user'))

    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('usersmanagement::dashboard.edit_user'),
            'short_description' => __('usersmanagement::dashboard.enter_the_user_details'),
            'breadcrumbs' => [],
        ]);
    @endsection
@else
    @section('title', __('usersmanagement::dashboard.users_management') . ' - ' .
        __('usersmanagement::dashboard.create_user'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('usersmanagement::dashboard.new_user'),
            'short_description' => __('usersmanagement::dashboard.enter_user_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@endif

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">{{ isset($user)? __('usersmanagement::dashboard.edit_user') : __('usersmanagement::dashboard.new_user') }}
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
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-1 col-form-label font-weight-bold">{{ __('usersmanagement::dashboard.role') }}</label>
                    <div class="col-2">
                        <x-dashboard.form.inputs.select :id="'role_id'" :name="'role_id'" :isRequired="true" :options="$roles"
                            :isMultiple="false" :requiredMessage="__('usersmanagement::dashboard.role_is_required')" :defaultOptionName="__('usersmanagement::dashboard.select_role')" :selectedOption="old('role_id', $user->role_id ?? '')" />
                        <span
                            class="form-text text-muted">{{ __('usersmanagement::dashboard.select_the_role_of_the_user') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <!-- User Name -->
                    <label class="col-1 col-form-label font-weight-bold">{{ __('usersmanagement::dashboard.name') }}</label>
                    <div class="col-2">
                        <x-dashboard.form.inputs.text :id="'name'" :class="'form-control'" :name="'name'" :placeholder="__('usersmanagement::dashboard.name')"
                            :value="old('name', $user->name ?? '')" :isRequired="true" :requiredMessage="__('usersmanagement::dashboard.name_is_required')" :maxlength="255"
                            :maxlengthMessage="__(
                                'usersmanagement::dashboard.number_of_characters_must_less_than_or_equal_255',
                            )" />
                    </div>
                    <!-- End User Name -->
                    <div class="col-1"></div>
                    <!-- Email -->
                    <div class="col-4">
                        <div class="row">
                            <label
                                class="col-4 col-form-label font-weight-bold">{{ __('usersmanagement::dashboard.email') }}</label>
                            <div class="col-6">
                                <x-dashboard.form.inputs.email :id="'email'" :class="'form-control'" :name="'email'"
                                    :emailValidationMessage="__('usersmanagement::dashboard.email_must_be_in_email_format')" :isRequired="true" :requiredMessage="__('usersmanagement::dashboard.email_is_required')" :placeholder="__('usersmanagement::dashboard.email')"
                                    :value="old('email', $user->email ?? '')" />
                            </div>
                        </div>
                    </div>
                    <!-- End Email -->
                </div>
                @if ($method == 'POST')
                    <div class="form-group row">
                        <!-- Password -->
                        <label for="item"
                            class="col-1 col-form-label font-weight-bold">{{ __('usersmanagement::dashboard.password') }}:</label>
                        <div class="col-2">
                            <div class="input-group">
                                <input type="password" name="password" class="form-control password-input" value=""
                                    required id="password" />
                                <div class="input-group-append">
                                    <button class="btn btn-secondary show-hide-password-btn" type="button">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- End Password -->
                        <div class="col-1"></div>
                        <!-- Confirm Password -->
                        <div class="col-4">
                            <div class="row">
                                <label for="confirm-password"
                                    class="col-4 col-form-label font-weight-bold">{{ __('usersmanagement::dashboard.confirm_password') }}:</label>
                                <div class="col-6">
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" id="confirm_password"
                                            class="form-control password-input" value="" required
                                            data-parsley-equalto="#password"
                                            data-parsley-equalto-message="Password and Confirm Password should match" />
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary show-hide-password-btn" type="button">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Confirm Password -->
                    </div>
                @endif
                <div class="form-group row">
                    <label
                        class="col-xl-2 col-lg-2 col-form-label text-left">{{ __('usersmanagement::dashboard.image_profile') }}</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="image-input image-input-empty image-input-outline"
                            style="background-image: url('{{ $user->image_profile_url ?? global_asset('metronic/assets/media/users/blank.png') }}')"
                            id="image_profile">
                            <div class="image-input-wrapper"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title=""
                                data-original-title="{{ __('usersmanagement::dashboard.change_image') }}">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="image_profile" accept=".png, .jpg, .jpeg, .svg" />
                                <input type="hidden" name="image_profile_remove" />
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="cancel" data-toggle="tooltip"
                                title="{{ __('usersmanagement::dashboard.cancel_image') }}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="remove" data-toggle="tooltip"
                                title="{{ __('usersmanagement::dashboard.remove_image') }}">
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
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('usersmanagement::dashboard.save') }}</button>
                        <a href="{{ route('dashboard.users-management.users.index') }}"
                            class="btn font-weight-bold btn-secondary">{{ __('usersmanagement::dashboard.cancel') }}</a>
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
    @include('usersmanagement::users.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
