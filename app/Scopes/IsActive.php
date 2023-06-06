<?php

namespace App\Scopes;

trait IsActive
{
    /**
     * Scope a query to only include active records.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('is_active', 1);
    }
}
