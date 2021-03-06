<?php

namespace App\Providers;

use App\Listeners\VisitEventSubscriber;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\ExampleEvent' => [
            'App\Listeners\ExampleListener',
        ],
    ];

    protected $subscribe = [
        VisitEventSubscriber::class
    ];
}
