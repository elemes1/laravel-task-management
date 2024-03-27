<?php

namespace App\Jobs;

use App\Models\Plan;
use App\Services\NotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPlanCreatedNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $plan;

    protected $planNotificationService;

    public function __construct(Plan $plan, NotificationService $planNotificationService)
    {
        $this->plan = $plan;
        $this->planNotificationService = $planNotificationService;
    }

    public function handle()
    {
        $this->planNotificationService->sendPlanCreatedNotification($this->plan);
    }
}
