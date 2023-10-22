<?php

namespace App\Jobs\Feedbacks;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use League\Csv\Reader;
use App\Models\Feedback;
use Exception;


class ImportFeedbackFromCSV implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $csvUrl;
    /**
     * Create a new job instance.
     */

    // Put url of the CSV file to import as my object dependency  
    public function __construct(string $csvUrl)
    {
        $this->csvUrl = $csvUrl;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $csvContent = file_get_contents($this->csvUrl);
            if (!$csvContent) {
                // Throw exception if CSV content doesnt exist
                throw new Exception("Failed to fetch content from {$this->csvUrl}");
            }

            $csv = Reader::createFromString($csvContent);
            $csv->setHeaderOffset(0);
        } catch (Exception $e) {
            // Report the error to Sentry for detailed tracking.
            \Sentry\captureException($e);
            throw $e;
        }
    }
}
