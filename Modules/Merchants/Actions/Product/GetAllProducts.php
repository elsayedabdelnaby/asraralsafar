<?php

namespace Modules\Merchants\Actions\Product;

use Modules\Merchants\Entities\Product;

class GetAllProducts
{
    public function handle()
    {
        return Product::with('translations')
            ->get()
            ->map(function ($query){
                return [
                    'id' => $query->id,
                    'name' => $query->translations()->where('language_id',1)->first()->name
                ];
            });
    }
}
