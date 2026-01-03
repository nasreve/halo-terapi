<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patients')->insert([
            [
                'name'              => 'Sherie Wright',
                'date_of_birth'     => '1998-12-21',
                'gender'            => 'Perempuan',
                'job'               => 'Akuntan',
                'phone_number'      => '87123212311',
                'whatsapp_number'   => '87123212311',
                'source'            => 'Whatsapp',
                'province_id'       => '33',
                'regency_id'        => '3311',
                'district_id'       => '3311100',
                'village'           => 'Sembarang',
                'address'           => 'Jl. Palem No.20',
                'address_origin'    => 'Jl. Palem No.20',
                'email'             => 'shewright@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('12345678'),
                'blocked'           => 0,
                'blocked_at'        => null,
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now()
            ],
            [
                'name'              => 'Adam Kim',
                'date_of_birth'     => '1991-08-17',
                'gender'            => 'Laki-Laki',
                'job'               => 'TNI',
                'phone_number'      => '87123212312',
                'whatsapp_number'   => '87123212312',
                'source'            => 'TikTok',
                'province_id'       => '33',
                'regency_id'        => '3310',
                'district_id'       => '3310210',
                'village'           => 'Sembarang',
                'address'           => 'Jl. Mangga No.21',
                'address_origin'    => 'Jl. Mangga No.21',
                'email'             => 'adamkim@outlook.com',
                'email_verified_at' => null,
                'password'          => Hash::make('12345678'),
                'blocked'           => 0,
                'blocked_at'        => null,
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now()
            ],
            [
                'name'              => 'Hutchinson',
                'date_of_birth'     => '1992-03-10',
                'gender'            => 'Perempuan',
                'job'               => 'PNS',
                'phone_number'      => '87123212313',
                'whatsapp_number'   => '87123212313',
                'source'            => 'YouTube',
                'province_id'       => '33',
                'regency_id'        => '3316',
                'district_id'       => '3316030',
                'village'           => 'Sembarang',
                'address'           => 'Jl. Semangka No.29',
                'address_origin'    => 'Jl. Semangka No.29',
                'email'             => 'hutchin@outlook.com',
                'email_verified_at' => null,
                'password'          => Hash::make('12345678'),
                'blocked'           => 1,
                'blocked_at'        => null,
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now()
            ],
            [
                'name'              => 'Tom Holland',
                'date_of_birth'     => '1992-03-10',
                'gender'            => 'Laki-laki',
                'job'               => 'PNS',
                'phone_number'      => '87123212314',
                'whatsapp_number'   => '87123212314',
                'source'            => 'YouTube',
                'province_id'       => '33',
                'regency_id'        => '3316',
                'district_id'       => '3316030',
                'village'           => 'Sembarang',
                'address'           => 'Jl. Semangka No.29',
                'address_origin'    => 'Jl. Semangka No.29',
                'email'             => 'tom.holland@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('12345678'),
                'blocked'           => 0,
                'blocked_at'        => null,
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now()
            ]
        ]);
    }
}
