<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TherapistAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('therapist_areas')->insert([
            [
                'id'           => '1',
                'therapist_id' => '1',
                'regency_id'   => '3313',
                'district_id'  => '3313150',
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                'id'           => '2',
                'therapist_id' => '2',
                'regency_id'   => '3313',
                'district_id'  => '3313080',
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                'id'           => '3',
                'therapist_id' => '3',
                'regency_id'   => '3313',
                'district_id'  => '3313090',
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                'id'           => '4',
                'therapist_id' => '4',
                'regency_id'   => '3313',
                'district_id'  => '3313060',
                'created_at'   => now(),
                'updated_at'   => now()
            ]
        ]);
    }
}
