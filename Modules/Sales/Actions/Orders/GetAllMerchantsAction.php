<?php

namespace Modules\Sales\Actions\Orders;

use Modules\Merchants\Entities\Merchant;

class GetAllMerchantsAction
{

    public function handle()
    {
        return Merchant::with('translations')
            ->get()
            ->map(function ($query) {
                return [
                    'id' => $query->id,
                    'name' => $query->translations->where('language_id',1)->first()->name
                ];
            });
    }
}
