<?php

namespace Vanguard\Mailers;


class CollaboratorMailer extends AbstractMailer
{
    public function sendEmailCollaborator($user, $token)
    {
        $view = 'emails.collaborator.confirmation';
        $data = ['token' => $token];
        $subject = 'Invitation to collaborate';

        $this->sendTo($user->email, $subject, $view, $data);
    }
}