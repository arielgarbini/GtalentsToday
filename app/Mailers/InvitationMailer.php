<?php

namespace Vanguard\Mailers;

class InvitationMailer extends AbstractMailer
{
    public function sendEmailSupplier($user, $token, $mess, $code)
    {
        $view = 'emails.supplier.confirmation';
        $data = ['token' => $token, 'mess' => $mess, 'code' => $code];
        $subject = 'Invitation to participate';

        $this->sendTo($user->email, $subject, $view, $data);
    }
}