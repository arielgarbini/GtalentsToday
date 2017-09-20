<?php

namespace Vanguard\Repositories\ExperienceYear;

use Vanguard\ExperienceYear;
use DB;

class EloquentExperienceYear implements ExperienceYearRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return ExperienceYear::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return ExperienceYear::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $experience = ExperienceYear::create($data);

      //  event(new Created($experience));

        return $experience;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $experience = $this->find($id);

        $experience->update($data);

        Cache::flush();

        //event(new Updated($experience));

        return $experience;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $experience = $this->find($id);

        //event(new Deleted($experience));

        $status = $experience->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return ExperienceYear::where('language_id', $language)->orderBy('value_id')->lists($column, $key);
    }
}
