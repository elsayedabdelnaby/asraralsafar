<?php

namespace Modules\Merchants\GraphQL\Queries;

use Modules\Merchants\Entities\Merchant;

/**
 * search in merchants
 */
final class MerchantsResolver
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $merchants = Merchant::where([
            ['request_status', 'approved'],
            ['working_status', 1]
        ])->active();


        //fitler merchants dependent on working category ids
        if (isset($args['working_category_ids'])) {
            $category_ids = $args['working_category_ids'];
            $merchants->whereHas('workingAs', function ($q) use ($category_ids) {
                $q->whereIn('category_id', $category_ids);
            });
        }

        //fitler merchants dependent on product category ids
        if (isset($args['product_category_ids'])) {
            $category_ids = $args['product_category_ids'];
            $merchants->whereHas('productCategories', function ($q) use ($category_ids) {
                $q->whereIn('category_id', $category_ids);
            });
        }

        //fitler merchants dependent on meal category ids
        if (isset($args['meal_category_ids'])) {
            $category_ids = $args['meal_category_ids'];
            $merchants->whereHas('mealCategories', function ($q) use ($category_ids) {
                $q->whereIn('category_id', $category_ids);
            });
        }

        //fitler merchants dependent on cuisine category ids
        if (isset($args['cuisine_category_ids'])) {
            $category_ids = $args['cuisine_category_ids'];
            $merchants->whereHas('cuisineCategories', function ($q) use ($category_ids) {
                $q->whereIn('category_id', $category_ids);
            });
        }

        return $merchants->get();
    }
}
