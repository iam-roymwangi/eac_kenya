<?php

namespace App\Notifications;

use App\Models\ProjectInterest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectInterestNotification extends Notification
{
    use Queueable;

    public function __construct(
        public ProjectInterest $interest
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Project Interest: ' . $this->interest->project_name)
            ->greeting('New Project Interest Received')
            ->line('A potential client has expressed interest in: **' . $this->interest->project_name . '**')
            ->line('**Company:** ' . $this->interest->company_name)
            ->line('**Contact Person:** ' . $this->interest->contact_person)
            ->line('**Email:** ' . $this->interest->email)
            ->line('**Phone:** ' . $this->interest->phone)
            ->line('**Interest Type:** ' . ucfirst($this->interest->interest_type))
            ->when($this->interest->message, function ($mail) {
                return $mail->line('**Message:** ' . $this->interest->message);
            })
            ->action('View in Admin Panel', url('/admin'))
            ->line('Please follow up with this lead promptly.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'project_interest',
            'project_name' => $this->interest->project_name,
            'company_name' => $this->interest->company_name,
            'contact_person' => $this->interest->contact_person,
            'email' => $this->interest->email,
            'interest_id' => $this->interest->id,
        ];
    }
}
