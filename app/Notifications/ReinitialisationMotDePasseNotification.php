<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReinitialisationMotDePasseNotification extends Notification
{
    use Queueable;

    protected $code;
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                    ->line('Vous recevez cet email car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.')
                    ->action('Code de réinitialisation '.$this->code,'#')
                    ->line('Si vous n\'avez pas demandé de réinitialisation de mot de passe, vous pouvez ignorer ce message.')
                    ->line("Merci d'utiliser notre application!");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
