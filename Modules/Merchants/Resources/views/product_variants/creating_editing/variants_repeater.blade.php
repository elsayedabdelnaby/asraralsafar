<div data-repeater-item class="form-group  align-items-top">

    <div class="row mt-15 select_product_attribute">
        <div class="col-md-5">
            <div class="row">
                <input name="attribute_type_selected" class="attribute_type_selected" id="attribute_type_selected" type="hidden">
                <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.select_attribute') }}:</label>
                <div class="col-md-7">
                    <select required data-parsley-required-message="{{__('merchants::dashboard.select_attribute_is_required')}}" class="form-control product_attribute select2" name="product_attribute" id="product_attribute">
                        @foreach($productAttributes as $productAttribute)
                            <option @if(isset($variant) && $variant['product_attribute_id'] == $productAttribute->id) selected @endif data-type="{{$productAttribute->input_type}}" value="{{$productAttribute->id}}">{{$productAttribute->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-5 product_type_options">
            <div class="row">
                <label class="col-md-3 col-form-label font-weight-bold">{{__('merchants::dashboard.options')}}</label>
                <div class="col-md-7">
                    <select  name="product_attribute_option"
                             required data-parsley-required-message="{{__('merchants::dashboard.select_option_is_required')}}"
                             id="product_attribute_option"
                             @if(isset($variant) &&  $variant['id'])  data-id='{{$variant['id']}}' data-selected="{{$variant['product_attribute_option_id']}}" @endif
                             class="form-control product_attribute_option">
                          <option>{{__('merchants::dashboard.select_attribute')}}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-5 mt-15 product_type_value">
            <div class="row">
                <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.value') }}:</label>
                <div class="col-md-7">
                    <x-dashboard.form.inputs.text
                        :id="'value'"
                        :class="'form-control'"
                        :name="'value'"
                        :placeholder="__('merchants::dashboard.value')"
                        :value="$variant['value'] ?? ''"
                        :isRequired="true"
                        :requiredMessage="__('merchants::dashboard.value_is_required')"
                        :maxlength="255"
                        :maxlengthMessage="__('merchants::dashboard.number_of_characters_must_less_than_or_equal_255')"
                    />
                </div>
            </div>
        </div>

        <div class="col-md-2 mt-15">
            <a href="javascript:;" data-repeater-delete="" class="btn btn-sm  font-weight-bolder btn-light-danger">
                <i class="la la-trash-o"></i>{{ __('merchants::dashboard.delete') }}
            </a>
        </div>

    </div>

</div>
