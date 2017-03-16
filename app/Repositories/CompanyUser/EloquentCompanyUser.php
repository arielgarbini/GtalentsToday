<?php

namespace Vanguard\Repositories\CompanyUser;

use Vanguard\Events\CompanyUser\Created;
use Vanguard\Events\CompanyUser\Updated;
use Vanguard\Events\CompanyUser\Deleted;
use Cache;
use Vanguard\CompanyUser;
use DB;

class EloquentCompanyUser implements CompanyUserRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return CompanyUser::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return CompanyUser::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = CompanyUser::query();

        if ($status) {
            $query->where('is_active', $status);
        }

        if ($search) {
            $query->where(function ($q) use($search) {
                $q->where('name', "like", "%{$search}%");
                $q->orwhere('comercial_name', "like", "%{$search}%");
                $q->orWhere('register_number', 'like', "%{$search}%");
                $q->orWhere('email', 'like', "%{$search}%");
            });
        }

        $result = $query->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $company_user = CompanyUser::create($data);

        event(new Created($company_user));

        return $company_user;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $company_user = $this->find($id);

        $company_user->update($data);

        Cache::flush();

        event(new Updated($company_user));

        return $company_user;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $company_user = $this->find($id);

        event(new Deleted($company_user));

        $status = $company_user->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($column = 'name', $key = 'id')
    {
        return Company::orderBy('name')->lists($column, $key);
    }

    /**
     * {@inheritdoc}
     */
    public function where($column, $id)
    {
        return CompanyUser::where($column, '=', $id)->first();
    }
}
