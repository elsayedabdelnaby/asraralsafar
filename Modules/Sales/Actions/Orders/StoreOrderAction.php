<?php

namespace Modules\Sales\Actions\Orders;

use Illuminate\Support\Facades\DB;
use Modules\Merchants\Entities\Coupon;
use Modules\Merchants\Entities\Product;
use Modules\Sales\Entities\Order;
use Modules\Sales\Entities\OrderProduct;
use Modules\Sales\Http\Requests\Orders\StoreOrderRequest;
use Modules\Sales\Services\OrderService;

class StoreOrderAction
{
    /**
     * @throws \Exception
     */
    public function handle(StoreOrderRequest $request)
    {
        $orderAttributes = (new OrderService())->prepareAttributesToStore($request);

        $total = 0;
        $coupon = $orderAttributes['coupon_code'] ?? null;

        DB::beginTransaction();

        try {
            $order = Order::create([
                'merchant_branch_id' => $orderAttributes['merchant_branch_id'],
                'customer_id' => $orderAttributes['customer_id'],
                'address_id' => $orderAttributes['address_id'],
                'delivery_id' => $orderAttributes['delivery_id'],
                'payment_method' => $orderAttributes['payment_method'],
                'coupon_id' => null,
                'total' => $total,
                'order_status_id'=>$orderAttributes['order_status_id']
            ]);

            foreach ($request->products as $product) {

                $price = $this->getProductPrice($product['product_id']);
                $total += $price * $product['quantity'];

                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $product['product_id'],
                    'price' => $price,
                    'quantity' => $product['quantity']
                ]);
            }
        } catch (\Exception $e) {

            DB::rollback();
            throw $e;
        }

        if ($coupon) {
            $coupon = Coupon::where('code', $coupon)
                ->first();

            try {
                (new ValidateCouponOrderAction)->handle($coupon, $orderAttributes['customer_id'], $total, $orderAttributes['payment_method']);
                $order->update(['coupon_id' => $coupon->id]);
                $total = $this->applyCoupon($total, $coupon);

            } catch (\Exception $e) {

                DB::rollback();
                throw $e;
            }
        }

        $order->update(['total' => $total]);
        DB::commit();
    }

    /**
     * @param $total
     * @param $coupon
     * @return float|int|mixed
     */
    private function applyCoupon($total, $coupon): mixed
    {
        if (!$coupon)
            return $total;

        if ($coupon->value_type === 'percentage')
            $total -= (($coupon->value / 100) * $total);

        elseif ($coupon->value_type === 'fixed')
            $total -= $coupon->value;

        return $total;
    }

    /**
     * @param $product_id
     * @return float
     */
    private function getProductPrice($product_id): float
    {
        return Product::whereId($product_id)
            ->first()
            ->price;
    }
}
