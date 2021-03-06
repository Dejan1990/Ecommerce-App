<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\AttributesTableSeeder;
use Database\Seeders\AttributeValuesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory()->create([
            'first_name' => 'Admin',
            'email' => 'admin@admin.com',
            'is_admin' => true
        ]);

        User::factory()->create([
            'first_name' => 'Lucy',
            'email' => 'lucy@mail.com'
        ]);

        //$this->call(AdminsTableSeeder::class); ovo mogu da napravim za admina umesto ovo iznad

        $this->call([
            SettingSeeder::class,
            CategorySeeder::class,
            AttributesTableSeeder::class,
            AttributeValuesTableSeeder::class
        ]);
    }
}
