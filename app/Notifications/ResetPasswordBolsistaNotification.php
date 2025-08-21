<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordBolsistaNotification extends ResetPassword
{
    public function toMail($notifiable)
    {
        $url = route('bolsistas.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        return (new MailMessage)
            ->subject('Redefinir Senha - Bolsistas')
            ->line('Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.')
            ->action('Redefinir Senha', $url)
            ->line('Se você não solicitou isso, nenhuma ação é necessária.');
    }
}
