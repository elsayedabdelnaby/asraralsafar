<?php

namespace Modules\Website\GraphQL\Queries;

use Modules\Website\Entities\FooterSection;

/**
 * return only the footer sections which have at least one active footer link
 */
final class FooterSectionsResolver
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return FooterSection::whereHas('footerlinks', function ($query) {
            return $query->where('is_active', true);
        })->orderBy('display_order')->get();
    }
}
