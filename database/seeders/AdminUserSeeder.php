<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // наш админ
            [
                'name' => 'Admin',
                'password' => Hash::make('password'), // замени на свой пароль
                'role' => 'admin', // важно, чтобы в таблице users было поле role
            ]
        );
    }
}
