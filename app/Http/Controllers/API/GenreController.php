<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $search = $request->query('search');
        $genres = Genre::query();
        $genres->orderBy('name');

        if ($search) {
            $genres->where('name', 'like', "%{$search}%");
        }

        return $genres->paginate();
    }
}
