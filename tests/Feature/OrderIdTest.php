<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Services\OrderService;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderIdTest extends TestCase
{
    use RefreshDatabase;

    /**
    * @test
    */
    public function order_id_test() {
        $jumlah_order = 10;

        $order = Order::factory()->times($jumlah_order)->create();

        $order_id = OrderService::generateOrderId();

        $this->assertTrue($order_id == "HT" . now()->format('y') . now()->format('m') . now()->format('d') . str_pad($jumlah_order + 1, 3, "0", STR_PAD_LEFT));
    }
}
