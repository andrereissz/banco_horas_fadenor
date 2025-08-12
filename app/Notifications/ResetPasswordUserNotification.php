<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordUserNotification extends ResetPassword
{
    public function toMail($notifiable)
    {
        $url = route('fundacao.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        return (new MailMessage)
            ->subject('Redefinir Senha - Fundação')
            ->view('mail.password-reset-user-mail', ['url' => $url]);
    }
}
