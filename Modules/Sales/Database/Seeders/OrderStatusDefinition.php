<?php

namespace Modules\Sales\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Sales\Entities\OrderStatus;
use Modules\Sales\Entities\OrderStatusTranslation;

class OrderStatusDefinition extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Status On Project 'requested', 'approved', 'processing', 'in_delivery', 'delivered'
        $defaultOrderStatus = [
            [
                'id'           => 1,
                'color'        => '#D3D3D3',
                'is_active'    => 1,
                'translations' => [
                    ['language_id' => 1, 'name' => 'requested'],
                    ['language_id' => 2, 'name' => 'مطلوب'],
                ]
            ],
            [
                'id'           => 2,
                'color'        => '#00FF00',
                'is_active'    => 1,
                'translations' => [
                    ['language_id' => 1, 'name' => 'approved'],
                    ['language_id' => 2, 'name' => 'موافقة'],
                ]
            ],
            [
                'id'           => 3,
                'color'        => '#FFA500',
                'is_active'    => 1,
                'translations' => [
                    ['language_id' => 1, 'name' => 'processing'],
                    ['language_id' => 2, 'name' => 'جاري التجهيز'],
                ]
            ],
            [
                'id'           => 4,
                'color'        => '#4169E1',
                'is_active'    => 1,
                'translations' => [
                    ['language_id' => 1, 'name' => 'in_delivery'],
                    ['language_id' => 2, 'name' => 'في الطريق'],
                ]
            ],
            [
                'id'           => 5,
                'color'        => '#006400',
                'is_active'    => 1,
                'translations' => [
                    ['language_id' => 1, 'name' => 'delivered'],
                    ['language_id' => 2, 'name' => 'تم التوصصيل'],
                ]
            ]
        ];
        foreach ($defaultOrderStatus as $orderStatusItem) {
            $translation = $orderStatusItem['translations'];
            unset($orderStatusItem['translations']);
            $orderStatusItem['display_order']=$orderStatusItem['id'];
            $orderStatusItem['created_by'] = 1;
            $orderStatusItem['updated_by'] = 1;
            $orderStatus                   = OrderStatus::create($orderStatusItem);
            $translation                   = collect($translation)->map(function ($item) use ($orderStatus) {
                $item['order_status_id'] = $orderStatus->id;
                $item['created_at']      = now();
                $item['updated_at']      = now();
                return $item;
            });
            OrderStatusTranslation::insert($translation->toArray());
        }
    }
}
