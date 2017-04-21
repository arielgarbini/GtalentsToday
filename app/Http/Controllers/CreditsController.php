<?php

namespace Vanguard\Http\Controllers;

use Illuminate\Http\Request;
use Vanguard\Balance;
use Vanguard\Http\Requests;
use Vanguard\Repositories\CreditRepository;
use Vanguard\Services\Paypal\PaypalService;

use Vanguard\Vacancy;


class CreditsController extends Controller
{

    protected $paypalService;

    protected $credit;

    public function __construct(PaypalService $paypalService, CreditRepository $credit)
    {
        $this->paypalService = $paypalService;
        $this->credit = $credit;
    }

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
        $credits = Balance::where('company_id', \Auth::user()->company_user->company_id)->get();
        return view('dashboard_user.credit.index', compact('credits', 'latestVacanciesSupplier','latestVacanciesPoster','potentialSupplier','potentialPoster'));
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
