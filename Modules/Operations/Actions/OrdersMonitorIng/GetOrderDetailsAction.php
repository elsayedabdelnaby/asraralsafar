<?php

namespace Modules\Operations\Actions\OrdersMonitorIng;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Operations\Http\Requests\OrdersMonitoring\CheckOrderValidationRequest;

class GetOrderDetailsAction
{
    public function handle(CheckOrderValidationRequest|Request $request)
    {
        $orderDetails               = (new FilterOrdersMonitoringAction())->handle($request)->select([
            'orders.id',
            'orders.total',
            'orders.payment_method',
            'orders.order_status_id',
            'order_status_translations.name as order_status',
            'order_status.color as order_status_color',
            'merchant_branches_translations.name as branch_name',
            'merchant_translations.name as merchant_name',
            'customer.name as customer_name',
            'delivery.name as delivery_name',
            'orders.created_at',
            'merchant_branches.id as merchant_branch_id',
            'merchant_branches.manager_id as merchant_branch_manager_id',
            'merchant_branches.merchant_id as merchant_id',
            'merchants.owner_id as merchant_manager_id',
            'orders.customer_id',
            'orders.delivery_id'
        ])->first()->toArray();
        $orderDetails['created_at'] = Carbon::createFromTimeStamp(strtotime($orderDetails['created_at']))->diffForHumans();

        $orderDetails['order_products'] = (new GetAllOrderProductsAction())->handle($request)->select([
            'product_translations.name',
            'order_products.price',
            'order_products.quantity',
        ])->get();

        return $orderDetails;
    }
}
