<?php

namespace Vanguard\Repositories\Candidate;

use Vanguard\Events\Candidate\Created;
use Vanguard\Events\Candidate\Deleted;
use Vanguard\Events\Candidate\Updated;
use Cache;
use Vanguard\Candidate;
use DB;

class EloquentCandidate implements CandidateRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Candidate::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Candidate::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null, $id = null)
    {
        $query = Candidate::query();

        if ($id) {
            $query->where('supplier_user_id', $id);
        }

        if ($status) {
            $query->where('is_active', $status);
        }

        if ($search) {
            $query->where(function ($q) use($search) {
                $q->where('first_name', "like", "%{$search}%");
                $q->orWhere('last_name', 'like', "%{$search}%");
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
        $candidate = Candidate::create($data);

        event(new Created($candidate));

        return $candidate;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $candidate = $this->find($id);

        $candidate->update($data);

        Cache::flush();

        event(new Updated($candidate));

        return $candidate;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $candidate = $this->find($id);

        event(new Deleted($candidate));

        $status = $candidate->delete();

        Cache::flush();

        return $status;
    }
    
    /**
     * {@inheritdoc}
     */
    public function where($column, $id)
    {
        return Candidate::where($column, '=', $id)->get();
    }
}
