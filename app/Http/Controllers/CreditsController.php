<?php

namespace Vanguard\Http\Controllers;

use Illuminate\Http\Request;
use Vanguard\Balance;
use Vanguard\Company;
use Vanguard\Credit;
use Vanguard\Http\Requests;
use Vanguard\Repositories\CreditRepository;
use Vanguard\Services\Paypal\PaypalService;

use Vanguard\Setting;
use Vanguard\Vacancy;
use Vanguard\VacancyCandidate;


class CreditsController extends Controller
{

    protected $paypalService;

    protected $credit;

    public function __construct(PaypalService $paypalService, CreditRepository $credit)
    {
        $this->paypalService = $paypalService;
        $this->credit = $credit;
    }

    public function lists()
    {
        $last_credit = Credit::orderby('created_at', 'desc')->get()->first();
        $candidate_price = Setting::where('key', 'candidate_price')->get()->first();
        $credits = Balance::orderBy('created_at', 'desc')->get();
        $companies = ['' => \Lang::get('app.choose_option')];
        foreach(Company::all() as $c){
            $companies[$c->id] = $c->name;
        }
        return view('credits.index', compact('credits', 'companies', 'last_credit', 'candidate_price'));
    }

    function storePriceCandidate(Request $request)
    {
        $sc = Setting::where('key', 'candidate_price')->get()->first();
        $sc->value = intval($request->credits);
        $sc->update();
        return redirect()->route('credits.list')->withSuccess(trans('app.credit_add_candidate'));
    }

    public function store(Request $request)
    {
        /*$validator = \Validator::make(
            ['company_id' => 'required|number']
            //['credits' => 'required|number']
        );*//*
        if ($validator->fails()) {
            return redirect()->route('credits.list')->withSuccess(trans('app.credit_not_saved'));
        }*/
        if(isset($request->status)){
            $status = $request->status;
        } else {
            $status = (intval($request->credits)<0) ? 3 : 1;
        }
        Balance::create(['company_id' => $request->company_id, 'credit' => $request->credits,
        'status'=>$status]);

        return redirect()->route('credits.list')->withSuccess(trans('app.credit_add'));
    }

    public function storePrice(Request $request)
    {
        /*$validator = \Validator::make(
            ['credits' => 'required']
        );*//*
        if ($validator->fails()) {
            return redirect()->route('credits.list')->withError(trans('app.credit_not_saved'));
        }*/
        Credit::create(['value' =>$request->credits]);
        return redirect()->route('credits.list')->withSuccess(trans('app.credit_updated'));
    }

    public function delete($id)
    {
        $credit = Balance::find($id);

        $credit->delete();

        return redirect()->route('credits.list')
            ->withSuccess(trans('app.credit_deleted'));
    }

    public function update(Request $request, $id)
    {
        $balance = Balance::find($id);
        //$balance->company_id = $request->company_id;
        $balance->credit = $request->credits;
        $balance->status = (intval($request->credits)<0) ? 0 : 1;

        $balance->save();

        return redirect()->route('credits.list')->withSuccess(trans('app.credit_add_updated'));
    }

    public function index()
    {
        $user_id =  \Auth::user()->id;
        $potentialPoster = 0;
        $potentialSupplier = 0;
        $latestVacanciesPoster = Vacancy::where('company_id', '=', \Auth::user()->company_user->company_id)->where('general_conditions', '!=', '')
            ->orderBy('created_at', 'DESC')->where(function($q){
                $q->where('vacancy_status_id', 1);
                $q->orWhere('vacancy_status_id', 5);
            })->get();
        $vacanciesPoster = [];
        foreach($latestVacanciesPoster as $vacancy){
            $vacanciesPoster[] = $vacancy->id;
            if($vacancy->group1==1) {
                preg_match_all('/\d{1,3}/' ,$vacancy->range_salary, $matches);
                $factur = (intval($matches[0][0].'000')+intval($matches[0][1].'000'))/2;
                $factur = ($vacancy->fee * $factur) / 100;
                $potentialPoster += $factur;
            } else {
                $potentialPoster += intval($vacancy->fee);
            }
        }
        $users_company = [];
        foreach(\Auth::user()->company_user->company->users as $u) {
            $users_company[] = $u->id;
        }
        $candidatePoster = VacancyCandidate::whereIn('vacancy_id', $vacanciesPoster)
            ->where('status','Contract')->count();
        $latestVacanciesSupplier = Vacancy::whereHas('asSupplier', function($query) use($users_company){
            $query->whereIn('supplier_user_id', $users_company)->where('status',1);
        })->where(function($q){
            $q->where('vacancy_status_id', 1);
            $q->orWhere('vacancy_status_id', 5);
        })->get();
        $vacanciesSupplier = [];
        foreach($latestVacanciesSupplier as $vacancy){
            $vacanciesSupplier[] = $vacancy->id;
            if($vacancy->group1==1) {
                preg_match_all('/\d{1,3}/' ,$vacancy->range_salary, $matches);
                $factur = (intval($matches[0][0].'000')+intval($matches[0][1].'000'))/2;
                $factur = ($vacancy->fee * $factur) / 100;
                $potentialSupplier += $factur;
            } else {
                $potentialSupplier += intval($vacancy->fee);
            }
        }
        $candidateSupplier = VacancyCandidate::whereIn('vacancy_id', $vacanciesSupplier)
            ->where('status','Contract')->count();
        $credits = Balance::where('company_id', \Auth::user()->company_user->company_id)
            ->orderby('created_at', 'desc')->get();
        return view('dashboard_user.credit.index', compact('candidatePoster', 'candidateSupplier', 'credits', 'latestVacanciesSupplier','latestVacanciesPoster','potentialSupplier','potentialPoster'));
    }

    public function getDetailsPayment(Request $request)
    {
        $credits = $this->credit->last()->value;
        $value_credits = floatval($credits) * $request->credits;
        return response()->json(['value' => $value_credits]);
    }

    public function getDetailsPaymentPaypal(Request $request)
    {
        $credits = $this->credit->last()->value;
        if($payment = $this->paypalService->initPay($request->credits, $credits)){
            return response()->json(['link' => $payment->getApprovalLink()]);
        } else {
            return response()->json(['error' => 'error'], 500);
        }

    }

    public function getPaymentSuccess(Request $request, $amount)
    {
        $credits = $this->credit->last()->value;
        if($payment = $this->paypalService->pay($request->paymentId, $amount)){
            $balance = New Balance();
            $balance->company_id = \Auth::user()->company_user->company_id;
            $balance->credit = $amount / $credits;
            $balance->save();
            return view('dashboard_user.credit.success', compact('balance'));
        } else {
            return view('dashboard_user.credit.error');
        }
    }

    public function getPaymentCancel(Request $request)
    {
        return view('dashboard_user.credit.cancel');
    }

}
