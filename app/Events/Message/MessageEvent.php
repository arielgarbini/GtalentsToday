<?php

namespace Vanguard\Events\Message;

use Vanguard\Message;

abstract class MessageEvent
{
    /**
     * @var Message
     */
    protected $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }
}
