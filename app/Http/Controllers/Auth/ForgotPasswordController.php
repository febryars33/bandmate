<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ForgotPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return Inertia::render('Auth/ForgotPassword', [
            'meta' => [
                'title' => 'Lupa Password',
                'description' => '',
            ],
        ]);
    }
}
