<?php

namespace App\Http\Controllers\API\Regional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Snairbef\Regional\Models\Regency;
use Snairbef\Regional\Repositories\RegencyRepository;

class RegencyController extends Controller
{
    public function __construct(
        protected RegencyRepository $regencies
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $search = $request->query('search');
        $regencies = Regency::query();
        $regencies->orderBy('name');

        if ($search) {
            $regencies->where('name', 'like', "%{$search}%");
        }

        return $regencies->paginate();
    }
}
