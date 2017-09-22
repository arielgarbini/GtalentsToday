<?php

namespace Vanguard\Services\Vacancies;
use Illuminate\Support\Facades\Auth;
use Vanguard\Company;
use Vanguard\Vacancy;

/**
 * Created by PhpStorm.
 * User: Xfrie
 * Date: 6/16/2017
 * Time: 4:13 PM
 */
class VacancyManager
{
    public function getRecommended($paginate)
    {
        $user_id = Auth::user()->id;
        $users_comapny = [];
        foreach(Auth::user()->company_user->company->users as $u){
            $users_comapny[] = $u->id;
        }
        $vacancies = Vacancy::select('vacancies.*')->where(function($q){
            $q->where('vacancy_status_id', 1);
            $q->orWhere('vacancy_status_id', 5);
        })->where('company_id', '!=', Auth::user()->company_user->company_id)->whereNotExists(function ($query) use($users_comapny){
            $query->select('vacancy_users.*')->from('vacancy_users')
            ->whereIn('supplier_user_id',$users_comapny)->whereRaw('vg_vacancy_users.vacancy_id = vg_vacancies.id');
        })->join('companies', function($join)
        {
            $join->on('vacancies.company_id', '=', 'companies.id');
        })->orderBy('category_id', 'DESC')->orderBy('vacancies.created_at', 'desc')->get();
        return $this->orderVacancies($vacancies, $paginate);
    }

    public function getById($vacancies)
    {
        $data = [];
        foreach ($vacancies as $v){
            $data[$v->id] = $v;
        }
        return $data;
    }

    public function orderVacancies($vacancies, $paginate, $request = null)
    {
        $results = [];
        $country_id = Auth::user()->country_id;
        $vacancies = $this->getById($vacancies);
        //ordenar por paises
        if($request==null || !isset($request['country_id'])) {
            foreach ($vacancies as $v) {
                if ($v->country_id == $country_id) {
                    $results[] = $v;
                    unset($vacancies[$v->id]);
                }
            }
        }
        //ordenar por industrias
        if($request==null || !isset($request['industry'])){
            $industries = $this->getIndustriesLogedUser();
            foreach($vacancies as $v){
                if(in_array($v->industry, $industries)){
                    $results[] = $v;
                    unset($vacancies[$v->id]);
                }
            }
        }
        if($request!=null && isset($request['page'])){
            $results = array_slice(array_merge($results, $vacancies), ($request['page'] - 1) * $paginate, $paginate);
        } else {
            $results = array_slice(array_merge($results, $vacancies), 0, $paginate);
        }
        return $results;
    }

    public function getIndustriesLogedUser()
    {
        $data = [];
        $company = Auth::user()->company()->get()->first();
        $experience = $company->experience()->get()->first();
        foreach($experience->industries_all()->get() as $ind){
            $data[] = $ind->industry_id;
        }
        return $data;
    }

}