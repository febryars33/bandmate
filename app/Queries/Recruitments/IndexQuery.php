<?php

namespace App\Queries\Recruitments;

use App\Http\Requests\Recruitments\IndexRequest;
use App\Models\Artist;
use App\Models\Recruitment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexQuery
{
    private const PER_PAGE = 10;

    public function __construct(private readonly IndexRequest $request) {}

    public function paginate(): LengthAwarePaginator
    {
        return Recruitment::query()
            ->with(['recruitmentable'])
            ->whereHasMorph('recruitmentable', [Artist::class]) // TODO: next time add Event
            ->when($this->request->search(), fn ($q, $s) => $this->applySearch($q, $s))
            ->unless($this->request->search(), fn ($q) => $q->latest())
            ->when($this->request->regencyIds(), fn ($q, $ids) => $q->whereIn('regency_id', $ids))
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
                recruitments.*,
                MATCH(title, regency_name, description)
                    AGAINST (? IN BOOLEAN MODE)             AS ft_score,
                (title_normalized = ?)            * 100      AS exact_score,
                (title_compact    = ?)            * 95       AS compact_exact_score,
                (title_normalized LIKE ?)         * 70       AS prefix_score,
                (title_compact    LIKE ?)         * 60       AS compact_prefix_score,
                (title_normalized LIKE ?)         * 40       AS contains_score
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
                    'MATCH(title, regency_name, description) AGAINST (? IN BOOLEAN MODE)',
                    ["{$normalized}*"]
                )
                ->orWhere('title_normalized', 'like', "%{$normalized}%")
                ->orWhere('title_compact', 'like', "%{$compact}%")
            )
            ->orderByRaw('
                (exact_score + compact_exact_score + prefix_score +
                 compact_prefix_score + contains_score + (ft_score * 10)) DESC
            ')
            ->orderBy('title');
    }
}
