<div class="form-group row mt-15 merchants_section">
    <!-- Start merchants -->
    <div class="col-md-6">
        <div class="row align-items-center">
            <label class="col-md-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.merchants') }}:
            </label>
            <div class="col-md-10">
                <select class="form-control select2"  multiple="multiple" name="merchant_ids[]" id="merchant_ids" style="width:100%">
                    @foreach($merchants as $merchant)
                        <option value="{{$merchant->id}}">{{$merchant->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <!-- End merchants -->
</div>
