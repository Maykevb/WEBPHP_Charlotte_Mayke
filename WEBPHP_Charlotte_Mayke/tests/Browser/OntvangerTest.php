<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class OntvangerTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     */
    public function testTrackAndTrace(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'ontvanger@gmail.com')
                ->type('password', 'wachtwoord')
                ->click('button[type="submit"]');

            $browser->visit('/myShipments')
                ->type('code', 'TKTK')
                ->click('button[type="submit"]')
                ->click('button[type="submit"]')
                ->type('text', 'Wat was dit een vervelende ervaring')
                ->click('button[type="submit"]');
        });
    }

    public function testReviewsSort()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/reviews')
                ->select('sorting', 'id_desc')
                ->click('button[id="button-addon2"]')
                ->select('sorting', 'id_asc')
                ->click('button[id="button-addon2"]')
                ->select('sorting', 'stars_desc')
                ->click('button[id="button-addon2"]')
                ->select('sorting', 'stars_asc')
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
            $browser->visit('/reviews')
                ->type('search', '1');
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
