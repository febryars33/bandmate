<?php

namespace App\Services;

use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Contracts\User as SocialUser;

class SocialAuthService
{
    public function findOrCreate(string $provider, SocialUser $social): User
    {
        return DB::transaction(function () use ($provider, $social) {
            $account = SocialAccount::with('user')
                ->where('provider', $provider)
                ->where('provider_id', $social->getId())
                ->first();

            if ($account) {
                $account->update($this->token($social));

                return $account->user;
            }

            $user = User::firstOrCreate(
                ['email' => $social->getEmail()],
                ['name' => $social->getName(), 'password' => null],
            );

            $user->social_accounts()->create([
                'provider' => $provider,
                'provider_id' => $social->getId(),
                ...$this->token($social),
            ]);

            return $user;
        });
    }

    private function token(SocialUser $social): array
    {
        return [
            'token' => $social->token,
            'refresh_token' => $social->refreshToken,
            'token_expires_at' => $social->expiresIn
                ? now()->addSeconds($social->expiresIn)
                : null,
        ];
    }
}
