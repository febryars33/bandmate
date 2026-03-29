<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SocialAuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /** Supported providers. Add new ones here — no other change needed. */
    private const PROVIDERS = ['google', 'spotify'];

    /** Extra OAuth scopes per provider (if provider default is insufficient). */
    private const SCOPES = [
        'spotify' => ['user-read-email', 'user-read-private'],
    ];

    public function __construct(private readonly SocialAuthService $svc) {}

    public function redirect(string $provider): RedirectResponse
    {
        abort_unless(in_array($provider, self::PROVIDERS, true), 404);

        $driver = Socialite::driver($provider);

        if ($scopes = self::SCOPES[$provider] ?? null) {
            $driver->scopes($scopes);
        }

        return $driver->redirect();
    }

    public function callback(string $provider): RedirectResponse
    {
        abort_unless(in_array($provider, self::PROVIDERS, true), 404);

        try {
            $social = Socialite::driver($provider)->user();
        } catch (\Throwable) {
            return redirect()->route('login')
                ->withErrors(['oauth' => 'Authentication failed. Please try again.']);
        }

        $user = $this->svc->findOrCreate($provider, $social);

        Auth::login($user, remember: true);

        return redirect()->intended(route('home'));
    }
}
