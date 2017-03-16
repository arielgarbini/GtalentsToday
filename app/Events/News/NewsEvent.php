<?php

namespace Vanguard\Events\News;

use Vanguard\News;

abstract class NewsEvent
{
    /**
     * @var New
     */
    protected $new;

    public function __construct(News $new)
    {
        $this->new = $new;
    }

    /**
     * @return New
     */
    public function getNew()
    {
        return $this->new;
    }
}
