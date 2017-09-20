<?php

namespace Vanguard\Events;

use Vanguard\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Vanguard\Vacancy;

class NotificationEvent extends Event
{
    use SerializesModels;

    /**
     * @var Vacancy
     */
    protected $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * @return Vacancy
     */
    public function getData()
    {
        return $this->params;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
