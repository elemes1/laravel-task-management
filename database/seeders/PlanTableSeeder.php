<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $statusArray = ['open', 'archived'];
        $descriptionArray = [
            'Launching a New Marketing Campaign',
            'Developing a Mobile Application',
            'Organizing an International Conference',
            'Company-wide Training Program',
            'Launching a New Product Line',
            'Office Renovation Project',
            'Implementing a New CRM System',
            'Organizing a Charity Event',
            'Expansion of Retail Outlets',
            'Corporate Branding Initiative'
        ];

        foreach ($users as $user) {
            foreach ($descriptionArray as $description) {
                Plan::factory()->create([
                    'title' => $description,
                    'status' => $statusArray[array_rand($statusArray)],
                    'created_by' => $user->id,
                ]);
            }
        }
    }
}
