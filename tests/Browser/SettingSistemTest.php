<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SettingSistemTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testFee()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                ->assertSee('Login')
                ->type('email', 'brofitjp@outlook.com')
                ->type('password', 'admin123')
                ->press('Login')
                ->assertPathIs('/admin/order')
                ->assertSee('Pesanan')
                ->clickLink('Pengaturan')
                ->clickLink('Sistem')
                ->assertSee('Sistem')
                ->type('therapist_fee', '80')
                ->type('vendor_fee', '10')
                ->type('referrer_fee', '10')
                ->press('Simpan')
                ->press('Ya, terapkan')
                ->waitForText('Berhasil!');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRekening()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/setting/system')
                ->assertSee('Sistem')
                ->clickLink('Rekening')
                ->type('bank_name', 'BCA')
                ->type('account_number', '80016371')
                ->type('bank_account', 'Terapis Satu')
                ->press('Simpan')
                ->waitForText('Berhasil!');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testTransport()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/setting/system')
                ->assertSee('Sistem')
                ->clickLink('Biaya Transport')
                ->type('.note-editable', 'Lorem ipsum dolot sit amet')
                ->press('Simpan')
                ->waitForText('Berhasil!');
        });
    }
}
