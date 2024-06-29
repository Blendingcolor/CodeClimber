<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends BaseVerifyEmail
{
    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->verificationUrl($notifiable));
        }

        return (new MailMessage)
            ->subject('Confirma tu dirección de correo electrónico')
            ->line('Haz clic en el botón de abajo para verificar tu dirección de correo electrónico.')
            ->action('Verificar Email', $this->verificationUrl($notifiable))
            ->line('Si no creaste una cuenta, no es necesario realizar ninguna otra acción.');
    }
}
