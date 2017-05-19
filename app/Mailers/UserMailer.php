<?php

namespace Vanguard\Mailers;

use Vanguard\User;

class UserMailer extends AbstractMailer
{
    public function sendConfirmationEmail($user, $token)
    {
        $view = 'emails.registration.confirmation';
        $data = ['token' => $token];
        $subject = 'Registration Confirmation';

        $this->sendTo($user->email, $subject, $view, $data);
    }

    public function sendConfirmationEmailLinkedin($user, $token)
    {
        $view = 'emails.registration.confirmationlinkedin';
        $data = ['token' => $token];
        $subject = 'Complete your register';

        $this->sendTo($user->email, $subject, $view, $data);
    }

    public function sendConfirmationEmailActive($user)
    {
        $view = 'emails.registration.confirmationactive';
        $data = ['user' => $user];
        $subject = 'Complete your register';

        $this->sendTo($user->email, $subject, $view, $data);
    }

    public function sendPasswordReminder(User $user, $token)
    {
        $view = 'emails.password.remind';
        $data = ['user' => $user, 'token' => $token];
        $subject = 'Password Reset Required';

        $this->sendTo($user->email, $subject, $view, $data);
    }
}