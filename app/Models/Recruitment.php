<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sushi\Sushi;

class Recruitment extends Model
{
    use SoftDeletes, Sushi;

    protected array $rows = [];

    public function __construct()
    {
        parent::__construct();

        for ($i = 1; $i <= 8; $i++) {
            $this->rows[] = [
                'id' => $i,
                'title' => fake()->sentence(),
                'description' => fake()->paragraph(),
                'location' => 'Bandung',
                'deleted_at' => null,
            ];
        }
    }
}
