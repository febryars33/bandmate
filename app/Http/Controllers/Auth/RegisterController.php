<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return Inertia::render('Auth/Register', [
            'meta' => [
                'title' => 'Buat Akun',
                'description' => 'Buat akun sekarang dan dapatkan akses ke fitur lengkap kami, termasuk pengelolaan data band, jadwal konser, dan profil artis favorit Anda. Kami juga menawarkan fitur keamanan dan diskusi yang lebih baik untuk Anda.',
            ],
        ]);
    }
}
