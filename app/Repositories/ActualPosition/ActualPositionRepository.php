<?php

namespace Vanguard\Repositories\ActualPosition;

interface ActualPositionRepository
{
    /**
     * Get all system promotions.
     *
     * @return mixed
     */
    public function all();

    /**
     * Finds the promotion by given id.
     *
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Creates new promotion from provided data.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Updates specified promotion.
     *
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * Remove specified promotion from repository.
     *
     * @param $id
     * @return mixed
     */
    public function delete($id);
    
    /**
     * Create $key => $value array for all available Actual positions.
     *
     * @param string $column
     * @param string $key
     * @return mixed
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id');
}
