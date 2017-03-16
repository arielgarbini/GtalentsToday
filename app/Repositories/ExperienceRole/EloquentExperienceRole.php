<?php

namespace Vanguard\Repositories\ExperienceRole;

use Vanguard\ExperienceRole;
use DB;

class EloquentExperienceRole implements ExperienceRoleRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return ExperienceRole::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return ExperienceRole::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $experience = ExperienceRole::create($data);

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
        return ExperienceRole::where('language_id', $language)->orderBy('name')->lists($column, $key);
    }
}
