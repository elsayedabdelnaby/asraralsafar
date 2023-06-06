<div data-repeater-item>
    <input type="hidden" name="text-input" />
    <!-- innner repeater -->
    <div class="inner-repeater">
        <div data-repeater-list="attribute-option-translations">
            @forelse(isset($option) ?  $option->translations()->get()->toArray() : [] as $item)
                @include('merchants::product_attributes.creating_editing.option_translations',$item)
            @empty
                @include('merchants::product_attributes.creating_editing.option_translations',[])
            @endforelse
        </div>
        <div class="row">
            <div class="col-2 offset-md-9 text-center">
                <a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
                    <i class="la la-plus"></i>{{ __('merchants::dashboard.add_translation') }}
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="row align-items-center">
                <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.is_active') }}:</label>
                <div class="col-md-6">
                    <x-dashboard.form.inputs.success-switch
                        class="mx-2"
                        :id="'option_is_active'"
                        :name="'option_is_active'"
                        :isChecked="$option['is_active'] ?? 'on'"
                    />

                    <input name="attribute_option_id" id="attribute_option_id" type="hidden" value="{{$option['id'] ?? ''}}">

                </div>
            </div>
        </div>
        <div class="col-2 offset-md-9">
            <a href="javascript:;" data-repeater-delete="" class="btn btn-sm mt-12 font-weight-bolder btn-light-danger hide_all_options_default">
                <i class="la la-trash-o"></i>{{ __('merchants::dashboard.delete_option') }}
            </a>
        </div>
    </div>

    <div class="separator separator-solid my-5"></div>
</div>
