<?php

namespace Modules\Merchants\Actions\Product;

use Modules\Merchants\Entities\Product;
use Modules\Merchants\Http\Requests\Product\AcceptAdditionsProductRequest;

class AcceptAdditionsToggleProductAction
{
    public function handle(AcceptAdditionsProductRequest $request)
    {
        $product= Product::find($request->get("id"));
        $product->accept_additions = !$product->accept_additions;
        return $product->save();
    }
}
