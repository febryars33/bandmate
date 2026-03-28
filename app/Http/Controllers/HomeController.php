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
            'meta' => [
                'title' => 'Platform Kolaborasi Musik',
                'paragraph' => 'Platform kolaborasi musisi di seluruh Indonesia. Mulai karir musikmu bersama rekan yang tepat.',
            ],
            'recruitments' => Recruitment::limit(8)->get(),
        ]);
    }
}
