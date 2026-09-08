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
                'password' => Hash::make($password),
            ]
        );
    }
}
