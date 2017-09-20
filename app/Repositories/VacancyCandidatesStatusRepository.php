<?php

namespace Vanguard\Repositories;

use Vanguard\VacancyCandidateStatus;

class VacancyCandidatesStatusRepository extends AbstractRepository
{

    function __construct(VacancyCandidateStatus $model)
    {
        $this->model = $model;
    }

    public function search(Array $params = [])
    {
        $query = $this->model
            ->select('vacancy_candidates_status.*');

        if(isset($params['vacancy_id'])){
            $query->where('vacancy_id', $params['vacancy_id']);
        }

        if(isset($params['candidate_id'])){
            $query->where('candidate_id', $params['candidate_id']);
        }

        if(isset($params['status'])){
            $query->where('status', $params['status']);
        }

        return $query->orderBy('created_at', 'desc');
    }
}