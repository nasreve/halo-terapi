<?php

namespace Tests\Browser;

use App\Models\Patient;
use App\Models\Therapist;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ForgotTest extends DuskTestCase
{
    /**
     * Tes lupa password dan reset admin.
     *
     * @test
     * @return void
     */
    public function admin_forgot_password()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                ->clickLink('Forgot Password')
                ->assertSee('Forgot Password')
                ->type('email', 'brofitjp@outlook.com')
                ->press('Submit')
                ->assertPathIs('/admin/forgot-password')
                ->assertSee('Kami sudah mengirimkan email yang berisi link atau tautan untuk mereset password Anda.')
                ->visit(
                    route('password.reset', [
                        'token' => Password::createToken(
                            User::where('email', 'brofitjp@outlook.com')->first()
                        ),
                        'email' => 'brofitjp@outlook.com'
                    ])
                )
                ->assertSee('Silakan buat password baru pada form di bawah.')
                ->value('#password', 'ammad123')
                ->value('#password_confirmation', 'ammad123')
                ->press('Submit')
                ->waitForText('Pesanan')
                ->assertSee('Pesanan');
        });
    }

    /**
     * Tes lupa password dan reset terapis.
     *
     * @test
     * @return void
     */
    public function therapist_forgot_password()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/therapist')
                ->clickLink('Forgot Password')
                ->assertSee('Forgot Password')
                ->type('email', 'sebastian.stan@gmail.com')
                ->press('Submit')
                ->assertPathIs('/therapist/forgot-password')
                ->assertSee('Kami sudah mengirimkan email yang berisi link atau tautan untuk mereset password Anda.')
                ->visit(
                    route('therapist.password.reset', [
                        'token' => Password::broker('therapists')->createToken(
                            Therapist::where('email', 'sebastian.stan@gmail.com')->first()
                        ),
                        'email' => 'sebastian.stan@gmail.com'
                    ])
                )
                ->assertSee('Silakan buat password baru pada form di bawah.')
                ->value('#password', 'ammad123')
                ->value('#password_confirmation', 'ammad123')
                ->press('Submit')
                ->waitForText('Pesanan')
                ->assertSee('Pesanan');
        });
    }

    /**
     * Tes lupa password dan reset pasien.
     *
     * @test
     * @return void
     */
    public function patient_forgot_password()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('.tbr_btn-login')
                ->pause(500)
                ->assertSee('Login')
                ->clickLink('Forgot Password')
                ->assertPathIs('/patient/forgot-password')
                ->assertSee('Forgot Password')
                ->type('email', 'brofitjp@outlook.com')
                ->press('Submit')
                ->assertPathIs('/patient/forgot-password')
                ->assertSee('Kami sudah mengirimkan email yang berisi link atau tautan untuk mereset password Anda.')
                ->visit(
                    route('patient.password.reset', [
                        'token' => Password::broker('patients')->createToken(
                            Patient::where('email', 'brofitjp@outlook.com')->first()
                        ),
                        'email' => 'brofitjp@outlook.com'
                    ])
                )
                ->assertSee('Silakan buat password baru pada form di bawah.')
                ->value('#password', 'ammad123')
                ->value('#password_confirmation', 'ammad123')
                ->press('Submit')
                ->assertPathIs('/');
        });
    }
}
