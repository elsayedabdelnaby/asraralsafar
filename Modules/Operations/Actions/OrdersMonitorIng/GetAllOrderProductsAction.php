<?php

namespace Modules\Operations\Actions\OrdersMonitorIng;

use Illuminate\Http\Request;
use Modules\Operations\Http\Requests\OrdersMonitoring\CheckOrderValidationRequest;
use Modules\Sales\Entities\OrderProduct;

class GetAllOrderProductsAction
{
    public function handle(CheckOrderValidationRequest|Request $request)
    {
        return OrderProduct::join('product_translations', 'product_translations.product_id', 'order_products.product_id')
            ->where('order_products.order_id', $request->get('id'))
            ->where('product_translations.language_id', getCurrentLanguage()->id);
    }
}
