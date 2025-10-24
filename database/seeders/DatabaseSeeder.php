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
            CategorySeeder::class,
            BrandSeeder::class,
            AttributeSeeder::class,
            ProductSeederHosomaki::class,
            ProductSeederUromaki::class,
            ProductSeederTempura::class,
            ProductSeederBurger::class,
            ProductSeederUdon::class,
            ProductSeederSoups::class,
            ProductSeederNigiri::class,
            ProductSeederGunkane::class,
            ProductSeederSashimi::class,
            ProductSeederSunomono::class,
            ProductSeederSets::class,
            ProductSeederDrink::class,
            // ProductAttributeSeeder::class,
            AdminUserSeeder::class,
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
