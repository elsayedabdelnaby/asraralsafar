<?php

namespace Modules\Merchants\Imports;

use Modules\Merchants\Entities\ProductAttribute;
use Modules\Merchants\Entities\ProductAttributeOptionTranslation;
use Modules\Merchants\Entities\ProductAttributeTranslation;
use Modules\Merchants\Entities\ProductVariant;
use Modules\Merchants\Entities\ProductVariantAttribute;
use Throwable;
use Illuminate\Support\Collection;
use Modules\Merchants\Entities\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Modules\Settings\Entities\CategoryTranslation;
use Modules\Merchants\Entities\ProductTranslation;

class ProductImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue, WithValidation
{
    private int $merchant_id;

    /**
     * @param $merchant_id
     */
    public function __construct($merchant_id)
    {
        $this->merchant_id = $merchant_id;
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 500;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            '*.name' => 'nullable|string',
            'category' => 'nullable|string',
            '*.category' => 'nullable|string',
            'category_type' => 'nullable|string',
            '*.category_type' => 'nullable|string',
            'price' => 'nullable|numeric',
            '*.price' => 'nullable|numeric',
            'product_id' => 'nullable|exists:products,id',
            '*.product_id' => 'nullable|exists:products,id',
        ];
    }

    /**
     * @throws Throwable
     */
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            if (isset($row['product_id']))
                $this->importProductVariant($row);
            else
                $this->importProductBasic($row);
        }
    }

    /**
     * @param Collection $row
     * @return void
     * @throws Throwable
     */
    private function importProductBasic(Collection $row): void
    {
        $category_ids = $this->getCategoryIdsByNames($row['category']);

        $product = $this->createProductBasicDetails($row);

        $this->createProductTranslations($row, $product->id);

        $this->attachProductToCategories($product, $category_ids);
    }

    /**
     * @throws Throwable
     */
    private function importProductVariant(Collection $row): void
    {
        $variants = $this->getVariantAttributesData($row);

        $this->createProductVariant($variants, $row);
    }

    /**
     * @param $product
     * @return mixed
     * @throws Throwable
     */
    private function createProductBasicDetails($product): mixed
    {
        $category_type_id = $this->getCategoryTypeIdByName($product['category_type']);

        return Product::create([
            'type' => isset($product['price']) ? 'simple' : 'variant',
            'image' => 'default.jpg',
            'merchant_id' => $this->merchant_id,
            'category_type_id' => $category_type_id,
            'accept_additions' => $product['accept_additions'] ?? 0,
            'price' => $product['price'] ?? null,
            'is_active' => $product['is_active'] ?? 0,
        ]);
    }

    /**
     * @param $category_type
     * @return mixed
     * @throws Throwable
     */
    private function getCategoryTypeIdByName($category_type): mixed
    {
        $category_type = CategoryTranslation::where('name', 'LIKE', '%' . trim($category_type) . '%')
            ->first();

        throw_if(!isset($category_type), new \Exception('Category Type does not exist'));

        return $category_type->id;
    }

    /**
     * @param $category
     * @return array
     * @throws Throwable
     */
    private function getCategoryIdsByNames($category): array
    {
        $category_ids = [];
        foreach (explode(',', $category) as $category_name) {
            $category = CategoryTranslation::where('name', 'LIKE', '%' . trim($category_name) . '%')
                ->first();
            throw_if(!isset($category), new \Exception('Category does not exist'));

            $category_ids[] = $category->id;
        }

        return $category_ids;
    }

    /**
     * @param Collection $row
     * @param int $product_id
     * @return void
     */
    private function createProductTranslations(Collection $row, int $product_id): void
    {
        ProductTranslation::create([
            'product_id' => $product_id,
            'name' => $row['name'],
            'language_id' => 1,
            'slug' => $row['name'],
            'description' => $row['description'],
        ]);
    }

    /**
     * @param Product $product
     * @param array $category_ids
     * @return void
     */
    private function attachProductToCategories(Product $product, array $category_ids): void
    {
        $product->categories()->sync($category_ids);
    }

    /**
     * @param Collection $row
     * @return array
     * @throws Throwable
     */
    private function getVariantAttributesData(Collection $row): array
    {
        $variant_data = [];
        $range = (int)round(count($row->keys()) / 4);

        for ($i = 1; $i < $range; $i++) {
            $variant_data ['type'][] = $this->variantValidation($row['type_' . $i], 'type');
            $variant_data ['name'][] = $this->variantValidation($row['name_' . $i], 'name');
            $variant_data ['options'][] = $this->variantValidation($row['options_' . $i], 'option');
            $variant_data ['value'][] = $row['value_' . $i];
        }

        return $variant_data;
    }

    /**
     * @param mixed $variant
     * @param string $type
     * @return mixed
     * @throws Throwable
     */
    private function variantValidation(mixed $variant, string $type)
    {
        switch ($type) {
            case 'type':
                $type = ProductAttribute::where('input_type', 'LIKE', '%' . trim($variant) . '%')
                    ->first();
                throw_if(is_null($type), new \Exception('Attribute does not exist'));

                return $type->id;

            case 'name':
                $name = ProductAttributeTranslation::where('name', 'LIKE', '%' . trim($variant) . '%')
                    ->where('language_id', 1)
                    ->first();
                throw_if(is_null($name), new \Exception('Attribute name does not exist'));

                return $name->id;

            case 'option':
                $option = ProductAttributeOptionTranslation::where('name', 'LIKE', '%' . trim($variant) . '%')
                    ->where('language_id', 1)
                    ->first();
                throw_if(is_null($option), new \Exception('Variant option does not exist'));

                return $option->id;
        }
    }

    /**
     * @param array $variants
     * @param Collection $row
     * @return void
     */
    private function createProductVariant(array $variants, Collection $row): void
    {
        $product_variant = ProductVariant::create([
            'product_id' => $row['product_id'],
            'is_active' => isset($row['is_active']) ? $row['is_active'] : 1,
            'price' => $row['price']
        ]);

        for ($i = 0; $i < count($variants['type']); $i++) {
            ProductVariantAttribute::create([
                'product_variant_id' => $product_variant->id,
                'product_attribute_id' => $variants['type'][$i],
                'product_attribute_option_id' => $variants['options'][$i],
                'value' => $variants['value'][$i],
            ]);
        }
    }
}
