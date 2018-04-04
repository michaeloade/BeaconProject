<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

/**
 * Date: 04/04/2018
 * Time: 16:21
 */
class OfferNotification extends Notification
{
    public function via() {
        return [''];
    }
}