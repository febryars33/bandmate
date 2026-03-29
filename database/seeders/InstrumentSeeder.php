<?php

namespace Database\Seeders;

use App\Models\Instrument;
use Illuminate\Database\Seeder;

class InstrumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instruments = [
            [
                'name' => 'Gitar',
                'name_english' => 'Guitar',
            ],
            [
                'name' => 'Drums',
                'name_english' => 'Drums',
            ],
            [
                'name' => 'Piano',
                'name_english' => 'Piano',
            ],
            [
                'name' => 'Bass',
                'name_english' => 'Bass Guitar',
            ],
            [
                'name' => 'Violin',
                'name_english' => 'Violin',
            ],
            [
                'name' => 'Saxophone',
                'name_english' => 'Saxophone',
            ],
            [
                'name' => 'Cello',
                'name_english' => 'Cello',
            ],
            [
                'name' => 'Biola',
                'name_english' => 'Violin',
            ],
            [
                'name' => 'Kontrabas',
                'name_english' => 'Double Bass',
            ],
            [
                'name' => 'Harpa',
                'name_english' => 'Harp',
            ],
            [
                'name' => 'Klarnet',
                'name_english' => 'Clarinet',
            ],
            [
                'name' => 'Flauta',
                'name_english' => 'Flute',
            ],
            [
                'name' => 'Oboa',
                'name_english' => 'Oboe',
            ],
            [
                'name' => 'Klarinet',
                'name_english' => 'Clarinet',
            ],
            [
                'name' => 'Fagot',
                'name_english' => 'Bassoon',
            ],
            [
                'name' => 'Horn',
                'name_english' => 'French Horn',
            ],
            [
                'name' => 'Trombon',
                'name_english' => 'Trombone',
            ],
            [
                'name' => 'Tuba',
                'name_english' => 'Tuba',
            ],
            [
                'name' => 'Saksofon',
                'name_english' => 'Saxophone',
            ],
        ];

        foreach ($instruments as $instrument) {
            Instrument::create($instrument);
        }
    }
}
