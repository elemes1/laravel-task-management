<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\UserRegistration;


describe('admin user creation test', function () {

uses(RefreshDatabase::class);

    it('creates a role', function () {
        $this->role->create(['name' => 'Admin', 'slug' => 'admin']);
        expect($this->role->all())->toHaveCount(1);
    });

    it('triggers event when role was created', function () {
        Event::fake();
        $role = $this->role->create(['name' => 'Admin', 'slug' => 'admin']);
        Event::assertDispatched(RoleWasCreated::class, fn($e) => $e->role->name === $role->name);
    });

    it('triggers event when role is creating', function () {
        Event::fake();
        $role = $this->role->create(['name' => 'Admin', 'slug' => 'admin']);
        Event::assertDispatched(RoleIsCreating::class, fn($e) => $e->getAttribute('name') === $role->name);
    });


    it('finds a role by id', function () {
        $this->role->create(['name' => 'Admin', 'slug' => 'admin']);
        $role = $this->role->find(1);
        expect($role->name)->toBe('Admin');
    });


    it('finds a role by its name', function () {
        $this->role->create(['name' => 'Admin', 'slug' => 'admin']);
        $role = $this->role->findByName('Admin');
        expect($role->name)->toBe('Admin');
    });



    it('updates a role', function () {
        $role = $this->role->create(['name' => 'Admin', 'slug' => 'admin']);
        $this->role->update($role->id, ['name' => 'Better Admin']);
        $role->refresh();
        expect($role->name)->toBe('Better Admin');
    });

    it('triggers role updated event', function () {
        $role = $this->role->create(['name' => 'Admin', 'slug' => 'admin']);
        Event::fake();
        $this->role->update($role->id, ['name' => 'Better Admin']);
        Event::assertDispatched(RoleWasUpdated::class, fn($e) => $e->role->id === $role->id);
    });

    it('fires event when role is updating', function () {
        $role = $this->role->create(['name' => 'Admin', 'slug' => 'admin']);
        Event::fake();
        $this->role->update($role->id, ['name' => 'Better Admin']);
        Event::assertDispatched(RoleIsUpdating::class, fn($e) => $e->getRole()->id === $role->id);
    });


    it('deletes a role', function () {
        $this->role->create(['name' => 'Admin', 'slug' => 'admin']);
        expect($this->role->all())->toHaveCount(1);
        $this->role->delete(1);
        expect($this->role->all())->toHaveCount(0);
    });

    it('triggers role deleted event', function () {
        $role = $this->role->create(['name' => 'Admin', 'slug' => 'admin']);
        Event::fake();
        $this->role->update($role->id, ['name' => 'Better Admin']);
        Event::assertDispatched(RoleWasUpdated::class, fn($e) => $e->role->id === $role->id);
    });


});
