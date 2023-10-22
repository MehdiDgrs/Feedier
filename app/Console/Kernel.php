<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\Feedbacks\ImportFeedbackFromCSV;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        $csvUrl = 'https://feedier-prod-europe.s3.eu-west-1.amazonaws.com/special/Reviews+Import.csv';

        // Execute the job handling import of feedback from CSV file every hour

        $schedule->job(
            new ImportFeedbackFromCSV($csvUrl)
        )->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
