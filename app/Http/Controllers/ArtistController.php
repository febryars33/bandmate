<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Artist/Index', [
            'meta' => [
                'title' => 'Daftar Artist & Band Terpopuler',
                'description' => 'Temukan daftar artist, band, dan musisi berbakat. Cari profil lengkap, jadwal manggung, dan karya terbaru dari musisi favorit Anda.',
            ],
            'artists' => Inertia::scroll(function () use ($request) {
                return Artist::query()
                    ->when($request->filled('search'), function ($query) use ($request) {
                        $search = $request->string('search');
                        if (strlen($search) < 3) {
                            return $query->where('name', 'like', "%{$search}%");
                        }

                        return $query->whereFullText(['name', 'about'], "$search*", ['mode' => 'boolean'])
                            ->orWhere('name', 'like', "%{$search}%")
                            ->orWhereRaw('SOUNDEX(name) = SOUNDEX(?)', [$search]);
                    })
                    ->latest()
                    ->paginate(10)
                    ->withQueryString();
            }),
            'filters' => $request->only(['search']),
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
}
