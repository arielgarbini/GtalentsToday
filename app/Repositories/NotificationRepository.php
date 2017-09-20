<?php

namespace Vanguard\Repositories;

use Vanguard\Notification;

class NotificationRepository extends AbstractRepository
{

    function __construct(Notification $model)
    {
        $this->model = $model;
    }
}