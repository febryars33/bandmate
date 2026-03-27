<?php

namespace App\Queries;

use App\Concerns\Queries\AppliesNameSearch;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Snairbef\Regional\Models\Regency;

class RegencySearchQuery
{
    use AppliesNameSearch;

    private const PER_PAGE = 10;

    public function __construct(private readonly ?string $search) {}

    public function paginate(): LengthAwarePaginator
    {
        return Regency::query()
            ->when(
                $this->search,
                fn ($q, $s) => $this->applyNameSearch($q, $s),
                fn ($q) => $q->orderBy('name'),
            )
            ->paginate(self::PER_PAGE)
            ->withQueryString();
    }
}
