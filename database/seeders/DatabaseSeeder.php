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
            ArtistSeeder::class,
            GenreSeeder::class,
        ]);

        // User::factory(10)->create();

        $admin = User::factory()->create([
            'name' => 'Administrator',
            'email' => 'test@example.com',
        ]);

        $admin->assignRole('administrator');
    }
}
