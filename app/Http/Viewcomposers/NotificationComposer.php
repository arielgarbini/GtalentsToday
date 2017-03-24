<?php

namespace Vanguard\Http\ViewComposers;

use Illuminate\View\View;
use Vanguard\VacancyUser;

class NotificationComposer
{
    public function compose(View $view)
    {
        if(\Auth::user()) {
            $data = [];
            $i = 0;
            foreach(\Auth::user()->notifications as $notification){
                $data[] = $notification;
                if($notification->type=='request_supplier_vacancy'){
                    $vacancyUser = VacancyUser::find($notification->element_id);
                    $data[$i]['post_id'] = $vacancyUser->vacancy_id;
                    $data[$i]['supplier_id'] = $vacancyUser->supplier_user_id;
                }
            }
            $view->with('notifications',(object) $data);
        }
    }
}