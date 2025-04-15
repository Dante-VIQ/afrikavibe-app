<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Destination>
 */
class DestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'name' => $this->faker->unique()->name,
            // 'detail' => $this->faker->sentence(),
            // // 'detail' => $this->faker->paragraph(2),
            // 'images' => $this->faker->image
        ];
    }
}
