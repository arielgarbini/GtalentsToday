<?php

namespace Vanguard\Http\ViewComposers;

use Illuminate\View\View;
use Vanguard\ContractType;
use Vanguard\ExperienceYear;
use Vanguard\ReplacementPeriod;
use Vanguard\FunctionalArea;
use Vanguard\VacancyUser;
use Vanguard\VacancyCandidate;
use Vanguard\ActualPosition;
use Vanguard\Repositories\VacancyViewedRepository;

class VacancyComposer
{
    private $vacancy_viewed;

    public function __construct(VacancyViewedRepository $vacancy_viewed)
    {
        $this->vacancy_viewed = $vacancy_viewed;
    }

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
        $candidatesApproved = VacancyCandidate::where('vacancy_id', $vacancy->id)->where('status','Active')->get();
        $candidatesRejected = VacancyCandidate::where('vacancy_id', $vacancy->id)->where('status','Rejected')->get();
        $candidatesUnRead = VacancyCandidate::where('vacancy_id', $vacancy->id)
            ->where('status', '!=' ,'Active')->where('status', '!=' ,'Rejected')->get();
        $candidatesUnReadCount = VacancyCandidate::where('vacancy_id', $vacancy->id)->where('status' ,'Unconfirmed')->get();
        $data = [];
        $i = 0;
        foreach ($candidatesUnRead as $can){
                $data[] = $can->candidate;
                $data[$i]['actual_position'] = ActualPosition::where('value_id', $data[$i]['actual_position_id'])
                    ->where('language_id', $language)->get()->first()->name;
                $i++;
        }
        $candidatesUnRead = $data;
        $data = [];
        $i = 0;
        foreach ($candidatesApproved as $can){
            $data[] = $can->candidate;
            $data[$i]['actual_position'] = ActualPosition::where('value_id', $data[$i]['actual_position_id'])
                ->where('language_id', $language)->get()->first()->name;
            $i++;
        }
        $candidatesApproved = $data;
        preg_match_all('/\d{1,2}/' ,$vacancy->range_salary, $matches);
        $factura = (intval($matches[0][0].'000')+intval($matches[0][1].'000'))/2;
        $factura = number_format($factura, 2, '.', ',');

        $viewed = $this->vacancy_viewed->search(['vacancy_id' => $vacancy->id])->count();
        $vacancy->location = $vacancy->locat->country->name.' / '.$vacancy->locat->name;
        $view->with('viewed', $viewed);
        $view->with('candidatesUnReadCount', $candidatesUnReadCount);
        $view->with('candidatesUnRead', $candidatesUnRead);
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