<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

/**
 * Date: 04/04/2018
 * Time: 16:21
 */
class OfferNotification extends Notification
{
    public function __construct(Collection $offers)
    {
        $this->offers = $offers;
    }

    public function toArray()
    {
        return $this->offers->toArray();
    }

    public function via($notifiable)
    {
        return ['database'];
    }
}