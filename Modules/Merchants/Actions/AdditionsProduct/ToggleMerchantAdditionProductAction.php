<?php

namespace Modules\Merchants\Actions\AdditionsProduct;

use Modules\Merchants\Entities\AdditionProduct;
use Modules\Merchants\Http\Requests\AdditionsProducts\ToggleMerchanAdditionProductRequest;

class ToggleMerchantAdditionProductAction
{
    public function handle(ToggleMerchanAdditionProductRequest $request)
    {
        $additionProduct= AdditionProduct::find($request->get("id"));
        $additionProduct->is_active = !$additionProduct->is_active;
        return $additionProduct->save();
    }
}
