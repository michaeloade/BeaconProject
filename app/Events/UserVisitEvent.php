<?php

namespace App\Events;

use App\Visit;

class UserVisitEvent extends Event
{
    /** @var Visit  */
    private $visit;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Visit $visit)
    {
        $this->visit = $visit;
    }

    public function getVisit()
    {
        return $this->visit;
    }
}
