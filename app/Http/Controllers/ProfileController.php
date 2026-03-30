<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $username)
    {
        $user = User::whereUsername($username)->firstOrFail();

        $musician = $user->musicianable;

        $musician->load(['instruments', 'genres']);

        return Inertia::render('Profile', [
            'musician' => $musician,
            'user' => $user->only('id', 'username'),
            'username' => $username,
            'profile' => [
                'id' => 1,
                'username' => $username,

                'name' => 'Ahmad Rizky',
                'avatar' => 'https://i.pravatar.cc/300?img=12',

                'location' => 'Bandung, Indonesia',
                'headline' => 'Guitarist | Session Player | Rock & Blues',

                'bio' => 'Passionate guitarist with 8+ years experience. Open for gigs, collaborations, and studio sessions.',

                'instruments' => [
                    'Guitar',
                    'Acoustic Guitar',
                ],

                'genres' => [
                    'Rock',
                    'Blues',
                    'Jazz',
                ],

                'experience_level' => 'professional',

                'collaboration_status' => 'open',

                'connections_count' => 128,
                'projects_count' => 12,

                'experiences' => [
                    [
                        'id' => 1,
                        'band_name' => 'The Night Strings',
                        'role' => 'Lead Guitarist',
                        'start_year' => 2018,
                        'end_year' => 2022,
                        'description' => 'Touring band across Java & Bali.',
                    ],
                    [
                        'id' => 2,
                        'band_name' => 'Session Project Jakarta',
                        'role' => 'Session Guitarist',
                        'start_year' => 2022,
                        'end_year' => null,
                        'description' => 'Studio recordings & live gigs.',
                    ],
                ],
            ],
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if ($request->boolean('_patch')) {
            $user->musicianable()->update($request->array('fields'));
            // $user->musicianable()->update($request->all('fields'));
        }

        // $user->musicianable()->update([
        //     'about' =>  $request->input('about'),
        // ]);

        return Redirect::back()->with([
            'data' => 'Something you want to pass to front-end',
        ]);
    }
}
