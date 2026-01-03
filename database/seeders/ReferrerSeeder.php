<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferrerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('referrers')->insert([
            [
                'id' => 1,
                'therapist_id' => null,
                'patient_id' => 1,
                'business_community'=> 'Himpunan Gamers Muda Indonesia',
                'business_name' => 'CV. Gajah Duduk',
                'business_address' => 'Jl. Mangga',
                'bank_name' => 'BCA',
                'bank_account' => 'Utomo Broyoto',
                'account_number' => '0878-8189-0000-1546',
                'unique_reff' => '1901',
                'blocked' => 0,
                'created_at' => now(),
                'updated_at' => now() 
            ],
            [
                'id' => 2,
                'therapist_id' => 1,
                'patient_id' => null,
                'business_community'=> 'Himpunan Pengusaha Muda Indonesia',
                'business_name' => 'CV. Cahaya Abadi',
                'business_address' => 'Jl. Mangga',
                'bank_name' => 'BRI',
                'bank_account' => 'Pranoto Silah',
                'account_number' => '2818-9889-0000-1926',
                'unique_reff' => '1905',
                'blocked' => 0,
                'created_at' => now(),
                'updated_at' => now()       
            ],
            [
                'id' => 3,
                'therapist_id' => null,
                'patient_id' => 2,
                'business_community'=> 'Himpunan Programmer Muda Indonesia',
                'business_name' => 'CV. Hujan Turun',
                'business_address' => 'Jl. Mangga',
                'bank_name' => 'Mandiri',
                'bank_account' => 'Utomo Broyoto',
                'account_number' => '0878-8189-0000-1546',
                'unique_reff' => '1906',
                'blocked' => 0,
                'created_at' => now(),
                'updated_at' => now()     
            ],
            [
                'id' => 4,
                'therapist_id' => 2,
                'patient_id' => null,
                'business_community'=> 'Himpunan Bisnis Muda Indonesia',
                'business_name' => 'CV. Panas Sekali',
                'business_address' => 'Jl. Mangga',
                'bank_name' => 'BNI',
                'bank_account' => 'Utomo Broyoto',
                'account_number' => '0878-8189-0000-1546',
                'unique_reff' => '1907',
                'blocked' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'therapist_id' => null,
                'patient_id' => 3,
                'business_community'=> 'Himpunan Pembalap Muda Indonesia',
                'business_name' => 'CV. Sukses Abadi',
                'business_address' => 'Jl. Mangga',
                'bank_name' => 'Sinar Mas',
                'bank_account' => 'Utomo Broyoto',
                'account_number' => '0878-8189-0000-1546',
                'unique_reff' => '1908',
                'blocked' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
