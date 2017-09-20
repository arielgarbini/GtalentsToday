<?php

namespace Vanguard\Repositories\OrganizationRole;

use Vanguard\OrganizationRole;
use DB;

class EloquentOrganizationRole implements OrganizationRoleRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return OrganizationRole::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return OrganizationRole::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $role = OrganizationRole::create($data);

      //  event(new Created($role));

        return $role;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $role = $this->find($id);

        $role->update($data);

        Cache::flush();

        //event(new Updated($role));

        return $role;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $role = $this->find($id);

        //event(new Deleted($role));

        $status = $role->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return OrganizationRole::where('language_id', $language)->orderBy('value_id')->lists($column, $key);
    }
}
