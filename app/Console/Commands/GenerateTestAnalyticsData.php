<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ContentView;

class GenerateTestAnalyticsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analytics:generate-test-data {count=1000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate test analytics data for the dashboard';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = (int) $this->argument('count');

        $this->info("Generating {$count} test content views...");

        // Use the factory directly
        ContentView::factory()->count($count)->create();

        $this->info("Successfully generated {$count} test content views!");
        $this->info("Visit /admin/analytics to see your analytics dashboard.");

        return Command::SUCCESS;
    }
}
