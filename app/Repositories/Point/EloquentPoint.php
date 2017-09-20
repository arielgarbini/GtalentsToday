<?php

namespace Vanguard\Repositories\Point;

use Vanguard\Events\Point\Created;
use Vanguard\Events\Point\Deleted;
use Vanguard\Events\Point\Updated;
use Vanguard\Point;
use DB;

class EloquentPoint implements PointRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Point::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Point::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $point = Point::create($data);

        event(new Created($point));

        return $point;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $point = $this->find($id);

        $point->update($data);

        Cache::flush();

        event(new Updated($point));

        return $point;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $point = $this->find($id);

        event(new Deleted($point));

        $status = $point->delete();

        Cache::flush();

        return $status;
    }
}