<?php

namespace App\Queries;

use App\Http\Requests\Artists\ArtistIndexRequest;
use App\Models\Artist;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArtistIndexQuery
{
    private const PER_PAGE = 10;

    public function __construct(private readonly ArtistIndexRequest $request) {}

    public function paginate(): LengthAwarePaginator
    {
        return Artist::query()
            ->with(['regency'])
            ->withCount('discographies')
            ->when($this->request->search(), fn ($q, $s) => $this->applySearch($q, $s))
            ->unless($this->request->search(), fn ($q) => $q->latest())
            ->when($this->request->regencyIds(), fn ($q, $ids) => $q->whereIn('regency_id', $ids))
            ->when($this->request->genreIds(), fn ($q, $ids) => $this->applyGenreFilter($q, $ids))
            ->paginate(self::PER_PAGE)
            ->withQueryString();
    }

    // ─── Private ─────────────────────────────────────────────────────────────

    private function applySearch($query, string $search)
    {
        $normalized = strtolower($search);
        $compact = preg_replace('/[^a-z0-9]/', '', $normalized);

        return $query
            ->selectRaw('
                artists.*,
                MATCH(name, regency_name, about)
                    AGAINST (? IN BOOLEAN MODE)             AS ft_score,
                (name_normalized = ?)            * 100      AS exact_score,
                (name_compact    = ?)            * 95       AS compact_exact_score,
                (name_normalized LIKE ?)         * 70       AS prefix_score,
                (name_compact    LIKE ?)         * 60       AS compact_prefix_score,
                (name_normalized LIKE ?)         * 40       AS contains_score
            ', [
                "{$normalized}*",
                $normalized,
                $compact,
                "{$normalized}%",
                "{$compact}%",
                "%{$normalized}%",
            ])
            ->where(fn ($q) => $q
                ->whereRaw(
                    'MATCH(name, regency_name, about) AGAINST (? IN BOOLEAN MODE)',
                    ["{$normalized}*"]
                )
                ->orWhere('name_normalized', 'like', "%{$normalized}%")
                ->orWhere('name_compact', 'like', "%{$compact}%")
            )
            ->orderByRaw('
                (exact_score + compact_exact_score + prefix_score +
                 compact_prefix_score + contains_score + (ft_score * 10)) DESC
            ')
            ->orderBy('name');
    }

    private function applyGenreFilter($query, array $genreIds)
    {
        return $query->whereHas(
            'genres',
            fn ($q) => $q->whereIn('genres.id', $genreIds)
        );
    }
}
