<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\Feedbacks\ImportFeedbackFromCSV;
use App\Jobs\Feedbacks\ExportFeedbacks;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        $csvUrl = 'https://feedier-production.s3.eu-west-1.amazonaws.com/special/Reviews+Import.csv';

        // Import CSV to DB every hour 
        $schedule->job(
            new ImportFeedbackFromCSV($csvUrl)
        )->hourly();

        // Send a mail to user with admin role every Friday
        $schedule->job(
            new ExportFeedbacks()
        )->weeklyOn(5);
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
