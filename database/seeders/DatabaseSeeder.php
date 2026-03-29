<?php

namespace Database\Seeders;

use App\Models\Musician;
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

        $musician = Musician::create([
            'stage_name' => null,
            'real_name' => 'Febri',
        ]);

        $admin = User::factory()->create([
            'name' => 'Febri',
            'username' => 'febry',
            'email' => 'febry@bandmate.id',
            'musicianable_type' => Musician::class,
            'musicianable_id' => $musician->id,
        ]);

        $admin->assignRole('administrator');

        sleep(1);
        // User::factory(24)->create();
    }
}
