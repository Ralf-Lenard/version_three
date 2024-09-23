<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AbuseReject extends Notification
{
    use Queueable;

    protected $abuses;

    public function __construct($abuses)
    {
        $this->abuses = $abuses;
    }

    public function via($notifiable)
    {
        return ['database']; // Store notification in the database
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Sorry your submmited report is rejected due to reason  ' . $this->abuses->reason . '.',
        ];
    }
}