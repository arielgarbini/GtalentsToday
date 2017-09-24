<?php

namespace Vanguard\Http\Controllers;

use Illuminate\Http\Request;
use Vanguard\Http\Requests;
use Vanguard\Testimonial;
use Vanguard\Vacancy;
use Vanguard\VacancyViewed;
use Vanguard\Repositories\VacancyViewedRepository;

class CalificationsController extends Controller
{
    protected $viewed;

    public function _construct(VacancyViewedRepository $viewed)
    {
        $this->viewed = $viewed;
    }

    public function index()
    {
        $user_id = \Auth::user()->id;
        $viewed = new VacancyViewedRepository(new VacancyViewed());
        $supplier = Vacancy::with('testimonials')->whereHas('testimonials', function($q) use($user_id) {
            $q->where('recommended_user_id', $user_id);
            $q->where('type', 'supplier');
        })->orderBy('vacancies.created_at','desc')->get();
        $poster = Vacancy::with('testimonials')->whereHas('testimonials', function($q) use($user_id) {
            $q->where('recommended_user_id', $user_id);
            $q->where('type', 'poster');
        })->orderBy('vacancies.created_at','desc')->get();
        foreach ($poster as $r){
            $r->testimonials = Testimonial::where('vacancy_id', $r->id)
                ->where('type','poster')->where('recommended_user_id', $user_id)->get();
        }
        foreach ($supplier as $r){
            $r->testimonials = Testimonial::where('vacancy_id', $r->id)
                ->where('type','supplier')->where('recommended_user_id', $user_id)->get();
        }
        return view('dashboard_user.calification.index', compact('poster', 'supplier', 'viewed'));
    }
}
