<?php

namespace App\Notifications;

use App\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TaskUpdate extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task;
    protected $purpose;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
        $this->purpose = empty($task->updatedBy)? 'Created New': 'Updated the';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mail = new MailMessage();
        $mail->subject($this->purpose.'Task '. $this->task->title)
        ->line('The introduction to the notification.')
        ->action('To Check', action('TaskController@show', $this->task->id))
        ->line('Thank you for '.$this->purpose.'Task');
        $mail->actionText = "Open the Task";
        $mail->actionUrl = action('TaskController@show', $this->task->id);
        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public function toArray($notifiable)
    {
        $avatar = auth()->user()->profile?auth()->user()->profile->avatar:null;
        if (in_array($this->task->status, ['Wating for Review','Processing','Hold'])) {
            $type = 'Warning';
        }elseif ($this->task->status == 'Finished') {
            $type = "Success";
        } elseif ($this->task->status == 'Rejected') {
            $type = "Danger";
        } else {
            $type = "Info";
        }
        return [
            "action" => action('TaskController@show', $this->task->id),
            "title"=> "<strong>".auth()->user()->name."</strong>'.$this->purpose.'<strong>".$this->task->id."</strong>",
            "message" => null,
            "image" => null,
            "avatar" => $avatar,
            "data_type" => $type
        ];
    }
}
