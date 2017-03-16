<?php

namespace Vanguard\Repositories\Company;

use Vanguard\Events\Company\Created;
use Vanguard\Events\Company\Updated;
use Vanguard\Events\Company\Deleted;
use Cache;
use Vanguard\Company;
use DB;

class EloquentCompany implements CompanyRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Company::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Company::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = Company::query();

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
        $company = Company::create($data);

        event(new Created($company));

        return $company;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $company = $this->find($id);

        $company->update($data);

        Cache::flush();

        event(new Updated($company));

        return $company;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $company = $this->find($id);

        event(new Deleted($company));

        $status = $company->delete();

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
}