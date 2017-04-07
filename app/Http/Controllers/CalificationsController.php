<?php

namespace Vanguard\Http\Controllers;

use Illuminate\Http\Request;
use Vanguard\Http\Requests;

class CalificationsController extends Controller
{
    public function index()
    {
        return view('dashboard_user.calification.index');
    }
}
