<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\UserRegistration;


describe('user registration', function () {

uses(RefreshDatabase::class);

it('registers a new user', function () {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $this->post(route('register'), $userData)
            ->assertRedirect(route('home')); // Or whatever route you redirect to after registration

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);

        expect(User::where('email', 'test@example.com')->exists())->toBeTrue();
});

it('registers a new user with user role', function () {
    // Assuming you have a method to create roles
    $this->createRole('User');

    app(UserRegistration::class)->register([
        'email' => 'sicyh@robot-mail.com',
        'password' => 'admin123',
        'first_name' => 'Sicyh',
        'last_name' => 'Sample',
        'mobile_no' => '081000000000',
        'username' => 'sicyh',
        'permissions' => ['dashboard.index' => true],
    ]);

    $user = User::where('email', 'sicyh@robot-mail.com')->first();

    expect($user)->toHaveCount(1);
    expect($user->email)->toBe('sicyh@robot-mail.com');
    expect($user->roles->first()->name)->toBe('User');
});


it('fires event when user has registered', function () {
        Event::fake();
        // User creation logic
        Event::assertDispatched(UserHasRegistered::class);
});

});
