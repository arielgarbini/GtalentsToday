<?php

namespace Vanguard\Repositories\Vacancy;

interface VacancyRepository
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
     * Paginate registered vacancies.
     *
     * @param $perPage
     * @param null $search
     * @param null $status
     * @return mixed
     */
    public function paginate($perPage, $search = null, $status = null);

    /**
     * Search vacancies.
     *
     * @param array $data
     * @return mixed
     */
    public function search($user, $perPage, array $data);

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

    /**
     * {@inheritdoc}
     */
    public function address($id);

    /**
     * {@inheritdoc}
     */
    public function languages($id);

    /**
     * {@inheritdoc}
     */
    public function latest($count);

    /**
     * {@inheritdoc}
     */
    public function supplier($id);

    /**
     * {@inheritdoc}
     */
    public function candidates($id);

    /**
     * {@inheritdoc}
     */
    public function createContract($id);

    /**
     * {@inheritdoc}
     */
    public function invoices($id);

    /**
     * {@inheritdoc}
     */
    public function getSupplier($table1, $campo1, $id1,$table2, $campo2,$id2, $campo3, $campo4,$campo5,$campo6,$campo7,$campo8, $poster_user_id);
  
}
