<?php

namespace Vanguard\Listeners;

use Vanguard\Notification;
use Illuminate\Support\Facades\Auth;
use Vanguard\Repositories\NotificationRepository;
use Vanguard\Events\NotificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationEventsSuscriber implements ShouldQueue
{
    protected $notification;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(NotificationRepository $notification)
    {
        $this->notification = $notification;
    }

    public function handle($event)
    {
        $dataRequest = $event->getData();
        $data = $this->getDataType($dataRequest);
        $this->notification->create(['element_id' =>$dataRequest['element_id'], 'user_id' => $dataRequest['user_id'],
            'type' => $dataRequest['type'], 'title'=>$data['title'], 'message' => $data['message'], 'read' => 0]);
    }

    public function getDataType($dataRequest)
    {
        switch($dataRequest['type']){
            case 'request_supplier_vacancy':
                $data =  ['title' => 'title_supplier__'.Auth::user()->code, 'message' =>'request_supplier_vacancy__'.$dataRequest['name']];
            break;
            case 'invited_supplier_vacancy':
                $data =  ['title' => 'title_invited_supplier', 'message' =>'invited_supplier_vacancy__'.$dataRequest['name']];
            break;
            case 'approved_supplier_vacancy':
                $data =  ['title' => 'title_approved_supplier', 'message' =>'approved_supplier_vacancy__'.$dataRequest['name']];
            break;
            case 'rejected_supplier_vacancy':
                $data =  ['title' => 'title_rejected_supplier', 'message' =>'rejected_supplier_vacancy__'.$dataRequest['name']];
            break;
            case 'approved_supplier_invited_vacancy':
                if(isset($dataRequest['user'])){
                    $data =  ['title' => 'title_supplier__'.$dataRequest['user'], 'message' =>'approved_supplier_invited_vacancy__'.$dataRequest['name']];
                } else {
                    $data =  ['title' => 'title_supplier__'.Auth::user()->code, 'message' =>'approved_supplier_invited_vacancy__'.$dataRequest['name']];
                }
            break;
            case 'rejected_supplier_invited_vacancy':
                $data =  ['title' => 'title_supplier__'.Auth::user()->code, 'message' =>'rejected_supplier_invited_vacancy__'.$dataRequest['name']];
            break;
            case 'request_supplier_candidates':
                $data =  ['title' => 'title_candidates', 'message' =>'request_supplier_candidates__'.$dataRequest['name']];
            break;
            case 'rejected_supplier_candidate':
                $data =  ['title' => 'title_rejected_candidates', 'message' =>'rejected_supplier_candidate__'.$dataRequest['name']];
            break;
            case 'approbate_supplier_candidate':
                $data =  ['title' => 'title_approved_candidates', 'message' =>'approbate_supplier_candidate__'.$dataRequest['name']];
            break;
            case 'message_received':
                $data =  ['title' => 'title_message_received', 'message' =>'message_received__'.$dataRequest['name']];
            break;
            case 'qualify_supplier_vacancy':
                $data =  ['title' => 'title_qualify_supplier_vacancy', 'message' =>'qualify_supplier_vacancy__'];
            break;
            case 'qualify_supplier_vacancy_contract':
                $data =  ['title' => 'title_qualify_supplier_vacancy_contract', 'message' =>'qualify_supplier_vacancy_contract__'.$dataRequest['name']];
            break;
            case 'get_points':
                $data =  ['title' => 'title_get_points', 'message' =>'get_points__'.$dataRequest['name'].'__points'];
            break;
            case 'promotion_received':
                $data =  ['title' => 'title_promotion_received', 'message' =>'promotion_received__'.$dataRequest['name']];
            break;
            case 'vacancy_change_status_paused':
                $data =  ['title' => 'title_change_status', 'message' =>'change_status_paused__'.$dataRequest['name']];
            break;
            case 'vacancy_change_status_closed':
                $data =  ['title' => 'title_change_status', 'message' =>'change_status_closed__'.$dataRequest['name']];
            break;
        }

        return $data;
    }

    /**
     * Handle the event.
     *
     * @param  NotificationEvent  $event
     * @return void
     */
    /*public function handle(NotificationEvent $event)
    {
        $vacancy = $event->getVacancy();
        $this->notification->create(['element_id' => $vacancy->id, 'user_id'=> $vacancy->poster_user_id,
            'type'=>'add_supplier', 'message' => 'hola']);
    }*/

    /*public function subscribe($events)
    {
        $events->listen(NotificationEvent::class, 'Vanguard\Listeners\NotificationEventsSuscriber@onCreateNotification');

    }*/
}
