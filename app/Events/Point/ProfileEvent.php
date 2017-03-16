<?php

namespace Vanguard\Events\Point;

use Vanguard\Point;

abstract class PointEvent
{
    /**
     * @var Point
     */
    protected $point;

    public function __construct(Point $point)
    {
        $this->point = $point;
    }

    /**
     * @return Point
     */
    public function getPoint()
    {
        return $this->point;
    }
}
