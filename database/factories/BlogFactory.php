<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'email' => $this->faker->companyEmail(),
            'category' => $this->faker->word(),
            'title' => $this->faker->sentence(),
            'image' => $this->faker->image,
            // 'tags' => 'laravel, api, backend',
            'description' => $this->faker->paragraph(200)
        ];
    }
}
