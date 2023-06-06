<?php

namespace Modules\Merchants\Actions\AdditionsProduct;

use Modules\Merchants\Entities\AdditionProduct;
use Modules\Merchants\Http\Requests\AdditionsProducts\DeleteAdditionProductRequest;

class DeleteAdditionProductAction
{
    public function handle(DeleteAdditionProductRequest $request)
    {
         $addition_product = AdditionProduct::findOrFail($request->get('id'));

         $addition_product->translations()->delete();
         $addition_product->delete();
    }
}
