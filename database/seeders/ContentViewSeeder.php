<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContentView;

class ContentViewSeeder extends Seeder
{
    public function run()
    {
        // Create 1000 random content views
        ContentView::factory()->count(1000)->create();

        // Create specific scenarios for testing
        $this->createRecentBlogViews();
        $this->createPopularDestination();
        $this->createUserSpecificActivity();
    }

    protected function createRecentBlogViews()
    {
        // Create 50 recent blog views
        ContentView::factory()
            ->count(50)
            ->blog()
            ->recent()
            ->create();
    }

    protected function createPopularDestination()
    {
        // Create many views for a specific destination (ID 5)
        ContentView::factory()
            ->count(75)
            ->destination()
            ->state(['viewable_id' => 5])
            ->create();
    }

    protected function createUserSpecificActivity()
    {
        // Create activity for a specific user
        ContentView::factory()
            ->count(30)
            ->forUser(1) // Assuming user ID 1 exists
            ->create();
    }
}
