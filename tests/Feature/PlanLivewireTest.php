<?php

use App\Livewire\Plan\CreatePlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('can create a plan', function () {
    $user = User::factory()->create();
    $planData = [
        'title' => 'New Plan Title',
        'description' => 'New Plan Description',
    ];

    Livewire::actingAs($user)
        ->test(CreatePlan::class)
        ->set('title', $planData['title'])
        ->set('description', $planData['description'])
        ->call('save')
        ->assertRedirect('/plans/1');

    $this->assertDatabaseHas('plans', [
        'title' => $planData['title'],
    ]);
});
