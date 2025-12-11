<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Admin KMP BPN',
                'username' => 'adminkmp',
                'email' => 'admin@dev.com',
                'password' => bcrypt('Minimal8'),
                'role' => 0,
            ],
            [
                'name' => 'Staff KMP BPN',
                'username' => 'staffkmp',
                'email' => 'staff@dev.com',
                'password' => bcrypt('Minimal8'),
                'role' => 1,
            ],
            [
                'name' => 'Petugas Arsip KMP BPN',
                'username' => 'petugaskmp',
                'email' => 'petugas@dev.com',
                'password' => bcrypt('Minimal8'),
                'role' => 2,
            ],
            [
                'name' => 'Kepala Subseksi KMP BPN',
                'username' => 'kepsubseksikmp',
                'email' => 'kepsubseksi@dev.com',
                'password' => bcrypt('Minimal8'),
                'role' => 3,
            ],
            [
                'name' => 'Kepala Seksi KMP BPN',
                'username' => 'kepseksikmp',
                'email' => 'kepseksi@dev.com',
                'password' => bcrypt('Minimal8'),
                'role' => 4,
            ],
        ];

        foreach ($user as $key => $value) {
            \App\Models\User::create($value);
        }
    }
}
