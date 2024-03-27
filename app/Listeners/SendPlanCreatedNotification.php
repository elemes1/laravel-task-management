<?php

namespace App\Listeners;

use App\Events\PlanCreated;
use App\Jobs\SendPlanCreatedNotificationJob;
use App\Services\NotificationService;

class SendPlanCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PlanCreated $event): void
    {
        SendPlanCreatedNotificationJob::dispatch($event->plan, new NotificationService());
    }
}
