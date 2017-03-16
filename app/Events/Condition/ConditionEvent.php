<?php

namespace Vanguard\Events\Condition;

use Vanguard\Condition;

abstract class ConditionEvent
{
    /**
     * @var Condition
     */
    protected $condition;

    public function __construct(Condition $condition)
    {
        $this->condition = $condition;
    }

    /**
     * @return Condition
     */
    public function getCondition()
    {
        return $this->condition;
    }
}
