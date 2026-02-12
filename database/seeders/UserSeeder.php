<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cart;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@bookstore.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '1234567890',
            'address' => '123 Admin Street',
        ]);

        Cart::create(['user_id' => $admin->id]);

        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@bookstore.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '0987654321',
            'address' => '456 User Avenue',
        ]);

        Cart::create(['user_id' => $user->id]);
    }
}
