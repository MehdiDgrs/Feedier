<?php

namespace Tests\Feature;

use App\Mail\FeedbackExportMail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Models\Feedback;


class MailTest extends TestCase
{


    public function test_feedbacks_sended_in_json_attachment(): void
    {

        Feedback::factory()->count(5)->create();

        $feedbacks = Feedback::all();
        $jsonFeedbacks = $feedbacks->toJson(JSON_PRETTY_PRINT);
        $file = tempnam(sys_get_temp_dir(), 'feedbacks') . '.json';
        file_put_contents($file, $jsonFeedbacks);

        Mail::fake();



        Mail::assertQueued(FeedbackExportMail::class, function ($mail) use ($file) {

            return $mail->hasAttachment($file, 'application/json');
        });

        // Delete temp file
        @unlink($file);
    }
}
