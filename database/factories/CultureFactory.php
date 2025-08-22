<?php

namespace Database\Factories;

use App\Models\Culture;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Culture>
 */
class CultureFactory extends Factory
{
    protected $model = Culture::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(),
            'detail' => $this->faker->paragraph(30),
            'location' => $this->faker->name(),
            'image' => $this->faker->image
        ];
    }
}
