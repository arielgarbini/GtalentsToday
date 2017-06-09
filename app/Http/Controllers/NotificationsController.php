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

    public function read()
    {
        Notification::where('user_id', \Auth::user()->id)->where('read',0)->update(['read' => 1]);
        return response()->json(['success' => 'success']);
    }

}
