<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected string $viewName;
    protected array $data;

    public function __construct(
        protected string $customSubject,
        string $viewName,
        array $data = []
    ) {
        $this->viewName = $viewName;
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject($this->customSubject)
            ->view($this->viewName)
            ->with($this->data);
    }

    public function attachments(): array
    {
        return [];
    }
}
