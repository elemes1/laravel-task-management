<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;

describe('user registration', function () {
    uses(RefreshDatabase::class);
//
//    it('registers a new user with user role', function () {
//
//        Role::factory()->create();
//
//        Livewire::test('pages.auth.register')
//            ->set('name', 'Test User')
//            ->set('email', 'sicyh@robot-mail.com')
//            ->set('password', 'password')
//            ->set('password_confirmation', 'password')
//            ->call('register')
//            ->assertRedirect(route('dashboard', ['absolute' => false]));
//
//        $user = User::whereEmail('sicyh@robot-mail.com')->first();
//        expect($user)->not()->toBeNull();
//        expect($user->email)->toBe('sicyh@robot-mail.com');
//        expect($user->roles->first()->name)->toBe('User');
//    });
//
//    it('fires event when user has registered', function () {
//        Livewire::test('pages.auth.register')
//            ->set('name', 'Test User')
//            ->set('email', 'sicyh@robot-mail.com')
//            ->set('password', 'password')
//            ->set('password_confirmation', 'password')
//            ->call('register');
//
//
//    });
});
