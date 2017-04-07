<?php

namespace Vanguard\Http\Controllers;

use Illuminate\Http\Request;
use Vanguard\Http\Requests;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard_user.supplier.index');
    }
}
