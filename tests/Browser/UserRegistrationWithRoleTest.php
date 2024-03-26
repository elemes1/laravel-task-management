<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class UserRegistrationWithRoleTest extends DuskTestCase
{
    /**
     * Test user registration through the UI.
     *
     * @return void
     * @throws Throwable
     */
    public function testUserRegistration()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('email', 'sicyh@robot-mail.com')
                ->type('password', 'admin123')
                ->type('first_name', 'Sicyh')
                ->type('last_name', 'Sample')
                ->press('Register')
                ->assertPathIs('/home');
        });
    }
}
