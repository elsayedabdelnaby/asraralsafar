<?php

namespace Modules\Sales\Actions\OrderStatus;

use App\Services\DeleteFile;
use Modules\Sales\Entities\OrderStatus;
use Modules\Sales\Http\Requests\OrderStatus\DeleteOrderStatusRequest;

/**
 * @purpose delete a customer
 */
class DeleteOrderStatusAction
{
    /**
     * @param DeleteOrderStatusRequest $request
     * @return Boolean
     */
    public function handle(DeleteOrderStatusRequest $request): bool
    {
        $orderStatus = OrderStatus::findOrFail($request->id);
        $orderStatus->translations()->delete();
        return $orderStatus->delete();
    }
}
