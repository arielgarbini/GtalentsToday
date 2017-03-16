<?php

namespace Vanguard\Repositories\Industry;

use Vanguard\Industry;
use DB;

class EloquentIndustry implements IndustryRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Industry::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Industry::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $industry = Industry::create($data);

      //  event(new Created($industry));

        return $industry;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $industry = $this->find($id);

        $industry->update($data);

        Cache::flush();

        //event(new Updated($industry));

        return $industry;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $industry = $this->find($id);

        //event(new Deleted($industry));

        $status = $industry->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return Industry::where('language_id', $language)->orderBy('name')->lists($column, $key);
    }
}
