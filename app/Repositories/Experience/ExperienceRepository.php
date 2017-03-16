<?php

namespace Vanguard\Repositories\Experience;

interface ExperienceRepository
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
     * {@inheritdoc}
     */
    public function sectors($id);

    /**
     * {@inheritdoc}
     */
    public function regions($id);

    /**
     * {@inheritdoc}
     */
    public function industries($id);

    /**
     * {@inheritdoc}
     */
    public function functional_areas($id);

    /**
     * {@inheritdoc}
     */
    public function experience_roles($id);

    /**
     * {@inheritdoc}
     */
    public function sourcing_networks($id);
}