<?php

namespace App\Listeners;

use App\Mail\ContactMail;
use App\Events\ContactChangedProcessed;

use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactChangedNotification implements ShouldQueue
{
    public function handle(ContactChangedProcessed $event) {
        $view        = $event->view;
        $contact     = $event->contact;
        $contactMail = new ContactMail($view, $contact);
        Mail::to($contact->email)->send($contactMail);
    }
}
