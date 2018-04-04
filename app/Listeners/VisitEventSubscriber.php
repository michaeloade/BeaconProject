<?php

namespace App\Listeners;

use App\Events\ExampleEvent;
use App\Events\UserEnteredRange;
use App\Events\UserLeftRange;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VisitEventSubscriber
{
    public function onEnter(UserEnteredRange $event)
    {

    }

    public function onLeave(UserLeftRange $event)
    {

    }


    /**
     * @param $events Dispatcher
     */
    public function subscribe($events)
    {
        $events->listen(
            UserEnteredRange::class,
            VisitEventSubscriber::class.'@onEnter'
        );

        $events->listen(
            UserLeftRange::class,
            VisitEventSubscriber::class.'@onLeave'
        );
    }
}
