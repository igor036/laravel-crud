<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    protected Contact $contact;

    public function __construct(string $view, Contact $contact)
    {
        $this->view = $view;
        $this->contact = $contact;
    }

    public function build()
    {
        $sendTo = env('MAIL_SEND_TO');
        return $this
            ->to($sendTo)
            ->view($this->view)
            ->with(['contact' => $this->contact]);
    }
}
