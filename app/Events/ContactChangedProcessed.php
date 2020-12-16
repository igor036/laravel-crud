<?php

namespace App\Events;

use App\Models\Contact;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactChangedProcessed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Contact $contact;
    public string $view;
    public function __construct(Contact $contact, string $view) {
        $this->contact = $contact;
        $this->view = $view;
    }
}
