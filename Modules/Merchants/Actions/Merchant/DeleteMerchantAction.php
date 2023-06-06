<?php

namespace Modules\Merchants\Actions\Merchant;

use Modules\Merchants\Entities\Merchant;
use Modules\Merchants\Http\Requests\Merchants\DeleteMerchantRequest;

/**
 * @purpose delete a city
 */
class DeleteMerchantAction
{
    /**
     * @param DeleteMerchantRequest $request
     * @return Boolean
     */
    public function handle(DeleteMerchantRequest $request): bool
    {
        $merchant = Merchant::findOrFail($request->id);
        $merchant->translations()->delete();
        return $merchant->delete();
    }
}
