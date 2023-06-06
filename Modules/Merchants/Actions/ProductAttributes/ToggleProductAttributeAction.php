<?php

namespace Modules\Merchants\Actions\ProductAttributes;

use Modules\Merchants\Entities\ProductAttribute;
use Modules\Merchants\Http\Requests\ProductAttribtues\ToggleProductAttributeRequest;

/**
 * @purpose
 * toggle the product attribute
 */
class ToggleProductAttributeAction
{
    /**
     * toggle the status of the city
     * @param ToggleProductAttributeRequest $request
     * @return bool
     */
    public function handle(ToggleProductAttributeRequest $request): bool
    {
        $productAttribute = ProductAttribute::find($request->get("id"));
        $productAttribute->is_active = !$productAttribute->is_active;
        return $productAttribute->save();
    }
}
