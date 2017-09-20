<?php

namespace Vanguard\Repositories\ProfilePosition;

use Vanguard\ProfilePosition;
use DB;

class EloquentProfilePosition implements ProfilePositionRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return ProfilePosition::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return ProfilePosition::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $profile = ProfilePosition::create($data);

      //  event(new Created($profile));

        return $profile;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $profile = $this->find($id);

        $profile->update($data);

        Cache::flush();

        //event(new Updated($profile));

        return $profile;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $profile = $this->find($id);

        //event(new Deleted($profile));

        $status = $profile->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return ProfilePosition::where('language_id', $language)->orderBy('id')->lists($column, $key);
    }
}