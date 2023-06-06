@extends('dashboard.layouts.app')

@if (isset($avatar))
    @section('title', __('usersmanagement::dashboard.users_management') . ' - ' .
        __('usersmanagement::dashboard.edit_avatar'))

    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('usersmanagement::dashboard.edit_avatar'),
            'short_description' => __('usersmanagement::dashboard.enter_avatar'),
            'breadcrumbs' => [],
        ]);
    @endsection
@else
    @section('title', __('usersmanagement::dashboard.users_management') . ' - ' .
        __('usersmanagement::dashboard.create_avatar'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('usersmanagement::dashboard.new_avatar'),
            'short_description' => __('usersmanagement::dashboard.enter_avatar'),
            'breadcrumbs' => [],
        ]);
    @endsection
@endif

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($avatar) ? __('usersmanagement::dashboard.edit_avatar') : __('usersmanagement::dashboard.new_avatar') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.users-management.avatars.index') }}"
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
                        class="col-1 col-form-label font-weight-bold">{{ __('usersmanagement::dashboard.is_active') }}</label>
                    <div class="col-1">
                        <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'" :name="'is_active'"
                            :isChecked="old('is_active', $avatar->is_active ?? '')" />
                    </div>
                    <div class="col-1"></div>
                    <label
                        class="col-xl-2 col-2 col-form-label text-center">{{ __('usersmanagement::dashboard.image') }}</label>
                    <div class="col-2 col-xl-2">
                        <div class="image-input image-input-empty image-input-outline"
                            style="background-image: url('{{ $avatar->image_url ?? global_asset('metronic/assets/media/users/blank.png') }}')"
                            id="image">
                            <div class="image-input-wrapper"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title=""
                                data-original-title="{{ __('usersmanagement::dashboard.change_image') }}">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg, .svg" />
                                <input type="hidden" name="image_remove" />
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
                        <a href="{{ route('dashboard.users-management.avatars.index') }}"
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
    @include('usersmanagement::avatars.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
