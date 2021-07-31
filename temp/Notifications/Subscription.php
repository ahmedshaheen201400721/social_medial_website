<?php

namespace App\Notifications;

use App\Models\Thread;
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
    public $thread;
    public $user;
    public function __construct(Thread $thread,User $user)
    {
        $this->thread=$thread;
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
            'thread'=>$this->thread->title,
            'path'=>$this->thread->path(),
            'photo'=>$this->user->profile_photo_path,
        ];
    }

    public function toBroadcast($notifiable)
    {
    return new BroadcastMessage([
        'data'=>[
            'user'=>$this->user->name,
            'time'=>now(),
            'thread'=>$this->thread->title,
            'path'=>$this->thread->path(),
            'photo'=>$this->user->profile_photo_path,
            ]
        ]);
    }
}
