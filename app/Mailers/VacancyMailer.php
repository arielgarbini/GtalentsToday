<?php

namespace Vanguard\Mailers;


class VacancyMailer extends AbstractMailer
{
    public function sendEmailSupplier($user, $vacancy, $data)
    {
        $view = 'emails.vacancy.supplier';
        $data = ['vacancy' => $vacancy, 'data' => $data];
        $subject = 'Vacancy status changed';

        $this->sendTo($user->email, $subject, $view, $data);
    }

    public function sendEmailGtalents($vacancy, $data)
    {
        $view = 'emails.vacancy.gtalents';
        $data = ['vacancy' => $vacancy, 'data' => $data];
        $subject = 'Vacancy status changed';

        $this->sendTo(env('MAIL_GTALENTS'), $subject, $view, $data);
    }
}