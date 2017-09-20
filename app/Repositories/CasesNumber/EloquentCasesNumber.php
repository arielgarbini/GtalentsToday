<?php

namespace Vanguard\Repositories\CasesNumber;

use Vanguard\CasesNumber;
use DB;

class EloquentCasesNumber implements CasesNumberRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return CasesNumber::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return CasesNumber::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $casesNumber = CasesNumber::create($data);

      //  event(new Created($casesNumber));

        return $casesNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $casesNumber = $this->find($id);

        $casesNumber->update($data);

        Cache::flush();

        //event(new Updated($casesNumber));

        return $casesNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $casesNumber = $this->find($id);

        //event(new Deleted($casesNumber));

        $status = $casesNumber->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return CasesNumber::where('language_id', $language)->orderBy('value_id')->lists($column, $key);
    }
}