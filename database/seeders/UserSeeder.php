<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Calvin',
            'username' => 'calvins',
            'email' => 'calvin@example.com',
            'password' => Hash::make('calvin'),
            'role' => 'admin_seller',
            'phone' => '08123456789',
            'address' => 'Jakarta',
            'gender' => 'Male',
            'store_id' => 1,
            'modified_by' => 'system',
            'modified_date' => now(),
            'created_by' => 'system',
            'created_date' => now(),
        ]);
        User::create([
            'name' => 'Jeje',
            'username' => 'jeje',
            'email' => 'jeje@example.com',
            'password' => Hash::make('jeje'),
            'role' => 'admin_seller',
            'phone' => '08123456789',
            'gender' => 'Female',
            'address' => 'Jakarta',
            'store_id' => 2,
            'modified_by' => 'system',
            'modified_date' => now(),
            'created_by' => 'system',
            'created_date' => now(),
        ]);
        User::create([
            'name' => 'andre',
            'username' => 'andre',
            'email' => 'andre@example.com',
            'password' => Hash::make('andre'),
            'role' => 'user',
            'phone' => '08123456789',
            'address' => 'Jakarta',
            'gender' => 'Male',
            'store_id' => 1,
            'modified_by' => 'system',
            'modified_date' => now(),
            'created_by' => 'system',
            'created_date' => now(),
        ]);
    }
}
