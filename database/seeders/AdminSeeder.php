<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Cimol Enak',
            'email' => 'admin@cimolenak.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);
    }
} 