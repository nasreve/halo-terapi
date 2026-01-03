<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LandingOrderTest extends DuskTestCase
{
    /**
     * terapis order dari landing page.
     *
     * @test
     * @return void
     */
    public function order_from_landing_page()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs(1, 'patient')
                ->visit('/referrer/1905')
                ->press('[for="service-1"]')
                ->waitForText('Selanjutnya')
                ->visit(route('order.step-2'))
                ->waitForText('Lokasi Anda')
                ->pause(200)
                ->click('#regency-1 + .select2')
                ->type('.select2-search--dropdown > input', 'Kabupaten Karanganyar')
                ->pause(300)
                ->click('.select2-results__option')
                ->pause(500)
                ->click('#district-1 + .select2')
                ->pause(300)
                ->type('.select2-search--dropdown > input', 'Mojogedang')
                ->pause(300)
                ->click('.select2-results__option')
                ->pause(300)
                ->press('.tbr_therapist:nth-child(1)')
                ->pause(300)
                ->visit(route('order.step-3'))
                ->waitForText('Data diri pasien')
                ->type('#buyer_sub_district', 'Tawangmangu')
                ->type('#buyer_address', 'Plumbon')
                ->type('#buyer_symptoms', 'Pusing')
                ->click('[for="transfer"]')
                ->click('.tbr_wizard_next')
                ->press('Submit')
                ->waitForText('Pesanan telah kami terima!', 15)
                ->assertSee('Pesanan telah kami terima!');
        });
    }

    /**
     * Mengetes order landing step ke 1
     *
     * @test
     * @return void
     */
    public function patient_select_service_step1()
    {
        $service_id = random_int(1, 12);

        $this->browse(function (Browser $browser) use ($service_id) {
            $browser
                ->visit('/')
                ->waitForText('Layanan haloterapi')
                ->press("[for='service-{$service_id}']")
                ->waitForText('Batalkan')
                ->scrollIntoView(".tbr_column:nth-child({$service_id})")
                ->press("[for='service-{$service_id}']")
                ->waitForText('Pesan')
                ->assertDontSee('Batalkan');
        });
    }

    /**
     * Mengetes order landing step ke 2
     *
     * @test
     * @return void
     */
    public function test_choose_therapist_step2()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs(1, 'patient')
                ->visit('/')
                ->scrollIntoView(".tbr_column:nth-child(1)")
                ->press("[for='service-1']")
                ->pause(500)
                ->press("[for='service-2']")
                ->pause(500)
                ->visit('/patient/order/step-2')
                ->waitForText('Lokasi Anda')
                ->assertSee('Lokasi Anda');

            $browser
                ->visit('/patient/order/step-2')
                ->waitForText('Lokasi Anda')
                ->click('#regency-1 + .select2')
                ->type('.select2-search--dropdown > input', 'Kabupaten Blora')
                ->pause(300)
                ->click('.select2-results__option')
                ->pause(500)
                ->click('#district-1 + .select2')
                ->pause(300)
                ->type('.select2-search--dropdown > input', 'Kradenan')
                ->pause(300)
                ->click('.select2-results__option')
                ->pause(300)
                ->click('.page-item:nth-child(' . random_int(8, 10) . ')')
                ->pause(300)
                ->click('.tbr_therapist:nth-child(5)')
                ->pause(300)
                ->click('#tbr_accordion_item_2 > button > h4')
                ->pause(300)
                ->click('#regency-2 + .select2')
                ->pause(300)
                ->type('.select2-search--dropdown > input', 'Kabupaten Karanganyar')
                ->pause(300)
                ->click('.select2-results__option')
                ->pause(300)
                ->click('#district-2 + .select2')
                ->pause(300)
                ->type('.select2-search--dropdown > input', 'Karangpandan')
                ->pause(300)
                ->click('.select2-results__option')
                ->pause(300)
                ->click("[for='service-2-2']")
                ->pause(300)
                ->click('.tbr_wizard_next')
                ->waitForText('Data diri pasien')
                ->assertSee('Data diri pasien');

            $this->browse(function (Browser $browser) {
                $browser
                    ->visit('/patient/order/step-3')
                    ->pause(300)
                    ->type('buyer_sub_district', 'Plumbon')
                    ->pause(300)
                    ->type('buyer_address', 'Watusambang')
                    ->pause(300)
                    ->type('buyer_symptoms', 'lorem ipsum')
                    ->pause(300)
                    ->click('.tbr_wizard_next')
                    ->waitForText('Data diri pasien dan informasi pesanan')
                    ->assertSee('Data diri pasien dan informasi pesanan');
            });
        });
    }
}
