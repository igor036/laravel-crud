<?php

namespace App\Listeners;

use App\Events\SendEmailProcessed;


class SendEmailNotification
{
    /**
     * @param  SendEmailProcessed  $event
     * @return void
     */
    public function handle(SendEmailProcessed $event)
    {
        $this->event = $event;
    }
}
