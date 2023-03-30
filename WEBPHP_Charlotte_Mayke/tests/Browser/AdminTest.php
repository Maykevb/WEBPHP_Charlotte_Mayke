<?php

namespace Tests\Browser;

use App\Models\user;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     */
    public function testWebshopCreation(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'admin@gmail.com')
                ->type('password', 'wachtwoord')
                ->click('button[type="submit"]');

            $browser->clickLink('Webshops')
                ->type('webshop', 'Coolblue')
                ->type('name', 'Coolblue')
                ->type('email', 'coolblue@gmail.com')
                ->type('password', 'wachtwoord')
                ->type('password_confirmation', 'wachtwoord')
                ->click('button[type="submit"]');
        });
    }

    public function testLanguage(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/home')
                ->clickLink('EN');

            $browser->visit('/home')
                ->clickLink('NL');
        });
    }
}
