<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     */
    public function testAuth(): void
    {
        $this->browse(function ($browser) {
            // We'll test the register feature here
            $browser->visit('/home')
                ->clickLink('Register')
                ->type('name', 'Samson')
                ->type('email', 'samson@test.com')
                ->type('password', 'wachtwoord')
                ->type('password_confirmation', 'wachtwoord')
                ->click('button[type="submit"]');

            // We'll test the login feature here
            if($browser->seeLink('Samson')) {
                $browser->clickLink('Samson');
            }

            if ($browser->seeLink('Log Out')) {
                $browser->clickLink('Log Out')

                    ->clickLink('Login')
                    ->type('email', 'samson@test.com')
                    ->type('password', 'wachtwoord')
                    ->click('button[type="submit"]');
            }
        });
    }
}
