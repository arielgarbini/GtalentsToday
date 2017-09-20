<?php

namespace Vanguard\Repositories\EducationLevel;

use Vanguard\EducationLevel;
use DB;

class EloquentEducationLevel implements EducationLevelRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return EducationLevel::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return EducationLevel::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $experience = EducationLevel::create($data);

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
        return EducationLevel::where('language_id', $language)->orderBy('value_id')->lists($column, $key);
    }
}
