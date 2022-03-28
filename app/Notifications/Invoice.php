<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Invoice extends Notification
{
    use Queueable;

    public $user;
    public $session;
    public $payment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $session, $payment)
    {
        $this->user = $user;
        $this->session = $session;
        $this->payment = $payment;
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
        return (new MailMessage)->markdown('mail.invoice', ['user' => $this->user, 'session' => $this->session, 'payment' => $this->payment])
                    ->from(env('MAIL_FROM_ADDRESS'), 'Super desiata')
                    ->subject('Platba bola prevedená');
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
