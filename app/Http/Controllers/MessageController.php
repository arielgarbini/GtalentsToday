<?php

namespace Vanguard\Http\Controllers;

use Illuminate\Http\Request;
use Vanguard\Http\Requests;
use Vanguard\Repositories\Message\MessageRepository;
use Vanguard\Repositories\ConversationRepository;
use Auth;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Message;
use Vanguard\Vacancy;
use Vanguard\User;
use Vanguard\Events\NotificationEvent;

class MessageController extends Controller
{
    private $users;

    private $messages;

    private $conversation;

    public function __construct(MessageRepository $messages, UserRepository $users, ConversationRepository $conversation)
    {     
       // $this->middleware('permission:messages.manage');
        $this->users = $users;
        $this->messages = $messages;
        $this->conversation = $conversation;
    }

    public function indexFrontend () {
        $user_id = Auth::user()->id;
        $conversations = Vacancy::with('conversations')->whereHas('conversations', function ($query) use($user_id){
            $query->where('destinatary_user_id', $user_id)->orWhere('sender_user_id', $user_id);
        })->get();
        $data = [];
        $i = 0;
        foreach($conversations as $conver){
            $data[] = $conver;
            $j = 0;
            foreach($conver->conversations as $con){
                $userP = ($con->sender_user_id != $user_id) ? $con->sender_user_id : $con->destinatary_user_id;
                $data[$i]['conversations'][$j]['code'] = User::find($userP)->code;
                $j++;
            }
            $i++;
        }
        $conversations = (object) $data;
        return view('dashboard_user.message.index', compact('conversations','user_id'));
    }

    public function getMessages($id)
    {
        $data = [];
        foreach(Message::where('conversation_id', $id)->orderBy('created_at', 'desc')->get() as $messages){
            $data[] = ['sender_user_id' => $messages->sender_user_id, 'destinatary_user_id' => $messages->destinatary_user_id,
                'created_at' => $messages->created_at->diffForHumans(), 'message' => $messages->message];
        }
        return $data;
    }

    public function PostMessages(Request $request)
    {
        $data = [
            'sender_user_id' => Auth::user()->id,
            'destinatary_user_id' => $request->destinatary,
            'message' => $request->message,
            'status' => 1,
            'conversation_id' => $request->conversation
        ];

        Message::create($data);

        $userCode = User::find(Auth::user()->id)->code;

        event(new NotificationEvent(['element_id' => $request->conversation,
            'user_id'=>$request->destinatary, 'type' => 'message_received', 'name'=>$userCode]));

        return redirect()->back()
            ->withSuccess(trans('app.message_created'));
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
