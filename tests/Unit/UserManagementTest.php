<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\UserRegistration;


describe('admin user creation test', function () {

uses(RefreshDatabase::class);

    it('creates a new user', function () {
        // Assuming $this->user is an instance of UserRepository
        $user = $this->user->create([
            'email' => 'sicyh@robot-mail.com',
            // other attributes
        ]);

        expect($user)->toBeInstanceOf(User::class);
        expect(User::count())->toBe(1);
    });

    it('fires event when user is creating', function () {
        Event::fake();
        // User creation logic
        Event::assertDispatched(UserIsCreating::class);
    });

    it('fires event when user is created', function () {
        Event::fake();
        // User creation logic
        Event::assertDispatched(UserWasCreated::class);
    });

    it('makes sure the event contains original attributes', function () {
        Event::fake();
        // User creation logic
        Event::assertDispatched(UserIsCreating::class, function ($e) {
            return $e->getOriginal('email') === 'sicyh@robot-mail.com';
        });
    });

    it('updates a user', function () {
        // User creation and update logic
        expect($user->fresh()->first_name)->toBe('John');
    });

    it('triggers event when user is updating', function () {
        Event::fake();
        // User update logic
        Event::assertDispatched(UserIsUpdating::class);
    });

    it('triggers events on user update', function () {
        Event::fake();
        // User update logic
        Event::assertDispatched(UserWasUpdated::class);
        Event::assertDispatched(UserIsUpdating::class);
    });

    it('deletes a user', function () {
        $user = $this->user->create([...]);
        expect(User::count())->toBe(1);

        $this->user->delete($user->id);
        expect(User::count())->toBe(0);
    });

    it('throws exception if user not found when deleting', function () {
        $this->expectException(UserNotFoundException::class);
        $this->user->delete(1);
    });

    it('hashes user password', function () {
        // User creation logic
        $hasher = app('hash');
        expect($hasher->check('password', $user->password))->toBeTrue();
    });

    it('creates user with given role', function () {
        // Assuming role assignment is part of user creation logic
        expect($user->roles->first()->name)->toBe('User');
    });
});
