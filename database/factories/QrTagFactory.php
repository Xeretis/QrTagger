<?php

namespace Database\Factories;

use App\Models\QrTag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class QrTagFactory extends Factory
{
    protected $model = QrTag::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'data' => $this->faker->words(),
            'secret' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
