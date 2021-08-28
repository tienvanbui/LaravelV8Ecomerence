<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [RoleSeeder::class,
            UserSeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            CategorySeeder::class,
            PaymentSeeder::class,
            ]
        );
    }
}
