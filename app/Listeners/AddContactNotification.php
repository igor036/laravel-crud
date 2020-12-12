<?php

namespace App\Listeners;

use App\Events\AddContactProcessed;
use App\Events\SendEmailProcessed;

class AddContactNotification
{
    public function handle(AddContactProcessed $event)
    {
        $contact = $event->contact;
        $sendTo  = env('NOTIFICATION_EMAIL');
        $title   = env('NOTIFICATION_EMAIL_ADD_CONTACT_TITLE');
        $body    = 'You added a new contact Name: '. $contact->name . ', Phone: '. $contact->phone . ', Email: '. $contact->email;
        event(new SendEmailProcessed($sendTo, $title, $body));
    }
}
