<?php

namespace Modules\Merchants\Actions\Product;

use Modules\Merchants\Entities\Product;
use Modules\Merchants\Http\Requests\Product\ToggleProductRequest;

class ToggleProductAction
{
    public function handle(ToggleProductRequest $request)
    {
        $product= Product::find($request->get("id"));
        $product->is_active = !$product->is_active;
        return $product->save();
    }
}
