<?php

namespace App\Listeners;

use App\Events\DeleteContactProcessed;
use App\Events\SendEmailProcessed;

class DeleteContactNotification
{

    public function handle(DeleteContactProcessed $event)
    {
        $contact = $event->contact;
        $sendTo = env('NOTIFICATION_EMAIL');
        $title  = env('NOTIFICATION_EMAIL_DEL_CONTACT_TITLE');
        $body   = 'You deleted a contact Name: '. $contact->name . ', Phone: '. $contact->phone . ', Email: '. $contact->email;
        event(new SendEmailProcessed($sendTo, $title, $body));
    }
}
