<?php

namespace Modules\Sales\Actions\OrderStatus;

use Modules\Sales\Entities\OrderStatus;

/**
 * @purpose get all customers with a specific type and status
 */
class GetAllOrderStatusAction
{
    /**
     * @param array $conditions
     */
    public function handle()
    {
        return OrderStatus::currentLanguageTranslation("order_status", 'order_status_translations', 'order_status_id')->orderBy('display_order');
    }
}
