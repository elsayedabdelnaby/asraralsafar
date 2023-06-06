<?php

namespace Modules\Sales\Actions\Orders;

use Illuminate\Support\Collection;
use Modules\Sales\Entities\Order;

class GetAllOrdersAction
{
    /**
     * @return Collection
     */
    public function handle(): Collection
    {
        return Order::MerchantBranchesIds()->with(['merchantBranch', 'merchantBranch.merchant.translations', 'customer', 'address', 'delivery', 'coupon','orderStatus'])
            ->get()
            ->map(function ($query) {
                return [
                    'id' => $query->id,
                    'merchant' => $query->merchantBranch()->first()->merchant->translations->first()->name,
                    'branch' => $query->merchantBranch->translations->first()->name,
                    'customer' => $query->customer->name,
                    'delivery' => $query->delivery->name ?? '-',
                    'total' => $query->total,
                    'status' => $query->orderStatus->translations()->first()->name,
                    'coupon' => $query->coupon->code ?? '-',
                    'actions' => null,
                ];
            });
    }
}
