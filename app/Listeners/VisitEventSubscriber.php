<?php

namespace App\Listeners;

use App\Events\ExampleEvent;
use App\Events\UserVisitEvent;
use App\Events\UserLeftRange;
use App\Notifications\OfferNotification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VisitEventSubscriber
{
    public function onEnter(UserVisitEvent $event)
    {
        /** @var Collection $products */
        $products = $event->getVisit()->beacon->products;
        $offers = new Collection;
        $products->each(function($product) use ($offers) {
            $offers->push($product->offers);
        });

        $event->getVisit()->user->notify(new OfferNotification($offers));
    }


    /**
     * @param $events Dispatcher
     */
    public function subscribe($events)
    {
        $events->listen(
            UserVisitEvent::class,
            VisitEventSubscriber::class.'@onEnter'
        );
    }
}
