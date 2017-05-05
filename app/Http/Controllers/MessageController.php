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
use Vanguard\VacancyUser;
use Vanguard\Events\NotificationEvent;
use Vanguard\Events\Message\Deleted;

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
        $messagesAdminSender = Message::where('sender_user_id', $user_id)->groupBy('destinatary_user_id')->get();
        $messagesAdminDestinatary = Message::where('destinatary_user_id', $user_id)->groupBy('sender_user_id')->get();
        $messageAdminConversation = [];
        $ids = [];
        foreach($messagesAdminSender as $message){
            if(!in_array($message->destinatary_user_id, $ids)){
                $ids[] = $message->destinatary_user_id;
                $messageAdminConversation[] = $message;
            }
        }
        foreach($messagesAdminDestinatary as $message){
            if(!in_array($message->sender_user_id, $ids)){
                $ids[] = $message->sender_user_id;
                $messageAdminConversation[] = $message;
            }
        }
        $data = [];
        $i = 0;
        foreach($conversations as $conver){
            $j = 0;
            $codigos = [];
            foreach ($conver->conversations as $con) {
                $sender = $con->sender_user_id;
                $dest = $con->destinatary_user_id;
                if(VacancyUser::where('vacancy_id',$conver->id)->where(function ($query) use($sender, $dest){
                    $query->orWhere('supplier_user_id', $sender)->orWhere('supplier_user_id', $dest);
                })->where('status',1)->count()>0) {
                    $codigos[] = $con;
                    $userP = ($con->sender_user_id != $user_id) ? $con->sender_user_id : $con->destinatary_user_id;
                    //$data[$i]['conversations'][$j]['code'] = User::find($userP)->code;
                    $codigos[$j]['code'] = User::find($userP)->code;
                    $j++;
                }
            }
            if(count($codigos)>0){
                $data[] = $conver;
                $data[$i]['conversations'] = $codigos;
                $i++;
            }
        }
        $conversations = (object) $data;
        return view('dashboard_user.message.index', compact('conversations','user_id', 'messageAdminConversation'));
    }

    public function getMessages(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $data = [];
        if(isset($request->admin)){
            foreach(Message::where(function($q) use($id, $user_id){
                $q->where('destinatary_user_id', $user_id);
                $q->where('sender_user_id', $id);
            })->orWhere(function($query) use($id, $user_id) {
                $query->where('sender_user_id', $user_id);
                $query->where('destinatary_user_id', $id);
            })->orderBy('created_at', 'desc')->get() as $messages){
                $data[] = ['sender_user_id' => $messages->sender_user_id, 'destinatary_user_id' => $messages->destinatary_user_id,
                    'created_at' => $messages->created_at->diffForHumans(), 'message' => $messages->message];
            }
        } else {
            foreach(Message::where('conversation_id', $id)->orderBy('created_at', 'desc')->get() as $messages){
                $data[] = ['sender_user_id' => $messages->sender_user_id, 'destinatary_user_id' => $messages->destinatary_user_id,
                    'created_at' => $messages->created_at->diffForHumans(), 'message' => $messages->message];
            }
        }
        return $data;
    }

    public function PostMessages(Request $request)
    {
        $data = [
            'sender_user_id' => Auth::user()->id,
            'destinatary_user_id' => $request->destinatary,
            'message' => $request->message,
            'status' => 1
        ];
        if($request->conversation!='admin'){
            $data['conversation_id'] = $request->conversation;
        }
        Message::create($data);

        $userCode = User::find(Auth::user()->id)->code;

        event(new NotificationEvent(['element_id' => $request->conversation,
            'user_id'=>$request->destinatary, 'type' => 'message_received', 'name'=>$userCode]));

        return redirect()->back()
            ->withSuccess(trans('app.message_created'));
    }

    public function delete($id){
        $user = Auth::user();

        $message = Message::find($id);

        event(new Deleted($message));

        $message->delete();

        return redirect()->route('messages.index')
            ->withSuccess(trans('app.message_deleted'));
    }

    public function index (Request $request) {
    	$user_id = Auth::user()->id;
       	if(isset($request->search)){
            $messages = $this->messages->search($request->search);
        } else {
            $messages = $this->messages->all();
        }
        $users = $this->users->lists();
    	return view('message.index', compact('messages','users'));		
        
    }

    public function store(Request $request){

        $user_id        = Auth::user()->id;
        $data       = $request->all() ;
        $messages   = $this->messages->create($data);

        event(new NotificationEvent(['element_id' => 'admin',
            'user_id'=>$request->destinatary_user_id, 'type' => 'message_received', 'name'=>Auth::user()->code]));

         return redirect()->route('messages.index')
            ->withSuccess(trans('app.message_created'));
    }

    public function details($id){
        $message = $this->messages->find($id);
        return View('message.details', compact('message'));    
    }
}
