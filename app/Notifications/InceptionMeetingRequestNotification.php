<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InceptionMeetingRequestNotification extends Notification
{
    use Queueable;

    public function __construct(
        public array $data,
        public array $questions = []
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject('Inception Meeting Request: ' . $this->data['project_name'])
            ->greeting('New Inception Meeting Request')
            ->line('A client has requested an inception meeting for: **' . $this->data['project_name'] . '**')
            ->line('**Company:** ' . $this->data['company_name'])
            ->line('**Contact Person:** ' . $this->data['contact_person'])
            ->line('**Email:** ' . $this->data['email'])
            ->line('**Phone:** ' . $this->data['phone']);

        if (!empty($this->data['meeting_mode'])) {
            $modeLabel = $this->data['meeting_mode'] === 'online' ? 'Online' : 'Physical';
            $mail->line('**Preferred Mode:** ' . $modeLabel);
        }

        if (!empty($this->questions)) {
            $mail->line('**Questions from Client:**');
            foreach ($this->questions as $index => $question) {
                $mail->line(($index + 1) . '. ' . $question);
            }
        }

        return $mail
            ->action('View QR Code', url('/admin'))
            ->line('A QR code has been generated for the onboarding process.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'inception_meeting_request',
            'project_name' => $this->data['project_name'],
            'company_name' => $this->data['company_name'],
            'contact_person' => $this->data['contact_person'],
            'email' => $this->data['email'],
             'meeting_mode' => $this->data['meeting_mode'] ?? null,
            'questions_count' => count($this->questions),
        ];
    }
}
