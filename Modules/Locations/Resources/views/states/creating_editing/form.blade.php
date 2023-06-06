@extends('dashboard.layouts.app')

@if (isset($state))
    @section('title', __('locations::dashboard.states_management') . ' - ' . __('locations::dashboard.edit_state'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('locations::dashboard.edit_state'),
            'short_description' => __('locations::dashboard.enter_state_details_and_submit'),
        ]);
    @endsection
@else
    @section('title', __('locations::dashboard.states_management') . ' - ' . __('locations::dashboard.new_state'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('locations::dashboard.new_state'),
            'short_description' => __('locations::dashboard.enter_state_details_and_submit'),
        ]);
    @endsection
@endif
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    @if (isset($state))
                        {{ __('locations::dashboard.edit_state') }}
                    @else
                        {{ __('locations::dashboard.new_state') }}
                    @endif
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.locations.states.index', ['country_id' => $country_id]) }}"
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

                <div id="kt_category_type_translation_repeater">
                    <!-- Translations -->
                    <div class="form-group">
                        <div data-repeater-list="translations">
                            @forelse (old('translations', isset($state->translations) ? collect($state->translations)->toArray() : []) as $translation)
                                @include('locations::states.creating_editing.translations', $translation)
                            @empty
                                @include('locations::states.creating_editing.translations', [])
                            @endforelse
                        </div>
                    </div>
                    <!-- END Translations -->

                    <div class="form-group row">
                        <div class="offset-md-10 col-md-2">
                            <a href="javascript:;" data-repeater-create=""
                                class="btn btn-sm font-weight-bolder btn-light-primary">
                                <i class="la la-plus"></i>{{ __('settings::dashboard.add') }}
                            </a>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3">
                            <div class="row align-items-center">
                                <label
                                    class="col-md-4 col-form-label font-weight-bold">{{ __('locations::dashboard.is_active') }}
                                    : </label>
                                <div class="col-md-6">
                                    <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'"
                                        :name="'is_active'" :isChecked="old('is_active', $state->is_active ?? '')" />
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
                    <a href="{{ route('dashboard.locations.states.index', ['country_id' => $country_id]) }}"
                        class="btn font-weight-bold btn-secondary">
                        {{ __('locations::dashboard.cancel') }}
                    </a>
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
    @include('locations::countries.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
