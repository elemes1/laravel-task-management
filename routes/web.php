<?php

use App\Livewire\Activities;
use App\Livewire\Plan\CreatePlan;
use App\Livewire\Plan\Plan;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::get('plans', CreatePlan::class)
    ->middleware(['auth'])
    ->name('plan.create');

Route::get('plans/{plan}', Plan::class)
    ->middleware(['auth'])
    ->name('plan.edit');


Route::get('plans/{plan}', Plan::class)
    ->middleware(['auth'])
    ->name('plan.edit');


Route::get('tasks/{task}/activities/', Activities::class)
    ->middleware(['auth'])
    ->name('activities.all');

require __DIR__.'/auth.php';
