<?php

namespace App\Jobs\Feedbacks;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Feedback;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Mail\FeedbackExportMail;

class ExportFeedbacks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Access all feedbacks from db
            $feedbacks = Feedback::all();

            // Convert feedbacks collection to a JSON format
            $jsonFeedbacks = $feedbacks->toJson(JSON_PRETTY_PRINT);

            // Create a temporary file in the system to store the JSON 
            $file = tempnam(sys_get_temp_dir(), 'feedbacks') . '.json';
            file_put_contents($file, $jsonFeedbacks);
            Log::info("Feedbacks content: " . $jsonFeedbacks);
            // Send the feedbacks in an email to user with role admin
            Mail::to(env('MAIL_TO_ADMIN'))->send(new FeedbackExportMail($file));
        } catch (Exception $e) {
            // Report the exception to Sentry
            \Sentry\captureException($e);
            throw $e;
        }
    }
}
