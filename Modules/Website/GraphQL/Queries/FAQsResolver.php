<?php

namespace Modules\Website\GraphQL\Queries;

use Modules\Website\Entities\FAQ;

/**
 * return only the footer sections which have at least one active footer link
 */
final class FAQsResolver
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        if (isset($args['category_id'])) {
            $category_id = $args['category_id'];
            return FAQ::whereHas('categories', function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })->orderBy('display_order')->get();
        }
        return FAQ::whereHas('categories')->orderBy('display_order')->get();
    }
}
