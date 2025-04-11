<?php
namespace App\Notifications;

use App\Models\ApplyScholarship;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ScholarshipStatusChanged extends Notification
{
    use Queueable;

    public $status;
    public $scholarship;

    public function __construct($status, ApplyScholarship $scholarship)
    {
        $this->status = $status;
        $this->scholarship = $scholarship;
    }

    public function via($notifiable)
    {
        return ['database'];  // Store in database
    }

    public function toArray($notifiable)
    {
        return [
            'student_name' => $this->scholarship->user->name,
            'message' => 'Your scholarship application has been ' . $this->status . '.',
            'status' => $this->status
        ];
    }
}

