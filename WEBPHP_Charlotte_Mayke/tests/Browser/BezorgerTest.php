<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BezorgerTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     */
    public function testShipmentRegistration(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'bezorger@gmail.com')
                ->type('password', 'wachtwoord')
                ->click('button[type="submit"]');

            $browser->visit('/shipmentRegistration');
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
