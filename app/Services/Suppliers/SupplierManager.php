<?php

namespace Vanguard\Services\Suppliers;

use Illuminate\Support\Facades\Auth;
use Vanguard\Company;
use Vanguard\User;
use Vanguard\VacancyUser;

class SupplierManager
{
    public function getRecommended($id = null, $paginate, $exclude = [], $vacancy_id)
    {
        $company_id = Auth::user()->company()->get()->first()->id;
        $supliers_recommended = User::where('id','!=',Auth::user()->id)->whereNotExists(function($query) use($id){
            $query->select('vacancy_users.*')->from('vacancy_users')
                ->where('vacancy_id', $id)
                ->whereRaw('vg_vacancy_users.supplier_user_id = vg_users.id');
        })->whereHas('company_user', function($q) use($company_id){
            $q->where('company_id', '!=', $company_id);
        })->with('company.category')->whereNotIn('id',$exclude)->get();
        return $this->orderSuppliers($supliers_recommended, $paginate, null, $vacancy_id);
    }

    public function getSuppliersSearch($data = [])
    {
        $company_id = Auth::user()->company()->get()->first()->id;
        $supliers_recommended = User::where('id','!=',Auth::user()->id)->whereNotExists(function($query) use($id){
            $query->select('vacancy_users.*')->from('vacancy_users')
                ->where('vacancy_id', $id)->whereRaw('vg_vacancy_users.supplier_user_id = vg_users.id');
        })->whereHas('company_user', function($q) use($company_id){
            $q->where('company_id', '!=', $company_id);
        })->with('company.category')->get();
    }

    public function getPostInteresting($id)
    {
        return VacancyUser::where('vacancy_id', $id)->where('status',0)->get();
    }

    public function getById($suppliers, $vacancy_id)
    {
        $data = [];
        $vacancy_user = VacancyUser::where('vacancy_id', $vacancy_id)->get();
        $companies = [];
        foreach ($vacancy_user as $va){
            $companies[] = $va->supplier->company_user->company_id;
        }
        foreach ($suppliers as $v){
            if(!in_array($v->company_user->company_id, $companies)){
                $data[$v->id] = $v;
            }
        }
        return $data;
    }

    public function orderSuppliers($suppliers, $paginate, $request = null, $vacancy_id)
    {
        $results = [];
        $country_id = Auth::user()->country_id;
        $suppliers = $this->getById($suppliers, $vacancy_id);
        //ordenar por paises
        if($request==null || !isset($request['country_id'])) {
            foreach ($suppliers as $v) {
                if ($v->country_id == $country_id) {
                    $results[] = $v;
                    unset($suppliers[$v->id]);
                }
            }
        }
        //ordenar por industrias
        if($request==null || !isset($request['industry'])){
            $industries = $this->getIndustriesLogedUser();
            foreach($suppliers as $v){
                $ind = $this->getIndustriesUser($v->id);
                foreach($ind as $i){
                    if(in_array($i, $industries)){
                        $results[] = $v;
                        unset($suppliers[$v->id]);
                        break;
                    }
                }
            }
        }
        if($request!=null && isset($request['page'])){
            $results = array_slice(array_merge($results, $suppliers), ($request['page'] - 1) * $paginate, $paginate);
        } else {
            $results = array_slice(array_merge($results, $suppliers), 0, $paginate);
        }
        return $results;
    }

    public function orderSupplierSearch($suppliers, $paginate, $request = null, $vacancy_id)
    {
        $results = [];
        $country_id = Auth::user()->country_id;
        $suppliers = $this->getById($suppliers, $vacancy_id);
        //ordenar por paises
        if($request==null || !isset($request['country_id'])) {
            foreach ($suppliers as $v) {
                if ($v->country_id == $country_id) {
                    $results[] = $v;
                    unset($suppliers[$v->id]);
                }
            }
        }
        //ordenar por industrias
        if($request==null || !isset($request['industry'])){
            $industries = $this->getIndustriesLogedUser();
            foreach($suppliers as $v){
                $ind = $this->getIndustriesUser($v->id);
                foreach($ind as $i){
                    if(in_array($i, $industries)){
                        $results[] = $v;
                        unset($suppliers[$v->id]);
                        break;
                    }
                }
            }
        }
        if($request!=null && isset($request['page'])){
            $results = array_slice(array_merge($results, $suppliers), ($request['page'] - 1) * $paginate, $paginate);
        } else {
            $results = array_slice(array_merge($results, $suppliers), 0, $paginate);
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

    public function getIndustriesUser($user)
    {
        $data = [];
        $user = User::where('id', $user)->with('company')->get()->first();
        $company = $user->company[0];
        $experience = $company->experience()->get()->first();
        if($experience){
            foreach($experience->industries_all()->get() as $ind){
                $data[] = $ind->industry_id;
            }
        }
        return $data;
    }
}