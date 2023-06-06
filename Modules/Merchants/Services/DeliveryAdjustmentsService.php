<?php

namespace Modules\Merchants\Services;

use Modules\Merchants\Entities\DeliveryAdjustments;
use Modules\Merchants\Http\Requests\DeliveryAdjustments\StoreDeliveryAdjustmentsRequest;
use Modules\Merchants\Http\Requests\DeliveryAdjustments\UpdateDeliveryAdjustmentsRequest;

class DeliveryAdjustmentsService
{
    /**
     * Take a request and return the array of data to create|update a city
     * @param StoreDeliveryAdjustmentsRequest $request
     * @return array
     */
    public function prepareAttributes(StoreDeliveryAdjustmentsRequest|UpdateDeliveryAdjustmentsRequest $request): array
    {
        return [
            'start_date'                  => $request->get('start_date'),
            'start_time'                  => $request->get('start_time'),
            'end_date'                    => $request->get('end_date'),
            'end_time'                    => $request->get('end_time'),
            'minimum_order_value'         => $request->get('minimum_order_value'),
            'maximum_order_value'         => $request->get('maximum_order_value'),
            'minimum_shipping_cost_value' => $request->get('minimum_shipping_cost_value'),
            'maximum_shipping_cost_value' => $request->get('maximum_shipping_cost_value'),
            'type'                        => $request->get('type'),
            'value_type'                  => $request->get('value_type'),
            'value'                       => $request->get('value'),
            'apply_on_cash_on_delivery'   => $request->has('apply_on_cash_on_delivery') ? 1 : 0,
            'apply_on_pay_from_wallet'    => $request->has('apply_on_pay_from_wallet') ? 1 : 0,
            'is_active'                   => $request->has('is_active') ? 1 : 0,
        ];
    }

    /**
     * Take a request and return the array of data to create|update a city
     * @param StoreDeliveryAdjustmentsRequest|UpdateDeliveryAdjustmentsRequest $request
     * @return array
     */
    public function prepareAttributesToDays(StoreDeliveryAdjustmentsRequest|UpdateDeliveryAdjustmentsRequest $request, DeliveryAdjustments $deliveryAdjustment): array
    {
        $delivery_adjustments_attrs = [];
        foreach ($request->get('day') as $day) {
            $delivery_adjustments_attrs[] = [
                'day_name'               => $day,
                'delivery_adjustment_id' => $deliveryAdjustment->id,
                'created_at'             => now(),
                'updated_at'             => now()
            ];
        }

        return $delivery_adjustments_attrs;
    }

    /**
     * create Delivery Adjustments Translations
     * @param StoreDeliveryAdjustmentsRequest $request
     * @return array
     */
    public function prepareAttributesTranslations(StoreDeliveryAdjustmentsRequest $request, DeliveryAdjustments $deliveryAdjustments): array
    {
        $delivery_adjustments_translations = [];
        foreach ($request->get('translations') as $translations) {
            $delivery_adjustments_translations[] = [
                'delivery_adjustment_id' => $deliveryAdjustments->id,
                'language_id'            => $translations['language_id'],
                'description'            => $translations['description'],
                'name'                   => $translations['name'],
                'created_at'             => now(),
                'updated_at'             => now()
            ];
        }

        return $delivery_adjustments_translations;
    }

    /**
     * @param StoreDeliveryAdjustmentsRequest|UpdateDeliveryAdjustmentsRequest $request
     * @param DeliveryAdjustments $deliveryAdjustments
     * @return array
     */
    public function prepareAttributesApplying(StoreDeliveryAdjustmentsRequest|UpdateDeliveryAdjustmentsRequest $request, DeliveryAdjustments $deliveryAdjustments): array
    {
        if ($deliveryAdjustments->type == "cities") {
            return $this->prepareAttributesForApplyingCities($request, $deliveryAdjustments);
        }


        if ($deliveryAdjustments->type == "merchants") {
            return $this->prepareAttributesForApplyingMerchants($request, $deliveryAdjustments);
        }

        if ($deliveryAdjustments->type == "products") {
            return $this->prepareAttributesForApplyingProducts($request, $deliveryAdjustments);
        }

        return [];
    }

    /**
     * @param StoreDeliveryAdjustmentsRequest|UpdateDeliveryAdjustmentsRequest $request
     * @param DeliveryAdjustments $deliveryAdjustments
     * @return array
     */
    private function prepareAttributesForApplyingCities(StoreDeliveryAdjustmentsRequest|UpdateDeliveryAdjustmentsRequest $request, DeliveryAdjustments $deliveryAdjustments): array
    {
        $delivery_adjustments_attrs[] = [
            'delivery_adjustment_id' => $deliveryAdjustments->id,
            'from_city_id'           => $request->get('city_from'),
            'to_city_id'             => $request->get('city_to'),
            'created_at'             => now(),
            'updated_at'             => now()
        ];
        return $delivery_adjustments_attrs;
    }

    /**
     * @param StoreDeliveryAdjustmentsRequest|UpdateDeliveryAdjustmentsRequest $request
     * @param DeliveryAdjustments $deliveryAdjustments
     * @return array
     */
    private function prepareAttributesForApplyingMerchants(StoreDeliveryAdjustmentsRequest|UpdateDeliveryAdjustmentsRequest $request, DeliveryAdjustments $deliveryAdjustments): array
    {
        $delivery_adjustments_attrs = [];
        foreach ($request->get('merchant_ids') as $merchant) {
            $delivery_adjustments_attrs[] = [
                'delivery_adjustment_id' => $deliveryAdjustments->id,
                'merchants_id'           => $merchant,
                'created_at'             => now(),
                'updated_at'             => now()
            ];
        }

        return $delivery_adjustments_attrs;
    }

    /**
     * @param StoreDeliveryAdjustmentsRequest|UpdateDeliveryAdjustmentsRequest $request
     * @param DeliveryAdjustments $deliveryAdjustments
     * @return array
     */
    private function prepareAttributesForApplyingProducts(StoreDeliveryAdjustmentsRequest|UpdateDeliveryAdjustmentsRequest $request, DeliveryAdjustments $deliveryAdjustments): array
    {
        $delivery_adjustments_attrs = [];
        foreach ($request->get('products_ids') as $product) {
            $delivery_adjustments_attrs[] = [
                'delivery_adjustment_id' => $deliveryAdjustments->id,
                'product_id'             => $product,
                'created_at'             => now(),
                'updated_at'             => now()
            ];
        }

        return $delivery_adjustments_attrs;
    }
}
