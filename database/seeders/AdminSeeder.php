<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $username = env('ADMIN_USERNAME', 'admin');
        $password = env('ADMIN_PASSWORD', 'sauqi123');

        User::updateOrCreate(
            ['username' => $username],
            [
                'name' => 'Admin Ar-Raudhah',
                'email' => $username . '@arraudhah.id',
                'role' => 'Administrator',
                'password' => Hash::make($password),
            ]
        );

        // Akun contoh Penguji TPQ
        User::updateOrCreate(
            ['username' => 'penguji_tpq'],
            [
                'name' => 'Ustadz Ahmad Al-Hafidz',
                'email' => 'ahmad@arraudhah.id',
                'role' => 'Penguji TPQ',
                'password' => Hash::make('tpq123'),
            ]
        );

        // Akun contoh Penguji RTQ
        User::updateOrCreate(
            ['username' => 'penguji_rtq'],
            [
                'name' => 'Ustadzah Fatimah Az-Zahra',
                'email' => 'fatimah@arraudhah.id',
                'role' => 'Penguji RTQ',
                'password' => Hash::make('rtq123'),
            ]
        );
    }
}
