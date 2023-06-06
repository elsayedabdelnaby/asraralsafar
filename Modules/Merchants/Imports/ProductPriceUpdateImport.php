<?php

namespace Modules\Merchants\Imports;

use Illuminate\Support\Collection;
use Modules\Merchants\Entities\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\Merchants\Entities\ProductVariant;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductPriceUpdateImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue, WithValidation
{
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {

            if (isset($row['product_id']))
                $this->updateVariant($row);
            else {
                $product = Product::whereId($row['id'])
                    ->first();
                $this->updateSimple($product, $row['price']);
            }
        }

    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function rules(): array
    {
        return [
            'id' => 'nullable|exists:products,id',
            '*.id' => 'nullable|exists:products,id',
            'product_id' => 'nullable|exists:product_variants,id',
            '*.product_id' => 'nullable|exists:product_variants,id',
            'price' => 'nullable|numeric',
            '*.price' => 'nullable|numeric',
        ];
    }

    private function updateSimple($product, $new_price): void
    {
        $product->update([
            'price' => $new_price
        ]);
    }

    private function updateVariant($row): void
    {
        ProductVariant::whereId($row['product_id'])
            ->update([
                'price' => $row['price']
            ]);
    }
}
