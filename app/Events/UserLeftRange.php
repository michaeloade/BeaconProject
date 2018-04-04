<?php

namespace App\Events;

use App\Visit;

class UserLeftRange extends Event
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Visit $visit)
    {

    }
}
