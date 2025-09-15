<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Developer User',
                'email' => 'developer@gmail.com',
                'password' => Hash::make('12345'),
                'role' => 'developer'
            ],
            [
                'name' => 'Manager User',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('12345'),
                'role' => 'manager'
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345'),
                'role' => 'admin'
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('12345'),
                'role' => 'user'
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
            ]);
            $user->assignRole($userData['role']);
        }
    }
}
