<?php

namespace Vanguard\Repositories;

use Vanguard\Conversation;

class ConversationRepository extends AbstractRepository
{

    function __construct(Conversation $model)
    {
        $this->model = $model;
    }

    public function search(Array $params = [])
    {
        $query = $this->model
            ->select('conversations.*');

        if(isset($params['destinatary_user_id'])){
            $query->where('destinatary_user_id', $params['destinatary_user_id']);
        }

        if(isset($params['sender_user_id'])){
            $query->where('sender_user_id', $params['sender_user_id']);
        }

        return $query->orderBy('created_at', 'desc');
    }

}