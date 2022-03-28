<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\HtmlString;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class GenerateNewPassword extends Notification
{
    use Queueable;

    public $user_name;
    public $user_email;
    public $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $password)
    {
        $this->user_name = $user->name;
        $this->user_email = $user->email;
        $this->password = $password;
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
                    ->from(env('MAIL_FROM_ADDRESS'), 'Super desiata')
                    ->subject('Heslo k Vášmu účtu bolo obnovené')
                    ->greeting("Dobrý deň, $this->user_name")
                    ->line("heslo k Vášmu účtu ($this->user_email) bolo úspešne obnovené.")
                    ->line(new HtmlString('Vaše nové heslo je: <strong>' . $this->password . '</strong>'));
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
