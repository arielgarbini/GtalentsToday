<?php

namespace Vanguard\Http\ViewComposers;

use Illuminate\View\View;
use Vanguard\Message;
use Vanguard\VacancyUser;

class NotificationComposer
{
    public function compose(View $view)
    {
        if(\Auth::user()) {
            $data = [];
            $i = 0;
            $unread = false;
            if(Message::where('destinatary_user_id', \Auth::user()->id)->where('status_destinatary_user', 0)->get()->first()){
                $unreadmessages = true;
            } else {
                $unreadmessages = false;
            }
            foreach(\Auth::user()->notifications as $notification){
                if($notification->read==0){
                    $unread = true;
                }
                $data[] = $notification;
                $message = explode('__',$notification->message);
                $title = explode('__',$notification->title);
                $data[$i]['message_traduccion'] = trans('app.'.$message[0]).' '.$message[1];
                $data[$i]['title_traduccion'] = trans('app.'.$title[0]);
                if(isset($title[1])){
                    $data[$i]['title_traduccion'].= ' '.$title[1];
                }
                if(isset($message[2])){
                    $data[$i]['message_traduccion'] .= ' '.trans('app.'.$message[2]);
                }
                if($notification->type=='request_supplier_vacancy'){
                    $vacancyUser = VacancyUser::find($notification->element_id);
                    $data[$i]['post_id'] = $vacancyUser->vacancy_id;
                    $data[$i]['supplier_id'] = $vacancyUser->supplier_user_id;
                }
                $i++;
            }
            $view->with('notifications',(object) $data);
            $view->with('read_notification', $unread);
            $view->with('read_messages', $unreadmessages);
        }
    }
}