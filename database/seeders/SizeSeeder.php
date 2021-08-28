<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;
class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Size::create(['size_name' =>'sm']);
        Size::create(['size_name' =>'m']);
        Size::create(['size_name' =>'l']);
        Size::create(['size_name' =>'xl']);
    }
}
