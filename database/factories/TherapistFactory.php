<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Therapist;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class TherapistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Therapist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'                  => $this->faker->name,
            'username'              => $this->faker->userName,
            'email'                 => $this->faker->safeEmail,
            'password'              => Hash::make('admin123'),
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
            'year_of_graduate'      => '2020',
            'str_number'            => '1111-2222-3333-2222',
            'job_place'             => 'RS. Massachusetts',
            'job_hour'              => "Senin-Jum'at jam 08.00 s.d. 15.00 WIB",
            'job_address'           => '77 Massachusetts Ave, Cambridge, MA 02139, United States 57752',
            'source'                => 'Instagram',
            'email_verified_at'     => now(),
            'blocked'               => FALSE,
            'blocked_at'            => null,
            'edu_history'           => 'Edu history, lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'workshop_history'      => 'Workshop history, lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'internship_experience' => 'Internship experience, lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'job_experience'        => 'Job experience, lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'equipment'             => 'Equipment, lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'max_distance'          => '20',
            'max_duration'          => '60',
            'homecare'              => 'Homecare, lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'bank_name'             => 'Danamon',
            'bank_account'          => 'Sebastian Stan',
            'account_number'        => '777 888 999 2222',
            'status'                => 'Disetujui',
            'step'                  => '1',
            'remember_token'        => null,
            'created_at'            => now(),
            'updated_at'            => now(),
        ];
    }
}
