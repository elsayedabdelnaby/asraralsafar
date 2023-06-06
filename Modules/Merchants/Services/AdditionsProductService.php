<?php

namespace Modules\Merchants\Services;

use Modules\Merchants\Http\Requests\AdditionsProducts\StoreMerchantAdditionsProductRequest;
use Modules\Merchants\Http\Requests\AdditionsProducts\UpdateMerchantAdditionProductRequest;


class AdditionsProductService
{
    /**
     * Take a request and return the array of data to create|update a city
     * @param StoreMerchantAdditionsProductRequest $request
     * @return array
     */
    public function prepareAttributes(StoreMerchantAdditionsProductRequest|UpdateMerchantAdditionProductRequest $request): array
    {
        return [
            'merchant_id'      => $request->get('merchant_id'),
            'price'            => $request->get('price'),
            'category_type_id' => 1,
            'discount_price'   => $request->get('discount_price'),
            'is_active'        => $request->has('is_active') ? 1 : 0,
        ];
    }

     /**
     * Take a request and return the array of data to create|update a city
     * @param StoreMerchantAdditionsProductRequest $request
     * @return array
     */
    public function prepareTranslationsAttributes(StoreMerchantAdditionsProductRequest $request,$additions_product_id):array
    {
        $additions_product_translations =[];
        foreach ($request->get('translations') as $translations){
            $additions_product_translations[]=[
                'addition_product_id'=>$additions_product_id,
                'language_id'=>$translations['language_id'],
                'name'=>$translations['name'],
                'created_at'=>now(),
                'updated_at'=>now()
            ];
        }

        return $additions_product_translations;
    }
}
