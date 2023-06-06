<?php

namespace Modules\Merchants\Http\Requests\Product;

use App\Rules\TranslationContainMainLanguage;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Merchants\Rules\PriceGreaterThanDiscountPrice;
use Modules\Merchants\Rules\UniqueProductName;

class GetAllCategoriesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'merchant_id' => 'required|exists:merchants,id,deleted_at,NULL',
            'category_type_id'=>'required|exists:categories,id,deleted_at,NULL'
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
            'category_type_id'=> request('category_type_id'),
            'merchant_id' => request()->merchant_id,
        ]);
    }
}
