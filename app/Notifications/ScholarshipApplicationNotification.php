<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ScholarshipApplicationNotification extends Notification
{
    use Queueable;

    public $studentName;
    public $applicationID;
    public $imagePath;

    public function __construct($studentName, $applicationID, $imagePath)
    {
        $this->studentName = $studentName;
        $this->applicationID = $applicationID;
        $this->imagePath = $imagePath;
    }

    // Choose the notification channels
    public function via($notifiable)
    {
        return ['database']; // Only store the notification in the database
    }

    // Define the data to be stored in the database
    public function toDatabase($notifiable)
    {
        return [
            'image_path' => $this->imagePath,
            'student_name' => $this->studentName,
            'application_id' => $this->applicationID,
            'message' => "Student {$this->studentName} has applied for a scholarship. Application ID: {$this->applicationID}"
        ];
    }
}
