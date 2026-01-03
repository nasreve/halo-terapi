<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Therapist;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTherapistTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function therapist()
    {
        $password = $this->faker->password;

        return [
            'email' => $this->faker->email,
            'name' => $this->faker->name,
            'username' => $this->faker->userName,
            'whatsapp' => 12345678,
            'password' => $password,
            'password_confirmation' => $password
        ];
    }

    /**
     * Mendaftar terapis di step pertama.
     *
     * @test
     */
    public function step_one()
    {
        $response = $this->get('/therapist/register/step-1');

        $response->assertStatus(200);

        $therapist = $this->therapist();
        $response = $this->json('POST', '/therapist/register/step-1', $therapist);

        $response->assertStatus(201);
        $this->assertDatabaseHas('therapists', collect($therapist)->except(['password', 'password_confirmation'])->toArray());
    }

    /**
     * @test
     */
    public function therapist_redirect_to_step_two()
    {
        $therapist = Therapist::factory()->create();
        $therapist->update([
            'email_verified_at' => now(),
            'step' => 2
        ]);

        $response = $this->json('POST', route('therapist.login', [
            'email' => $therapist->email,
            'password' => 'admin123'
        ]));
        $response->assertRedirect(route('therapist.order.history'));

        $response = $this->actingAs($therapist)->get(route('therapist.order.history'));
        $response->assertRedirect(route('therapist.register.step-2'));
    }

    /**
    * @test
    */
    public function therapist_fill_form_step_two() {
        $therapist = Therapist::factory()->create();
        $therapist->update([
            'email_verified_at' => now(),
            'step' => 2
        ]);

        $response = $this->json('POST', route('therapist.login', [
            'email' => $therapist->email,
            'password' => 'admin123'
        ]));

        $data = [
            'name'                  => $this->faker->name,
            'photo_name'            => 'sample_therapist_04',
            'photo_path'            => 'dummy/photo.png',
            'province_id'           => '33',
            'regency_id'            => '3313',
            'district_id'           => '3313150',
            'village'               => 'Mojogedang',
            'address'               => 'Jalan Setapak, RT 03 RW 02, Dusun Mojogedang',
            'address_origin'        => 'Jl. Palem RT 05 RW IX Cemani, Grogol, Sukoharjo, Jawa Tengah 57552',
            'religion'              => 'Islam',
            'phone'                 => '81390990016',
            'whatsapp'              => '81390990016',
            'bank_name'             => 'Danamon',
            'bank_account'          => 'Sebastian Stan',
            'account_number'        => '777 888 999 2222',
            'year_of_graduate'      => '2020',
            'str_number'            => '1111-2222-3333-2222',
            'source'                => 'Instagram'
        ];
        $response = $this->json('POST', route('therapist.register.step2submit'), $data);

        $this->assertDatabaseHas('therapists', $data + ['id' => $therapist->id]);
        $response->assertRedirect(route('therapist.register.step-3'));
    }

    /**
     * @test
     */
    public function therapist_redirect_to_step_three()
    {
        $therapist = Therapist::factory()->create();
        $therapist->update([
            'email_verified_at' => now(),
            'step' => 3
        ]);

        $response = $this->json('POST', route('therapist.login', [
            'email' => $therapist->email,
            'password' => 'admin123'
        ]));
        $response->assertRedirect(route('therapist.order.history'));

        $response = $this->actingAs($therapist)->get(route('therapist.order.history'));
        $response->assertRedirect(route('therapist.register.step-3'));
    }

    /**
    * @test
    */
    public function therapist_fill_form_step_three() {
        $therapist = Therapist::factory()->create();
        $therapist->update([
            'email_verified_at' => now(),
            'step' => 3
        ]);

        $response = $this->json('POST', route('therapist.login', [
            'email' => $therapist->email,
            'password' => 'admin123'
        ]));
        $data = [
            'edu_history'           => 'Edu history, lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'workshop_history'      => 'Workshop history, lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'internship_experience' => 'Internship experience, lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'job_experience'        => 'Job experience, lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        ];
        $response = $this->json('POST', route('therapist.register.step3submit'), $data);

        $this->assertDatabaseHas('therapists', $data + ['id' => $therapist->id]);
        $response->assertRedirect(route('therapist.register.step-4'));
    }

    /**
     * @test
     */
    public function therapist_redirect_to_step_four()
    {
        $therapist = Therapist::factory()->create();
        $therapist->update([
            'email_verified_at' => now(),
            'step' => 4
        ]);

        $response = $this->json('POST', route('therapist.login', [
            'email' => $therapist->email,
            'password' => 'admin123'
        ]));
        $response->assertRedirect(route('therapist.order.history'));

        $response = $this->actingAs($therapist)->get(route('therapist.order.history'));
        $response->assertRedirect(route('therapist.register.step-4'));
    }

    /**
    * @test
    */
    public function therapist_fill_form_step_four() {
        $therapist = Therapist::factory()->create();
        $therapist->update([
            'email_verified_at' => now(),
            'step' => 4
        ]);

        $response = $this->json('POST', route('therapist.login', [
            'email' => $therapist->email,
            'password' => 'admin123'
        ]));

        $data = [
            'equipment'             => 'Equipment, lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'max_distance'          => '20',
            'max_duration'          => '60',
            'homecare'              => 'Homecare, lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'service_id'            => [1, 2],
            'rate'                  => [100000, 200000],
            'regency'               => [1101],
            'district'              => [1101010]
        ];
        $response = $this->json('POST', route('therapist.register.step4submit'), $data);

        $this->assertDatabaseHas('therapists', collect($data)->except(['service_id', 'rate', 'regency', 'district'])->toArray() + ['id' => $therapist->id]);

        for ($i=0; $i <= 1; $i++) {
            $this->assertDatabaseHas('therapist_services', [
                'therapist_id' => $therapist->id,
                'service_id' => $data['service_id'][$i],
                'rate' => $data['rate'][$i]
            ]);
        }

        $this->assertDatabaseHas('therapist_areas', [
            'therapist_id' => $therapist->id,
            'regency_id' => $data['regency'][0],
            'district_id' => $data['district'][0]
        ]);
        $response->assertOk();
    }
}