<?php

namespace Vanguard\Repositories\Condition;

interface ConditionRepository
{
    /**
     * Get all system promotions.
     *
     * @return mixed
     */
    public function all($id);

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
     * Get all system promotions where.
     *
     * @return mixed
     */
    public function where($column, $id);
}
