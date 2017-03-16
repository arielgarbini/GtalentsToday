<?php

namespace Vanguard\Http\Controllers;

use Auth;
use Cache;
use Illuminate\Http\Request;
use Vanguard\Repositories\Country\CountryRepository;
use Vanguard\Http\Requests;

class CountryController extends Controller
{
    /**
     * @var CountryRepository
     */
    private $countries;

    /**
     * VacancyController constructor.
     * @param VacancyRepository $vacancies)
     */
    public function __construct(CountryRepository $countries)
    {
        $this->middleware('registration', ['only' => ['confirmData']]);
        $this->countries = $countries;
    }

     /**
     * getProvinceByCountry
     *
     * Gets provinces by country 
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function getProvinceByCountry(Request $request)
    {
        $country = $this->countries->find($request->get('country'));
        
        return response()->json($country->states->toArray());
    }
}
