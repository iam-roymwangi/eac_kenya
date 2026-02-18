<?php

namespace App\Notifications;

use App\Models\ProjectQuestion;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectQuestionNotification extends Notification
{
    use Queueable;

    public function __construct(
        public ProjectQuestion $question
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Question About: ' . $this->question->project_name)
            ->greeting('New Project Question Received')
            ->line('A potential client has asked a question about: **' . $this->question->project_name . '**')
            ->line('**Company:** ' . $this->question->company_name)
            ->line('**Contact Person:** ' . $this->question->contact_person)
            ->line('**Email:** ' . $this->question->email)
            ->line('**Phone:** ' . $this->question->phone)
            ->line('**Question:**')
            ->line($this->question->question)
            ->action('View in Admin Panel', url('/admin'))
            ->line('Please respond to this inquiry promptly.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'project_question',
            'project_name' => $this->question->project_name,
            'company_name' => $this->question->company_name,
            'contact_person' => $this->question->contact_person,
            'email' => $this->question->email,
            'question_id' => $this->question->id,
        ];
    }
}
