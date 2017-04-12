<?php

namespace Vanguard\Http\Controllers;

use Illuminate\Http\Request;
use Vanguard\Http\Requests;
use Vanguard\Testimonial;
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
        $viewed = new VacancyViewedRepository(new VacancyViewed());
        $supplier = Testimonial::where('recommended_user_id', \Auth::user()->id)
            ->where('type','supplier')->orderBy('created_at')->get();
        $poster = Testimonial::where('recommended_user_id', \Auth::user()->id)
            ->where('type','poster')->orderBy('created_at')->get();
        return view('dashboard_user.calification.index', compact('poster', 'supplier', 'viewed'));
    }
}
