<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Brofit',
                'email' => 'brofitjp@outlook.com',
                'password' => Hash::make('admin123'),
                'blocked' => 0,
                'blocked_at' => null,
                'role' => 'Superadmin',
                'remember_token' => null
            ],
            [
                'name' => 'Difa Agung',
                'email' => 'difaap@gmail.com',
                'password' => Hash::make('difaaa123'),
                'blocked' => 0,
                'blocked_at' => null,
                'role' => 'Admin',
                'remember_token' => null
            ],
        ]);
    }
}
