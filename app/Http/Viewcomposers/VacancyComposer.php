<?php

namespace Vanguard\Http\ViewComposers;

use Illuminate\View\View;
use Vanguard\ContractType;
use Vanguard\ExperienceYear;
use Vanguard\ReplacementPeriod;
use Vanguard\FunctionalArea;
use Vanguard\VacancyUser;
use Vanguard\VacancyCandidate;

class VacancyComposer
{
    public function compose(View $view)
    {
        if (session('lang') =='en'){
            $language = 2;
        }else{
            $language = 1;
        }
        $vacancy = $view->getData()['vacancy'];
        $contract = ContractType::where('value_id', $vacancy->contract_type_id)->where('language_id', $language)->get()->first();
        $experiencie = ExperienceYear::where('value_id', $vacancy->contract_type_id)->where('language_id', $language)->get()->first();
        $replacementPeriod = ReplacementPeriod::where('value_id', $vacancy->contract_type_id)->where('language_id', $language)->get()->first();
        $functionalArea = FunctionalArea::where('value_id', $vacancy->contract_type_id)->where('language_id', $language)->get()->first();
        $suppliers = VacancyUser::where('vacancy_id', $vacancy->id)->where('status',1)->get();
        $candidatesApproved = VacancyCandidate::where('vacancy_id', $vacancy->id)->where('status',1)->get();
        $candidatesRejected = VacancyCandidate::where('vacancy_id', $vacancy->id)->where('status',0)->get();
        preg_match_all('/\d{1,2}/' ,$vacancy->range_salary, $matches);
        $factura = (intval($matches[0][0].'000')+intval($matches[0][1].'000'))/2;
        $factura = number_format($factura, 2, '.', ',');


        $view->with('candidatesApproved', $candidatesApproved);
        $view->with('candidatesRejected', $candidatesRejected);
        $view->with('suppliers', $suppliers);
        $view->with('factura', $factura);
        $view->with('contract', $contract);
        $view->with('experiencie', $experiencie);
        $view->with('replacementPeriod', $replacementPeriod);
        $view->with('functionalArea', $functionalArea);
    }
}