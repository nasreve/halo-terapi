<?php

namespace Tests\Browser;

use App\Models\Therapist;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\URL;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TherapistRegisterTest extends DuskTestCase
{
    use WithFaker;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testTherapistRegister()
    {
        $name = $this->faker->name;
        $email = $this->faker->safeEmail;
        $image = $this->faker->image('/tmp', 1080, 1920);

        $this->browse(function (Browser $browser) use ($name, $email, $image) {
            $browser->visit('/therapist/register/step-1')
                ->value('#name', $name)
                ->value('#username', str_replace(' ', '', $name))
                ->value('#email', $email)
                ->value('#password', 'admin123')
                ->value('#password_confirmation', 'admin123')
                ->press('Submit')
                ->waitForText('Verifikasi')
                ->visit(URL::temporarySignedRoute(
                    'therapist.verification.verify',
                    now()->addMinutes(60),
                    ['id' => Therapist::where('email', $email)->first()->id, 'hash' => sha1(Therapist::where('email', $email)->first()->email)]
                ))
                ->waitForText('Lengkapi Data Personal')
                ->value('#str_number', $this->faker->uuid)
                ->select2('#province_id')
                ->pause(200)
                ->select2('#regency_id')
                ->pause(200)
                ->select2('#district_id')
                ->value('#village', $this->faker->streetAddress)
                ->value('#address', $this->faker->address)
                ->value('#address_origin', $this->faker->address)
                ->select2('#religion')
                ->value('#phone', $this->faker->numberBetween(80000000000, 9999999999))
                ->value('#whatsapp', $this->faker->numberBetween(80000000000, 9999999999))
                ->attach('#photo_path', $image)
                ->value('#year_of_graduate', 2012)
                ->value('#job_place', $this->faker->address)
                ->value('#job_hour', $this->faker->time())
                ->value('#job_address', $this->faker->address)
                ->select2('#source')
                ->value('#bank_name', 'Mandiri')
                ->value('#bank_account', $this->faker->name)
                ->value('#account_number', $this->faker->bankAccountNumber)
                ->press('Selanjutnya')
                ->waitForText('Pengalaman')
                ->type('#collapse-1 div.note-editable.card-block', 'Lorem ipsum dolot sit amet')
                ->press('Riwayat seminar dan pelatihan')
                ->type('#collapse-2 div.note-editable.card-block', 'Lorem ipsum dolot sit amet')
                ->press('Pengalaman praktik kerja lapangan (PKL)')
                ->type('#collapse-3 div.note-editable.card-block', 'Lorem ipsum dolot sit amet')
                ->press('Pengalaman kerja')
                ->type('#collapse-4 div.note-editable.card-block', 'Lorem ipsum dolot sit amet')
                ->press('Selanjutnya')
                ->waitForText('Layanan')
                ->click('#label-service-4')
                ->value('#rate-4', 750000)
                ->click('#label-service-8')
                ->value('#rate-8', 1000000)
                ->press('Lokasi pelayanan')
                ->pause(500)
                ->select2('#regency-1', 'Kabupaten Simeulue', 10)
                ->select2('#district-1', 'Teupah Selatan')
                ->pause(500)
                ->press('Peralatan yang dimiliki')
                ->pause(500)
                ->type('#collapse-3 div.note-editable.card-block', 'Lorem ipsum dolot sit amet')
                ->press('Jadwal pelayanan home care')
                ->pause(500)
                ->type('#collapse-4 div.note-editable.card-block', 'Lorem ipsum dolot sit amet')
                ->press('Maksimal jarak tempuh melayani')
                ->value('#max_distance', 10)
                ->value('#max_duration', 10)
                ->press('Selanjutnya')
                ->waitForText('Di sini adalah Dashboard untuk mengelola pesanan Anda.')
                ->assertSee('Di sini adalah Dashboard untuk mengelola pesanan Anda.');
        });
    }
}
