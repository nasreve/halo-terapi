<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'therapist_fee'  => '70',
            'vendor_fee'     => '20',
            'referrer_fee'   => '10',
            'bank_name'      => 'BCA',
            'logo_path'      => 'assets/svg/etc/BCA.svg',
            'bank_account'   => 'Haloterapi',
            'account_number' => '999 888 777 666',
            'transport_note' => 'Biaya di atas tidak termasuk tarif transport. Admin haloterapi 
            akan segera mengubungi Anda melalui nomor telepon di atas untuk mencapai kesepakatan 
            biaya atau tarif transport.'
        ]);
    }
}
