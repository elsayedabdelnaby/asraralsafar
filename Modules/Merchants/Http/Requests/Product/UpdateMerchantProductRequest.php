<?php

namespace Modules\Merchants\Http\Requests\Product;

use App\Rules\TranslationContainMainLanguage;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Merchants\Rules\CheckCategoryItemsIds;
use Modules\Merchants\Rules\PriceGreaterThanDiscountPrice;
use Modules\Merchants\Rules\UniqueProductName;

class UpdateMerchantProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'=>'required|exists:products,id,deleted_at,NULL',
            'merchant_id'=> 'required|exists:merchants,id,deleted_at,NULL',
            'category_type_id'=>'required|exists:categories,id,deleted_at,NULL',
            'category_id'=>['required','array',new CheckCategoryItemsIds()],
            'translations'=> ['required', 'array', new UniqueProductName(request('id')), new TranslationContainMainLanguage],
            'type'=> 'required|in:simple,variant',
            'price'=> ['nullable', 'numeric'],
            'discount_price' => ['nullable', 'numeric', new PriceGreaterThanDiscountPrice(request('price'))],
            'image'=> 'nullable|image'
        ];
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'id'          => request('id'),
            'merchant_id' => request()->merchant_id,
        ]);
    }
}
