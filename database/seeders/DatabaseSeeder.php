<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Patient;
use App\Models\Therapist;
use App\Models\TherapistArea;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(RegencySeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(TherapistSeeder::class);
        $this->call(TherapistAreaSeeder::class);
        $this->call(TherapistServiceSeeder::class);
        // Therapist::factory(100)->create();
        // TherapistArea::factory(100)->create();
        // $this->call(ReferrerSeeder::class);
        // Order::factory(100)->create();
        // OrderItem::factory(100)->create();

        // $this->updateOrder();
    }

    // public function updateOrder()
    // {
    //     $orders = Order::with('orderItems')->get();

    //     foreach ($orders as $index => $order) {
    //         $order->update([
    //             'transaction_amount' => $order->orderItems->sum('rate')
    //         ]);
    //     }
    // }
}
