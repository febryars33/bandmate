<?php

namespace App\Queries;

use App\Concerns\Queries\AppliesNameSearch;
use App\Models\Genre;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GenreSearchQuery
{
    use AppliesNameSearch;

    private const PER_PAGE = 10;

    public function __construct(private readonly ?string $search) {}

    public function paginate(): LengthAwarePaginator
    {
        return Genre::query()
            ->when(
                $this->search,
                fn ($q, $s) => $this->applyNameSearch($q, $s),
                fn ($q) => $q->orderBy('name'),
            )
            ->paginate(self::PER_PAGE)
            ->withQueryString();
    }
}
