<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->data() as $data) {
            Genre::create($data);
        }
    }

    protected function data(): array
    {
        return [
            [
                'name' => 'Rock',
                'slug' => 'rock',
            ],
            [
                'name' => 'Pop',
                'slug' => 'pop',
            ],
            [
                'name' => 'Jazz',
                'slug' => 'jazz',
            ],
            [
                'name' => 'Metal',
                'slug' => 'metal',
            ],
            [
                'name' => 'Folk',
                'slug' => 'folk',
            ],
            [
                'name' => 'Blues',
                'slug' => 'blues',
            ],
            [
                'name' => 'Classical',
                'slug' => 'classical',
            ],
            [
                'name' => 'Dance',
                'slug' => 'dance',
            ],
            [
                'name' => 'Country',
                'slug' => 'country',
            ],
            [
                'name' => 'Reggae',
                'slug' => 'reggae',
            ],
            [
                'name' => 'Punk',
                'slug' => 'punk',
            ],
            [
                'name' => 'Ska',
                'slug' => 'ska',
            ],
            [
                'name' => 'Hip-Hop',
                'slug' => 'hip-hop',
            ],
            [
                'name' => 'Rap',
                'slug' => 'rap',
            ],
            [
                'name' => 'Funk',
                'slug' => 'funk',
            ],
            [
                'name' => 'Soul',
                'slug' => 'soul',
            ],
            [
                'name' => 'Disco',
                'slug' => 'disco',
            ],
            [
                'name' => 'Post-Hardcore',
                'slug' => 'post-hardcore',
            ],
            [
                'name' => 'Emo',
                'slug' => 'emo',
            ],
            [
                'name' => 'Grunge',
                'slug' => 'grunge',
            ],
            [
                'name' => 'Indie',
                'slug' => 'indie',
            ],
            [
                'name' => 'Indie Rock',
                'slug' => 'indie-rock',
            ],
            [
                'name' => 'Indie Pop',
                'slug' => 'indie-pop',
            ],
            [
                'name' => 'Indie Folk',
                'slug' => 'indie-folk',
            ],
            [
                'name' => 'Death Metal',
                'slug' => 'death-metal',
            ],
            [
                'name' => 'Heavy Metal',
                'slug' => 'heavy-metal',
            ],
            [
                'name' => 'Progressive Metal',
                'slug' => 'progressive-metal',
            ],
            [
                'name' => 'Metalcore',
                'slug' => 'metalcore',
            ],
            [
                'name' => 'Thrash Metal',
                'slug' => 'thrash-metal',
            ],
            [
                'name' => 'Power Metal',
                'slug' => 'power-metal',
            ],
            [
                'name' => 'Symphonic Metal',
                'slug' => 'symphonic-metal',
            ],
            [
                'name' => 'Doom Metal',
                'slug' => 'doom-metal',
            ],
            [
                'name' => 'Gothic Metal',
                'slug' => 'gothic-metal',
            ],
            [
                'name' => 'Black Metal',
                'slug' => 'black-metal',
            ],
            [
                'name' => 'Viking Metal',
                'slug' => 'viking-metal',
            ],
        ];
    }
}
