<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TherapistLogin extends TestCase
{
    /**
     * Melihat login page.
     *
     * @test
     * @return void
     */
    public function login_page()
    {
        $response = $this->get('/therapist');

        $response->assertStatus(200);
    }

    /**
     * Melakukan proses login
     *
     * @test
     * @return void
     */
    public function login_action()
    {
        $response = $this->post('/therapist', [
            'email' => 'sebastian.stan@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        $response->assertStatus(200);
    }
}
