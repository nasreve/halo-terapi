<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LandingTest extends TestCase
{
    /**
     * Test memilih pesanan di landing page.
     * Melihat apakah data di session sesuai dengan layanan yang telah dipilih.
     *
     * @test
     * @return \Illuminate\Testing\TestResponse
     */
    public function choose_service()
    {
        $service_id = random_int(1, 12);

        $response = $this->post('/order', ['service_id' => $service_id], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        $session_data = collect();
        $session_data->push([
            'service_id' => $service_id
        ]);

        $response->assertSessionHas('orderVisitor', $session_data);
    }

    /**
     * Cek apakah tombol pesan berubah sesuai dengan layanan yang di pilih
     *
     * @test
     * @return void
     */
    public function choose_service_view()
    {
        $service_id = random_int(1, 12);

        $session_data = collect();
        $session_data->push([
            'service_id' => $service_id
        ]);

        $response = $this
            ->withSession(['orderVisitor' => $session_data])
            ->get('/');

        $response->assertSeeText('Anda memesan 1 layanan');
    }
}
