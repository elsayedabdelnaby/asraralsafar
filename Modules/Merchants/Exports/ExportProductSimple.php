<?php

namespace Modules\Merchants\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Merchants\Entities\Product;

class ExportProductSimple implements FromCollection, WithHeadings
{
    private int $merchant_id;

    public function __construct(int $merchant_id)
    {
        $this->merchant_id = $merchant_id;
    }

    public function collection()
    {
        return Product::with(['translations', 'categoryType.translations', 'categories.translations'])
            ->where('merchant_id', $this->merchant_id)
            ->get()
            ->map(function ($q) {
                return [
                    'id' => $q->id,
                    'name' => $q->translations->first()->name,
                    'type' => $q->type,
                    'category_type' => $q->categoryType->translations->first()->name,
                    'categories' => implode(', ', current($q->categories->map(function ($t) {
                        return $t->translations->first()->name;
                    }))),
                    'description' => $q->translations->first()->description,
                    'accept_additions' => $q->accept_additions,
                    'price' => $q->price,
                    'is_active' => $q->is_active,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'type',
            'category_type',
            'category',
            'description',
            'accept_additions',
            'price',
            'is_active',
        ];
    }
}
