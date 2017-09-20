<?php

namespace Vanguard\Repositories;

use Vanguard\VacancyViewed;

class VacancyViewedRepository extends AbstractRepository
{

    function __construct(VacancyViewed $model)
    {
        $this->model = $model;
    }

    public function search(Array $params = [])
    {
        $query = $this->model
            ->select('vacancy_viewed.*');

        if(isset($params['vacancy_id'])){
            $query->where('vacancy_id', $params['vacancy_id']);
        }

        if(isset($params['user_id'])){
            $query->where('user_id', $params['user_id']);
        }

        return $query;
    }
}