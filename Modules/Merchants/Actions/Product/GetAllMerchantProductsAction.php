<?php

namespace Modules\Merchants\Actions\Product;

use Modules\Merchants\Entities\Product;
use Modules\Merchants\Http\Requests\Product\GetAllMerchantProductsRequest;

class GetAllMerchantProductsAction
{
    public function handle(GetAllMerchantProductsRequest $request)
    {
        return Product::where('merchant_id',$request->get('merchant_id'))->with('translations')
            ->get()
            ->map(function ($query){
                return [
                    'id' => $query->id,
                    'name' => $query->translations()->where('language_id',1)->first()->name
                ];
            });
    }
}
