<?php

namespace Modules\Sales\Actions\Orders;

use Exception;
use Modules\Merchants\Entities\Coupon;
use Modules\Sales\Entities\Order;

class ValidateCouponOrderAction
{
    /**
     * @param $coupon
     * @param $user
     * @param $total
     * @param $payment_method
     * @return void
     * @throws Exception
     */
    public function handle($coupon, $user, $total, $payment_method): void
    {
        $orders_count = Order::where('coupon_id', $coupon->id)
            ->where('customer_id', $user)
            ->count();

        $this->validateCouponIsOneTimeUsage($coupon, $orders_count);

        $this->validateCouponIsUserFirstOrder($coupon, $orders_count);

        $this->validateCouponHasLimitedUsage($coupon, $orders_count);

        $this->validateCouponHasMaxUsage($coupon, $orders_count);

        $this->validateCouponHasMinOrderValue($coupon, $total);

        $this->validateCouponHasMaxOrderValue($coupon, $total);

        $this->validateCouponHasSuitablePaymentMethod($coupon, $payment_method);

        $this->validateCouponIsActiveAndAvailable($coupon);

    }

    /**
     * @param Coupon $coupon
     * @param $coupon_usage
     * @return void
     * @throws Exception
     */
    private function validateCouponIsOneTimeUsage(Coupon $coupon, $coupon_usage): void
    {
        if ((int)$coupon->one_time === 0 && $coupon_usage === 1)
            throw new Exception(__('merchants::dashboard.coupon_is_used_before'));
    }

    /**
     * @param Coupon $coupon
     * @param $coupon_usage
     * @return void
     * @throws Exception
     */
    private function validateCouponIsUserFirstOrder(Coupon $coupon, $coupon_usage): void
    {
        if ((int)$coupon->first_order === 1 && $coupon_usage === 1)
            throw new Exception(__('merchants::dashboard.coupon_is_user_first_order'));
    }

    /**
     * @param Coupon $coupon
     * @param $coupon_usage
     * @return void
     * @throws Exception
     */
    private function validateCouponHasLimitedUsage(Coupon $coupon, $coupon_usage): void
    {
        if (isset($coupon->limited_usage) && ($coupon_usage >= $coupon->limited_usage))
            throw new Exception(__('merchants::dashboard.coupon_exceeded_limited_usage'));
    }

    /**
     * @param Coupon $coupon
     * @param $coupon_usage
     * @return void
     * @throws Exception
     */
    private function validateCouponHasMaxUsage(Coupon $coupon, $coupon_usage): void
    {
        if (isset($coupon->user_max_usage) && $coupon_usage >= $coupon->user_max_usage)
            throw new Exception(__('merchants::dashboard.coupon_max_usage_exceeded'));
    }

    /**
     * @param $coupon
     * @param $total
     * @return void
     * @throws Exception
     */
    private static function validateCouponHasMinOrderValue($coupon, $total): void
    {
        if (isset($coupon->min_order) && $total < $coupon->min_order)
            throw new Exception(__('merchants::dashboard.coupon_min_order_exceeded'));
    }

    /**
     * @param $coupon
     * @param $total
     * @return void
     * @throws Exception
     */
    private static function validateCouponHasMaxOrderValue($coupon, $total): void
    {
        if (isset($coupon->max_order) && $total > $coupon->max_order)
            throw new Exception(__('merchants::dashboard.coupon_max_order_exceeded'));
    }

    /**
     * @param $coupon
     * @param $payment_method
     * @return void
     * @throws Exception
     */
    private static function validateCouponHasSuitablePaymentMethod($coupon, $payment_method): void
    {
        if ($coupon->apply_on_card === 1 && $payment_method === 'wallet') {
            return;
        }

        if ($coupon->apply_on_cash === 1 && $payment_method === 'cash_on_delivery') {
            return;
        }

        throw new Exception(__('merchants::dashboard.coupon_payment_method_is_wrong'));
    }

    /**
     * @param $coupon
     * @return void
     * @throws Exception
     */
    private static function validateCouponIsActiveAndAvailable($coupon): void
    {
        if ($coupon->is_active !== 1 && $coupon->status !== 'available')
            throw new Exception(__('merchants::dashboard.coupon_is_inactive_or_unavailable'));
    }
}
