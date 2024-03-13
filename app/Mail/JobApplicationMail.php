<?php

namespace App\Mail;

use App\Models\JobListing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resumePath;
    public $mailMessage;
    public $userName;
    public $employerName;

    /**
     * Create a new message instance.
     */
    public function __construct($mailMessage, $resumePath, $userName, $employerName)
    {
        $this->mailMessage = $mailMessage;
        $this->resumePath = $resumePath;
        $this->userName = $userName;
        $this->employerName = $employerName;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Job Application Mail',
        );
    }

    public function build()
    { 
        $resumeName = basename($this->resumePath);
        return $this->view('job_seeker.composeMail')
                ->attach(storage_path('app/public/resumes/' . $resumeName), ['as' => $resumeName]);
    }
    /*
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
