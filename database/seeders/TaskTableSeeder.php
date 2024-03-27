<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    public function run()
    {
        // Fetch all plans
        $plans = Plan::all();

        foreach ($plans as $plan) {
            // Create 5 tasks per plan
            Task::factory()->count(5)->create([
                'plan_id' => $plan->id,
            ]);
        }
    }
}
