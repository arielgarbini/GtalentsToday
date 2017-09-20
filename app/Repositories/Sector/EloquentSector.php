<?php

namespace Vanguard\Repositories\Sector;

use Vanguard\Sector;
use DB;

class EloquentSector implements SectorRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Sector::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Sector::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $sector = Sector::create($data);

      //  event(new Created($sector));

        return $sector;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $sector = $this->find($id);

        $sector->update($data);

        Cache::flush();

        //event(new Updated($sector));

        return $sector;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $sector = $this->find($id);

        //event(new Deleted($sector));

        $status = $sector->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return Sector::where('language_id', $language)->orderBy('name')->lists($column, $key);
    }
}
