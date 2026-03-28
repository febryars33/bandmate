<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return Inertia::render('Auth/Login', [
            'meta' => [
                'title' => 'Login ke Akun Anda',
                'description' => 'Masuk ke akun Anda untuk mengelola data band, jadwal konser, dan profil artis favorit Anda dalam satu platform.',
            ],
        ]);
    }
}
