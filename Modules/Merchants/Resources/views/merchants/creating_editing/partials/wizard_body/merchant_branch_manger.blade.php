<h2 class="mb-6 p-6 bg-secondary rounded">{{ __('merchants::dashboard.branch_manager') }}:</h2>

@if (isset($merchant_managers))
    <div class="row">
        <div class="col-md-4">
            <div class="row align-items-center">
                <label
                    class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.select_branch_manger') }}:</label>
                <div class="col-md-7">
                    <select class="form-control" id="select_branch_manger" name="select_branch_manger">
                        <option value="select_from_mangers">{{ __('merchants::dashboard.select_from_mangers') }}</option>
                        <option value="create_new_manager">{{ __('merchants::dashboard.create_new_manager') }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="row align-items-center select_from_mangers">
                <label
                    class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.select_from_mangers') }}
                    :</label>
                <div class="col-md-8">
                    <select class="form-control" name="merchant_branch_manger_id" id="merchant_branch_manger_id">
                        @foreach ($merchant_managers as $item)
                            <option @if (isset($merchant_branch) && $item->id == $merchant_branch->manager_id) selected @endif value="{{ $item->id }}">
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

    </div>
@endif

<!-- Start OF Branch Manager -->
<div class="create_new_manger row">
    <!-- Start branch_manager_name  -->
    <div class="col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.branch_manager_name') }}
                : </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.text :id="'branch_manager_name'" :class="'form-control'" :name="'branch_manager_name'" :isDecimal="true"
                    :isRequired="true" :requiredMessage="__('merchants::dashboard.branch_manger_name_must_be_inserted')" :emailValidationMessage="__('merchants::dashboard.branch_manger_name_must_be_inserted')" :placeholder="__('merchants::dashboard.branch_manager_name')" :value="old('branch_manager_name')" />
            </div>
        </div>
    </div>
    <!-- End Merchant branch_manager_name -->
    <!-- Start branch_manager_email -->
    <div class="offset-md-1 col-md-4">
        <div class="row align-items-center">
            <label
                class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.branch_manager_email') }}:
            </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.email :id="'branch_manager_email'" :class="'form-control'" :name="'branch_manager_email'"
                    :isRequired="true" :requiredMessage="__('merchants::dashboard.branch_manager_email_must_be_inserted')" :emailValidationMessage="__('merchants::dashboard.branch_manager_email_must_be_inserted')" :placeholder="__('merchants::dashboard.branch_manager_email')" :value="old('branch_manager_email')" />
            </div>
        </div>
    </div>
    <!-- End branch_manager -->

    <!-- Start branch_manager_phone_number  -->
    <div class="col-md-4 mt-3">
        <div class="row align-items-center">
            <label
                class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.branch_manager_phone_number') }}
                : </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.text :id="'branch_manager_phone_number'" :class="'form-control'" :name="'branch_manager_phone_number'"
                    :isDecimal="true" :isRequired="true" :requiredMessage="__('merchants::dashboard.branch_manger_phone_number_must_be_inserted')" :emailValidationMessage="__('merchants::dashboard.branch_manger_phone_number_must_be_inserted')" :placeholder="__('merchants::dashboard.branch_manager_phone_number')"
                    :value="old('branch_manager_phone_number')" />
            </div>
        </div>
    </div>
    <!-- End Merchant branch_manager_phone_number -->

    <!-- Start branch_manager_password -->
    <div class="offset-md-1 col-md-4 mt-3">
        <div class="row align-items-center">
            <label
                class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.branch_manager_password') }}
                : </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.text :id="'branch_manager_password'" :class="'form-control'" :name="'branch_manager_password'"
                    :isRequired="true" :requiredMessage="__('merchants::dashboard.branch_manager_password_is_required')" :placeholder="__('merchants::dashboard.branch_manager_password')" :value="old('branch_manager_password', '')" />
            </div>
        </div>
    </div>
    <!-- End branch_manager -->
</div>
<!-- End OF  Branch Manager -->
