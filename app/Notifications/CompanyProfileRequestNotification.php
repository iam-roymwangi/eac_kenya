<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanyProfileRequestNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $clientName,
        public string $contactPerson
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Company Profile Request - EAC Green Group')
            ->greeting('Dear ' . $this->contactPerson . ',')
            ->line('Thank you for expressing interest in our renewable energy projects.')
            ->line('To proceed with your project evaluation and onboarding process, we kindly request that you submit your company profile.')
            ->line('Please provide the following information:')
            ->line('• Company Registration Certificate')
            ->line('• Tax Compliance Certificate (KRA PIN)')
            ->line('• Company Profile/Brochure')
            ->line('• Contact Information of Key Personnel')
            ->line('• Brief description of your company\'s experience in renewable energy or related sectors')
            ->action('Submit Company Profile', url('/contact'))
            ->line('If you have any questions or need assistance, please don\'t hesitate to contact us.')
            ->salutation('Best regards,')
            ->salutation('EAC Green Group Team')
            ->salutation('Kitisuru, Nairobi, Kenya')
            ->salutation('Phone: +254 794 833 868')
            ->salutation('Email: info@eacgreengroup.com');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'client_name' => $this->clientName,
            'contact_person' => $this->contactPerson,
        ];
    }
}
