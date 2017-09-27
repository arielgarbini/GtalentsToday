<?php

namespace Vanguard\Repositories\Category;

use Vanguard\Events\Category\Created;
use Vanguard\Events\Category\Deleted;
use Vanguard\Events\Category\Updated;
use Vanguard\Category;
use Cache;
use DB;

class EloquentCategory implements CategoryRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Category::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Category::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = Category::query();

        if ($status) {
            $query->where('is_active', $status);
        }

        if ($search) {
            $query->where(function ($q) use($search) {
                $q->where('name', "like", "%{$search}%");
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
        $category = Category::create($data);

        event(new Created($category));

        return $category;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $category = $this->find($id);

        $category->update($data);

        Cache::flush();

        event(new Updated($category));

        return $category;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $category = $this->find($id);

        event(new Deleted($category));

        $status = $category->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'id')
    {
        return Category::where('language_id', $language)->orderBy('id','asc')->lists($column, $key);
    }
}
