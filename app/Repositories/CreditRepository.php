<?php

namespace Vanguard\Repositories;

use Vanguard\Credit;

class CreditRepository extends AbstractRepository
{
    function __construct(Credit $model)
    {
        $this->model = $model;
    }
}