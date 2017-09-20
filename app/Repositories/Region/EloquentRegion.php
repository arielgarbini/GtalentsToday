<?php

namespace Vanguard\Repositories\Region;

use Vanguard\Region;
use DB;

class EloquentRegion implements RegionRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Region::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Region::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $region = Region::create($data);

      //  event(new Created($region));

        return $region;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $region = $this->find($id);

        $region->update($data);

        Cache::flush();

        //event(new Updated($region));

        return $region;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $region = $this->find($id);

        //event(new Deleted($region));

        $status = $region->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return Region::where('language_id', $language)->orderBy('value_id')->lists($column, $key);
    }
}
