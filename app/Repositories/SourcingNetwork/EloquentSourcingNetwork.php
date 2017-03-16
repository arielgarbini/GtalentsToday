<?php

namespace Vanguard\Repositories\SourcingNetwork;

use Vanguard\SourcingNetwork;
use DB;

class EloquentSourcingNetwork implements SourcingNetworkRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return SourcingNetwork::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return SourcingNetwork::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $sourcing = SourcingNetwork::create($data);

      //  event(new Created($sourcing));

        return $sourcing;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $sourcing = $this->find($id);

        $sourcing->update($data);

        Cache::flush();

        //event(new Updated($sourcing));

        return $sourcing;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $sourcing = $this->find($id);

        //event(new Deleted($sourcing));

        $status = $sourcing->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return SourcingNetwork::where('language_id', $language)->orderBy('id')->lists($column, $key);
    }
}
