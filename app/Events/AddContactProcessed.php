<?php

namespace App\Events;

use App\Models\Contact;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * @property Contact $contact
 */
class AddContactProcessed
{

    /** @var CHANNEL string */
    public const CHANNEL = 'addContactChannel';

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function broadcastOn()
    {
        return new PrivateChannel(AddContactProcessed::CHANNEL);
    }
}
