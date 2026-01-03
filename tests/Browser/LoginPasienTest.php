<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginPasienTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoginPasien()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Home')
                ->press('#loginButton')
                ->pause(1000)
                ->assertSee('Login')
                ->type('email', 'shewright@gmail.com')
                ->type('password', 'shewright123')
                ->press('Login')
                ->waitForText('Verifikasi');
        });
    }
}
