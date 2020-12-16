<?php

namespace App\Providers;

use App\Events\ContactChangedProcessed;
use App\Events\SendEmailProcessed;
use App\Listeners\ContactChangedNotification;
use App\Listeners\SendEmailNotification;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SendEmailProcessed::class => [SendEmailNotification::class],
        ContactChangedProcessed::class => [ContactChangedNotification::class]
    ];
}
