<?php

namespace App\Notifications;

use App\Models\Meeting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class Meetings extends Notification
{
    use Queueable;

    public $meeting;

    /**
     * Create a new notification instance.
     *
     * @param  Meeting  $meeting
     * @return void
     */
    public function __construct(Meeting $meeting)
    {
        $this->meeting = $meeting;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification for database.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'adoption_request_id' => $this->meeting->adoption_request_id,
            'meeting_date' => $this->meeting->meeting_date,
            'status' => $this->meeting->status,
            'message' => $this->generateMessage(),
        ];
    }

    /**
     * Generate a readable message for the notification.
     *
     * @return string
     */
    private function generateMessage()
    {
        return 'Your meeting is scheduled on ' . $this->meeting->meeting_date . '.';
    }
}
