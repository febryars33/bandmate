<?php

namespace App\Http\Controllers;

use App\Models\Recruitment;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return Inertia::render('Home', [
            'title' => fake()->sentence(),
            'paragraph' => fake()->paragraph(),
            'recruitments' => Recruitment::all(),
        ]);
    }
}
