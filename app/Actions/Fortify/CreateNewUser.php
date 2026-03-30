<?php

namespace App\Actions\Fortify;

use App\Models\Musician;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'username' => [
                'required',
                'string',
                Rule::unique(User::class),
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $musician = Musician::create([
            'real_name' => $input['name'],
        ]);

        return User::create([
            'name' => $input['name'],
            'username' => strtolower($input['username']),
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'musicianable_type' => Musician::class,
            'musicianable_id' => $musician->id,
        ]);
    }
}
