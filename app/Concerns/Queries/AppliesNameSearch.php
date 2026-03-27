<?php

namespace App\Concerns\Queries;

use Illuminate\Database\Eloquent\Builder;

/**
 * Reusable LIKE search dengan CASE WHEN relevance ordering.
 * Dipakai oleh RegencySearchQuery dan GenreSearchQuery.
 */
trait AppliesNameSearch
{
    protected function applyNameSearch(Builder $query, string $search): Builder
    {
        return $query
            ->where('name', 'like', "%{$search}%")
            ->orderByRaw('
                CASE
                    WHEN name = ?         THEN 0
                    WHEN name LIKE ?      THEN 1
                    WHEN name LIKE ?      THEN 2
                    ELSE                       3
                END
            ', [
                $search,
                "{$search} %",
                "{$search}%",
            ])
            ->orderBy('name');
    }
}
