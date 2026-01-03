<?php

namespace Database\Seeders;

use App\Models\Therapist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TherapistServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for ($i = 1; $i <= Therapist::count(); $i++) {
            for ($j = 1; $j <= 12; $j++) {
                $data[] = [
                    'therapist_id' => $i,
                    'service_id' => $j,
                    'rate' => 900000,
                    'status' => 'Diterima'
                ];
            }
        }

        DB::table('therapist_services')->insert($data);

        // DB::table('therapist_services')->insert([
        //     // Therapist 1 (12 service item)
        //     [
        //         'id'           => '1',
        //         'therapist_id' => '1',
        //         'service_id'   => '1',
        //         'rate'         => 10000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '2',
        //         'therapist_id' => '1',
        //         'service_id'   => '2',
        //         'rate'         => 20000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '3',
        //         'therapist_id' => '1',
        //         'service_id'   => '3',
        //         'rate'         => 30000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '4',
        //         'therapist_id' => '1',
        //         'service_id'   => '4',
        //         'rate'         => 40000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '5',
        //         'therapist_id' => '1',
        //         'service_id'   => '5',
        //         'rate'         => 50000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '6',
        //         'therapist_id' => '1',
        //         'service_id'   => '6',
        //         'rate'         => 60000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '7',
        //         'therapist_id' => '1',
        //         'service_id'   => '7',
        //         'rate'         => 70000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '8',
        //         'therapist_id' => '1',
        //         'service_id'   => '8',
        //         'rate'         => 80000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '9',
        //         'therapist_id' => '1',
        //         'service_id'   => '9',
        //         'rate'         => 90000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '10',
        //         'therapist_id' => '1',
        //         'service_id'   => '10',
        //         'rate'         => 100000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '11',
        //         'therapist_id' => '1',
        //         'service_id'   => '11',
        //         'rate'         => 110000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '12',
        //         'therapist_id' => '1',
        //         'service_id'   => '12',
        //         'rate'         => 120000,
        //         'status'       => 'Diterima'
        //     ],

        //     // Therapist 2 (8 service item)
        //     [
        //         'id'           => '13',
        //         'therapist_id' => '2',
        //         'service_id'   => '1',
        //         'rate'         => 10000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '14',
        //         'therapist_id' => '2',
        //         'service_id'   => '2',
        //         'rate'         => 20000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '15',
        //         'therapist_id' => '2',
        //         'service_id'   => '3',
        //         'rate'         => 30000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '16',
        //         'therapist_id' => '2',
        //         'service_id'   => '4',
        //         'rate'         => 40000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '17',
        //         'therapist_id' => '2',
        //         'service_id'   => '5',
        //         'rate'         => 50000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '18',
        //         'therapist_id' => '2',
        //         'service_id'   => '6',
        //         'rate'         => 60000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '19',
        //         'therapist_id' => '2',
        //         'service_id'   => '7',
        //         'rate'         => 70000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '20',
        //         'therapist_id' => '2',
        //         'service_id'   => '8',
        //         'rate'         => 80000,
        //         'status'       => 'Diterima'
        //     ],

        //     // Therapist 3 (4 service item)
        //     [
        //         'id'           => '21',
        //         'therapist_id' => '3',
        //         'service_id'   => '1',
        //         'rate'         => 10000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '22',
        //         'therapist_id' => '3',
        //         'service_id'   => '2',
        //         'rate'         => 20000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '23',
        //         'therapist_id' => '3',
        //         'service_id'   => '3',
        //         'rate'         => 30000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '24',
        //         'therapist_id' => '3',
        //         'service_id'   => '4',
        //         'rate'         => 40000,
        //         'status'       => 'Diterima'
        //     ],

        //     // Therapist 4 (2 service item)
        //     [
        //         'id'           => '25',
        //         'therapist_id' => '4',
        //         'service_id'   => '1',
        //         'rate'         => 10000,
        //         'status'       => 'Diterima'
        //     ],
        //     [
        //         'id'           => '26',
        //         'therapist_id' => '4',
        //         'service_id'   => '2',
        //         'rate'         => 20000,
        //         'status'       => 'Diterima'
        //     ]
        // ]);
    }
}
