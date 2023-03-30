<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function ($browser) {
            //We'll test the register feature here
            $browser->visit('/home')
                ->clickLink('Register')
                ->value('#name', 'Samson')
                ->value('#email', 'samson@test.com')
                ->value('#password', 'wachtwoord')
                ->value('#password_confirmation', 'wachtwoord')
                ->click('button[type="submit"]')

                //We'll test the login feature here
                ->press('Samson');
            if ($browser->seeLink('Log Out')) {
                $browser->clickLink('Log Out')

                    ->clickLink('Login')
                    ->value('#email', 'samson@test.com')
                    ->value('#password', 'wachtwoord')
                    ->click('button[type="submit"]');
            }

        });
    }
}
