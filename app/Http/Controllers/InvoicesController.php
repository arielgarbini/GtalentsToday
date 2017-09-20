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

    public function lists()
    {
        $invoices = Invoice::orderBy('created_at', 'desc')->get();
        return view('invoices.index', compact('invoices'));
    }

    public function edit($id)
    {
        $invoice = Invoice::find($id);

        if (session('lang') =='en')
            $language = 2;
        else
            $language = 1;
        $edit = true;
        return view('invoices.edit', compact('edit', 'invoice'));
    }

    public function delete($id)
    {
        $invoice = Invoice::find($id);

        $invoice->delete();

        return redirect()->route('invoices.list')
            ->withSuccess(trans('app.invoice_deleted'));
    }
}
