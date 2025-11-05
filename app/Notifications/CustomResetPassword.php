<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPassword extends Notification
{
    use Queueable;
    public $url_restablecimiento;

    /**
     * Create a new notification instance.
     */
    public function __construct($url_restablecimiento)
    {
        $this->url_restablecimiento=$url_restablecimiento;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Establecer nueva contraseña')
            ->line('Hola '.$notifiable->name.', para completar tu registro debes crear una nueva contraseña.')
            ->action('Establecer nueva contraseña', $this->url_restablecimiento);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
