<?php

namespace Modules\Merchants\Http\Requests\Merchants;

use App\Rules\TranslationContainMainLanguage;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Merchants\Rules\CheckMerchantCategoryItems;
use Modules\Merchants\Rules\CheckMerchantCuisines;
use Modules\Merchants\Rules\CheckMerchantMeals;
use Modules\Merchants\Rules\CheckMerchantTypes;
use Modules\Merchants\Rules\UniqueMerchantName;


class UpdateMerchantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'=> 'required|exists:merchants,id,deleted_at,NULL',
            //Start Merchant General Info
            'merchant_translations'    => [
                'required',
                'array',
                new TranslationContainMainLanguage,
                new UniqueMerchantName(request('id'))
            ],
            'order_minimum_amount'=> 'required|numeric',
            'minimum_delivery_charges' => 'required|numeric',
            'average_delivery_time'=> 'required|numeric',
            'maximum_distance'=> 'required|numeric',
            'hot_line'=> 'required|numeric|unique:merchants,hot_line,'.request('id'),
            'merchant_image'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            //End Merchant General Info


            //Start Merchant Category Info
            'merchant_types'           => ['required', 'array', new CheckMerchantTypes()],
            'merchant_category_items'  => ['required', 'array', new CheckMerchantCategoryItems()],
            'merchant_cuisines'        => ['required', 'array', new CheckMerchantCuisines()],
            'merchant_meals'           => ['required', 'array', new CheckMerchantMeals()],
            //End Merchant Category Info
        ];
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    public function prepareForValidation()
    {
        $this->merge([
            'id' => request('id'),
        ]);
    }
}
