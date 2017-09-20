<?php

namespace Vanguard\Mailers;


class InterestedMailer extends AbstractMailer
{
    public function sendEmail($user, $data)
    {
        $view = 'emails.supplier.interested';
        $subject = 'New supplier interested';

        $this->sendTo($user->email, $subject, $view, $data);
    }
}