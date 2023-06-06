<?php

namespace Modules\Operations\Actions\OrdersMonitorIng;

use Illuminate\Http\Request;
use Modules\Operations\Http\Requests\OrdersMonitoring\CheckOrderValidationRequest;
use Modules\Sales\Entities\Order;

class FilterOrdersMonitoringAction
{
    public function handle(Request|CheckOrderValidationRequest $request)
    {
        $orders = Order::join('merchant_branches', 'merchant_branches.id', 'orders.merchant_branch_id')
            ->join('merchant_branches_translations', 'merchant_branches_translations.merchant_branch_id', 'orders.merchant_branch_id')
            ->join('merchant_translations', 'merchant_translations.merchant_id', 'merchant_branches.merchant_id')
            ->join('users as customer', 'customer.id', 'orders.customer_id')
            ->leftjoin('users as delivery', 'delivery.id', 'orders.delivery_id')
            ->join('order_status','order_status.id','orders.order_status_id')
            ->join('order_status_translations', 'order_status_translations.order_status_id', 'orders.order_status_id')
            ->join('merchants','merchants.id','merchant_branches.merchant_id')
            ->where('merchant_branches_translations.language_id', getCurrentLanguage()->id)
            ->where('order_status_translations.language_id', getCurrentLanguage()->id)
            ->where('merchant_translations.language_id', getCurrentLanguage()->id);

        if ($request->has('order_status')) {
            $orders = $orders->where('orders.order_status_id', $request->get('order_status'));
        }


        if ($request->has('id') || !is_null($request->get('id'))){
            $orders = $orders->where('orders.id',$request->get('id'));
        }

        return $orders;
    }
}
