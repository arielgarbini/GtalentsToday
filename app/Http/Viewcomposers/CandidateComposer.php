<?php

namespace Vanguard\Http\ViewComposers;

use Illuminate\View\View;
use Vanguard\ActualPositionCandidate;
use Vanguard\Company;
use Vanguard\Country;
use Vanguard\Compensation;

class CandidateComposer
{
    public function compose(View $view)
    {
        if (session('lang') =='en'){
            $language = 2;
        }else{
            $language = 1;
        }

        $positions = ActualPositionCandidate::where('language_id', $language)->orderBy('name')->lists('name', 'value_id')->all();
        $companies = Company::orderBy('name')->lists('name', 'id')->all();
        $countries = Country::orderBy('name', 'asc')->lists('name', 'id')->all();
        $compensations = Compensation::orderBy('id')->lists('salary', 'id')->all();

        $view->with('positions', $positions);
        $view->with('companies_candidates', $companies);
        $view->with('countries', $countries);
        $view->with('compensations', $compensations);
    }
}