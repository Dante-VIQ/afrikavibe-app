<?php

namespace Database\Factories;

use App\Models\ContentView;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentViewFactory extends Factory
{
    protected $model = ContentView::class;

    public function definition()
    {
        // Define content types and their corresponding models
        $contentTypes = [
            'App\Models\Blog',
            'App\Models\Destination',
            'App\Models\Culture'
        ];

        $contentType = $this->faker->randomElement($contentTypes);
        $contentId = $this->faker->numberBetween(1, 50);

        // Random date within the last 90 days
        $createdAt = $this->faker->dateTimeBetween('-90 days', 'now');

        return [
            'viewable_type' => $contentType,
            'viewable_id' => $contentId,
            'user_id' => $this->faker->optional(0.7)->randomElement(User::pluck('id')->toArray()), // 70% chance of having a user
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }

    // State methods for specific content types
    public function blog()
    {
        return $this->state(function (array $attributes) {
            return [
                'viewable_type' => 'App\Models\Blog',
                'viewable_id' => $this->faker->numberBetween(1, 20),
            ];
        });
    }

    public function destination()
    {
        return $this->state(function (array $attributes) {
            return [
                'viewable_type' => 'App\Models\Destination',
                'viewable_id' => $this->faker->numberBetween(1, 15),
            ];
        });
    }

    public function culture()
    {
        return $this->state(function (array $attributes) {
            return [
                'viewable_type' => 'App\Models\Culture',
                'viewable_id' => $this->faker->numberBetween(1, 15),
            ];
        });
    }

    // State methods for specific time periods
    public function recent()
    {
        return $this->state(function (array $attributes) {
            return [
                'created_at' => $this->faker->dateTimeBetween('-7 days', 'now'),
            ];
        });
    }

    public function last30Days()
    {
        return $this->state(function (array $attributes) {
            return [
                'created_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
            ];
        });
    }

    public function last90Days()
    {
        return $this->state(function (array $attributes) {
            return [
                'created_at' => $this->faker->dateTimeBetween('-90 days', 'now'),
            ];
        });
    }

    // State method for specific user
    public function forUser($userId)
    {
        return $this->state(function (array $attributes) use ($userId) {
            return [
                'user_id' => $userId,
            ];
        });
    }

    // State method for guest views
    public function guest()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => null,
            ];
        });
    }
}
