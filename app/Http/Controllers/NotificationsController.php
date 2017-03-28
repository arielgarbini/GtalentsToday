<?php

namespace Vanguard\Http\Controllers;

use Illuminate\Http\Request;
use Vanguard\Http\Requests;
use Vanguard\Notification;

class NotificationsController extends Controller
{

    public function delete($id)
    {
        Notification::destroy($id);
        return redirect()->back();
    }

}
