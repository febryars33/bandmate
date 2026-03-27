<?php

namespace App\Http\Controllers;

use App\Http\Requests\Artists\ArtistIndexRequest;
use App\Models\Artist;
use App\Models\User;
use App\Queries\ArtistIndexQuery;
use App\Queries\GenreSearchQuery;
use App\Queries\RegencySearchQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ArtistIndexRequest $request): Response
    {
        return Inertia::render('Artists/Index', [
            'meta' => $this->meta(),
            'artists' => Inertia::scroll(fn () => (new ArtistIndexQuery($request))->paginate()),
            'regencies' => Inertia::scroll(fn () => (new RegencySearchQuery($request->search()))->paginate()),
            'genres' => Inertia::scroll(fn () => (new GenreSearchQuery($request->search()))->paginate()),
            'filters' => $request->only(['search', 'regencies', 'genres']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        // ArtistMusician::find(2)
        //     ->update([
        //         'instruments' => [
        //             'Guitar',
        //             'Bass'
        //         ]
        //     ]);
        $artist = Artist::query()
            ->where('slug', $slug)
            ->with(['discographies', 'genres', 'current_lineups', 'past_members', 'complete_lineups'])
            ->firstOrFail();

        return Inertia::render('Artists/Show', [
            'meta' => [
                'title' => $artist->name,
                'description' => Str::of(strip_tags($artist->about))->limit(156, '...'),
            ],
            'slug' => $slug,
            'artist' => $artist
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $user = User::with(['organizers'])->find(1);
        dd($user->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function meta(): array
    {
        return [
            'title' => 'Daftar Artist & Band Terpopuler',
            'description' => 'Temukan daftar artist, band, dan musisi berbakat. Cari profil lengkap, jadwal manggung, dan karya terbaru dari musisi favorit Anda.',
        ];
    }
}
