<?php

namespace Vanguard\Repositories\Profile;

use Vanguard\Events\Profile\Created;
use Vanguard\Events\Profile\Deleted;
use Vanguard\Events\Profile\Updated;
use Cache;
use Vanguard\Profile;
use DB;

class EloquentProfile implements ProfileRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Profile::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Profile::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $profile = Profile::create($data);

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

        event(new Updated($profile));

        return $profile;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $profile = $this->find($id);

        event(new Deleted($profile));

        $status = $profile->delete();

        Cache::flush();

        return $status;
    }
}