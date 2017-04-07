<?php

namespace Vanguard\Http\Controllers;

use Illuminate\Http\Request;
use Vanguard\Http\Requests;

use Vanguard\Vacancy;

class CreditsController extends Controller
{
    public function index()
    {
        $user_id =  \Auth::user()->id;
        $potentialPoster = 0;
        $potentialSupplier = 0;
        $latestVacanciesPoster = Vacancy::where('poster_user_id', '=', \Auth::user()->id)->where('general_conditions', '!=', '')
            ->orderBy('created_at', 'DESC')->get();
        foreach($latestVacanciesPoster as $vacancy){
            preg_match_all('/\d{1,2}/' ,$vacancy->range_salary, $matches);
            $factur = (intval($matches[0][0].'000')+intval($matches[0][1].'000'))/2;
            $potentialPoster += $factur;
        }
        $latestVacanciesSupplier = Vacancy::whereHas('asSupplier', function($query) use($user_id){
            $query->where('supplier_user_id', $user_id)->where('status',1);
        })->get();
        foreach($latestVacanciesSupplier as $vacancy){
            preg_match_all('/\d{1,2}/' ,$vacancy->range_salary, $matches);
            $factur = (intval($matches[0][0].'000')+intval($matches[0][1].'000'))/2;
            $potentialSupplier += $factur;
        }
        return view('dashboard_user.credit.index', compact('latestVacanciesSupplier','latestVacanciesPoster','potentialSupplier','potentialPoster'));
    }
}
