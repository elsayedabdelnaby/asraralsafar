<?php

namespace Modules\Sales\Actions\Orders;

use App\Console\Commands\RedisSubscribe;
use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Merchants\Entities\Coupon;
use Modules\Merchants\Entities\Product;
use Modules\Sales\Entities\Order;
use Modules\Sales\Entities\OrderProduct;
use Modules\Sales\Http\Requests\Orders\UpdateOrderRequest;
use Modules\Sales\Services\OrderService;
use Throwable;

class UpdateOrderAction
{
    /**
     * @throws Exception|Throwable
     */
    public function handle(UpdateOrderRequest $request)
    {
        $orderAttributes = (new OrderService())->prepareAttributesToUpdate($request);

        $total = 0;
        $coupon = $orderAttributes['coupon_code'] ?? null;

        DB::beginTransaction();

        try {

            $order = Order::whereId($orderAttributes['id'])->first();

            throw_if(!in_array($order->order_status_id, [1,2]), new Exception('Order Can not be deleted once it is approved'));

            $order->update([
                'delivery_id' => $orderAttributes['delivery_id'],
                'address_id' => $orderAttributes['address_id'],
                'payment_method' => $orderAttributes['payment_method'],
                'order_status_id' => $orderAttributes['order_status_id'],
            ]);

            OrderProduct::where('order_id', $orderAttributes['id'])->delete();

            foreach ($request->products as $product) {

                $price = $this->getProductPrice($product['product_id']);
                $total += $price * $product['quantity'];

                OrderProduct::create([
                    'order_id' => $orderAttributes['id'],
                    'product_id' => $product['product_id'],
                    'price' => $price,
                    'quantity' => $product['quantity']
                ]);
            }

            //Now Publish Socket Notification To Order Monitoring
            (new RedisSubscribe())->publisherOrderChangeStatus($order->id);


        } catch (Exception $e) {

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

            } catch (Exception $e) {

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
