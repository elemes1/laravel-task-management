<?php

namespace App\Listeners;

use App\Models\Role;
use Illuminate\Auth\Events\Registered;

class AssignDefaultRoleToRegisteredUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $role = Role::firstWhere(['name' => config('todo.default_user_role_name')]);
        if ($role) {
            $event->user->roles()->attach($role);
        }
    }
}
