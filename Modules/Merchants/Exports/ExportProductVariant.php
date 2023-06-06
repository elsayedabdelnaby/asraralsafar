<?php

namespace Modules\Merchants\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Merchants\Entities\ProductVariant;

class ExportProductVariant implements FromCollection, WithHeadings
{
    private int $merchant_id;
    private Collection $variants;
    private int $attribute_length;

    public function __construct(int $merchant_id)
    {
        $this->merchant_id = $merchant_id;

        $this->variants = ProductVariant::with(['product', 'attributes', 'attributes.productAttribute', 'attributes.productAttribute.translations', 'attributes.productAttributeOption', 'attributes.productAttributeOption.translations'])
            ->whereHas(
                'product', function ($query) {
                $query->where('merchant_id', $this->merchant_id);
            })
            ->get()
            ->map(function ($q) {
                return [
                    'product_id' => $q->product->id,
                    'variant_id' => $q->id,
                    'price' => $q->price,
                    'is_active' => $q->is_active,
                    'attributes' => $q->attributes->map(function ($v) {
                        return [
                            'type' => $v->productAttribute->input_type,
                            'name' => $v->productAttribute->translations->first()->name,
                            'options' => $v->productAttributeOption->translations->first()->name,
                            'value' => $v->value,
                        ];
                    }),
                ];
            });

        $attributes = $this->variants->pluck('attributes')->toArray();
        $this->attribute_length = count(max($attributes));
    }

    public function headings(): array
    {
        $headings = ['product_id', 'variant_id', 'price', 'is_active'];

        for ($i = 1; $i <= $this->attribute_length; $i++) {
            $headings [] = 'type_' . $i;
            $headings [] = 'name_' . $i;
            $headings [] = 'options_' . $i;
            $headings [] = 'value_' . $i;
        }
        return $headings;
    }

    public function collection(): Collection
    {
        $variants = $this->variants->toArray();
        $this->flatten($variants);

        return collect($variants);
    }

    private function flatten(&$variants): void
    {
        foreach ($variants as $k => $variant) {
            for ($i = 0; $i <= $this->attribute_length; $i++) {
                if (isset($variant['attributes'][$i])) {
                    $variants[$k]['type_' . $i + 1] = $variant['attributes'][$i]['type'];
                    $variants[$k]['name_' . $i + 1] = $variant['attributes'][$i]['name'];
                    $variants[$k]['options_' . $i + 1] = $variant['attributes'][$i]['options'];
                    $variants[$k]['value_' . $i + 1] = $variant['attributes'][$i]['value'] ?? null;
                }
            }
            unset($variants[$k]['attributes']);
        }
    }
}
