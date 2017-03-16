<?php

namespace Vanguard\Repositories\News;

use Vanguard\Events\News\Created;
use Vanguard\Events\News\Deleted;
use Vanguard\Events\News\Updated;
use Cache;
use Vanguard\News;
use DB;

class EloquentNews implements NewsRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return News::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return News::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = News::query();

        if ($search) {
            $query->where(function ($q) use($search) {
                $q->where('title', "like", "%{$search}%");
                $q->orwhere('description', "like", "%{$search}%");
                $q->orWhere('section', 'like', "%{$search}%");
            });
        }

        $result = $query->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $new = News::create($data);

        event(new Created($new));

        return $new;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $new = $this->find($id);

        $new->update($data);

        Cache::flush();

        event(new Updated($new));

        return $new;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $new = $this->find($id);

        event(new Deleted($new));

        $status = $new->delete();

        Cache::flush();

        return $status;
    }
}