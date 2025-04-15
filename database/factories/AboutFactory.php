<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\About;
use Illuminate\Database\Eloquent\Factories\Factory;
use PhpParser\Node\NullableType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\About>
 */
class AboutFactory extends Factory
{

    protected $model = About::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->company(),
            'detail' => $this->faker->paragraph(),
            'merit' => $this->faker->sentence(),
            'image' => $this->faker->image,
            'photo' => $this->faker->image,
            'user_id' => User::factory(),

        ];
    }
}
