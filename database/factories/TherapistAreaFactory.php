<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Regency;
use App\Models\Therapist;
use App\Models\TherapistArea;
use Illuminate\Database\Eloquent\Factories\Factory;

class TherapistAreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TherapistArea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $distircts = District::where('regency_id', 3316)->pluck('id')->toArray();

        return [
            'therapist_id' => $this->faker->randomElement(Therapist::all()->pluck('id')->toArray()),
            'regency_id' => 3316,
            'district_id' => 3316030
        ];
    }
}
