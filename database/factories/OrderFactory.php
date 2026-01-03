<?php

namespace Database\Factories;

use App\Http\Services\OrderService;
use App\Models\Order;
use App\Models\Patient;
use App\Models\Referrer;
use App\Models\Setting;
use App\Models\Therapist;
use Database\Seeders\SettingSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use faker\Provider\id_ID\Address;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $id = 1;
        $patient = $this->patient();
        $payment_status = $this->faker->randomElement(['Belum Dibayar', 'Sudah Dibayar']);
        $order_id = "HT" . now()->format('y') . now()->format('m') . now()->format('d') . str_pad($id, 3, "0", STR_PAD_LEFT);

        return [
            'id' => $id++,
            'order_id' => $order_id,
            'patient_id' => $patient->id,
            'therapist_id' => $this->faker->randomElement(Therapist::all()->pluck('id')->toArray()),
            'referrer_id' => random_int(1, 4),
            'buyer_name' => $patient->name,
            'buyer_age' => rand(20, 50),
            'buyer_gender' => $patient->gender,
            'buyer_job' => $patient->job,
            'buyer_phone' => $patient->phone_number,
            'buyer_whatsapp' => $patient->whatsapp_number,
            'buyer_email' => $patient->email,
            'buyer_province' => getProvinceName($patient->province_id),
            'buyer_regency' => getRegencyName($patient->regency_id),
            'buyer_district' => getDistrictName($patient->district_id),
            'buyer_sub_district' => $patient->village,
            'buyer_address' => $patient->address,
            'buyer_symptoms' => $this->faker->paragraph(3),
            'buyer_payment_method' => $this->faker->randomElement(['Transfer', 'Cash']),
            'buyer_bank_name' => $this->faker->randomElement(['BCA', 'BRI', 'Mandiri']),
            'buyer_account' => $this->setting()->bank_account,
            'buyer_account_number' => $this->setting()->account_number,
            'payment_status' => $payment_status,
            'payment_date' => $this->faker->dateTimeBetween('-1 Months'),
            'order_status' => $payment_status === "Sudah Dibayar" ? $this->faker->randomElement(['Selesai', 'Terjadwal']) : "Menunggu",
            'created_at' => now()->subDays(random_int(1, 10)),
            'updated_at' => now(),
        ];
    }

    public function patient()
    {
        if (Patient::count() == 0) {
            return Patient::factory()->create();
        }

        return Patient::inRandomOrder()->first();
    }

    public function setting()
    {
        if(Setting::count() == 0) {
            (new SettingSeeder)->run();
        }

        return Setting::first();
    }
}
