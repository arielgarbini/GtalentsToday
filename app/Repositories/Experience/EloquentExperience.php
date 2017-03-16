<?php

namespace Vanguard\Repositories\Experience;

use Vanguard\Events\Experience\Created;
use Vanguard\Events\Experience\Deleted;
use Vanguard\Events\Experience\Updated;
use Cache;
use Vanguard\Experience;
use DB;

class EloquentExperience implements ExperienceRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Experience::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Experience::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $experience = Experience::create($data);

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

        event(new Updated($experience));

        return $experience;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $experience = $this->find($id);

        event(new Deleted($experience));

        $status = $experience->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function sectors($id){

        $experience = $this->find($id);

        return $experience->sectors();
    }

    /**
     * {@inheritdoc}
     */
    public function regions($id){

        $experience = $this->find($id);

        return $experience->regions();
    }

    /**
     * {@inheritdoc}
     */
    public function industries($id){

        $experience = $this->find($id);

        return $experience->industries();
    }

    /**
     * {@inheritdoc}
     */
    public function functional_areas($id){

        $experience = $this->find($id);

        return $experience->functional_areas();
    }

    /**
     * {@inheritdoc}
     */
    public function experience_roles($id){

        $experience = $this->find($id);

        return $experience->experience_roles();
    }

    /**
     * {@inheritdoc}
     */
    public function sourcing_networks($id){

        $experience = $this->find($id);

        return $experience->sourcing_networks();
    }
}