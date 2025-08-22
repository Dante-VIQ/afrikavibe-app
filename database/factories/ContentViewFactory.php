<?php

namespace Database\Factories;

use App\Models\ContentView;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContentView>
 */
class ContentViewFactory extends Factory
{

    protected $model = ContentView::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id' => \App\Models\User::factory(),
            'viewable_type' => $this->faker->randomElement([
                'App\Models\Blog',
                'App\Models\Doctor',
                'App\Models\Culture'
            ]),
            'viewable_id' => function (array $attributes) {
                return class_basename($attributes['viewable_type'])::factory();
            },'';//j
            'ip_address' =>$this->faker->ipv4,
            'user_agent' => $this->faker->userAgent,
            'country_code' => $this->faker->countryCode,
            'time_spent_seconds' => $this->faker->numberBetween(5, 600),
            'is_engaged' => $this->faker->boolean(70)
        ];
    }
}
