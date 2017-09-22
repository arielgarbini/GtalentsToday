<?php

namespace Vanguard\Http\ViewComposers;

use Illuminate\View\View;
use Vanguard\ContractType;
use Vanguard\ExperienceYear;
use Vanguard\LanguageVacancy;
use Vanguard\ReplacementPeriod;
use Vanguard\FunctionalArea;
use Vanguard\User;
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
        $userCategorie = User::find($vacancy->poster_user_id)->company[0]->category;
        $contract = ContractType::where('value_id', $vacancy->contract_type_id)->where('language_id', $language)->get()->first();
        $experiencie = ExperienceYear::where('value_id', $vacancy->contract_type_id)->where('language_id', $language)->get()->first();
        $replacementPeriod = ReplacementPeriod::where('value_id', $vacancy->contract_type_id)->where('language_id', $language)->get()->first();
        $functionalArea = FunctionalArea::where('value_id', $vacancy->contract_type_id)->where('language_id', $language)->get()->first();
        $suppliers = VacancyUser::where('vacancy_id', $vacancy->id)->where('status',1)->get();
        $candidatesApproved = VacancyCandidate::where('vacancy_id', $vacancy->id)
            ->where('status','!=','Unconfirmed')->where('status','!=','Rejected')->get();
        $candidatesRejected = VacancyCandidate::where('vacancy_id', $vacancy->id)
            ->where('status','Rejected')->get();
        $candidatesUnRead = VacancyCandidate::where('vacancy_id', $vacancy->id)->where('status', 'Unconfirmed')->get();
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
        try{
            if($vacancy->group1==1) {
                preg_match_all('/\d{1,3}/' ,$vacancy->range_salary, $matches);
                $factura = (intval($matches[0][0].'000')+intval($matches[0][1].'000'))/2;
                $factura = ($vacancy->fee * $factura) / 100;
                $factura = number_format($factura, 2, '.', ',');
            } else {
                $factura = $vacancy->fee;
            }
        } catch (\Exception $e){
            $factura = '';
        }

        $viewed = $this->vacancy_viewed->search(['vacancy_id' => $vacancy->id])->count();
        $vacancy->location = $vacancy->country->name.' / '.$vacancy->state->name;
        if($vacancy->city){
            $vacancy->location .= ' / '.$vacancy->city->name;
        }
        $languages = LanguageVacancy::where('vacancy_id', $vacancy->id)->get();

        $view->with('userCategorie', $userCategorie);
        $view->with('languages', $languages);
        $view->with('language', $language);
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