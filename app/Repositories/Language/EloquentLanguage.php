<?php

namespace Vanguard\Repositories\Language;

use Vanguard\Language;
use Cache;
use DB;

class EloquentLanguage implements LanguageRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Language::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Language::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = Language::query();

        if ($search) {
            $query->where(function ($q) use($search) {
                $q->where('name', "like", "%{$search}%");
                $q->orWhere('code', 'like', "%{$search}%");
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
        $language = Language::create($data);

        return $language;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $language = $this->find($id);

        $language->update($data);

        Cache::flush();

        return $language;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $language = $this->find($id);

        $status = $language->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($column = 'name', $key = 'id')
    {
        return Language::orderBy('id')->lists($column, $key);
    }
}
