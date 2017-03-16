<?php

namespace Vanguard\Repositories\LevelPosition;

use Vanguard\LevelPosition;
use DB;

class EloquentLevelPosition implements LevelPositionRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return LevelPosition::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return LevelPosition::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $level = LevelPosition::create($data);

      //  event(new Created($level));

        return $level;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $level = $this->find($id);

        $level->update($data);

        Cache::flush();

        //event(new Updated($level));

        return $level;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $level = $this->find($id);

        //event(new Deleted($level));

        $status = $level->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return LevelPosition::where('language_id', $language)->orderBy('id')->lists($column, $key);
    }
}
