<?php

namespace Database\Factories;

use App\Http\Services\FormWizardService;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Service;
use App\Models\TherapistService;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $id = 1;
        $service = $this->faker->randomElement([
            'Akupunktur Pengobatan',
            'Akupunktur Estetika',
            'Bekam',
            'Fisioterapi',
            'Fisioterapi Anak'
        ]);
        $service_id = Service::where('title', 'Akupunktur Pengobatan')->first()->id;
        $rate = TherapistService::where('service_id', $service_id)->first()->rate;
        $order_id = $this->faker->randomElement(Order::all()->pluck('id')->toArray());
        $order = Order::find($order_id);

        return [
            'id' => $id++,
            'order_id' => $order_id,
            'service' => $service,
            'rate' => $rate,
            'therapist_fee' => FormWizardService::getTherapistFee($rate),
            'vendor_fee' => FormWizardService::getVendorFee($rate, $order->referrer_id),
            'referrer_fee' => FormWizardService::getreRerrerFee($rate, $order->referrer_id),
            'created_at' => now()
        ];
    }
}
