<?php

namespace Vanguard\Http\Controllers;

use Illuminate\Http\Request;
use Vanguard\Http\Requests;
use Vanguard\VacancyCandidate;
use Vanguard\Candidate;
use Vanguard\Invoice;
use Vanguard\Testimonial;
use Vanguard\Events\NotificationEvent;
use Vanguard\Notification;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard_user.supplier.index');
    }

    public function calificationSupplier(Request $request, $id)
    {
        $vacancy_user = VacancyCandidate::find($id);
        $candidate = Candidate::where('id', $vacancy_user->candidate_id)->get()->first();
        $invoices = Invoice::where('vacancy_id', $vacancy_user->vacancy_id)
            ->where('supplier_user_id', $candidate->supplier_user_id)->where('candidate_id', $candidate->id)->get()->first();
        $date_of_admission = explode('-', $invoices->date_of_admission);
        $date_of_admission = $date_of_admission[2].'/'.$date_of_admission[1].'/'.$date_of_admission[0];
        return view('dashboard_user.supplier.calification_supplier', compact('candidate', 'id', 'invoices', 'date_of_admission'));
    }

    public function calificationSupplierStore(Request $request, $id)
    {
        $vacancy_user = VacancyCandidate::find($id);
        $candidate = Candidate::where('id', $vacancy_user->candidate_id)->get()->first();

        $data = [
            'recommended_user_id' => $vacancy_user->vacacy->poster_user_id,
            'recommended_by_user_id' => \Auth::user()->id,
            'testimony'             => $request->comments_poster,
            'type'                  => 'poster',
            'vacancy_id'            => $vacancy_user->vacancy_id,
            'point'                 => $request->rating,
            'is_active'             => 1
        ];

        Testimonial::create($data);
        $vacancy_user = VacancyCandidate::where('vacancy_id', $vacancy_user->vacancy_id)
            ->where('candidate_id', $candidate->id)->get()->first();

        event(new NotificationEvent(['element_id' => $vacancy_user->id,
            'user_id'=>$vacancy_user->vacacy->poster_user_id, 'type' => 'qualify_supplier_vacancy', 'name'=>$vacancy_user->vacacy->name]));

        return redirect()->route('dashboard')
            ->withSuccess(trans('app.rating_submitted'));
    }
}
