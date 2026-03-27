<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DefaultRoleSeeder::class,
            // ArtistSeeder::class,
            // GenreSeeder::class,
        ]);

        $admin = User::factory()->create([
            'name' => 'Febriansyah Riki Setiadi',
            'username'  =>  'febryars33',
            'email' => 'febry@bandmate.id',
        ]);
        $admin->assignRole('administrator');

        sleep(1);
        User::factory(24)->create();
    }
}
