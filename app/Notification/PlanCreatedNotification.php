<?php

namespace App\Notification;


use App\Models\Plan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PlanCreatedNotification extends Notification
{
    use Queueable;


    public $plan;

    public function __construct(Plan $plan)
    {
        $this->plan = $plan;

    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {

        return (new MailMessage)
            ->subject('New Plan Created: ' . $this->plan->title)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('A new plan has been created in our system.')
            ->line('Plan Title: ' . $this->plan->title)
            ->line('Description: ' . $this->plan->description)
            ->action('View Plans', url('/plans'))
            ->line('Thank you for using our application!')
            ->salutation('Best Regards,');
    }
}

