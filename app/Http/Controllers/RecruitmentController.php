<?php

namespace App\Http\Controllers;

use App\Http\Requests\Recruitments\IndexRequest;
use App\Models\Recruitment;
use App\Queries\GenreSearchQuery;
use App\Queries\Recruitments\IndexQuery;
use App\Queries\RegencySearchQuery;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        return Inertia::render('Recruitments/Index', [
            'meta' => [
                'title' => 'Lowongan Musisi',
                'paragraph' => 'Platform kolaborasi musisi di seluruh Indonesia. Mulai karir musikmu bersama rekan yang tepat.',
            ],
            'regencies' => Inertia::scroll(fn () => (new RegencySearchQuery($request->search()))->paginate()),
            'genres' => Inertia::scroll(fn () => (new GenreSearchQuery($request->search()))->paginate()),
            'filters' => $request->only(['search', 'regencies', 'genres']),
            'recruitments' => Inertia::scroll(fn () => (new IndexQuery($request))->paginate()),
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
        $recruitment = Recruitment::where('slug', $slug)->firstOrFail();

        $recruitment->loadMissing([
            'recruitmentable',
        ]);

        return Inertia::render('Recruitments/Show', [
            'meta' => [
                'title' => 'Lowongan - '.$recruitment->title,
                'description' => $recruitment->truncated_description,
            ],
            'recruitment' => $recruitment,
        ]);
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
