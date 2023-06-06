<h2 class="mb-6 p-6 bg-secondary rounded">{{ __('merchants::dashboard.merchant_owner') }}:</h2>

<div class="row">
    <!-- Start Merchant owner_name -->
    <div class="col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.owner_name') }}
                : </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.text :id="'owner_name'" :class="'form-control'" :name="'owner_name'" :isDecimal="true"
                    :isRequired="true" :requiredMessage="__('merchants::dashboard.owner_name_must_be_inserted')" :emailValidationMessage="__('merchants::dashboard.owner_name_must_be_inserted')" :placeholder="__('merchants::dashboard.owner_name')" :value="old('owner_name', $merchant->user->name ?? '')" />
            </div>
        </div>
    </div>
    <!-- End Merchant owner_name -->

    <!-- Start Merchant owner_phone_number -->
    <div class="offset-md-1 col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.owner_phone_number') }} :
            </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.text :id="'owner_phone_number'" :class="'form-control'" :name="'owner_phone_number'" :isDecimal="true"
                    :isRequired="true" :requiredMessage="__('merchants::dashboard.owner_phone_number_must_be_inserted')" :emailValidationMessage="__('merchants::dashboard.owner_phone_number_must_be_inserted')" :placeholder="__('merchants::dashboard.owner_phone_number')" :value="old('owner_phone_number', $merchant->user->phone_number ?? '')" />
            </div>
        </div>
    </div>
    <!-- End Merchant owner_phone_number -->
</div>

<div class="row">
    <!-- Start Merchant owner_Email -->
    <div class="col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.owner_email') }}
                : </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.email :id="'owner_email'" :class="'form-control'" :name="'owner_email'"
                    :isDecimal="true" :isRequired="true" :requiredMessage="__('merchants::dashboard.owner_Email_must_be_inserted')" :emailValidationMessage="__('merchants::dashboard.owner_Email_must_be_inserted')" :placeholder="__('merchants::dashboard.owner_email')"
                    :value="old('owner_email', $merchant->user->email ?? '')" />
            </div>
        </div>
    </div>
    <!-- End Merchant owner_Email -->

    <!-- Start Merchant password -->
    <div class="offset-md-1 col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.owner_password') }}
                : </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.text :id="'owner_password'" :class="'form-control'" :name="'owner_password'"
                    :isDecimal="true" :isRequired="true" :requiredMessage="__('merchants::dashboard.owner_password')" :placeholder="__('merchants::dashboard.owner_password')" :value="old('owner_password', '')" />
            </div>
        </div>
    </div>
    <!-- End Merchant password -->
</div>
