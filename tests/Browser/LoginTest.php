<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                ->assertSee('Login')
                ->type('email', 'brofitjp@outlook.com')
                ->type('password', 'admin123')
                ->press('Login')
                ->assertPathIs('/admin/order')
                ->assertAuthenticated();
        });
    }
}
