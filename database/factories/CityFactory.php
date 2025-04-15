<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

                // 'email' => $this->faker->companyEmail(),o
                'name' => $this->faker->word(),
                'country' => $this->faker->country(),
                'image' => $this->faker->image()
                // 'tags' => 'laravel, api, backend',
                // 'description' => $this->faker->paragraph(200)

        ];
    }
}
