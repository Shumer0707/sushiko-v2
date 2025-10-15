<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            CategorySeeder::class,      // 1. Сначала категории
            BrandSeeder::class,          // 2. Потом бренды
            AttributeSeeder::class,      // 3. Атрибуты (размер, острота)
            ProductSeeder::class,        // 4. И наконец продукты
            AdminUserSeeder::class,      // 5. Админ
        ]);

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'), // пароль
            'role' => 'user', // обычный пользователь
        ]);
    }
}
