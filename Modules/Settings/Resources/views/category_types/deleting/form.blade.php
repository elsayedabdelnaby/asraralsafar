@extends('dashboard.layouts.modal')
@section('content')
    <div class="modal-header">
        <h5 class="modal-title" id="deleteCategoryTypeLabel">{{ __('settings::dashboard.delete_category_type') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form class="form parsley-form" action="{{ route('dashboard.settings.category-types.destroy', ['id' => $item->id]) }}"
        method="POST">
        <div class="modal-body">
            @method('DELETE')
            @csrf
            <input type="hidden" name="id" value="{{ $item->id }}" />
            <div class="form-group row">
                <label for="item" class="col-4 col-form-label">{{ __('dashboard.item_to_delete') }}:</label>
                <div class="col-6">
                    <input type="text" class="form-control" disabled value="{{ $item->type_name }}" />
                </div>
            </div>
            <div class="form-group row">
                <label for="recipient-name" class="col-4 col-form-label">{{ __('dashboard.replace_it_with') }}:</label>
                <div class="col-6">
                    <x-dashboard.form.inputs.select :id="'category-type'" :name="'replace_with'" :isRequired="true" :options="$other_items"
                        :requiredMessage="__('settings::dashboard.item_is_required')" :isMultiple="false" :defaultOptionName="__('settings::dashboard.select_category_type')" :selectedOption="old('replace_with')" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit"
                class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('settings::dashboard.save') }}</button>
            <button type="button" class="btn font-weight-bold btn-secondary close-modal"
                data-dismiss="modal">{{ __('settings::dashboard.cancel') }}</button>
        </div>
    </form>
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
@endpush
