<?php

namespace Modules\Merchants\Http\Requests\Merchants;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;
use Modules\Merchants\Rules\CheckMerchantMeals;
use Modules\Merchants\Rules\CheckMerchantTypes;
use Modules\Merchants\Rules\UniqueMerchantName;
use Modules\Merchants\Rules\CheckMerchantCuisines;
use Modules\Merchants\Rules\CheckMerchantCategoryItems;
use Modules\UsersManagement\Http\Requests\Users\StoreMerchantOwnerRequest;
use Modules\Merchants\Http\Requests\MerchantBranch\StoreMerchantBranchRequest;
use Modules\UsersManagement\Http\Requests\Users\StoreMerchantBranchMangerRequest;


class StoreMerchantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $merchantRules  = [
            //Start Merchant General Info
            'merchant_translations'    => [
                'required',
                'array',
                new TranslationContainMainLanguage,
                new UniqueMerchantName()
            ],
            'order_minimum_amount'     => 'required|numeric',
            'minimum_delivery_charges' => 'required|numeric',
            'average_delivery_time'    => 'required|numeric',
            'maximum_distance'         => 'required|numeric',
            'hot_line'                 => 'required|numeric|unique:merchants,hot_line',
            'merchant_image'           => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'rush_time_additional_fees' => 'nullable|numeric',
            //End Merchant General Info


            //Start Merchant Category Info
            'merchant_types'           => ['required', 'array', new CheckMerchantTypes()],
            'merchant_category_items'  => ['required', 'array', new CheckMerchantCategoryItems()],
            'merchant_cuisines'        => ['required', 'array', new CheckMerchantCuisines()],
            'merchant_meals'           => ['required', 'array', new CheckMerchantMeals()],
            //End Merchant Category Info
        ];
        $merchantOwner  = (new StoreMerchantOwnerRequest())->rules();
        $merchantBranch = (new StoreMerchantBranchRequest())->rules();
        $branchManger   = (new StoreMerchantBranchMangerRequest())->rules();

        return array_merge($merchantRules, $merchantOwner, $merchantBranch, $branchManger);
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
}
