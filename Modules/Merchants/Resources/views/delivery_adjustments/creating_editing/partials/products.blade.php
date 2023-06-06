<div class="mt-10  row products_section">
    <!-- Start merchants -->
    <div class="col-md-3">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.merchants') }}:
            </label>
            <div class="col-md-8">
                <select class="form-control select2" name="merchant_id" id="merchant_id">
                    <option value="all" selected> {{__('merchants::dashboard.select_merchants')}}</option>
                    @foreach($merchants as $merchant)
                        <option value="{{$merchant->id}}">{{$merchant->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <!-- End merchants -->

    <!-- Start merchants -->
    <div class="col-md-4">
        <div class="row align-items-center">
            <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.products') }}:</label>
            <div class="col-md-9">
                <select class="form-control select2" name="products_ids[]" multiple="multiple" id="products_ids" style="width: 100%"></select>
            </div>
        </div>
    </div>
    <!-- End merchants -->

</div>
