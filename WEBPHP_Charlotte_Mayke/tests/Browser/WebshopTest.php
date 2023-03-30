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

    public function testLabelsSorting(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/labelList')
                ->select('sorting', 'id_desc')
                ->click('button[id="button-addon2"]')
                ->select('sorting', 'id_asc')
                ->click('button[id="button-addon2"]')
                ->select('sorting', 'name_desc')
                ->click('button[id="button-addon2"]')
                ->select('sorting', 'name_asc')
                ->click('button[id="button-addon2"]')

                ->select('filter', '1')
                ->click('button[id="button-addon2"]')
                ->select('filter', '2')
                ->click('button[id="button-addon2"]')
                ->select('filter', '3')
                ->click('button[id="button-addon2"]')
                ->select('filter', '4')
                ->click('button[id="button-addon2"]')
                ->select('filter', '0')
                ->select('sorting', '0')
                ->click('button[id="button-addon2"]');
        });
    }

    public function testSearch()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/labelList')
                ->type('search', '1');
        });
    }

    public function testPickUp()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/labelList')
                ->click('a[id="request1"]');
        });
    }

    public function testDownload()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/labelList')
                ->click('input[id="checkbox1"]')
                ->element("btn btn-dark 1")
                ->click('button[class="btn btn-dark 1"]');
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

