<?php

namespace App\Providers;

use App\Events\AddContactProcessed;
use App\Events\SendEmailProcessed;
use App\Events\DeleteContactProcessed;
use App\Listeners\AddContactNotification;
use App\Listeners\SendEmailNotification;
use App\Listeners\DeleteContactNotification;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SendEmailProcessed::class => [SendEmailNotification::class],
        AddContactProcessed::class => [AddContactNotification::class],
        DeleteContactProcessed::class => [DeleteContactNotification::class]
    ];
}
