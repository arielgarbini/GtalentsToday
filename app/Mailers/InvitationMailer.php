<?php
/**
 * Created by PhpStorm.
 * User: Xfrie
 * Date: 4/12/2017
 * Time: 2:53 PM
 */

namespace Vanguard\Mailers;

class InvitationMailer extends AbstractMailer
{
    public function sendEmailSupplier($user, $token, $message)
    {
        $view = 'emails.supplier.confirmation';
        $data = ['token' => $token, 'message' => $message];
        $subject = 'Invitation to participate';

        $this->sendTo($user->email, $subject, $view, $data);
    }
}