<?php

namespace Vanguard\Http\Controllers;

use Illuminate\Http\Request;
use Vanguard\Http\Requests;
use Vanguard\Repositories\Message\MessageRepository;
use Auth;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Message;

class MessageController extends Controller
{
    public function __construct(MessageRepository $messages, UserRepository $users)
    {     
       // $this->middleware('permission:messages.manage');
        $this->users = $users;
        $this->messages = $messages;
    }

    public function index () {
    	$user_id = Auth::user()->id;
       	$messages = $this->messages->all()->where('destinatary_user_id', $user_id);
        $users = $this->users->lists();
    	return view('message.index', compact('messages','users'));		
        
    }

    public function store(Request $request){

        $user_id        = Auth::user()->id;
        $data       = $request->all() ;
        $messages   = $this->messages->create($data);

         return redirect()->route('messages.index')
            ->withSuccess(trans('app.message_created'));
    }

    public function details($id){
        $message = $this->messages->find($id);
        return View('message.details', compact('message'));    
    }
}
