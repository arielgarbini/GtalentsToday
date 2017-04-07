<?php

namespace Vanguard\Http\Controllers;

use Illuminate\Http\Request;
use Vanguard\Http\Requests;
use Vanguard\Invoice;

class InvoicesController extends Controller
{
    public function index()
    {
        $pay = Invoice::where('poster_user_id', \Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $charge = Invoice::where('supplier_user_id', \Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('dashboard_user.invoice.index', compact('pay', 'charge'));
    }
}
