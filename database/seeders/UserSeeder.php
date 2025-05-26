<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->delete();
        // admin kullanıcısı
        User::create([
            'name' => 'Test admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Admin Two',
            'email' => 'admin2@example.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Admin Three',
            'email' => 'admin3@example.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        // user kullanıcısı
        User::create([
            'name' => 'Test user',
            'email' => 'user@example.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
        ]);
    }
}
