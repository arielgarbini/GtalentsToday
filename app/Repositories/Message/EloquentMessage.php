<?php

namespace Vanguard\Repositories\Message;

use Vanguard\Events\Message\Created;
use Vanguard\Events\Message\Deleted;
use Vanguard\Events\Message\Updated;
use Cache;
use Vanguard\Message;
use DB;

class EloquentMessage implements MessageRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Message::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Message::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $message = Message::create($data);

        event(new Created($message));

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $message = $this->find($id);

        $message->update($data);

        Cache::flush();

        event(new Updated($message));

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $message = $this->find($id);

        event(new Deleted($message));

        $status = $message->delete();

        Cache::flush();

        return $status;
    }
}