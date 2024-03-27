<?php


use App\Models\User;
use App\Models\Plan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('can create a task within a plan', function () {
    $user = User::factory()->create();
    $plan = Plan::factory()->create();
    $taskData = [
        'title' => 'New Task Title',
        'description' => 'New Task Description',
        'status' => 'pending',
    ];
    Livewire::actingAs($user)
        ->test(\App\Livewire\Plan\Plan::class, ['plan' => $plan])
        ->emit('task-created', $taskData)->assertStatus(200);

    $this->assertDatabaseHas('tasks', [
        'title' => $taskData['title'],
        'plan_id' => $plan->id,
    ]);
});
