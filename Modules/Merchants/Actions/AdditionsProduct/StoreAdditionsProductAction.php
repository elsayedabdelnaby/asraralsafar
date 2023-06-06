<?php

namespace Modules\Merchants\Actions\AdditionsProduct;

use Modules\Merchants\Entities\AdditionProduct;
use Modules\Merchants\Entities\AdditionProductTranslation;
use Modules\Merchants\Http\Requests\AdditionsProducts\StoreMerchantAdditionsProductRequest;
use Modules\Merchants\Services\AdditionsProductService;

class StoreAdditionsProductAction
{
    public function handle(StoreMerchantAdditionsProductRequest $request): void
    {
        //Create Addition Product
        $additionProduct = AdditionProduct::create((new AdditionsProductService())->prepareAttributes($request));

        //create Addition Translations
        AdditionProductTranslation::insert((new AdditionsProductService())->prepareTranslationsAttributes($request,$additionProduct->id));
    }
}
