@extends('dashboard.layouts.app')

@section('title', __('operations::dashboard.booking_request_management') . ' - ' .
    __('operations::dashboard.edit_booking_request_message'))

@section('subheader')
    @include('dashboard.layouts.partials.sub_header', [
        'module_name' => __('operations::dashboard.edit_booking_request_message'),
        'short_description' => __('operations::dashboard.write_answer_and_save'),
        'breadcrumbs' => [],
    ]);
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ __('operations::dashboard.edit_message') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.operations.contact-us.index') }}"
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
                    <!-- customer Name -->
                    <div class="col-4">
                        <div class="row">
                            <label
                                class="col-4 col-form-label font-weight-bold">{{ __('operations::dashboard.name') }}</label>
                            <div class="col-8">
                                <x-dashboard.form.inputs.text :id="'name'" :class="'form-control'" :name="'name'"
                                    :placeholder="__('operations::dashboard.name')" :value="$booking_request->name" disabled />
                            </div>
                        </div>
                    </div>
                    <!-- End customer Name -->

                    <!-- Email -->
                    <div class="offset-md-1 col-4">
                        <div class="row">
                            <label
                                class="col-4 col-form-label font-weight-bold">{{ __('operations::dashboard.email') }}</label>
                            <div class="col-8">
                                <x-dashboard.form.inputs.text :id="'email'" :class="'form-control'" :name="'email'"
                                    :placeholder="__('operations::dashboard.email')" :value="$booking_request->email" disabled />
                            </div>
                        </div>
                    </div>
                    <!-- End Email -->
                </div>

                <!-- Phone Number -->
                <div class="form-group row">
                    <div class="col-4">
                        <div class="row">
                            <label for="phone_number"
                                class="col-4 col-form-label font-weight-bold">{{ __('operations::dashboard.phone_number') }}
                                :</label>
                            <div class="col-8">
                                <x-dashboard.form.inputs.text :id="'phone'" :class="'form-control'" :name="'phone'"
                                    :placeholder="__('operations::dashboard.phone')" :value="$booking_request->phone" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="col-4 offset-md-1">
                        <div class="row">
                            <label for="title"
                                class="col-4 col-form-label font-weight-bold">{{ __('operations::dashboard.title') }}
                                :</label>
                            <div class="col-8">
                                <x-dashboard.form.inputs.text :id="'service_name'" :class="'form-control'" :name="'service_name'"
                                    :placeholder="__('operations::dashboard.service_name')" :value="$booking_request->service->name" disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Phone Number -->
                <div class="row">
                    <div class="col-9">
                        <div class="row">
                            <label for="status"
                                class="col-2 col-form-label font-weight-bold">{{ __('operations::dashboard.status') }}
                                :</label>
                            <div class="col-8">
                                <x-dashboard.form.inputs.enum-select :id="'status'" :name="'status'"
                                    :isRequired="true" :options="$cases" :requiredMessage="__('operations::dashboard.status_is_required')" :defaultOptionName="__('operations::dashboard.select_status')"
                                    :selectedOption="old('status', $booking_request->status ?? '')" />
                                <span
                                    class="form-text text-muted">{{ __('operations::dashboard.select_the_status_of_request') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('operations::dashboard.save') }}</button>
                        <a href="{{ route('dashboard.operations.contact-us.index') }}"
                            class="btn font-weight-bold btn-secondary">{{ __('operations::dashboard.cancel') }}</a>
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
@endpush
