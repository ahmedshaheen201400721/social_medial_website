<?php

namespace App\Notifications;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Subscription extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $tweet;
    public $user;
    public function __construct(Tweet $tweet,User $user)
    {
        $this->tweet=$tweet;
        $this->user=$user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'user'=>$this->user->name,
            'time'=>now(),
            'tweet'=>$this->tweet->body,
            'path'=>$this->tweet->path,
            'photo'=>$this->user->avatar,
        ];
    }

    public function toBroadcast($notifiable)
    {
    return new BroadcastMessage([
        'data'=>[
            'user'=>$this->user->name,
            'time'=>now(),
            'tweet'=>$this->tweet->body,
            'path'=>$this->tweet->path,
            'photo'=>$this->user->avatar,
            ]
        ]);
    }
}
