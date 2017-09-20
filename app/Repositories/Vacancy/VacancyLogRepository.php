<?php

namespace Vanguard\Repositories\Vacancy;

interface VacancyLogRepository
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
     * Paginate registered vacancies.
     *
     * @param $perPage
     * @param null $search
     * @param null $status
     * @return mixed
     */
    public function paginate($perPage, $search = null, $status = null);

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
