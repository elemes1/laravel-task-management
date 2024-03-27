<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        $taskDescriptions = [
            'Design the Product Brochure',
            'Finalize Event Venue and Catering',
            'Develop User Interface for the App',
            'Create Social Media Marketing Strategy',
            'Conduct Market Research',
            'Negotiate with Suppliers',
            'Set up Project Management Tools',
            'Hire New Team Members',
            'Plan the Training Schedule',
            'Design a New Logo',
            'Organize Team Building Activities',
            'Prepare a Budget Proposal',
            'Coordinate with Stakeholders',
            'Launch Beta Testing Phase',
            'Prepare Launch Event'
        ];

        return [
            'title' => $this->faker->randomElement($taskDescriptions),
            'description' => $this->faker->sentence(),
            'status' => 'open',
            'due_date' => $this->faker->date(),
            'plan_id' => Plan::inRandomOrder()->first()->id,
        ];
    }
}
