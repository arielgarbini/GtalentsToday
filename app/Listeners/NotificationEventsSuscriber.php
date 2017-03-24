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
                $data =  ['title' => 'Supplier '.Auth::user()->code, 'message' =>'Quiere participar en '.$dataRequest['name']];
            break;
            case 'approved_supplier_vacancy':
                $data =  ['title' => '¡Aprobado!', 'message' =>'Has sido aprobado a '.$dataRequest['name']];
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
