<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class WebshopTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     */
    public function testCalendar(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'webshop@gmail.com')
                ->type('password', 'wachtwoord')
                ->click('button[type="submit"]');

            $browser->clickLink('Calendar');
        });
    }

    public function testAdministrive(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/registerAdministrativeEmployee')
//                ->type('webshop', 'Coolblue')
                ->type('name', 'Coolblue2')
                ->type('email', 'coolblue2@gmail.com')
                ->type('password', 'wachtwoord')
                ->type('password_confirmation', 'wachtwoord')
                ->click('button[type="submit"]');
        });
    }

    public function testPacker(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/registerPackerEmployee')
//                ->type('webshop', 'Coolblue')
                ->type('name', 'Coolblue3')
                ->type('email', 'coolblue3@gmail.com')
                ->type('password', 'wachtwoord')
                ->type('password_confirmation', 'wachtwoord')
                ->click('button[type="submit"]');
        });
    }

    public function testShipments(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/shipmentRegistration')
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

