<?php

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Database\Seeder;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->data() as $artist) {
            Artist::factory()->create($artist);
        }
    }

    protected function data(): array
    {
        return [
            [
                'name' => 'saymenothing',
                'slug' => 'saymenothing',
            ],
            [
                'name' => 'Saosin',
                'slug' => 'saosin',
            ],
            [
                'name' => 'As I Lay Dying',
                'slug' => 'as-i-lay-dying',
            ],
            [
                'name' => 'Burgerkill',
                'slug' => 'burgerkill',
            ],
            [
                'name' => 'DeadSquad',
                'slug' => 'deadsquad',
            ],
            [
                'name' => 'Jasad',
                'slug' => 'jasad',
            ],
            [
                'name' => 'Forgotten',
                'slug' => 'forgotten',
            ],
            [
                'name' => 'Beside',
                'slug' => 'beside',
            ],
            [
                'name' => 'Koil',
                'slug' => 'koil',
            ],
            [
                'name' => 'Strangers',
                'slug' => 'strangers',
            ],
            [
                'name' => 'Before Outside',
                'slug' => 'before-outside',
            ],
            [
                'name' => 'GoodbyeBlvesky',
                'slug' => 'goodbye-blvesky',
            ],
            [
                'name' => 'Nocturnal INA',
                'slug' => 'nocturnal-ina',
            ],
            [
                'name' => 'Esvara 51',
                'slug' => 'esvara-51',
            ],
            [
                'name' => 'Classemonde',
                'slug' => 'classemonde',
            ],
            [
                'name' => 'Bettersuck',
                'slug' => 'bettersuck',
            ],
            [
                'name' => 'Foodcourt',
                'slug' => 'foodcourt',
            ],
            [
                'name' => 'Threesixty',
                'slug' => 'threesixty',
            ],
            [
                'name' => 'For Revenge',
                'slug' => 'for-revenge',
            ],
        ];
    }
}
