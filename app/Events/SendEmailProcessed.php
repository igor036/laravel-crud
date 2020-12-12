<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 *
 * @property string $sendTo
 * @property string $title
 * @property string $body
 *
 */
class SendEmailProcessed
{

    /** @var CHANNEL string */
    public const CHANNEL = 'sendEmailChannel';

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(string $sendTo, string $title, string $body)
    {
        $this->sendTo = $sendTo;
        $this->title = $title;
        $this->body = $body;
    }

    public function broadcastOn()
    {
        return new PrivateChannel(SendEmailProcessed::CHANNEL);
    }
}
