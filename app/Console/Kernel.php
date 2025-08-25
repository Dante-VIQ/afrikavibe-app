<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('analytics:generate-test-data')->daily(); // Example schedule
        $schedule->call(function () {
            \App\Models\ContentView::where('created_at', '<', now()->subYear())
                ->delete();
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');

        // Manually register your command (optional - usually auto-loaded)
        // $this->app->singleton('command.analytics.generate', function () {
        //     return new \App\Console\Commands\GenerateTestAnalyticsData();
        // });
        // $this->commands('command.analytics.generate');
    }
}
