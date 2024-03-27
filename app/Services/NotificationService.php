<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Task;
use App\Notification\PlanCreatedNotification;

final class NotificationService
{

    public function sendPlanCreatedNotification(Plan $plan)
    {
        $user = $plan->user;
        $user->notify(new PlanCreatedNotification($plan));
    }

    public function sendTaskCreatedNotification(Task $task)
    {
      //Todo::
    }
}
