<?php

namespace Tests\Browser;

use App\Models\Patient;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\URL;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    use WithFaker;

    /**
     * Register test.
     *
     * @return void
     */
    public function testRegister()
    {
        $email = $this->faker->safeEmail;

        $this->browse(function (Browser $browser) use ($email) {
            $browser->visit('/patient/register')
                ->waitForText('Register')
                ->value("[name='name']", $this->faker->name)
                ->select2("[name='province_id']")
                ->pause(200)
                ->select2("[name='regency_id']")
                ->pause(200)
                ->select2("[name='district_id']")
                ->pause(200)
                ->select2("[name='source']")
                ->value("[name='email']", $email)
                ->value("[name='password']", 'admin123')
                ->value("[name='password_confirmation']", 'admin123')
                ->scrollIntoView("[name='password_confirmation']")
                ->press('Submit')
                ->waitForText('Verifikasi')
                ->visit(URL::temporarySignedRoute(
                    'patient.verification.verify',
                    now()->addMinutes(60),
                    ['id' => Patient::where('email', $email)->first()->id, 'hash' => sha1(Patient::where('email', $email)->first()->email)]
                ))
                ->waitForText('Anda tidak sempat')
                ->assertSee('Anda tidak sempat');
        });
    }
}
