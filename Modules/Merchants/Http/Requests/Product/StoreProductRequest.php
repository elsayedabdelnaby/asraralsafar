<?php

namespace Modules\Merchants\Http\Requests\Product;

use App\Rules\TranslationContainMainLanguage;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Merchants\Rules\CheckCategoryItemsIds;
use Modules\Merchants\Rules\PriceGreaterThanDiscountPrice;
use Modules\Merchants\Rules\UniqueProductName;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $storeProductRules= [
            'merchant_id' => 'required|exists:merchants,id,deleted_at,NULL',
            'category_type_id'=>'required|exists:categories,id,deleted_at,NULL',
            'category_id'=>['required','array',new CheckCategoryItemsIds()],
            'translations'=>['required','array',new UniqueProductName(),new TranslationContainMainLanguage],
            'type' => 'required|in:simple,variant',
            'image'=>'required|image'
        ];

        if (request('type') == 'simple'){
            $storeProductRules['price'] = ['required','numeric'];
            $storeProductRules['discount_price'] = ['nullable','numeric',new PriceGreaterThanDiscountPrice(request('price'))];
        }

        return $storeProductRules;
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
            'merchant_id' => request()->merchant_id,
        ]);
    }
}
